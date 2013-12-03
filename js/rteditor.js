/*
 * - jQuery WYSIWYG Text Editor -
 * 
 * Copyright 2012
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 * 
 * 
 * Images Used:
 * Silk Icons - Button Images by Mark James
 * http://www.famfamfam.com
 * 
 */

(function($) {
	
	$.fn.rtEditor = function() {
		
		
		return this.each(function() {
			var strSelectedFont;
			var $this = $(this);
			var strEditableDivID = "wysiwygTextArea"+(Math.round((Math.random()*100)+500));
			
			var arrOnOffButtons = new Array("boldButton", "italicButton", "underlineButton", "leftalignButton", "rightalignButton", "centeralignButton", "unorderedlistButton", "orderedlistButton", "htmlButton");
			var arrOnOffValues = new Array(0,0,0,0,0,0,0,0,0);

			
			var jsDivSelector = document.getElementById(strEditableDivID);
			
			
			var buttonsHTML = "" +
					"<input type='button' id='boldButton' class='boldButton' title='Bold'>" +
					"<input type='button' id='italicButton' class='italicButton' title='Italic'>" +
					"<input type='button' id='underlineButton' class='underlineButton' title'Underline'>" +
					"<input type='button' id='leftalignButton' class='leftalignButton' title='Left Align'>" +
					"<input type='button' id='rightalignButton' class='rightalignButton' title='Right Align'>" +
					"<input type='button' id='centeralignButton' class='centeralignButton' title='Center Align'>" +
					"<input type='button' id='imageButton' title='Insert Image'>" +
					"<input type='button' id='linkButton' title='Create Link from Selection'>" +
					"<input type='button' id='htmlButton' class='htmlButton' title='Edit HTML'>" +
					"<input type='button' id='unorderedlistButton' class='unorderedlistButton' title='Insert Unordered List'>" +
					"<input type='button' id='orderedlistButton' class='orderedlistButton' title='Insert Ordered List'>" +
					"<textarea name='wysiwygHTML' id='wysiwygHTML' style='width: 530px; height: 200px; display: none; position: relative; top: 25px' class='main'></textarea>";
	
			// Text-Editor Fonts, Add to this array to include more fonts in your editor
			var arrFonts = new Array("Arial", "Verdana", "Trebuchet MS", "Impact", "Comic Sans MS", "Times New Roman", "Serif", "Sans-Serif");
			var arrFontStyle = new Array("style='font-family: Arial'", "style='font-family: Verdana'", "style='font-family: Trebuchet MS'", "style='font-family: Impact'", "style='font-family: Comic Sans MS'", "style='font-family: Times New Roman'", "style='font-family: Serif'", "style='font-family: Sans-Serif'");
			
			var fontselectHTML = "" +
					"<div id='fontSelector' style='position: absolute; top: 3px; left: 310px'><select id='fontfamily' class='dropDown'><option value='Verdana'>Select Font</option><option value='arial'>Arial</option><option value='verdana'>Verdana</option><option value='trebuchet ms'>Trebuchet</option><option value='impact'>Impact</option><option value='comic sans ms'>Comic Sans</option><option value='times new roman'>Times New Roman</option><option value='sans-serif'>Sans-Serif</option><option value='serif'>Serif</option></select></div>" +
					"<div id='fontsizeSelector' style='position: absolute; top: 3px; left: 455px'><select id='fontsize'><option value='3'>Font Size</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option></select></div>";
			
			var textareaHTML = "<div contentEditable='true' name='wysiwygDiv' id='wysiwygDiv' style='font-family: verdana; font-size: 12px; padding: 3px; position: relative; background-color: white; margin-top: 30px; width: 530px; height: 200px; border: solid black 1px'></div>";
			

			var dialogHTML = "<div id='wysiwygDialog' style='display: none' class='main'><p><span id='wysiwygDialogText'></span></p><p><input type='text' id='wysiwygDialogValue' class='textBox' style='width: 250px'></p><span id='wysiwygDialogMore'></span></div>";
			
			$this.html(buttonsHTML+fontselectHTML+textareaHTML+dialogHTML);
			
			
			$(":button").hover(
					function() {
						var intBtnOnOff = $.inArray($(this).attr("id"),arrOnOffButtons);
						if(intBtnOnOff > -1) {
							document.getElementById($(this).attr("id")).className = $(this).attr("id")+"_hover";
						}
					},
					function() {
						var intBtnOnOff = $.inArray($(this).attr("id"),arrOnOffButtons);
						if(intBtnOnOff > -1 && arrOnOffValues[intBtnOnOff] == 0) {
							document.getElementById($(this).attr("id")).className = $(this).attr("id");
						}
					}
			);
			
			
			$('#fontSelector').click(function() {
				if($("#wysiwygDiv").is(":visible")) {
					$('#wysiwygDiv').focus();
					var strSelection;
					var rangeInfo;
					if(window.getSelection) {
						strSelection = window.getSelection();
						if(strSelection.rangeCount) {
							rangeInfo = strSelection.getRangeAt(0);
						}
					}
					else if(document.selection) {
						rangeInfo = document.selection.createRange();
					}
	
					if(rangeInfo != "") {
						
						if(document.createRange) {
							window.getSelection().addRange(rangeInfo);
						}
						else if(document.selection) {
							rangeInfo.select();
						}
					}
				}
			});
			
			$('#fontfamily').change(function() {
				if($("#wysiwygDiv").is(":visible")) {
					$('#wysiwygDiv').focus();
					document.execCommand("fontName", false, $('#fontfamily').val());
				}
			});
			
			$('#fontsizeSelector').click(function() {
				if($("#wysiwygDiv").is(":visible")) {
					$('#wysiwygDiv').focus();
					var strSelection;
					var rangeInfo;
					if(window.getSelection) {
						strSelection = window.getSelection();
						if(strSelection.rangeCount) {
							rangeInfo = strSelection.getRangeAt(0);
						}
					}
					else if(document.selection) {
						rangeInfo = document.selection.createRange();
					}
	
					if(rangeInfo != "") {
						
						if(document.createRange) {
							window.getSelection().addRange(rangeInfo);
						}
						else if(document.selection) {
							rangeInfo.select();
						}
					}
				}
			});
			
			$('#fontsize').change(function() {
				if($("#wysiwygDiv").is(":visible")) {
					$('#wysiwygDiv').focus();
					document.execCommand("fontSize", false, $('#fontsize').val());
				}
			});
			
			$('#wysiwygDiv').keydown(function() {
				$('#wysiwygHTML').val($('#wysiwygDiv').html());				
			});
			
			
			$(":button").click(function() {
				
				if($("#wysiwygDiv").is(":visible") || $(this).attr("id") == "htmlButton") {
					var intBtnOnOff = $.inArray($(this).attr("id"),arrOnOffButtons);
					$('#wysiwygDiv').focus();
					
					if(intBtnOnOff > -1) {
						
						if(arrOnOffValues[intBtnOnOff] == 0) {
							
							arrOnOffValues[intBtnOnOff] = 1;
							document.getElementById($(this).attr("id")).className = $(this).attr("id")+"_hover";
							
						}
						else {
							arrOnOffValues[intBtnOnOff] = 0;
							tempVar = arrOnOffValues[intBtnOnOff];
							$(this).addClass(tempVar);
						}
					}
				}
				
				switch($(this).attr("id")) 
				{
				case "boldButton":
					
					if($("#wysiwygDiv").is(":visible")) {
						document.execCommand("bold", false, null);
					}
					
					break;
				case "italicButton":
					if($("#wysiwygDiv").is(":visible")) {
						document.execCommand("italic", false, null);
					}
					break;
				case "underlineButton":
					if($("#wysiwygDiv").is(":visible")) {
						document.execCommand("underline", false, null);
					}
					
					break;
				case "leftalignButton":
					if($("#wysiwygDiv").is(":visible")) {
						arrOnOffValues[4] = 0; // Right Align
						arrOnOffValues[5] = 0; // Center Align
						$("#rightalignButton").mouseleave();
						$("#centeralignButton").mouseleave();
						document.execCommand("justifyLeft", false, null);
					}
					break;
				case "rightalignButton":
					if($("#wysiwygDiv").is(":visible")) {
						arrOnOffValues[3] = 0; //Left Align
						arrOnOffValues[5] = 0; // Center Align
						$("#leftalignButton").mouseleave();
						$("#centeralignButton").mouseleave();
						document.execCommand("justifyRight", false, null);
					}
					break;
				case "centeralignButton":
					if($("#wysiwygDiv").is(":visible")) {
						arrOnOffValues[3] = 0; //Left Align
						arrOnOffValues[4] = 0; // Right Align
						$("#rightalignButton").mouseleave();
						$("#leftalignButton").mouseleave();
						document.execCommand("justifyCenter", false, null);
					}
					break;
				case "orderedlistButton":
					if($("#wysiwygDiv").is(":visible")) {
						document.execCommand("InsertOrderedList", false, null);
					}
					break;
				case "unorderedlistButton":
					if($("#wysiwygDiv").is(":visible")) {
						document.execCommand("InsertUnorderedList", false, null);
					}
					break;
				case "htmlButton":
					if(arrOnOffValues[intBtnOnOff] == 1) {
						
						$('#wysiwygHTML').val($('#wysiwygDiv').html());
						$('#wysiwygHTML').show();
						$('#wysiwygDiv').hide();

					}
					else {
						$('#wysiwygHTML').hide();
						$('#wysiwygDiv').html($('#wysiwygHTML').val());
						$('#wysiwygDiv').show();
					}
					break;
				case "linkButton":
					if($("#wysiwygDiv").is(":visible")) {
						var strSelection;
						var rangeInfo;
						if(window.getSelection) {
							strSelection = window.getSelection();
							if(strSelection.rangeCount) {
								rangeInfo = strSelection.getRangeAt(0);
							}
						}
						else if(document.selection) {
							rangeInfo = document.selection.createRange();
						}
						
						$('#wysiwygDialogText').html("Enter Link URL:");
						$('#wysiwygDialogMore').html("");
						$('#wysiwygDialog').dialog({
							title: 'Create Link From Selection',
							width: 300,
							modal: false,
							zIndex: 9999,
							resizable: false,
							show: 'scale',
							buttons: {
								
								'OK': function() {
									if($('#wysiwygDialogValue').val() != "") {
										var strLink = $('#wysiwygDialogValue').val();
										
										
										if(rangeInfo != "") {
											if(document.createRange) {
												window.getSelection().addRange(rangeInfo);
											}
											else if(document.selection) {
												rangeInfo.select();
											}
										}
										
										document.execCommand("createLink", false, strLink);
										
										$('#wysiwygDialogValue').val("");
										
									}
									$(this).dialog("close");
								},
								'Cancel': function() {
									$('#wysiwygDialogValue').val("");
									$(this).dialog("close");
								}
							}
						});
					}
					break;
				case "imageButton":
					if($("#wysiwygDiv").is(":visible")) {
						$('#wysiwygDialogMore').html("<p>Image Width: <input type='text' id='wysiwygImageWidth' class='textBox' style='width: 40px'></p><p>Image Height: <input type='text' id='wysiwygImageHeight' class='textBox' style='width: 40px'></p>");
						$('#wysiwygDialogText').html("Enter Image URL:");
						$('#wysiwygDialog').dialog({
							title: 'Insert Image',
							width: 300,
							modal: false,
							zIndex: 9999,
							resizable: false,
							show: 'scale',
							buttons: {
								'OK': function() {
									$('#wysiwygDiv').focus();
									if($('#wysiwygDialogValue').val() != "") {
										
										tempWidth = "";
										if(!isNaN($('#wysiwygImageWidth').val())) {
											tempWidth = $('#wysiwygImageWidth').val();
										}
										
										tempHeight = "";
										if(!isNaN($('#wysiwygImageHeight').val())) {
											tempHeight = $('#wysiwygImageHeight').val();
										}
										
										tempVar = $('#wysiwygDiv').html();
										$('#wysiwygDiv').html(tempVar+"<img src='"+$('#wysiwygDialogValue').val()+"' width='"+tempWidth+"' height='"+tempHeight+"'>");
									}
									$(this).dialog("close");
								}
							}
						});
					}
					break;
				case "test":
					alert($('#wysiwygDiv').html());
					break;
				}
			});
			
			
		});
		
	};
	
	
	
}) ( jQuery );