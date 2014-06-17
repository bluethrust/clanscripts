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



include($prevFolder."include/lib_autolink/lib_autolink.php");


// General functions to filter out all <, >, ", and ' symbols
function filterArray($arrValues) {
	$newArray = array();
	foreach($arrValues as $key => $value) {
		$temp = str_replace("<", "&lt;", $value);
		$value = str_replace(">", "&gt;", $temp);
		$temp = str_replace("'", "&#39;", $value);
		$value = str_replace('"', '&quot;', $temp);
		$temp = str_replace("&middot;", "&#38;middot;", $value);
		$temp = str_replace("&raquo;", "&#38;raquo;", $temp);
		$temp = str_replace("&laquo;", "&#38;laquo;", $temp);
		
		$newArray[$key] = $temp;
	}
	return $newArray;
}

function filterText($strText) {
	$temp = str_replace("<", "&lt;", $strText);
	$value = str_replace(">", "&gt;", $temp);
	$temp = str_replace("'", "&#39;", $value);
	$value = str_replace('"', '&quot;', $temp);
	$temp = str_replace("&middot;", "&#38;middot;", $value);
	$temp = str_replace("&raquo;", "&#38;raquo;", $temp);
	$temp = str_replace("&laquo;", "&#38;laquo;", $temp);
	
	

	return $temp;
}

function getPreciseTime($intTime, $timeFormat="", $bypassTimeDiff=false) {

	$timeDiff = (!$bypassTimeDiff) ? time() - $intTime : 99999;

	if($timeDiff < 3) {
		$dispLastDate = "just now";
	}
	elseif($timeDiff < 60) {
		$dispLastDate = "$timeDiff seconds ago";
	}
	elseif($timeDiff < 3600) {
		$minDiff = round($timeDiff/60);
		$dispMinute = "minutes";
		if($minDiff == 1) {
			$dispMinute = "minute";
		}

		$dispLastDate = "$minDiff $dispMinute ago";
	}
	elseif($timeDiff < 86400) {
		$hourDiff = round($timeDiff/3600);
		$dispHour = "hours";
		if($hourDiff == 1) {
			$dispHour = "hour";
		}

		$dispLastDate = "$hourDiff $dispHour ago";
	}
	else {

		if($timeFormat == "") {
			$timeFormat = "D M j, Y g:i a";
		}


		$dispLastDate = date($timeFormat, $intTime);
	}

	return $dispLastDate;

}

function parseBBCode($strText) {
global $MAIN_ROOT;

	// Basic Codes

	$arrBBCodes['Bold'] = array("bbOpenTag" => "[b]", "bbCloseTag" => "[/b]", "htmlOpenTag" => "<span style='font-weight: bold'>", "htmlCloseTag" => "</span>");
	$arrBBCodes['Italic'] = array("bbOpenTag" => "[i]", "bbCloseTag" => "[/i]", "htmlOpenTag" => "<span style='font-style: italic'>", "htmlCloseTag" => "</span>");
	$arrBBCodes['Underline'] = array("bbOpenTag" => "[u]", "bbCloseTag" => "[/u]", "htmlOpenTag" => "<span style='text-decoration: underline'>", "htmlCloseTag" => "</span>");
	$arrBBCodes['Image'] = array("bbOpenTag" => "[img]", "bbCloseTag" => "[/img]", "htmlOpenTag" => "<img src='", "htmlCloseTag" => "'>");
	$arrBBCodes['CenterAlign'] = array("bbOpenTag" => "[center]", "bbCloseTag" => "[/center]", "htmlOpenTag" => "<p align='center'>", "htmlCloseTag" => "</p>");
	$arrBBCodes['LeftAlign'] = array("bbOpenTag" => "[left]", "bbCloseTag" => "[/left]", "htmlOpenTag" => "<p align='left'>", "htmlCloseTag" => "</p>");
	$arrBBCodes['RightAlign'] = array("bbOpenTag" => "[right]", "bbCloseTag" => "[/right]", "htmlOpenTag" => "<p align='right'>", "htmlCloseTag" => "</p>");
	$arrBBCodes['Quote'] = array("bbOpenTag" => "[quote]", "bbCloseTag" => "[/quote]", "htmlOpenTag" => "<div class='forumQuote'>", "htmlCloseTag" => "</div>");
	$arrBBCodes['Code'] = array("bbOpenTag" => "[code]", "bbCloseTag" => "[/code]", "htmlOpenTag" => "<div class='forumCode'>", "htmlCloseTag" => "</div>");
	
	$randPollDiv = "poll_".md5(time().uniqid());
	
	$arrBBCodes['Poll'] = array("bbOpenTag" => "[poll]", "bbCloseTag" => "[/poll]", "htmlOpenTag" => "<div id='".$randPollDiv."'></div><script type='text/javascript'>embedPoll('".$MAIN_ROOT."', '".$randPollDiv."', '", "htmlCloseTag" => "');</script>");
	
	


	foreach($arrBBCodes as $bbCode) {

		$strText = str_ireplace($bbCode['bbOpenTag'],$bbCode['htmlOpenTag'],$strText);
		$strText = str_ireplace($bbCode['bbCloseTag'],$bbCode['htmlCloseTag'],$strText);

	}
	
	// Emoticons
	
	$arrEmoticonCodes = array(":)", ":(", ":D", ";)", ":p");
	$arrEmoticonImg = array("smile.png", "sad.png", "grin.png", "wink.png", "cheeky.png");
	
	foreach($arrEmoticonCodes as $key => $value) {
		
		$imgURL = "<img src='".$MAIN_ROOT."images/emoticons/".$arrEmoticonImg[$key]."' width='15' height='15'>";
		$strText = str_ireplace($value, $imgURL, $strText);
		
	}
	

	// Complex Codes, ex. Links, colors...

	$strText = preg_replace("/\[url](.*?)\[\/url]/i", "<a href='$1' target='_blank'>$1</a>", $strText); // Links no Titles
	$strText = preg_replace("/\[url=(.*?)\](.*?)\[\/url\]/i", "<a href='$1' target='_blank'>$2</a>", $strText); // Links with Titles

	
	
	$strText = preg_replace("/\[color=(.*)\](.*)\[\/color\]/i", "<span style='color: $1'>$2</span>", $strText); // Text Color

	$strText = str_replace("[/youtube]", "[/youtube]\n", $strText);
	$strText = preg_replace("/\[youtube\](http|https)(\:\/\/www\.youtube\.com\/watch\?v\=)(.*)\[\/youtube\]/i", "<iframe class='youtubeEmbed' src='http://www.youtube.com/embed/$3?wmode=opaque' frameborder='0' allowfullscreen></iframe>", $strText);
	$strText = preg_replace("/\[\youtube\](http|https)(\:\/\/youtu\.be\/)(.*)\[\/youtube\]/i", "<iframe class='youtubeEmbed' src='http://www.youtube.com/embed/$3?wmode=opaque' frameborder='0' allowfullscreen></iframe>", $strText);
	
	$strText = str_replace("[/twitch]", "[/twitch]\n", $strText);
	$strText = preg_replace("/\[twitch\](http|https)(\:\/\/www\.twitch\.tv\/)(.*)\[\/twitch\]/i", "<object class='youtubeEmbed' type='application/x-shockwave-flash' id='live_embed_player_flash' data='http://www.twitch.tv/widgets/live_embed_player.swf?channel=$3' bgcolor='#000000'><param name='allowFullScreen' value='true' /><param name='wmode' value='opaque' /><param name='allowScriptAccess' value='always' /><param name='allowNetworking' value='all' /><param name='movie' value='http://www.twitch.tv/widgets/live_embed_player.swf' /><param name='flashvars' value='hostname=www.twitch.tv&channel=$3&auto_play=false&start_volume=25' /></object>", $strText);
	
	$strText = autolink($strText);

	return $strText;


}

function autoLinkImage($strText) {

	$strText = preg_replace("/<img src=(\"|\')(.*)(\"|\')>/", "<a href='$2' target='_blank'><img src='$2'></a>", $strText);
	$strText = preg_replace("/<img src=(\"|\')(.*)(\"|\') alt=(\"|\')(.*)(\"|\') \/>/", "<a href='$2' target='_blank'><img src='$2'></a>", $strText);
	
	
	return $strText;
}


function __autoload($class_name) {
	global $prevFolder;
	include_once($prevFolder."classes/".strtolower($class_name).".php");
}


function deleteFile($filename) {
	$returnVal = false;
	if(file_exists($filename)) {
		$returnVal = unlink($filename);	
	}
	
	return $returnVal;
}


function getHTTP() {
	if(trim($_SERVER['HTTPS']) == "" || $_SERVER['HTTPS'] == "off") {
		$dispHTTP = "http://";
	}
	else {
		$dispHTTP = "https://";
	}
	
	return $dispHTTP;
}


function addArraySpace($arr, $space, $atSpot) {

	$newArr = array();
	$i=0;
	foreach($arr as $key => $value) {
		
		if($atSpot == $key) {

			for($x=0; $x<$space; $x++) {
				$newArr[$i] = "";
				$i++;
			}
			
			$newArr[$i] = $value;
		}
		else {
			$newArr[$i] = $value;	
		}
	
		$i++;	
	}
	
	return $newArr;
}


function pluralize($word, $num) {

	if($num == 1) {
		$returnVal = $word;
	}
	else {
		$returnVal = $word."s";
	}
	
	return $returnVal;
}

//======================== START OF FUNCTION ==========================//
// FUNCTION: bbcode_to_html                                            //
//=====================================================================//
function bbcode_to_html($bbtext){
  $bbtags = array(
    '[heading1]' => '<h1>','[/heading1]' => '</h1>',
    '[heading2]' => '<h2>','[/heading2]' => '</h2>',
    '[heading3]' => '<h3>','[/heading3]' => '</h3>',
    '[h1]' => '<h1>','[/h1]' => '</h1>',
    '[h2]' => '<h2>','[/h2]' => '</h2>',
    '[h3]' => '<h3>','[/h3]' => '</h3>',

    '[paragraph]' => '<p>','[/paragraph]' => '</p>',
    '[para]' => '<p>','[/para]' => '</p>',
    '[p]' => '<p>','[/p]' => '</p>',
    '[left]' => '<p style="text-align:left;">','[/left]' => '</p>',
    '[right]' => '<p style="text-align:right;">','[/right]' => '</p>',
    '[center]' => '<p style="text-align:center;">','[/center]' => '</p>',
    '[justify]' => '<p style="text-align:justify;">','[/justify]' => '</p>',

    '[bold]' => '<span style="font-weight:bold;">','[/bold]' => '</span>',
    '[italic]' => '<span style="font-weight:bold;">','[/italic]' => '</span>',
    '[underline]' => '<span style="text-decoration:underline;">','[/underline]' => '</span>',
    '[b]' => '<span style="font-weight:bold;">','[/b]' => '</span>',
    '[i]' => '<span style="font-weight:bold;">','[/i]' => '</span>',
    '[u]' => '<span style="text-decoration:underline;">','[/u]' => '</span>',
    '[break]' => '<br>',
    '[br]' => '<br>',
    '[newline]' => '<br>',
    '[nl]' => '<br>',
    
    '[unordered_list]' => '<ul>','[/unordered_list]' => '</ul>',
    '[list]' => '<ul>','[/list]' => '</ul>',
    '[ul]' => '<ul>','[/ul]' => '</ul>',

    '[ordered_list]' => '<ol>','[/ordered_list]' => '</ol>',
    '[ol]' => '<ol>','[/ol]' => '</ol>',
    '[list_item]' => '<li>','[/list_item]' => '</li>',
    '[li]' => '<li>','[/li]' => '</li>',
    
    '[*]' => '<li>','[/*]' => '</li>',
    '[code]' => '<code>','[/code]' => '</code>',
    '[preformatted]' => '<pre>','[/preformatted]' => '</pre>',
    '[pre]' => '<pre>','[/pre]' => '</pre>',     
  );

  $bbtext = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);

  $bbextended = array(
    "/\[url](.*?)\[\/url]/i" => "<a href=\"http://$1\" title=\"$1\">$1</a>",
    "/\[url=(.*?)\](.*?)\[\/url\]/i" => "<a href=\"$1\" title=\"$1\">$2</a>",
    "/\[email=(.*?)\](.*?)\[\/email\]/i" => "<a href=\"mailto:$1\">$2</a>",
    "/\[mail=(.*?)\](.*?)\[\/mail\]/i" => "<a href=\"mailto:$1\">$2</a>",
    "/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
    "/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
    "/\[image_left\]([^[]*)\[\/image_left\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_left\" />",
    "/\[image_right\]([^[]*)\[\/image_right\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_right\" />",
  );

  foreach($bbextended as $match=>$replacement){
    $bbtext = preg_replace($match, $replacement, $bbtext);
  }
  return $bbtext;
}
//=====================================================================//
//  FUNCTION: bbcode_to_html                                           //
//========================= END OF FUNCTION ===========================//

?>