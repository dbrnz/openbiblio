<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../shared/common.php");
require_once(REL(__FILE__, "../functions/inputFuncs.php"));	
require_once(REL(__FILE__, "../model/Sites.php"));

$sites_table = new Sites;		
$sites = $sites_table->getSelect();

// Adjusted, so that if 'library_name' contains a string, the site is put by default on 1.
if(empty($_SESSION['current_site'])){ 
 	// Check for cookie, otherwise take default
	if(isset($_COOKIE['OpenBiblioSiteID'])) {
		$siteId = $_COOKIE['OpenBiblioSiteID'];
	} else {
		if($_SESSION['multi_site_func'] > 0){
			$_SESSION['current_site'] = $_SESSION['multi_site_func'];
		} else {
			$_SESSION['current_site'] = 1;
		}
		setcookie("OpenBiblioSiteID", $_SESSION['current_site'], time()+60*60*24*365);
	}			
}
	
if(isset($_REQUEST['selectSite'])){
	$_SESSION['current_site'] =  $_REQUEST['selectSite'];
	header("Location: opac/index.php");
}

if(!empty($_SESSION['current_site'])) header("Location: ../catalog/biblio_search.php?tab=OPAC");
	

session_cache_limiter(null);

$tab = "opac";
$nav = "home";
$focus_form_name = "catalog_search";
$focus_form_field = "searchText";

Page::header_opac(array('nav'=>$nav, 'title'=>''));

?>

			<h1><? echo T('Welcome to the libary');?></h1>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="phrasesearch">
					<fieldset>
					<legend><?php T('Please select the library') ?></legend>
					<table class="primary">
						<tbody>
							<tr>
							<td class="primary" nowrap="true">
								<?php echo T('Please select the library:'); ?>
							</td><td>
								<?php echo inputfield('select', 'selectSite', Settings::get('library_name'), NULL, $sites); 	?>								
								<input class="button" name="action" type="submit" value="<?echo T('Select site')?>"/>
							</td></tr>							
						</tbody>
					</table>
				</fieldset>
			</form>			
<?
 ;
?>
