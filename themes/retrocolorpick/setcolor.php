<?php
	session_start();
	ini_set('session.use_only_cookies', '1');
	$arrPossibleThemeColors = array("red", "blue", "green", "pink", "orange", "gray");
	if(in_array($_POST['themeColor'], $arrPossibleThemeColors)) {
		
		$_SESSION['rcpThemeColor'] = $_POST['themeColor'];
		
		echo "
			<script type='text/javascript'>
				location.reload();
			</script>
			
		";
		
	}

?>