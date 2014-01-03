<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2014
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
	
	
	if($appComponentObj->select($_POST['appCompID'])) {
		
		$appCompInfo = $appComponentObj->get_info_filtered();
		$appComponentObj->set_assocTableName("app_selectvalues");
		$appComponentObj->set_assocTableKey("appselectvalue_id");
		
		$countErrors = 0;
		$dispError = "";
		
		if($_POST['saveComponent']) {
			
			
			// Check Component Name
			
			if(trim($_POST['saveComponentName']) == "") {
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You can't have a blank component name.<br>";
				$countErrors++;
			}
			
			$arrOptionTypes = array("input", "largeinput", "select", "multiselect", "captcha", "captchaextra");
			if(!in_array($_POST['saveComponentType'], $arrOptionTypes)) {
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid component type.<br>";
				$countErrors++;
			}
			
			
			
			if($countErrors == 0) {
				
				if($_POST['saveComponentRequired'] != 0) {
					$_POST['saveComponentRequired'] = 1;
				}
				
				$arrColumns = array("name", "componenttype", "required", "tooltip");
				$arrValues = array($_POST['saveComponentName'], $_POST['saveComponentType'], $_POST['saveComponentRequired'], $_POST['saveComponentTooltip']);
				

				if($appComponentObj->update($arrColumns, $arrValues)) {
					if($appCompInfo['componenttype'] == "select" || $appCompInfo['componenttype'] == "multiselect") {
						$mysqli->query("DELETE FROM ".$dbprefix."app_selectvalues WHERE appcomponent_id = '".$appCompInfo['appcomponent_id']."'");
					}
					
					
					if($_POST['saveComponentType'] == "select" || $_POST['saveComponentType'] == "multiselect") {
						$appComponentSelectOptionObj = new Basic($mysqli, "app_selectvalues", "appselectvalue_id");
						foreach($_SESSION['btAppComponent']['cOptions'] as $optionValue) {
							$appComponentSelectOptionObj->addNew(array("appcomponent_id", "componentvalue"), array($appCompInfo['appcomponent_id'], $optionValue));
						}
					}
					
					
					$member->logAction("Modified the member application.");
					
					echo "
					
						<div id='editAppComponentSuccess' style='display: none'>
							<p class='main' align='center'>
								Member Application Component Saved!<br><br>
								Click OK to continue modifying the member application.
							</p>
						</div>
						
						<script type='text/javascript'>
							$(document).ready(function() {
								
								$('#editAppComponentSuccess').dialog({
								
									title: 'Edit Application Component',
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
			
			
			if($countErrors > 0) {
				$_POST['saveComponent'] = false;
			}
			
			
			
		}
		
		
		if(!$_POST['saveComponent']) {
		
			
			
			if(($appCompInfo['componenttype'] == "select" || $appCompInfo['componenttype'] == "multiselect") && $countErrors == 0) {
				$appSelectOptionObj = new Basic($mysqli, "app_selectvalues", "appselectvalue_id");
				$arrSelectValues = $appComponentObj->getAssociateIDs();
			
				$tempArr = array();
				foreach($arrSelectValues as $selectValueID) {
					
					$appSelectOptionObj->select($selectValueID);
					$appSelectValue = $appSelectOptionObj->get_info_filtered("componentvalue");
					
					$tempArr[$selectValueID] = $appSelectValue;
				}
				
				asort($tempArr);
	
				$_SESSION['btAppComponent']['cOptions'] = $tempArr;
				
			}
			elseif($countErrors == 0) {
				$_SESSION['btAppComponent']['cOptions'] = array();
			}
			
			
			$selectedLargeInput = "";
			$selectedSelect = "";
			$selectedMultiSelect = "";
			
			$selectedTypeOptions = array();
			$selectedTypeOptions[$appCompInfo['componenttype']] = " selected";
			
			
			if($dispError != "") {
				echo "
				<div class='errorDiv' style='width: 90%'>
				<strong>Unable to edit application component because the following errors occurred:</strong><br><br>
				$dispError
				</div>
				";
			}
			
			$checkRequired = "";
			if($appCompInfo['required'] == 1) {
				$checkRequired = " checked";
			}
			
			
			echo "
			
				<table class='formTable' style='width: 90%'>
					<tr>
						<td class='main' style='width: 25%'><b>Name:</b></td>
						<td class='main' style='width: 75%'><input type='text' class='textBox' value='".$appCompInfo['name']."' id='componentName'></td>
					</tr>
					<tr>
						<td class='main' style='width: 25%'><b>Type:</b></td>
						<td class='main' style='width: 75%'>
							<select id='componentType' class='textBox'>
								<option value='input'>Input</option>
								<option value='largeinput'".$selectedTypeOptions['largeinput'].">Large-Input</option>
								<option value='select'".$selectedTypeOptions['select'].">Select</option>
								<option value='multiselect'".$selectedTypeOptions['multiselect'].">Multi-Select</option>
								<option value='captcha'".$selectedTypeOptions['captcha'].">Captcha</option>
								<option value='captchaextra'".$selectedTypeOptions['captchaextra'].">Captcha - Extra Distortion</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='main' style='width: 25%'><b>Required:</b></td>
						<td class='main' style='width: 75%'><input type='checkbox' id='componentRequiredCB'".$checkRequired."><input type='hidden' id='componentRequired' value='".$appCompInfo['required']."'><span id='captchaMessage' class='tinyFont' style='display: none'><i>Captcha's are automatically required.</i></span></td>
					</tr>
					<tr>
						<td class='main' style='width: 25%' valign='top'><b>Tooltip:</b></td>
						<td class='main' style='width: 75%'>
							<textarea style='width: 200px; height: 40px' id='componentTooltip' class='textBox'>".$appCompInfo['tooltip']."</textarea>
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
					
						if($('#componentType').val() == 'captcha' || $('#componentType').val() == 'captchaextra') {
							$('#componentRequiredCB').attr('disabled', 'disabled');
							$('#captchaMessage').show();
						}
						else {
							$('#componentRequiredCB').attr('disabled', false);
							$('#captchaMessage').hide();
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
		
		
		
		
	}
	else {
		echo "
			<script type='text/javascript'>
				$(document).ready(function() {
					$('#appComponentForm').dialog('close');
				});
			</script>
		";
	}
	
}



?>