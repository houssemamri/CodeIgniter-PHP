"use strict";

/////////////////////////////////////////
///Main Function createeditor() Start////
function createeditor(form, id, mode, theme) {
	var editodivnode = document.getElementById(id);
	var editodivelem = document.createElement('div');

//Default text for editor if the <textarea> is blank
//You can change this to your own and it should not be blank. If you need to make it blank please input "&nbsp;"
if(editodivnode.innerHTML==="") {
	editodivnode.innerHTML = "&nbsp;";
}

//Generates Random number to avoice DOM Id clashes. All the DOM Object generated will have this randNo in their id="" and name="" attributes.
	var randNo = Math.random();

//Generating Editor based on "mode"
switch (mode){
//Full Editor
case "Full":
	editodivelem.innerHTML+='<div class="container"><div class="row" style="margin:0px -15px -15px -15px;"><div class="col-md-12" style="padding:0px; margin:0px;"><div class="panel panel-primary"> <div class="panel-heading" style="background-color:'+theme+'; border-color:'+theme+';"><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Save" onclick="submit_form(\''+form+'\',\''+id+'\',\''+randNo+'\');"><i class="fa fa-save"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Undo" onclick="iUndo('+randNo+');"><i class="fa fa-reply"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Redo" onclick="iRedo('+randNo+')"><i class="fa fa-share"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Bold" onclick="iBold('+randNo+')"><i class="fa fa-bold"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Italic" onclick="iItalic('+randNo+')"><i class="fa fa-italic"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Underline" onclick="iUnderline('+randNo+')"><i class="fa fa-underline"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Strikethrough" onclick="iStrike('+randNo+')"><i class="fa fa-strikethrough"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Subscript"  onclick="iSubscript('+randNo+')"><i class="fa fa-subscript"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Superscript" onclick="iSuperscript('+randNo+')"><i class="fa fa-subscript"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Descrease Font Size" onclick="idecreaseFontSize('+randNo+');"><i class="fa fa-arrow-circle-down"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Increase Font Size" onclick="iincreaseFontSize('+randNo+');"><i class="fa fa-arrow-circle-up"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Clear Formating" onclick="iClearFormat('+randNo+')"><i class="fa fa-file-text-o"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Horizontal Line" onclick="iHorizontalRule('+randNo+');"><i class="fa fa-h-square"></i></button></div> <div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Align left" onclick="ijustifyLeft('+randNo+')"><i class="fa fa-align-left"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Align center" onclick="ijustifyCenter('+randNo+')"><i class="fa fa-align-center"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Align right" onclick="ijustifyRight('+randNo+')"><i class="fa fa-align-right"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Align justify" onclick="ijustifyFull('+randNo+')"><i class="fa fa-align-justify"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Numbered list" onclick="iUnorderedList('+randNo+')"><i class="fa fa-list-ol"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Bulleted list" onclick="iOrderedList('+randNo+')"><i class="fa fa-list-ul"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Link" onclick="iLink('+randNo+')"><i class="fa fa-link"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Unlink" onClick="iUnLink('+randNo+');"><i class="fa fa-unlink"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default"  data-toggle="tooltip" title="Picture" onclick="iImage('+randNo+')"><i class="fa fa-picture-o"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Indent" onclick="iIndent('+randNo+')"><i class="fa fa-indent"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Outdent" onclick="iOutdent('+randNo+')"><i class="fa fa-outdent"></i></button></div></div><div class="panel-body" id="EditorSpace'+randNo+'" style="background-color:'+theme+';"></div><div class="panel-footer"></div></div></div></div></div>';
break;

//Simple Editor
case "Simple":
editodivelem.innerHTML+='<div class="container"><div class="row" style="margin:0px -15px -15px -15px;"><div class="col-md-12" style="padding:0px; margin:0px;"><div class="panel panel-primary"> <div class="panel-heading" style="background-color:'+theme+'; border-color:'+theme+';"><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Bold" onclick="iBold('+randNo+')"><i class="fa fa-bold"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Italic" onclick="iItalic('+randNo+')"><i class="fa fa-italic"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Underline" onclick="iUnderline('+randNo+')"><i class="fa fa-underline"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Strikethrough" onclick="iStrike('+randNo+')"><i class="fa fa-strikethrough"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Subscript"  onclick="iSubscript('+randNo+')"><i class="fa fa-subscript"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Superscript" onclick="iSuperscript('+randNo+')"><i class="fa fa-subscript"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Descrease Font Size" onclick="idecreaseFontSize('+randNo+');"><i class="fa fa-arrow-circle-down"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Increase Font Size" onclick="iincreaseFontSize('+randNo+');"><i class="fa fa-arrow-circle-up"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Clear Formating" onclick="iClearFormat('+randNo+')"><i class="fa fa-file-text-o"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Horizontal Line" onclick="iHorizontalRule('+randNo+');"><i class="fa fa-h-square"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Align left" onclick="ijustifyLeft('+randNo+')"><i class="fa fa-align-left"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Align center" onclick="ijustifyCenter('+randNo+')"><i class="fa fa-align-center"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Align right" onclick="ijustifyRight('+randNo+')"><i class="fa fa-align-right"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Align justify" onclick="ijustifyFull('+randNo+')"><i class="fa fa-align-justify"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Numbered list" onclick="iUnorderedList('+randNo+')"><i class="fa fa-list-ol"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Bulleted list" onclick="iOrderedList('+randNo+')"><i class="fa fa-list-ul"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Indent" onclick="iIndent('+randNo+')"><i class="fa fa-indent"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Outdent" onclick="iOutdent('+randNo+')"><i class="fa fa-outdent"></i></button></div></div><div class="panel-body" id="EditorSpace'+randNo+'" style="background-color:'+theme+';"></div><div class="panel-footer"></div></div></div></div></div>';
break;

//Minimal Editor
case "Minimal":
editodivelem.innerHTML+='<div class="container"><div class="row" style="margin:0px -15px -15px -15px;"><div class="col-md-12" style="padding:0px; margin:0px;"><div class="panel panel-primary"> <div class="panel-heading" style="background-color:'+theme+'; border-color:'+theme+';"><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Bold" onclick="iBold('+randNo+')"><i class="fa fa-bold"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Italic" onclick="iItalic('+randNo+')"><i class="fa fa-italic"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Underline" onclick="iUnderline('+randNo+')"><i class="fa fa-underline"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Strikethrough" onclick="iStrike('+randNo+')"><i class="fa fa-strikethrough"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Subscript"  onclick="iSubscript('+randNo+')"><i class="fa fa-subscript"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Superscript" onclick="iSuperscript('+randNo+')"><i class="fa fa-subscript"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Descrease Font Size" onclick="idecreaseFontSize('+randNo+');"><i class="fa fa-arrow-circle-down"></i></button><button type="button" class="btn btn-default" data-toggle="tooltip" title="Increase Font Size" onclick="iincreaseFontSize('+randNo+');"><i class="fa fa-arrow-circle-up"></i></button></div><div class="btn-group"><button type="button" class="btn btn-default" data-toggle="tooltip" title="Clear Formating" onclick="iClearFormat('+randNo+')"><i class="fa fa-file-text-o"></i></button></div></div><div class="panel-body" id="EditorSpace'+randNo+'" style="background-color:'+theme+';"></div><div class="panel-footer"></div></div></div></div></div>';
break;
}


//Creating Editor markups just before <textarea>
	editodivelem.setAttribute("id", id+"editodiv");
    editodivelem.style.padding = "0px";
    editodivelem.style.margin = "0px 0px 0px 0px";
    editodivelem.style.overflow = "hidden";
	editodivnode.parentNode.insertBefore(editodivelem,editodivnode);

//Creating iframe for execComand() designMode
//This will be created inside the editodivelemen or created markup above.
//Iframe will append as child to "EditorSpace'+randNo+'
	var iframe = document.createElement('iframe');
    iframe.style.width = "100%";
    iframe.style.height = "100%";
    iframe.style.border = "1px inset "+theme;
    iframe.style.margin = "0px 5px 5px 5px";
    iframe.style.margin = "0 auto";
    iframe.style.background = "#FFF";
    iframe.setAttribute("id", "richTextField"+randNo);
    iframe.setAttribute("name", "richTextField"+randNo);
    document.getElementById('EditorSpace'+randNo).appendChild(iframe);

//Hiding <textarea> because textarea is no longer need to be displayed
    document.getElementById(id).style.display = 'none';

//Get content of <textarea>, decode content and write those contents to iframe.contentWidnow.
	var cotent = document.getElementById(id).innerHTML;
	var text = $("<textarea/>").html(cotent).text();
	iframe.contentWindow.document.write(text);

//Inserting a onsubmit function to the form to get edited contents from iframe.cotentWindow to <textarea>
	var submitFunc = "submit_form(\'"+form+"\',\'"+id+"\',\'"+randNo+"\')";
	form = document.getElementById(form);
    form.setAttribute("onsubmit", submitFunc);

//Swit on designMode for created iframe
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.designMode = 'On';

//Tool tip function for mouse over effects  when document ready
   $('button').tooltip({container: 'body'});

 }
////Main Function createeditor() End/////
/////////////////////////////////////////

///////////////////////////////////////////////////////
////Other Functions (Editor Button Commands) Start ////

//Text Bold
function iBold(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('bold',false,null);
}

//Text Underline
function iUnderline(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('underline',false,null);
}

//Text Strike
function iStrike(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('strikeThrough',false,null);
}

//Text Clear Formating (clear mess codes)
function iClearFormat(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('removeFormat',false,null);
}

//Text Subscript
function iSubscript(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('subscript',false,null);
}

//Text Superscript
function iSuperscript(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('superscript',false,null);
}

//Text Increase Font Size
function iincreaseFontSize(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('increaseFontSize',false,null);
}

//Text Decrease Font Size
function idecreaseFontSize(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('decreaseFontSize',false,null);
}

//Text Italic
function iItalic(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('italic',false,null);
}

//Text Align Left
function ijustifyLeft(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('justifyLeft',false,null);
}

//Text Align Center
function ijustifyCenter(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('justifyCenter',false,null);
}

//Text Align Right
function ijustifyRight(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('justifyRight',false,null);
}

//Text Align Justify
function ijustifyFull(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('justifyFull',false,null);
}

//Redo
function iRedo(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('redo',false,null);
}

//Undo
function iUndo(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('undo',false,null);
}

//Indent
function iIndent(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('indent',false,null);
}

//Outdent
function iOutdent(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('outdent',false,null);
}

//Horizontal Rule
function iHorizontalRule(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('inserthorizontalrule',false,null);
}

//Ordered List
function iUnorderedList(randNo) {
var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand("InsertOrderedList", false,"newOL");
}

//UnOrdered List
function iOrderedList(randNo) {
var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand("InsertUnorderedList", false,"newUL");
}

//Insert Link
function iLink(randNo) {
	var linkURL  =  prompt("Enter the URL for this link:", "http://");
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand("CreateLink", false, linkURL);
}

//Unlink
function iUnLink(randNo) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand("Unlink", false, null);
}

//Insert Image
function iImage(randNo) {
	var imgSrc = prompt('Enter image location', '');
    if(imgSrc !== null) {
	var iframeNow = document.getElementById('richTextField'+randNo);
	iframeNow.contentWindow.document.execCommand('insertimage', false, imgSrc);
    }
}

////Other Functions (Editor Button Commands) End ////
///////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////
////Onsubmit Function (to get edited content again to <textarea> Start ////

function submit_form(form,textarea,randNo) {
	var theForm = document.getElementById(form);
	theForm.elements[textarea].value = window.frames['richTextField'+randNo].document.body.innerHTML;
	theForm.submit();
}
function returnID(){
	return window.frames['richTextField'+randNo].document.body.innerHTML;
}

////Onsubmit Function (to get edited content again to <textarea> End ////
/////////////////////////////////////////////////////////////////////////
