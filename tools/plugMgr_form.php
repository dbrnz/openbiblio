<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");

	session_cache_limiter(null);

  $tab = "tools";
  $nav = "plugMgr";
  $focus_form_name = "workForm";
  $focus_form_field = "list";

  require_once(REL(__FILE__, "../functions/inputFuncs.php"));
  require_once(REL(__FILE__, "../shared/logincheck.php"));
	Page::header(array('nav'=>$tab.'/'.$nav, 'title'=>''));

	require_once(REL(__FILE__, "plugMgr_js.php"));
?>
<h3 id="pageHdr" class="title"><?php echo T('Plugin Manager'); ?></h3>

<div id="listDiv">
	<form id="listForm" name="listForm" class="form">
		<label for="pluginOK"><?php echo T('Plugins Allowed?'); ?></label>
  	<?php echo inputfield('checkbox', 'pluginOK', 'Y', NULL, $_SESSION['allow_plugins_flg']); ?>

		<fieldset id="pluginSet">
		  <legend><?php echo T('Select Plugins'); ?></legend>
   		<ul id="pluginList" ></ul>
		</fieldset>
	</form>
</div>

<div id="msgDiv"><fieldSet id="msgArea"></fieldset></div>

<?php include(REL(__FILE__,"../shared/footer.php")); ?>
