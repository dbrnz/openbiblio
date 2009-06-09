<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	require_once("../shared/common.php");

	$tab = "circulation";
	$nav = "mbr";
	$focus_form_name = "bookingsearch";
	$focus_form_field = "searchText";

	require_once(REL(__FILE__, "../functions/inputFuncs.php"));
	require_once(REL(__FILE__, "../functions/formatFuncs.php"));
	require_once(REL(__FILE__, "../shared/logincheck.php"));
	require_once(REL(__FILE__, "../model/Members.php"));
	require_once(REL(__FILE__, "../model/Sites.php"));
	require_once(REL(__FILE__, "../model/Biblios.php"));
	require_once(REL(__FILE__, "../model/Copies.php"));
	require_once(REL(__FILE__, "../model/History.php"));
	require_once(REL(__FILE__, "../model/MaterialTypes.php"));
	require_once(REL(__FILE__, "../model/Bookings.php"));
	require_once(REL(__FILE__, "../model/MemberAccounts.php"));
	require_once(REL(__FILE__, "../classes/Report.php"));
	require_once(REL(__FILE__, "../shared/get_form_vars.php"));


	#****************************************************************************
	#*  Checking for get vars.  Go back to form if none found.
	#****************************************************************************
	if (count($_GET) == 0) {
		header("Location: ../circ/index.php");
		exit();
	}

	#****************************************************************************
	#*  Retrieving get var
	#****************************************************************************
	$mbrid = $_GET["mbrid"];
	if ($_GET["msg"]) {
		$msg = '<p class="error">'.H($_GET["msg"]).'</p><br /><br />';
	} else {
		$msg = "";
	}

	#****************************************************************************
	#*  Loading a few domain tables into associative arrays
	#****************************************************************************
	$mattypes = new MaterialTypes;
	$types = $mattypes->getAll();
	$materialTypeDm = array();
	$materialImageFiles = array();
	while ($type = $types->next()) {
		$materialTypeDm[$type['code']] = $type['description'];
		$materialImageFiles[$type['code']] = $type['image_file'];
	}

	#****************************************************************************
	#*  Check for outstanding balance due
	#****************************************************************************
	$acct = new MemberAccounts;
	$balance = $acct->getBalance($mbrid);
	$balMsg = "";
	if ($balance != 0) {
		$balText = $LOC->moneyFormat($balance);
		$balMsg = '<p class="error">'.T("Note: Mbr outstanding balance %bal%", array("bal"=>$balText)).'</p><br /><br />';
	}

	#****************************************************************************
	#*  Search database for member
	#****************************************************************************
	$members = new Members;
	$mbr = $members->maybeGetOne($mbrid);

	if ($mbr) {
		$_SESSION['currentMbrid'] = $mbrid;
	} else {
		header('Location: ../circ/index.php');
		exit();
	}

	$sites = new Sites;
	$site = $sites->getOne($mbr['siteid']);
	$biblios = new Biblios;
	$bookings = new Bookings;

	if (isset($_REQUEST['seq'])) {
		$seq = Sequence::load($_REQUEST['seq']);
	} else {
		$seq = NULL;
	}

	#**************************************************************************
	#*  Show member information
	#**************************************************************************
	Page::header(array('nav'=>$tab.'/'.$nav, 'title'=>''));

	if (isset($_REQUEST['rpt'])) {
		$rpt = Report::load($_REQUEST['rpt']);
	} else {
		$rpt = NULL;
	}
	if ($rpt and isset($_REQUEST['seqno'])) {
		$p = $rpt->row($_REQUEST['seqno']-1);
		$n = $rpt->row($_REQUEST['seqno']+1);
		echo '<table style="margin-bottom: 10px" width="60%" align="center"><tr><td align="left">';
		if ($p) {
			echo '<a href="../circ/mbr_view.php?mbrid='.HURL($p['mbrid']).'&amp;tab='.HURL($tab).'&amp;rpt='.HURL($rpt->name).'&amp;seqno='.HURL($p['seqno']).'" accesskey="p">&laquo;'.T("Prev").'</a>';
		}
		echo '</td><td align="center">';
		echo T("Record %item% of %items%", array('item'=>H($_REQUEST['seqno']+1), 'items'=>H($rpt->count())));
		echo '</td><td align="right">';
		if ($n) {
			echo '<a href="../circ/mbr_view.php?mbrid='.HURL($n['mbrid']).'&amp;tab='.HURL($tab).'&amp;rpt='.HURL($rpt->name).'&amp;seqno='.HURL($n['seqno']).'" accesskey="n">'.T("Next").'&raquo;</a>';
		}
		echo '</td></tr></table>';
	}
?>

<?php echo $balMsg ?>
<?php echo $msg ?>

<form name="selection" id="selection" class="not_block" action="../shared/dispatch.php" method="post">
<input type="hidden" name="tab" value="<?php echo H($tab)?>" />
<table class="resultshead">
	<tr>
			<th><?php echo T("Member Information"); ?></th>
		<td class="resultshead">
<table class="buttons">
<tr>
<?php
if ($_SESSION['currentBookingid']) {
	echo '<td>';
	echo '<input type="hidden" name="bookingid" value="'.H($_SESSION['currentBookingid']).'" />';
	echo '<input type="hidden" name="id[]" value="'.H($mbrid).'" />';
	echo '<input type="submit" name="action_booking_mbr_add" value="'.T("Add To Booking").'" />';
	echo '</td>';
}
?>
</tr>
</table>
</td>
</tr>
</table>
</form>
<table class="biblio_view">
	<tr>
		<td class="name"><?php echo T("Name:"); ?></td>
		<td class="value">
			<?php echo H($mbr['last_name']);?>, <?php echo H($mbr['first_name']);?>
		</td>
	</tr>
	<tr>
		<td class="name">
			<?php echo T("Site:"); ?>
		</td>
		<td class="value">
			<?php echo H($site['name']) ?>
		</td>
	</tr>
	<tr>
		<td class="name">
			<?php echo T("Card Number:"); ?>
		</td>
		<td class="value">
			<?php echo H($mbr['barcode_nmbr']);?>
		</td>
	</tr>
	<tr>
		<td class="name">
			<?php echo T("School Grade:"); ?>
		</td>
		<td class="value">
			<?php echo H($mbr['school_grade']);?>
		</td>
	</tr>
</table>

<br />

<!--****************************************************************************
		*  Checkout form
		**************************************************************************** -->
<form name="bookingsearch" method="get" action="../shared/biblio_search.php">
<table class="primary">
	<tr>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Make Booking"); ?>
		</th>
	</tr>
	<tr>
		<td nowrap="nowrap" class="primary">
			<select name="searchType">
				<option value="keyword"><?php echo T("Keyword"); ?></option>
				<option value="title"><?php echo T("Title"); ?></option>
				<option value="subject"><?php echo T("Subject"); ?></option>
				<option value="series"><?php echo T("Series"); ?></option>
				<option value="publisher"><?php echo T("Publisher"); ?></option>
				<option value="callno" selected><?php echo T("Item Number"); ?></option>
			</select>
			<input type="text" name="searchText" size="30" maxlength="256" />
			<input type="hidden" name="sortBy" value="default" />
			<input type="hidden" name="tab" value="<?php echo H($circ); ?>" />
			<input type="hidden" name="lookup" value="<?php echo H($lookup); ?>" />
			<input type="submit" value="<?php echo T("Search"); ?>" class="button" />
		</td>
	</tr>
</table>
</form>

<form name="barcodesearch" method="post" action="../circ/checkout.php">
<table class="primary">
	<tr>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Quick Check Out"); ?>
		</th>
	</tr>
	<tr>
		<td nowrap="nowrap" class="primary">
			<?php echo T("Barcode Number:"); ?>
			<?php printInputText("barcodeNmbr",18,18,$postVars,$pageErrors); ?>
			<input type="hidden" name="mbrid" value="<?php echo H($mbrid);?>" />
			<input type="hidden" name="classification" value="<?php echo H($mbr['classification']);?>" />
			<input type="submit" value="<?php echo T("Check Out"); ?>" class="button" />
		</td>
	</tr>
</table>
</form>

<h1><?php echo T("Items Currently Checked Out"); ?></h1>
<table class="primary">
	<tr>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Checked Out"); ?>
		</th>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Material"); ?>
		</th>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Barcode"); ?>
		</th>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Title"); ?>
		</th>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Due Back"); ?>
		</th>
		<th valign="top" align="left">
			<?php echo T("Days Late"); ?>
		</th>
	</tr>

<?php
	#****************************************************************************
	#*  Get copies this member has out.
	#****************************************************************************
	$copies = new Copies;
	$checkouts = $copies->getMemberCheckouts($mbrid);
	if ($checkouts->count() == 0) {
?>
	<tr>
		<td class="primary" align="center" colspan="6">
			<?php echo T("No items are currently checked out."); ?>
		</td>
	</tr>
<?php
	} else {
		while ($copy = $checkouts->next()) {
			$history = new History;
			$biblio = $biblios->getOne($copy['bibid']);
			$status = $history->getOne($copy['histid']);
			$booking = $bookings->getByHistid($copy['histid']);
			if ($booking == NULL) {
				Fatal::internalError(T("Broken histid/booking reference"));
			}
?>
	<tr>
		<td class="primary" valign="top" nowrap="nowrap">
			<?php echo H($status['status_begin_dt']);?>
		</td>
		<td class="primary" valign="top">
			<img src="../images/<?php echo H($materialImageFiles[$biblio['material_cd']]);?>" width="20" height="20" border="0" align="middle" alt="<?php echo H($materialTypeDm[$biblio['material_cd']]);?>">
			<?php echo H($materialTypeDm[$biblio['material_cd']]);?>
		</td>
		<td class="primary" valign="top" >
			<?php echo H($copy['barcode_nmbr']);?>
		</td>
		<td class="primary" valign="top" >
			<a href="../shared/biblio_view.php?bibid=<?php echo HURL($copy['bibid']);?>"><?php echo H($biblio['marc']->getValue('245$a'));?></a>
		</td>
		<td class="primary" valign="top" nowrap="nowrap">
			<?php echo H($booking['due_dt']);?>
		</td>
		<td class="primary" valign="top" >
			<?php echo H($bookings->getDaysLate($booking));?>
		</td>
	</tr>
<?php
		}
	}
?>

</table>

<br />
<!--****************************************************************************
		*  Hold form
		**************************************************************************** -->
<form name="holdForm" method="post" action="../circ/place_hold.php">
<table class="primary">
	<tr>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Place Hold"); ?>
		</th>
	</tr>
	<tr>
		<td nowrap="nowrap" class="primary">
			<?php echo T("Barcode Number"); ?>
			<?php printInputText("holdBarcodeNmbr",18,18,$postVars,$pageErrors); ?>
			<a href="javascript:popSecondaryLarge(../opac/index.php?lookup=Y)">search</a>
			<input type="hidden" name="mbrid" value="<?php echo $mbrid;?>" />
			<input type="hidden" name="classification" value="<?php echo $mbr['classification'];?>" />
			<input type="submit" value="<?php echo T("Place Hold"); ?>" class="button" />
		</td>
	</tr>
</table>
</form>

<h1><?php echo T("Copies Currently On Hold"); ?></h1>
<table class="primary">
	<tr>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Function"); ?>
		</th>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Placed On Hold"); ?>
		</th>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Barcode"); ?>
		</th>
		<th valign="top" nowrap="nowrap" align="left">
			<?php echo T("Title"); ?>
		</th>
		<th valign="top" align="left">
			<?php echo T("Status"); ?>
		</th>
		<th valign="top" align="left">
			<?php echo T("Due Back"); ?>
		</th>
	</tr>
<?php
	#****************************************************************************
	#*  Search database for BiblioHold data
	#****************************************************************************
	$holds = Report::create('holds');
	$holds->init(array('mbrid'=>$mbrid));
	if ($holds->count() == 0) {
?>
	<tr>
		<td class="primary" align="center" colspan="7">
			<?php echo T("No copies on hold"); ?>
		</td>
	</tr>
<?php
	} else {
		while ($hold = $holds->each()) {
?>
	<tr>
		<td class="primary" valign="top" nowrap="nowrap">
			<a href="../shared/hold_del_confirm.php?holdid=<?php echo HURL($hold['holdid']);?>&amp;bibid=<?php echo HURL($hold['bibid']); ?>&amp;mbrid=<?php echo HURL($mbrid);?>"><?php echo T("del"); ?></a>
		</td>
		<td class="primary" valign="top" nowrap="nowrap">
			<?php echo H($hold['hold_begin']);?>
		</td>
		<td class="primary" valign="top" >
			<?php echo H($hold['barcode_nmbr']);?>
		</td>
		<td class="primary" valign="top" >
			<a href="../shared/biblio_view.php?bibid=<?php echo HURL($hold['bibid']);?>"><?php echo H($hold['title']);?></a>
		</td>
		<td class="primary" valign="top" >
			<?php echo H($hold['status']);?>
		</td>
		<td class="primary" valign="top" >
			<?php echo H($hold['due']);?>
		</td>
	</tr>
<?php
		}
	}
?>

</table>

<?php

	Page::footer();
