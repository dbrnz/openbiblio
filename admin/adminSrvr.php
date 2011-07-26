<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  require_once("../shared/common.php");

	### TODO - legacy feature, replace with following switch ###
	require_once(REL(__FILE__, "../model/Collections.php"));
	require_once(REL(__FILE__, "../model/MediaTypes.php"));
	require_once(REL(__FILE__, "../model/Online.php"));
	require_once(REL(__FILE__, "../model/Settings.php"));
	require_once(REL(__FILE__, "../model/Sites.php"));
	require_once(REL(__FILE__, "../model/Staff.php"));
	require_once(REL(__FILE__, "../model/States.php"));
	require_once(REL(__FILE__, "../model/Themes.php"));
	
	switch ($_REQUEST['cat']) {
		case 'copyFlds':
			require_once(REL(__FILE__, "../model/BiblioCopyFields.php"));
			$ptr = new BiblioCopyFields;
			break;
		case 'mbrFlds':
			require_once(REL(__FILE__, "../model/MemberCustomFields.php"));
			$ptr = new MemberCustomFields;
			break;
		default:
		  echo "<h4>invalid category: &gt;".$_REQUEST['cat']."&lt;</h4><br />";
		  exit;
		break;
	}

	switch ($_REQUEST['mode']){

	  #-.-.-.-.-.- Collections -.-.-.-.-.-.-
		case 'getCircList':
			$ptr = new CircCollections;
		  $colls = array();
			$set = $ptr->getAll('code');
			while ($row = $set->next()) {
			  $colls[] = $row;
			}
			echo json_encode($colls);
			break;
		case 'getDistList':
			$ptr = new DistCollections;
		  $colls = array();
			$set = $ptr->getAll('code');
			while ($row = $set->next()) {
			  $colls[] = $row;
			}
			echo json_encode($colls);
			break;
		case 'getTypes':
			$ptr = new Collections;
			echo json_encode($ptr->getTypeSelect());
			break;
		case 'getAllCollections':
			$ptr = new Collections;
		  $colls = array();
			$set = $ptr->getAllWithStats();
			while ($row = $set->next()) {
			  $colls[] = $row;
			}
			echo json_encode($colls);
			break;
		case 'addNewCollection':
			$ptr = new Collections;
			$col = array(
				'description'=>$_POST["description"],
				'default_flg'=>$_POST['default_flg'],
				'type'=>$_POST["type"],
				'days_due_back'=>$_POST["days_due_back"],
				'daily_late_fee'=>$_POST["daily_late_fee"],
				'restock_threshold'=>$_POST["restock_threshold"],
			);
			list($id, $errors) = $ptr->insert_el($col);
			if (empty($errors)) {
				$msg = T("Collection, %desc%, has been added.", array('desc'=>H($col['description'])));
				echo $msg;
			}
			break;
		case 'updateCollection':
			$ptr = new Collections;
			$coll = array(
				'code'=>$_POST["code"],
				'description'=>$_POST["description"],
				'default_flg'=>$_POST['default_flg'],
				'type'=>$_POST["type"],
				'days_due_back'=>$_POST["days_due_back"],
				'daily_late_fee'=>$_POST["daily_late_fee"],
				'restock_threshold'=>$_POST["restock_threshold"],
			);
			$errors = $ptr->update_el($coll);
			if (empty($errors)) {
				$msg = T("Collection, %desc%, has been updated.", array('desc'=>H($coll['description'])));
			}
			echo $msg;
			break;
		case 'd-3-L-3-tCollections':
			$ptr = new Collections;
			$ptr->deleteOne($_POST['code']);
			$msg = T("Collection, %desc%, has been deleted.", array('desc'=>$description));
			echo $msg;
			break;
			
	  #-.-.-.-.-.-Custom Copy Fields -.-.-.-.-.-.-
		case 'getAllCopyFlds':
			$flds = array();
			$set = $ptr->getAll();
			while ($row = $set->next()) {
			  $flds[] = $row;
			}
			echo json_encode($flds);
			break;
		case 'addNewCopyFld':
			list($id, $errs) = $ptr->insert_el(array(
				'code'=>@$_POST['code'],
				'description'=>@$_POST['description'],
			));
			if ($errs) {echo $errs;} else {echo T("Add New successful");}
			break;
		case 'updateCopyFld':
			$errs = $ptr->update_el(array(
				'code'=>@$_POST["code"],
				'description'=>@$_POST["description"],
			));
			if ($errs) {echo $errs;} else {echo T("Update successful");}
			break;
		case 'd-3-L-3-tCopyFld':
			$ptr->deleteOne($_POST[code]);
			if ($errs) {echo $errs;} else {echo T("Delete completed");}
			break;

	  #-.-.-.-.-.- Custom Member Fields -.-.-.-.-.-.-
		case 'getAllMbrFlds':
			$flds = array();
			$set = $ptr->getAll();
			while ($row = $set->next()) {
			  $flds[] = $row;
			}
			echo json_encode($flds);
			break;
		case 'addNewMbrFld':
			list($id, $errs) = $ptr->insert_el(array(
				'code'=>@$_POST['code'],
				'description'=>@$_POST['description'],
			));
			if ($errs) {echo $errs;} else {echo T("Add New successful");}
			break;
		case 'updateMbrFld':
			$errs = $ptr->update_el(array(
				'code'=>@$_POST["code"],
				'description'=>@$_POST["description"],
			));
			if ($errs) {echo $errs;} else {echo T("Update successful");}
			break;
		case 'd-3-L-3-tMbrFld':
			$ptr->deleteOne($_POST[code]);
			if ($errs) {echo $errs;} else {echo T("Delete completed");}
			break;

  	#-.-.-.-.-.- Media Types -.-.-.-.-.-.-
		case 'getAllMedia':
			$ptr = new MediaTypes;
			$med = array();
			$set = $ptr->getAllWithStats();
			while ($row = $set->next()) {
			  $med[] = $row;
			}
			echo json_encode($med);
			break;
		case 'addNewMedia':
			$ptr = new MediaTypes;
			$type = array(
				'description'=>$_POST["description"],
				'default_flg'=>$_POST['default_flg'],
				'adult_checkout_limit'=>$_POST["adult_checkout_limit"],
				'juvenile_checkout_limit'=>$_POST["juvenile_checkout_limit"],
				'image_file'=>$_POST["image_file"],
				);
			list($id, $errors) = $ptr->insert_el($type);
			if (empty($errors)) {
				$msg = T("Material type, %desc%, has been added.", array('desc'=>H($type['description'])));
				echo $msg;
			}
			break;
		case 'updateMedia':
			$ptr = new MediaTypes;
			$type = array(
				'code'=>$_POST["code"],
				'description'=>$_POST["description"],
				'default_flg'=>$_POST['default_flg'],
				'adult_checkout_limit'=>$_POST["adult_checkout_limit"],
				'juvenile_checkout_limit'=>$_POST["juvenile_checkout_limit"],
				'image_file'=>$_POST["image_file"],
			);
			$errors = $ptr->update_el($type);
			if (empty($errors)) {
				$msg = T("Material type, %desc%, has been updated.", array('desc'=>H($type['description'])));
				echo $msg;
			}
			break;
		case 'd-3-L-3-tMedia':
			$code = $_POST["code"];
			$description = $_POST["desc"];
			$ptr = new MediaTypes;
			$ptr->deleteOne($code);
			$msg = T("Material type, %desc%, has been deleted.", array('desc'=>$description));
			echo $msg;
			break;
				
  	#-.-.-.-.-.- Online Hosts -.-.-.-.-.-.-
		case 'getHosts':
			$ptr = new Hosts;
		  $hosts = array();
			$et = $ptr->getAll('seq');
			while ($row = $set->next()) {
			  $hosts[] = $row;
			}
			echo json_encode($hosts);
			break;
		case 'addNewHost':
			$ptr = new Hosts;
			if (empty($_POST[active])) $_POST[active] = 'n';
			echo $ptr->insert($_POST);
			break;
		case 'updateHost':
			$ptr = new Hosts;
			if (empty($_POST[active])) $_POST[active] = 'n';
			echo $ptr->update($_POST);
			break;
		case 'd-3-L-3-tHost':
			$ptr = new Hosts;
			$sql = "DELETE FROM $ptr->name WHERE `id`=$_GET[id]";
			echo $ptr->db->act($sql);
			break;

	  #-.-.-.-.-.- Online Options -.-.-.-.-.-.-
		case 'getOpts':
			$ptr = new Opts;
	  	$opts = array();
			$set = $ptr->getAll();
			$row = $set->next();
			echo json_encode($row);
			break;
		case 'updateOpts':
			$ptr = new Opts;
		  $_POST[id] = 1;
			if (empty($_POST[autoDewey])) $_POST[autoDewey] = 'n';
			if (empty($_POST[defaultDewey])) $_POST[defaultDewey] = 'n';
			if (empty($_POST[autoCutter])) $_POST[autoCutter] = 'n';
			if (empty($_POST[autoCollect])) $_POST[autoCollect] = 'n';
			$rslt = $ptr->update($_POST);
			if(empty($rslt)) $rslt = '1';
			echo $rslt;
			break;

	  #-.-.-.-.-.- Sites -.-.-.-.-.-.-
		case 'getAllSites':
			$ptr = new Sites;
		  $sites = array();
			$set = $ptr->getAll('name');
			while ($row = $set->next()) {
			  $sites[] = $row;
			}
			echo json_encode($sites);
			break;
		case 'addNewSite':
			$ptr = new Sites;
			echo $ptr->insert($_REQUEST);
			break;
		case 'updateSite':
			$ptr = new Sites;
			echo $ptr->update($_REQUEST);
			break;
		case 'd-3-L-3-tSite':
			$ptr = new Sites;
			echo $ptr->deleteOne($_REQUEST);
			break;

	  #-.-.-.-.-.- Staff -.-.-.-.-.-.-
		case 'getAllStaff':
			$ptr = new Staff;
		  $staff = array();
			$set = $ptr->getAll('last_name');
			while ($row = $set->next()) {
			  $staff[] = $row;
			}
			echo json_encode($staff);
			break;
		case 'addNewStaff':
			foreach (array('suspended','admin','circ','circ_mbr','catalog','reports','tools') as $flg) {
				if (isset($_POST[$flg.'_flg'])) {
					$_POST[$flg.'_flg'] = 'Y';
				} else {
					$_POST[$flg.'_flg'] = 'N';
				}
			}
			$ptr = new Staff;
			echo $ptr->insert_el($_POST);
			break;
		case 'updateStaff':
			$ptr = new Staff;
			echo $ptr->update_el($_POST);
			break;
		case 'd-3-L-3-tStaff':
			$ptr = new Staff;
			echo $ptr->deleteOne($_POST['userid']);
			break;
		case 'setStaffPwd':
			$ptr = new Staff;
			$rec = array('userid'=>$_POST['userid'], 'pwd'=>$_POST['pwd'], 'pwd2'=>$_POST['pwd2']);
			echo $ptr->update_el($rec);
			break;

	  #-.-.-.-.-.- States / Provinces -.-.-.-.-.-.-
		case 'getAllStates':
			$ptr = new States;
		  $states = array();
			$set = $ptr->getAll('description');
			while ($row = $set->next()) {
			  $states[] = $row;
			}
			echo json_encode($states);
			break;
		case 'addNewState':
			$ptr = new States;
			echo $ptr->insert($_REQUEST);
			break;
		case 'updateState':
			$ptr = new States;
			echo $ptr->update($_REQUEST);
			break;
		case 'd-3-L-3-tState':
			$ptr = new States;
			echo $ptr->deleteOne($_REQUEST);
			break;

	  #-.-.-.-.-.- Themes -.-.-.-.-.-.-
		case 'getAllThemes':
			$ptr = new Themes;
		  $thms = array();
			$set = $ptr->getAll('theme_name');
			while ($row = $set->next()) {
			  $thms[] = $row;
			}
			echo json_encode($thms);
			break;
		case 'setCrntTheme':
			$ptr = new Settings;
			echo $ptr->setOne_el('themeid', $_POST['themeid']);
			break;
		case 'addNewTheme':
			$ptr = new Themes;
			echo $ptr->insert_el($_POST);
			break;
		case 'updateTheme':
			$ptr = new Themes;
			echo $ptr->update_el($_POST);
			break;
		case 'd-3-L-3-tTheme':
			$ptr = new Themes;
			echo $ptr->deleteOne($_POST['themeid']);
			break;

  	#-.-.-.-.-.-.-.-.-.-.-.-.-
		default:
		  echo "<h4>invalid mode: &gt;$_REQUEST[mode]&lt;</h4><br />";
		break;
	}
