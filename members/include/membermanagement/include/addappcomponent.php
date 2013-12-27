<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2012
 *
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 *
 * License: http://www.bluethrust.com/license.php
 *
 */


include_once("../../../../_setup.php");
include_once("../../../../classes/member.php");
include_once("../../../../classes/basicorder.php");



$consoleObj = new ConsoleOption($mysqli);
$member = new Member($mysqli);
$member->select($_SESSION['btUsername']);

$cID = $consoleObj->findConsoleIDByName("Member Application");
$consoleObj->select($cID);

$appComponentObj = new BasicOrder($mysqli, "app_components", "appcomponent_id");


if($member->authorizeLogin($_SESSION['btPassword']) && $member->hasAccess($consoleObj)) {
	$countErrors = 0;
	$dispError = "";
	if($_POST['saveComponent']) {
		
		// Check Component Name
		
		if(trim($_POST['newComponentName']) == "") {
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You can't have a blank component name.<br>";
			$countErrors++;
		}
		
		$arrOptionTypes = array("input", "largeinput", "select", "multiselect");
		if(!in_array($_POST['newComponentType'], $arrOptionTypes)) {
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid component type.<br>";
			$countErrors++;
		}
		
		
		
		if($countErrors == 0) {
			
			
			if($appComponentObj->getHighestOrderNum() == "") {
				$componentOrderNum = $appComponentObj->validateOrder("first", "before");	
			}
			else {
				$appComponentObj->selectByOrder(1);
				$componentOrderNum = $appComponentObj->makeRoom("after");
			}
			
			if($_POST['newComponentRequired'] != 0) {
				$_POST['newComponentRequired'] = 1;
			}
			
			$arrColumns = array("name", "componenttype", "ordernum", "required", "tooltip");
			$arrValues = array($_POST['newComponentName'], $_POST['newComponentType'], $componentOrderNum, $_POST['newComponentRequired'], $_POST['newComponentTooltip']);
			
			if($appComponentObj->addNew($arrColumns, $arrValues)) {
				
				if($_POST['newComponentType'] == "select" || $_POST['newComponentType'] == "multiselect") {
					$appComponentSelectOptionObj = new Basic($mysqli, "app_selectvalues", "appselectvalue_id");
					$newComponentID = $appComponentObj->get_info("appcomponent_id");
					foreach($_SESSION['btAppComponent']['cOptions'] as $optionValue) {
						$appComponentSelectOptionObj->addNew(array("appcomponent_id", "componentvalue"), array($newComponentID, $optionValue));
					}
					
				}
				
				$member->logAction("Added a new member application component.");
				echo "
					<div id='addAppComponentSuccess' style='display: none'>
						<p class='main' align='center'>
							New Member Application Component Added!<br><br>
							Click OK to continue modifying the member application.
						</p>
					</div>
					
					<script type='text/javascript'>
						$(document).ready(function() {
							
							$('#addAppComponentSuccess').dialog({
							
								title: 'Add Application Component',
								modal: true,
								zIndex: 99999,
								show: 'scale',
								width: 450,
								resizable: false,
								buttons: {
									'OK': function() {
									
										$('#loadingSpiral').show();
										$('#appComponentList').fadeOut(250);
										$.post('".$MAIN_ROOT."members/include/membermanagement/include/appcomponentlist.php', { }, function(data) {
											$('#appComponentList').html(data);
											$('#loadingSpiral').hide();
											$('#appComponentList').fadeIn(250);				
										});
									
									
										$(this).dialog('close');
									}
								}
							
							});
							
							$('#appComponentForm').dialog('close');
							
						
						});
					</script>
					
				";
				
				
			}
			else {
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to the database.  Please contact the website administrator.<br>";
				$countErrors++;
			}
			
		}
		
		
		if($countErrors == 0) {
			echo "
				<script type='text/javascript'>
					$(document).ready(function() {
					
						$('#addAppComponentFormDialog').hide();
					
					});
				</script>
			";
		}
		
	}
	
	if(!$_POST['saveComponent']) {
		$_SESSION['btAppComponent']['cOptions'] = array();
	}
	
	$selectedLargeInput = "";
	$selectedSelect = "";
	$selectedMultiSelect = "";
	if($_POST['newComponentType'] == "largeinput") {
		$selectedLargeInput = " selected";	
	}
	elseif($_POST['newComponentType'] == "select") {
		$selectedSelect = " selected";
	}
	elseif($_POST['newComponentType'] == "multiselect") {
		$selectedMultiSelect = " selected";
	}
	
	
	if($dispError != "") {
		echo "
		<div class='errorDiv' style='width: 90%'>
		<strong>Unable to add new application component because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
	
		
	
		<div id='addAppComponentFormDialog'>
			<table class='formTable' style='width: 90%'>
				<tr>
					<td class='main' style='width: 25%'><b>Name:</b></td>
					<td class='main' style='width: 75%'><input type='text' class='textBox' value='".$_POST['newComponentName']."' id='componentName'></td>
				</tr>
				<tr>
					<td class='main' style='width: 25%'><b>Type:</b></td>
					<td class='main' style='width: 75%'>
						<select id='componentType' class='textBox'>
							<option value='input'>Input</option>
							<option value='largeinput'".$selectedLargeInput.">Large-Input</option>
							<option value='select'".$selectedSelect.">Select</option>
							<option value='multiselect'".$selectedMultiSelect.">Multi-Select</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class='main' style='width: 25%'><b>Required:</b></td>
					<td class='main' style='width: 75%'><input type='checkbox' id='componentRequiredCB'><input type='hidden' id='componentRequired' value='0'></td>
				</tr>
				<tr>
					<td class='main' style='width: 25%' valign='top'><b>Tooltip:</b></td>
					<td class='main' style='width: 75%'>
						<textarea style='width: 200px; height: 40px' id='componentTooltip' class='textBox'></textarea>
					</td>
				</tr>
			</table>
			
			<div id='moreComponentOptions' style='display: none'>
			
				<table class='formTable' style='width: 90%'>
					<tr>
						<td class='main dottedLine' colspan='2'>
							<b>Selectable Options</b>
						</td>
					</tr>
					<tr>
						<td class='main' style='width: 25%'><b>Option Value:</b></td>
						<td class='main' style='width: 75%'><input type='text' id='optionValue' class='textBox'> <input type='button' id='addOptionValueBtn' class='submitButton' value='Add'></td>
					</tr>
					<tr>
						<td class='main' style='width: 25%' valign='top'><b>Option List:</td></td>
						<td class='main' style='width: 75%' valign='top'>
							<div id='optionValueList' style='height: 75px; overflow: auto'></div>
						</td>
					</tr>		
				</table>
			
			</div>
		</div>
		<script type='text/javascript'>
			
			$(document).ready(function() {
				
			
				$('#componentRequiredCB').click(function() {
					
					if($(this).is(':checked')) {
						$('#componentRequired').val('1');
					}
					else {
						$('#componentRequired').val('0');
					}
					
				});
			
				$('#componentType').change(function() {
				
					if($('#componentType').val() == 'select' || $('#componentType').val() == 'multiselect') {
						$('#moreComponentOptions').show();					
					}
					else {
						$('#moreComponentOptions').hide();
					}
				
				});
				
				$('#addOptionValueBtn').click(function() {
				
					$('#optionValueList').fadeOut(250);
					$.post('".$MAIN_ROOT."members/include/membermanagement/include/appcomponentcache.php', { action: 'add', newOptionValue: $('#optionValue').val() }, function(data) {
						$('#optionValueList').html(data);
						$('#optionValue').val('');
						$('#optionValueList').fadeIn(250);
					});
				
				});
				
				
				
				$.post('".$MAIN_ROOT."members/include/membermanagement/include/appcomponentcache.php', { }, function(data) {
					$('#optionValueList').html(data);				
				});
			
				$('#componentType').change();
				
			});
		
			function deleteOptionValue(intValueKey) {
			
				$(document).ready(function() {
					$('#optionValueList').fadeOut(250);
					$.post('".$MAIN_ROOT."members/include/membermanagement/include/appcomponentcache.php', { action: 'delete', deleteOptionKey: intValueKey }, function(data) {
						$('#optionValueList').html(data);
						$('#optionValue').val('');
						$('#optionValueList').fadeIn(250);
					});
				});
			
			}
			
			
		</script>
	
	";
	
	
}


?>