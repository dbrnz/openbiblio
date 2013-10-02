<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once(REL(__FILE__, "../classes/CoreTable.php"));
require_once(REL(__FILE__, "../model/CopiesCustomFields.php"));
require_once(REL(__FILE__, "../model/History.php"));

/**
 * BiblioCopy-specific specification & search facilities
 * additional functions from SrchDb integrated 3 Aug 2013 - FL
 * some duplication apparent, re-factoring is probably desirable. - FL
 * @author Micah Stetson
 */

class Copies extends CoreTable {
	public function __construct() {
		parent::__construct();
		$this->setName('biblio_copy');
		$this->setFields(array(
			'bibid'=>'number',
			'copyid'=>'number',
			'barcode_nmbr'=>'string',
			'copy_desc'=>'string',
			#'vendor'=>'string',
			#'fund'=>'string',
			#'price'=>'string',
			#'expiration'=>'string',
			'histid'=>'number',
			'siteid'=>'number',
		));
		$this->setKey('copyid');
		$this->setSequenceField('copyid');
		$this->setForeignKey('bibid', 'biblio', 'bibid');
		$this->setForeignKey('histid', 'biblio_status_hist', 'histid');
		$this->setForeignKey('siteid', 'site', 'siteid');
		
		$this->custom = new CopiesCustomFields;
		$this->custom->setName('biblio_copy_fields');
		$this->custom->setFields(array(
			'copyid'=>'string',
			'code'=>'string',
			'data'=>'string',
		));
		$this->custom->setKey('copyid', 'code');
	 }

	public function getCpyList($bibid) {
		$rslt = $this->getKeyList('copyid',array('bibid'=>$bibid));
		$cpys = array();
		while($row = $rslt->fetch_assoc()) {
			$cpys[] = $row['copyid'];
		}
		return $cpys;
	}
	public function getByBarcode($barcode) {
		$rows = $this->getMatches(array('barcode_nmbr'=>$barcode));
		if ($rows->num_rows == 0) {
			$barcode = $this->normalizeBarcode($barcode);
			$rows = $this->getMatches(array('barcode_nmbr'=>$barcode));
		}
		if ($rows->num_rows == 0) {
			return NULL;
		} else if ($rows->num_rows == 1) {
			return $rows->fetch_assoc();
		} else {
			Fatal::internalError(T("Duplicate barcode: %barcode%", array('barcode'=>$barcode)));
		}
	}
/*
	function getNextCopy() {
	  ## deprecated - retained for compatability with legacy code
		$sql = $this->mkSQL("select max(copyid) as nextCopy from biblio_copy");
		$nextCopy = $this->select1($sql);
		return $nextCopy["nextCopy"]+1;
	}
*/
	public function getNewBarCode($width) {
		//$sql = $this->mkSQL("select max(copyid) as lastCopy from biblio_copy");
		$sql = $this->mkSQL("select max(barcode_nmbr) as lastNmbr from biblio_copy");
		$cpy = $this->select1($sql);
	  if(empty($width)) $w = 13; else $w = $width;
		return sprintf("%0".$w."s",($cpy[lastNmbr]+1));
	}
	
	## ========================= ##
	public function getBibsForCpys ($barcode_list) {
		global $opts;
		$copies = new Copies;
		# build an array of barcodes
		$barcodes = array();
		foreach (explode("\n", $barcode_list) as $b) {
			if (trim($b) != "") {
				$barcodes[] = str_pad(trim($b), $opts['barcdWidth'], '0', STR_PAD_LEFT);
			}
		}
		$rslt = $copies->lookupBulk_el($barcodes);
		return $rslt;
	}

	## ========================= ##
	public function getCopyInfo ($bibid) {
		$copies = new Copies; // needed later
		$bcopies = $copies->getMatches(array('bibid'=>$bibid),'barcode_nmbr');
		$copy_states = new CopyStatus;
		$states = $copy_states->getSelect();
		$history = new History;
		$bookings = new Bookings;

		$BCQ = new BiblioCopyFields;
		$custRows = $BCQ->getAll();
		$custFieldList = array();
		while ($row = $custRows->fetch_assoc()) {
			$custFieldList[$row["code"]] = "";
		}

		while ($copy = $bcopies->fetch_assoc()) {
			$status = $history->getOne($copy['histid']);
			$booking = $bookings->getByHistid($copy['histid']);
			if ($_SESSION['multi_site_func'] > 0) {
				$sites_table = new Sites;
				$sites = $sites_table->getSelect();
				$copy['site'] = $sites[$copy[siteid]];
			}
			$copy['status'] = $states[$status[status_cd]];
			$copy['statusCd'] = $status[status_cd];
			if($_SESSION['show_checkout_mbr'] == "Y" && ($status[status_cd] == OBIB_STATUS_OUT || $status[status_cd] == OBIB_STATUS_ON_HOLD)){
				if($status[status_cd] == OBIB_STATUS_OUT){
					$checkout_mbr = $copies->getCheckoutMember($copy[histid]);
				} else {
					$checkout_mbr = $copies->getHoldMember($copy[copyid]);
				}
				$copy['mbrId'] = $checkout_mbr[mbrid];
				$copy['mbrName'] = "$checkout_mbr[first_name] $checkout_mbr[last_name]";
			}
			// Add custom fields - Bit complicated, but seems the easiest way to populate empty fields (list compiled at beginning of procedure to lower databse queries)
			// Now populate data
			$custom = $copies->getCustomFields($copy[copyid]);
			$copy['custFields'] = array();
			$fieldList = $custFieldList;
			//while ($row = $custom->fetch_assoc() ) {
			while ($row = $custom->fetch_assoc() ) {
				$fieldList[$row["code"]] = $row["data"];
			}

			//Finally add to copy
			foreach($fieldList as $key => $value){
				$copy['custFields'][] = array('code' => $key, 'data' => $value);
			}
			$rslt[] = json_encode($copy);
		}
		return $rslt;
	}
	## ========================= ##
	public function insertCopy($bibid,$copyid) {
		//$this->lock();
		if (empty($_POST['copy_site'])) {
			$theSite = $_SESSION['current_site'];
		} else {
			$theSite = $_POST['copy_site'];
		}
		$sql = "INSERT `biblio_copy` SET "
		      ."`bibid` = $bibid,"
		      ."`barcode_nmbr` = '".$_POST['barcode_nmbr']."',"
		      ."`siteid` = '$theSite'," // set to current site
		      ."`create_dt` = NOW(),"
		      ."`last_change_dt` = NOW(),"
		      ."`last_change_userid` = $_SESSION[userid],"
		      ."`copy_desc` = '".$_POST['copy_desc']."' ";
		$rows = $this->act($sql);
		$copyid = $this->getInsertID();

		$sql = "Insert `biblio_status_hist` SET "
		      ."`bibid` = $bibid,"
		      ."`copyid` = $copyid,"
		      ."`status_cd` = '$_POST[status_cd]',"
		      ."`status_begin_dt` = NOW()";
		$rows = $this->act($sql);
		$histid = $this->getInsertID();

		$sql = "Update `biblio_copy` SET "
		      ."`histid` = '$histid' "
					." WHERE (`bibid` = $bibid) AND (`copyid` = $copyid) ";
		$rows = $this->act($sql);
		//$this->unlock();

		$this->postCstmCopyFlds($bibid, $copyid);

		return "!!success!!";
	}
	## ========================= ##
	public function updateCopy($bibid,$copyid) {
		$this->lock();
		$sql = "SELECT `status_cd`, `histid` FROM `biblio_status_hist` "
					." WHERE (`bibid` = $bibid) AND (`copyid` = $copyid)"
					." ORDER BY status_begin_dt";
		$rslt = $this->select($sql);
		$rcd = $rslt->fetch_assoc();  // only first (most recent) response wanted
		$histid = $rcd['histid'];

		if ($rcd[status_cd] != $_POST[status_cd]) {
			$sql = "INSERT `biblio_status_hist` SET "
			      ."`status_cd` = '$_POST[status_cd]',"
			      ."`status_begin_dt` = NOW(),"
						."`bibid` = $bibid,"
						."`copyid` = $copyid ";
			$rslt = $this->act($sql);
			$histid = $this->getInsertID();
		}

		$sql = "UPDATE `biblio_copy` SET "
		      ."`barcode_nmbr` = '$_POST[barcode_nmbr]', "
		      ."`copy_desc` = '$_POST[copy_desc]', "
		      ."`siteid` = '$_POST[siteid]', "
					."`histid` = $histid "
					." WHERE (`bibid` = $bibid) AND (`copyid` = $copyid) ";
		$rows = $this->act($sql);

		$this->postCstmCopyFlds($bibid, $copyid);

		$this->unlock();
		// Changed this to nothing, so any message/output is taken as an error message - LJ
		// Changed to specific success text to be looked for in JS - FL
		echo "!!success!!";
		return;
	}
	## ========================= ##
	public function deleteCopy($copyid) {
		$this->lock();
		$sql = "DELETE FROM `biblio_copy` "
					." WHERE (`copyid` = $copyid) ";
		//echo "sql=$sql<br />";
		$rows = $this->act($sql);
		if ($rows == '0') die ("copy# {$copyid} delete failed");

		$sql = "DELETE FROM `biblio_copy_fields` "
					." WHERE (`copyid` = $copyid) ";
		//echo "sql=$sql<br />";
		$rows = $this->act($sql);
		if ($rows == '0') die ("copy_field# {$copyid} delete failed");

		$this->unlock();
		return T("Delete completed");
	}
	## ========================= ##
	private function postCstmCopyFlds ($bibid, $copyid) {
		// Update custom fields if set
		$custom = array();
		$ptr = new BiblioCopyFields;
		$rows = $ptr->getAll();
		while ($row = $rows->fetch_assoc()) {
			if (isset($_REQUEST['copyCustom_'.$row["code"]])) {
				$custom[$row["code"]] = $_POST['copyCustom_'.$row["code"]];
			}
		}
		$copies = new Copies;
		$copies->setCustomFields($copyid, $custom);
	}
	protected function insert_el($copy) {
		$this->lock();
		list($id, $errors) = parent::insert_el($copy);
		if (!$errors) {
			$history = new History;
			$history->insert(array(
				'bibid'=>$copy['bibid'], 'copyid'=>$id, 'status_cd'=>'in', 'siteid'=>$copy['siteid'],
			));
		}
		$this->unlock();
		return array($id, $errors);
	}
	protected function validate_el($copy, $insert) {
		$errors = array();
		foreach (array('bibid', 'barcode_nmbr') as $req) {
			if ($insert and !isset($copy[$req])
					or isset($copy[$req]) and $copy[$req] == '') {
				$errors[] = new FieldError($req, T("Required field missing"));
			}
		}
		if($this->isDuplicateBarcd($copy['barcode_nmbr'], $copy['copyid'])){
			$errors[] = new FieldError('barcode_nmbr', T("Barcode number already in use."));
		}
		return $errors;
	}
	public function isDuplicateBarcd($barcd,$cpyid) {
		/* Check for duplicate barcodes */
		/* broken out from validate_el() for access by client via AJAX - fl*/
		if (isset($barcd)) {
			$sql = $this->mkSQL("select count(*) count from biblio_copy "
				. "where barcode_nmbr=%Q ", $barcd);
			if (isset($cpyid)) {
				$sql .= $this->mkSQL("and not copyid=%N ", $cpyid);
			}
			$duplicates = $this->select1($sql);
			if ($duplicates['count'] > 0) {
				$errors[] = new FieldError('barcode_nmbr', T("Barcode number already in use."));
				return true;
			}
			return false;
		}
	}

	/**
	 * Convert a barcode to the preferred form.
	 * Currently this strips leading zeros, possibly after an
	 * alphabetic prefix.
	 */
	protected function normalizeBarcode($barcode) {
		return preg_replace('/^([A-Za-z]+)?0*(.*)/', '\\1\\2', $barcode);
	}

	public function getMemberCheckouts($mbrid) {
		$sql = "select c.copyid "
			. "from biblio_copy c, booking b, booking_member m "
			. "where c.histid = b.out_histid "
			. "and m.bookingid = b.bookingid ";
		$sql .= $this->mkSQL("and m.mbrid=%N ", $mbrid);
		return $this->select($sql);
	}

	public function getCheckoutMember($histid) {
		$sql = "select mbr.* "
				 . "from member mbr, booking bk, booking_member bkm "
				 . "where mbr.mbrid=bkm.mbrid "
				 . "and bkm.bookingid=bk.bookingid ";
		$sql .= $this->mkSQL("and bk.out_histid=%N ", $histid);
		$result = $this->select($sql);
		return ($result->fetch_assoc());
	}

	public function getHoldMember($copyid) {
		$sql = "select mbr.* "
				 . "from member mbr, biblio_hold bh "
				 . "where mbr.mbrid=bh.mbrid ";
		$sql .= $this->mkSQL("and bh.copyid=%N order by bh.hold_begin_dt", $copyid);
		$result = $this->select($sql);
		return ($result->fetch_assoc());
	}	

	public function lookupBulk_el($barcodes) {
		$copyids = array();
		$bibids = array();
		$errors = array();
		foreach ($barcodes as $b) {
			$copy = $this->getByBarcode($b);
			if (!$copy) {
				$errors[] = new Error(T("No copy with barcode")/' '.$b);
			} else {
				if (!in_array($copy['copyid'], $copyids)) {
					$copyids[] = $copy['copyid'];
				}
				if (!in_array($copy['bibid'], $bibids)) {
					$bibids[] = $copy['bibid'];
				}
			}
		}
		return array($copyids, $bibids, $errors, $barcodes);
	}
	public function lookupAvability ($bibid) {
		$sql = "select c.copyid, c.siteid, h.status_cd "
				 . "from biblio_copy c, biblio_status_hist h "
				 . "where (c.bibid = {$bibid}) "
				 . "  and (h.histid = c.histid) ";
		$rslt = $this->select($sql);
		$nCpy = $rslt->num_rows;

		## default - copy not available
		$avIcon = "circle_red.png";

		while ($row = $rslt->fetch_assoc()) {
			if($row['status_cd'] == OBIB_STATUS_IN) {
				// See on which site
				if($_SESSION['current_site'] == $row['siteid'] || !($_SESSION['multi_site_func'] > 0)){
					$avIcon = "circle_green.png"; // one or more available
					break;
				} else {
					$avIcon = "circle_orange.png"; // one or more available on another site
				}
			}
			// Removed && $this->avIcon != "circle_orange.png" as and extra clause, as it is better to show the book is there, even if not available
			else if($copy[status_cd] == OBIB_STATUS_ON_HOLD || $copy[status_cd] == OBIB_STATUS_NOT_ON_LOAN) {
				$avIcon = "circle_blue.png"; // only copy is on hold
			}
		}
		$rcd['nCpy'] = $nCpy;
		$rcd['avIcon'] = $avIcon;
		return $rcd;
	}
	public function lookupNoCopies($bibids, $del_copyids) {
		$no_copies = array();
		foreach ($bibids as $bibid) {
			$has_copies = false;
			$copies = $this->getMatches(array('bibid'=>$bibid));
			while ($c = $copies->fetch_assoc()) {
				if (!in_array($c['copyid'], $del_copyids)) {
					$has_copies = true;
					break;
				}
			}
			if (!$has_copies) {
				$no_copies[] = $bibid;
			}
		}
		return $no_copies;
	}
	public function getShelvingCart() {
		$sql = "select bc.* "
			. "from biblio_copy bc, biblio_status_hist bsh "
			. "where bc.histid=bsh.histid "
			. $this->mkSQL("and bsh.status_cd=%Q ",
				OBIB_STATUS_SHELVING_CART);
		//echo "sql=$sql<br />\n";
		return $this->select($sql);
	}
	/* way incomplete, done in Copy object now
	function checkin($bibids,$copyids) {
		$this->lock();
		$history = new History;
		for ($i=0; $i < count($bibids); $i++) {
		 $hist = array(
			 'bibid'=>$bibids[$i],
			 'copyid'=>$copyids[$i],
			 'status_cd'=>OBIB_STATUS_IN,
		 );
		 $history->insert($hist);
		}
		$this->unlock();
	}
	*/
	public function massCheckin() {
		$this->lock();
		$cart = $this->getShelvingCart();
		$bibids = array();
		$copyids = array();
		while ($copy = $cart->fetch_assoc()) {
			array_push($bibids, $copy['bibid']);
			array_push($copyids, $copy['copyid']);
		}
		$this->checkin($bibids, $copyids);
		$this->unlock();
	}
	public function getCustomFields($copyid, $arrayWanted=false) {
		$rslt = $this->custom->getMatches(array('copyid'=>$copyid));
		if ($arrayWanted) {
			while ($row = $rslt->fetch_assoc()) {
				$flds[] = $row;
			}
			return $flds;
		}
		return $rslt;
	}
	public function deleteCustomFields($copyid) {
		return $this->custom->deleteMatches(array('copyid'=>$copyid));
	}

	public function setCustomFields($copyid, $customFldsarr) {
		$this->custom->deleteMatches(array('copyid'=>$copyid));
		foreach ($customFldsarr as $code => $data) {
			$fields= array(
				copyid=>$copyid ,
				code=>$code,
				data=>$data
			);
			$this->custom->insert($fields);
		}
	}
}
