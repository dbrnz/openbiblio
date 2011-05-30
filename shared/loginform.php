<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	require_once("../shared/common.php");
	require_once(REL(__FILE__,"../functions/inputFuncs.php"));
	require_once(REL(__FILE__, "../model/Sites.php"));	

	## assure all session values are current
	setSessionFmSettings(); // part of ../shared/common.php
	
	$temp_return_page = "";
	if (isset($_GET["RET"])){
		$_SESSION["returnPage"] = $_GET["RET"];
	}

	$sites_table = new Sites;		
	$sites = $sites_table->getSelect();	

	// If the current_site is set, default to this site, otherwise use the cookie and finally the site default
	if(isset($_REQUEST['selectSite'])){
		$siteId = $_REQUEST['selectSite'];
	} elseif(isset($_COOKIE['OpenBiblioSiteID'])) {
		$siteId = $_COOKIE['OpenBiblioSiteID'];
	} else {
		$siteId = Settings::get('multi_site_func');
		if(!($siteId > 0)){
			$siteId = 1;
		}
	}
	$tab = "circ";
	$nav = "";
	$focus_form_name = "loginform";
	$focus_form_field = "username";

	require_once(REL(__FILE__, "../shared/get_form_vars.php"));
	Page::header(array('nav'=>$tab.'/'.$nav, 'title'=>''));

	# for later use by inputfields()
	$attrs = array(size=>"20", maxlength=>"20");

?>
<h1><span id="searchHdr" class="title"><?php echo T("Staff Login"); ?></span></h1>
<?php //print_r($_SESSION); //debugging only ?>

<form name="loginform" method="post" action="../shared/login.php">
<fieldset>
<table class="primary">

	<tbody>
	<?php if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)) { ?>
		<tr>
			<td colspan="2"><p><font color="red"><?php echo T("Browser not supported") ?></font></p></td>
		</tr>
	<?php } ?>
	<tr>
		<td valign="top" class="noborder">
			<label for="username"><?php echo T("Username:"); ?></label>
		</td>
		<td valign="top" class="noborder">
			<?php echo inputfield('text','username',$postVars["username"],$attrs); ?>
		</td>
	</tr>
	<tr>
		<td valign="top" class="noborder">
			<label for="password"><?php echo T("Password:"); ?></label>
		</td>
		<td valign="top" class="noborder">
			<?php echo inputfield('password','pwd',$postVars["pwd"],$attrs); ?>
		</td>
	</tr>
	<?php if(($_SESSION['multi_site_func'] > 0) || ($_SESSION['site_login'] == 'Y')){ ?>
	<tr>
		<td>
			<label for="selectSite"><?php echo T("Library Site"); ?>:</label>
		</td>
		<td>
			<?php 
				echo inputfield('select', 'selectSite', $siteId, NULL, $sites); 	
			?>	
		</td>
	</tr>
	<?php } ?>
	</tbody>
	
	<tfoot>
	<tr>
		<td colspan="2" align="center" class="noborder">
			<input type="submit" value="<?php echo T("Login"); ?>" class="button" />
		</td>
	</tr>
	<tfoot>
	
</table>
</fieldset>
</form>

<?php

	Page::footer();
