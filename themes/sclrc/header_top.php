<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
// code html tag with language attribute if specified.
echo "<html";
if (Settings::get('html_lang_attr') != "") {
	echo " lang=\"".H(Settings::get('html_lang_attr'))."\"";
}
echo ">\n"; ?>
<head>
<?php // code character set if specified
if (Settings::get('charset') != "") { ?>
<meta http-equiv="content-type" content="text/html; charset=<?php echo H(Settings::get('charset')); ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo H($ThemeDirUrl) ?>/style.php?themeid=<?php echo HURL(Settings::get('themeid')); ?>" />
<meta name="description" content="OpenBiblio Library Automation System">
<title><?php echo H(Settings::get('library_name'));?></title>

<script language="JavaScript">
<!--
function popSecondary(url) {
		var SecondaryWin;
		SecondaryWin = window.open(url,"secondary","resizable=yes,scrollbars=yes,width=535,height=400");
		self.name="main";
}
function popSecondaryLarge(url) {
		var SecondaryWin;
		SecondaryWin = window.open(url,"secondary","toolbar=yes,resizable=yes,scrollbars=yes,width=700,height=500");
		self.name="main";
}
function backToMain(URL) {
		var mainWin;
		mainWin = window.open(URL,"main");
		mainWin.focus();
		this.close();
}
var modified = false;
function confirmLink(e) {
		if (modified) {
			return confirm("This will discard any changes you've made on this page.  Are you sure?");
		} else {
			return true;
		}
}
function init() {
<?php
if (isset($focus_form_name) && ($focus_form_name != "")) {
	echo 'self.focus();';
	echo 'document.'.$focus_form_name.'.'.$focus_form_field.'.focus();';
}
if (isset($confirm_links) and $confirm_links) {
?>
	elems = document.getElementsByTagName('a');
	for (i=0; i<elems.length; i++) {
		if (!elems[i].onclick) {
			elems[i].onclick = l=confirmLink;
			if (elems[i].captureEvents) elems[i].captureEvents(Event.CLICK);
		}
	}
<?php } ?>
}
-->
</script>


</head>
<body onLoad="init()">
