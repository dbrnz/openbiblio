<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

//	include($params['theme_dir']."/header_top.php");
	include(REL(__FILE__,"/header_top.php"));
?>

<!-- **************************************************************************************
		 * Left nav
		 **************************************************************************************-->
<?php
// cellspacing="0" cellpadding="0" works around IE's lack of
// support for CSS2's border-spacing property.
?>
<div id="sidebar">
	<h3 class="staff_head">
			<?php
			//echo T("%library%:<br />Staff Interface", array('library'=>$lib[name]));
			echo "$lib[name]:<br />Staff Interface";
			?>
	</h3>
	<br />
	<form method="get" action="../shared/logout.php">
		<input type="submit" value="<?php echo T("Logout") ?>" class="button">
	</form>
	<br />
	
	<?php Nav::display($params['nav']); ?>

	<div id="footer">
		<a href="http://obiblio.sourceforge.net/">
			<img src="../images/powered_by_openbiblio.gif" width="125" height="44" border="0" />
		</a>
		<br />
		Powered by OpenBiblio version <?php echo H(OBIB_CODE_VERSION);?><br />
		OpenBiblio is free software, copyright by its authors.<br />
		Get <a href="../COPYRIGHT.html">more information</a>.
	</div>
</div>

<!-- **************************************************************************************
		 * beginning of main body
		 **************************************************************************************-->
<div id="content">