<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	require_once("../shared/common.php");

	session_cache_limiter(null);

	$tab = "cataloging";
	$nav = "new";
	$helpPage = "biblioEdit";
	$cancelLocation = "../catalog/index.php";
	$focus_form_name = "newbiblioform";
	$focus_form_field = "materialCd";

	require_once(REL(__FILE__, "../functions/inputFuncs.php"));
	require_once(REL(__FILE__, "../shared/logincheck.php"));
	require_once(REL(__FILE__, "../shared/get_form_vars.php"));
	Page::header(array('nav'=>$tab.'/'.$nav, 'title'=>''));

	$headerWording = T("Add New");

	/*****************************************************
	 *  Set form defaults
	 *****************************************************/
	if (isset($_GET["reset"])){
		$postVars["opacFlg"] = "CHECKED";
	}

?>
	<script type="text/javascript">
		<!--
			function matCdReload(){
	var material_cd_value = document.newbiblioform.materialCd.options[document.newbiblioform.materialCd.selectedIndex].value;
				alert(material_cd_value);
	window.location.href="<?php echo $_SERVER['PHP_SELF'];?>?material_cd="+material_cd_value;
			}
		//-->
	</script>
<form name="newbiblioform" method="post" action="../catalog/biblio_new.php">

<?php

	include(REL(__FILE__, "../catalog/biblio_fields.php"));
	Page::footer();
