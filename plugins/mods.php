<?php

	

	function minecraftSkins() {
		global $arrSections;
		
		$arrSections = addArraySpace($arrSections, 5, 2);
		
		$arrSections[2] = "include/profile/_minecraftskin.php";

	}

	$hooksObj->addHook("profile_sections", "minecraftSkins");
	
	
	
	
	include(BASE_DIRECTORY."plugins/donations/include/menu_module.php");
	
?>