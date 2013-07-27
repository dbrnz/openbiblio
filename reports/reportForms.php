<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	require_once("../shared/common.php");
	require_once(REL(__FILE__, "../functions/inputFuncs.php"));

	session_cache_limiter(null);

	$tab="working";
	$nav="results";
	if (isset($_REQUEST['tab'])) {
		$tab = $_REQUEST['tab'];
	}
	if (isset($_REQUEST['nav'])) {
		$nav = $_REQUEST['nav'];
	}
	require_once(REL(__FILE__, "../shared/logincheck.php"));

	$focus_form_name = "";
	$focus_form_field = "";

	## menu modifications  go here
//	foreach ($rpt->layouts() as $l) {
//		if ($l['title']) {
//			$title = $l['title'];
//		} else {
//			$title = $l['name'];
//		}
//		Nav::node('reports/results/'.$l['name'], $title,
//			'../shared/layout.php?rpt=Report&name='.U($l['name']));
//	}
//	Nav::node('reports/results/list', T("Print List"),
//		'../shared/layout.php?rpt=Report&name=list');
//	Nav::node('reports/results/list', T("Prepare CSV file"),
//		'../shared/layout.php?rpt=Report&name=csv');
//	Nav::node('reports/reportcriteria', T("Report Criteria"),
//		'../reports/report_criteria.php?type='.U($rpt->type()));
	## end of menu modifications

	## create web page ###
//	Nav::node('reports/reportcriteria',T($rpt->title()));
	Page::header(array('nav'=>$tab.'/'.$nav, 'title'=>''));
	//echo "<br />";print_r($_REQUEST);echo "<br />";
	//print_r($_SESSION); // for debugging
?>

	<h3 id="pageTitle"> </h3>

	<p id="errSpace" class="error"></p>
	<input type="hidden" id="tab" value="<?php echo $tab;?>" />
	<input type="hidden" id="rptType" value="" />

<!-- ------------------------------------------------------------------------ -->
	<div id="specsDiv">
		<fieldset>
			<legend>Report Criteria</legend>
			<form id="reportcriteriaform" name="reportcriteriaform">
				<!--input type="hidden" id="title" name="title" value="" /-->
				<input type="hidden" id="type" name="type" value="" />
				<input type="hidden" id="firstItem" name="firstItem" value="0" />
				<input type="hidden" id="mode" name="mode" value="getPage" />

				<div id="specs"> </div>

				<input id="searchBtn" type="button" value="<?php echo T("Submit"); ?>" class="button" />
			</form>
		</fieldset>
	</div>

<!-- ------------------------------------------------------------------------ -->
	<div id="reportDiv">
		<ul class="btnRow">
			<li><input type="button" class="gobkRptBtn" value="<?php echo T("Go Back"); ?>"></li>
		</ul>
		<fieldset>
			<div class="cntlArea">
				<div class="btnBox">
					<ul class="btnRow">
						<li><button class="prevBtn"><?php echo T("Prev");?></button></li>
						<li><button class="nextBtn"><?php echo T("Next");?></button></li>
					</ul>
				</div>
				<div class="countBox"><span id="rptCount"></span> <?php echo T("items found"); ?></div>
				<div class="sortBox">
					<!--select id="orderBy">
						<option value="title">Title</option>
						<option value="author" SELECTED>Author</option>
						<option value="callno">Call No.</option>
					</select-->
				</div>
			</div>

			<fieldset id="rsltSet">
				<legend><?php echo T("Report Results"); ?></legend>
				<div id="report"><div>
			</fieldset>

			<div class="cntlArea">
				<div class="nmbrbox">
					<ul class="btnRow">
						<li><button class="prevBtn"><?php echo T("Prev");?></button></li>
						<li><button class="nextBtn"><?php echo T("Next");?></button></li>
					</ul>
				</div>
			</div>
		</fieldset>
		<ul class="btnRow">
			<li><input type="button" class="gobkRptBtn" value="<?php echo T("Go Back"); ?>"></li>
		</ul>

	</div>

<!-- ------------------------------------------------------------------------ -->
<div id="biblioDiv">
	<ul class="btnRow">
		<li><input type="button" class="gobkBiblioBtn" value="<?php echo T("Go Back"); ?>" /></li>
	</ul>

		<?php include(REL(__FILE__,"../catalog/itemDisplayForm.php")); ?>

	<ul class="btnRow">
		<li><input type="button" class="gobkBiblioBtn" value="<?php echo T("Go Back"); ?>"></li>
	</ul>
</div>

<!-- ------------------------------------------------------------------------ -->
<div id="workDiv">
	<img id="img-dummy" src="../images/shim.gif" class="biblioImage" />
</div>
<!-- ------------------------------------------------------------------------ -->
<?php
  require_once(REL(__FILE__,'../shared/footer.php'));
	include "./reportJs.php";
?>

</body>
</html>
