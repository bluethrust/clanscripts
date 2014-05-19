<?php

	if(!defined("LOGGED_IN") || !LOGGED_IN) { die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."'</script>"); }
	
	
		
	$hooksObj->run("console_forms");
	$formObj->buildForm($setupFormArgs);
	
	
	if($_POST['submit']) {
		
		if($formObj->save()) {
			
			$popupLink = ($formObj->saveLink == "") ? $MAIN_ROOT."members" : $formObj->saveLink;
			
			if($formObj->saveMessage != "") {
				echo "
				
					<div style='display: none' id='successBox'>
						<p align='center'>
							".$formObj->saveMessage."
						</p>
					</div>
					
					<script type='text/javascript'>
						popupDialog('".$consoleInfo['pagetitle']."', '".$popupLink."', 'successBox');
					</script>
				
				";
			}
			else {

				echo "
					<script type='text/javascript'>
						window.location = '".$popupLink."'
					</script>
				";
				
			}
				
		}
		

		if(count($formObj->errors) > 0) {
			$_POST = filterArray($_POST);
			if($formObj->prefillValues) {
				$formObj->prefillPostedValues();
			}
			$_POST['submit'] = false;		
		}
		
		
	}
	
	
	if(!$_POST['submit']) {
		$formObj->show();	
	}
	
	
	
?>