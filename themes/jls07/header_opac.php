<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
	require_once(REL(__FILE__, "../../model/Members.php"));
	require_once(REL(__FILE__, "header_top.php"));
?>

<div id="sidebar">
	<h3 class="staff_head">
			<?php echo T("%library%:<br />OPAC Interface", array('library'=>H(Settings::get('library_name')))) ?>
	</h3>
	<div id="library_hours"><?php echo T(Settings::get('library_hours')) ?></div>
	<div id="library_phone"><?php echo H(Settings::get('library_phone')) ?></div>
 	<hr width="95%" />

<?php Nav::display($nav); ?>

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
	<?php
		if (isset($_GET['msg'])) {
			echo "<div class=\"msg\">".H($_GET['msg'])."</div>";
		}
