<?php

	function replaceRichTextEditor() {

		$GLOBALS['richtextEditor'] = "
			
			CKEDITOR.replace('".$GLOBALS['rtCompID']."');
		
		";
		
	}

	$hooksObj->addHook("form_richtexteditor", "replaceRichTextEditor");
	
?>