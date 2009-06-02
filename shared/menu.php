<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

Nav::node('circulation', T("Circulation"), '../circ/index.php');
Nav::node('circulation/searchform', T("Member Search"), '../circ/index.php');
Nav::node('circulation/search', T("Search Results"));
if (isset($mbrid)) {
	$params = 'mbrid='.U($mbrid);
	if (isset($_REQUEST['rpt']) and isset($_REQUEST['seqno'])) {
		$params .= '&rpt='.U($_REQUEST['rpt']);
		$params .= '&seqno='.U($_REQUEST['seqno']);
	}
	Nav::node('circulation/mbr', T("Member Info"), '../circ/mbr_view.php?'.$params);
	Nav::node('circulation/mbr/edit', T("Edit Info"), '../circ/mbr_edit_form.php?'.$params);
	Nav::node('circulation/mbr/delete', T("Delete"), '../circ/mbr_del_confirm.php?'.$params);
	Nav::node('circulation/mbr/account', T("Account"), '../circ/mbr_account.php?'.$params.'&reset=Y');
	Nav::node('circulation/mbr/hist', T("Checkout History"), '../circ/mbr_history.php?'.$params);
}
Nav::node('circulation/new', T("New Member"), '../circ/mbr_new_form.php?reset=Y');
Nav::node('circulation/bookings', T("Bookings"), '../circ/bookings.php');
Nav::node('circulation/bookings/cart', T("Booking Cart"), '../circ/booking_cart.php');
Nav::node('circulation/bookings/pending', T("Pending Bookings"));
if (isset($bookingid)) {
	$params = 'bookingid='.U($bookingid);
	if (isset($_REQUEST['rpt']) and isset($_REQUEST['seqno'])) {
		$params .= '&rpt='.U($_REQUEST['rpt']);
		$params .= '&seqno='.U($_REQUEST['seqno']);
	}
	Nav::node('circulation/bookings/view', T("Booking Info"),
		'../circ/booking_view.php?'.$params);
	Nav::node('circulation/bookings/deleted', T("Deleted"));
}
Nav::node('circulation/bookings/book', T("Create Booking"));
Nav::node('circulation/checkin', T("Check In"), '../circ/checkin_form.php?reset=Y');
Nav::node('cataloging', T("Cataloging"), '../catalog/index.php');
Nav::node('cataloging/searchform', T("New Search"), "../catalog/index.php");
Nav::node('cataloging/images', T("Browse Images"), '../shared/image_browse.php');
if (isset($_SESSION['rpt_BiblioSearch'])) {
	Nav::node('cataloging/search', T("Search Results"),
		'../shared/biblio_search.php?searchType=previous&tab='.U($tab));
}
Nav::node('cataloging/cart', T("Request Cart"), '../shared/req_cart.php?tab='.U($tab));
if (isset($_REQUEST['bibid'])) {
	$params = 'bibid='.U($_REQUEST['bibid']);
	if (isset($_REQUEST['rpt']) and isset($_REQUEST['seqno'])) {
		$params .= '&rpt='.U($_REQUEST['rpt']);
		$params .= '&seqno='.U($_REQUEST['seqno']);
	}
	Nav::node('cataloging/biblio', T("Item Info"),
		"../shared/biblio_view.php?".$params);
      	Nav::node('cataloging/biblio/edit', T("Edit"),
		"../catalog/biblio_edit_form.php?".$params);
	Nav::node('cataloging/biblio/editmarc', T("Edit MARC"),
		"../catalog/biblio_marc_edit_form.php?".$params);
	Nav::node('cataloging/biblio/images', T("Manage Images"),
		"../catalog/image_manage.php?".$params);
	Nav::node('cataloging/biblio/images/new', T("Add New Image..."),
		"../catalog/image_upload_form.php?".$params);
	Nav::node('cataloging/biblio/images/del', T("Delete Image"));
	Nav::node('cataloging/biblio/editstock', T("Edit Stock Info"));
	Nav::node('cataloging/biblio/newcopy', T("New Copy"));
 	Nav::node('cataloging/biblio/newlike', T("New Like"), "../catalog/biblio_new_like.php?".$menu_params);
	Nav::node('cataloging/biblio/editcopy', T("Edit Copy"));
	Nav::node('cataloging/biblio/bookings', T("Item Bookings"),
		"../reports/run_report.php?type=bookings"
		. "&rpt_order_by=outd!r"
		. "&tab=cataloging&nav=biblio/bookings"
		. "&rpt_bibid=".U($_REQUEST['bibid'])
		. "&".$params);
	Nav::node('cataloging/biblio/holds', T("Hold Requests"),
		"../catalog/biblio_hold_list.php?".$params);
	Nav::node('cataloging/biblio/delete', T("Delete"),
		"../catalog/biblio_del_confirm.php?".$params);
}
Nav::node('cataloging/new', T("New Item"),
	"../catalog/biblio_new_form.php?reset=Y");
Nav::node('cataloging/upload_usmarc', T("MARC Import"),
	"../catalog/upload_usmarc_form.php");
Nav::node('cataloging/bulk_delete', T("Bulk Delete"),
	"../catalog/biblio_bulk_del.php");
Nav::node('admin', T("Admin"), '../admin/index.php');
Nav::node('admin/summary', T("Admin Summary"), '../admin/index.php');
Nav::node('admin/staff', T("Staff Admin"), '../admin/staff_list.php');
Nav::node('admin/settings', T("Library Settings"), '../admin/settings_edit_form.php?reset=Y');
Nav::node('admin/calendars', T("Calendars"), '../admin/calendars_list.php');
Nav::node('admin/calendars/new', T("New Calendar"), '../admin/calendar_edit_form.php');
Nav::node('admin/calendars/edit', T("Edit Calendar"));
if (isset($calendar) and $calendar != OBIB_MASTER_CALENDAR) {
	Nav::node('admin/calendars/del', T("Delete Calendar"),
		'../admin/calendar_del_confirm.php?calendar='.U($calendar));
}
Nav::node('admin/sites', T("Sites"), '../admin/sites_list.php');
Nav::node('admin/sites/new', T("New Site"), '../admin/sites_edit_form.php');
Nav::node('admin/sites/edit', T("Edit Site"));
if (isset($siteid)) {
	Nav::node('admin/sites/del', T("Delete Site"),
		'../admin/sites_del_confirm.php?siteid='.U($siteid));
}
Nav::node('admin/memberfields', T("Member Fields"), '../admin/member_fields_list.php');
Nav::node('admin/biblio_copy_fields', T("Biblio Copy Fields"),
	'../admin/biblio_copy_fields_list.php');
Nav::node('admin/materials', T("Material Types"), '../admin/materials_list.php');
Nav::node('admin/collections', T("Collections"), '../admin/collections_list.php');
Nav::node('admin/themes', T("Themes"), '../admin/theme_list.php');
Nav::node('admin/integrity', T("Check Database"), '../admin/integrity.php');
Nav::node('reports', T("Reports"), '../reports/index.php');
Nav::node('reports/reportlist', T("Report List"), '../reports/index.php');
if (isset($_SESSION['rpt_Report'])) {
	Nav::node('reports/results', T("Report Results"),
		'../reports/run_report.php?type=previous');
}

$helpurl = "javascript:popSecondary('../shared/help.php";
if (isset($helpPage)) {
	$helpurl .= "?page=".$helpPage;
}
$helpurl .= "')";
Nav::node('help', T("Help"), $helpurl);
