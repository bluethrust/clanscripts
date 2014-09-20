<?php
	header("Content-type: text/css");
	session_start();
	$THEME_COLOR = (!isset($_SESSION['rcpThemeColor']) || $_SESSION['rcpThemeColor'] == "") ? "blue" : $_SESSION['rcpThemeColor'];

	$arrRCPThemeColors = array(
		"red" => "darkred", 
		"blue" => "darkblue", 
		"green" => "green", 
		"pink" => "#FF69B4", 
		"orange" => "orange", 
		"gray" => "darkgray"
	);
	
	echo "
body {
	background-color: black;
	font-family: verdana, sans-serif;
	font-size: 11px;
	color: white;
}


a {
	color: silver;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
	color: white;
}

#colorButton_red {
	background: url('images/colorpick_sprite.png') 0px 0px;
	width: 22px;
	height: 15px;
	margin-left: 5px;
	cursor: pointer;
}

#colorButton_blue {
	background: url('images/colorpick_sprite.png') -22px 0px;
	width: 22px;
	height: 15px;
	margin-left: 5px;
	cursor: pointer;
}

#colorButton_orange {
	background: url('images/colorpick_sprite.png') -44px 0px;
	width: 22px;
	height: 15px;
	margin-left: 5px;
	cursor: pointer;
}

#colorButton_green {
	background: url('images/colorpick_sprite.png') -66px 0px;
	width: 22px;
	height: 15px;
	margin-left: 5px;
	cursor: pointer;
}

#colorButton_gray {
	background: url('images/colorpick_sprite.png') -88px 0px;
	width: 22px;
	height: 15px;
	margin-left: 5px;
	cursor: pointer;
}

#colorButton_pink {
	background: url('images/colorpick_sprite.png') -110px 0px;
	width: 22px;
	height: 15px;
	margin-left: 5px;
	cursor: pointer;
}


.mainSiteTable {
	padding: 0px;
	margin: 0px;
	margin-left: auto;
	margin-right: auto;
	width: 990px;
}

.logoTD {
	border: solid ".$arrRCPThemeColors[$THEME_COLOR]." 1px;
}

.navMenu {
	width: 148px;
	font-size: 11px;
	padding: 0px;
	border: solid ".$arrRCPThemeColors[$THEME_COLOR]." 1px;
}

.navMenuTitle {
	width: 142px;
	border: solid ".$arrRCPThemeColors[$THEME_COLOR]." 1px;
	background-image: url('images/theme/".$THEME_COLOR."/gradient.png');
	height: 19px;
	font-size: 12px;
	font-weight: bold;
	text-align: center;
	margin: 3px;
	margin-bottom: 1px;
	padding-top: 1px;
	margin-left: auto;
	margin-right: auto;
}

.navMenuLinks {
	padding-left: 5px;
	margin-top: 0px;
	margin-bottom: 5px;
	width: 90%;

}

.mainSiteContent {
	width: 686px;
	font-size: 11px;
	padding: 2px;
	border-bottom: solid ".$arrRCPThemeColors[$THEME_COLOR]." 1px;
}

.footerSection {
	padding: 3px;
	font-size: 10px;
}

.gradientBox {
	height: 20px;
	background-image: url('images/theme/".$THEME_COLOR."/gradient.png');
	border: solid ".$arrRCPThemeColors[$THEME_COLOR]." 1px;
}
	
	
";
	
?>

/* Custom BTCS4.css */

.menusNewestMembersWrapper {
	margin-right: 0px;
}

.menusForumActivityWrapper {
	margin-left: auto;
	margin-right: auto;
}

.menusNewestMembersItemWrapper, .menusForumActivityItemWrapper {
	padding: 5px 2px;
}

.shoutBox {
	padding: 3px;
}