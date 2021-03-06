<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
	require_once(REL(__FILE__, "../../model/Members.php"));
	$navLoc = new Localize(Settings::get('locale'),"navbars");

include(REL(__FILE__, "header_top.php"));
?>
<!-- **************************************************************************************
		 * Library Name and hours
		 **************************************************************************************-->
<div class="title">
	<dl class="hours">
		<?php if (Settings::get('library_hours') != "") { ?>
			<dt>Media Center Hours:</dt><?php # ALLOW HTML ?>
			<dd><?php echo Settings::get('library_hours') ?></dd>
		<?php } ?>
		<?php if (Settings::get('library_phone') != "") { ?>
		<dt>Media Center Phone:</dt><?php # ALLOW HTML ?>
			<dd><?php echo Settings::get('library_phone') ?></dd>
		<?php } ?>
	</dl>
	<h1>
		<?php
			if (Settings::get('library_image_url') != "") {
			 echo "<img align=\"middle\" src=\"".H(Settings::get('library_image_url'))."\" border=\"0\" />";
			}
			if (Settings::get('use_image_flg') != 'Y') {
				echo H(Settings::get('library_name'));
			}
		?>
	</h1>
</div>
<div id="login">
<?php
$mbr = NULL;
if (isset($_SESSION['authMbrid'])) {
	$members = new Members;
	$mbr = $members->maybeGetOne($_SESSION['authMbrid']);
}
if ($mbr) {
	echo 'Hello, '.H($mbr['first_name']).' (<a href="../opac/logout.php">logout</a>)';
} else {
?>
<form action="../opac/login.php" method="POST">
ID:<input type="text" name="id" size="20" />
Password:<input type="password" name="password" size="8" />
<input class="button" type="submit" value="Log in" />
<a class="small_button" href="../opac/register.php">Register</a>
</form>
<?php
}
?>
</div>
<!-- **************************************************************************************
		 * Left nav
		 **************************************************************************************-->
<?php
// cellspacing="0" cellpadding="0" works around IE's lack of
// support for CSS2's border-spacing property.
?>
<table id="main" height="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td id="sidebar">
		
<?php
Nav::display($nav);

if ($nav == "request") {
?>
 <hr width="95%" />
 <iframe src="../shared/calendar.php" height="100%" width="95%" frameborder="0">
	 <p>The calendar cannot be displayed with your current browser configuration.</p>
 </iframe>
<?php } ?>
		</td>
		<td id="content">
<!-- **************************************************************************************
		 * beginning of main body
		 **************************************************************************************-->
