<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	require_once("../shared/common.php");
	require_once(REL(__FILE__, "../functions/inputFuncs.php"));
	require_once(REL(__FILE__, "../classes/Query.php"));
	require_once(REL(__FILE__, "../model/Sites.php"));
	require_once(REL(__FILE__, "../model/Copies.php"));
	require_once(REL(__FILE__, "../model/CopyStates.php"));

	## --------------------- ##
class SrchDb {
	public $bibid;
	public $createDt;
	public $daysDueBack;
	public $matlCd;
	public $collCd;
	public $imageFile;
	public $opacFlg;

	function SrchDb () {
		$this->db = new Query;
	}
	## ========================= ##
	function getBiblioByBarcd($barcd){
		$sql = "SELECT b.bibid "
					."	FROM `biblio_copy` bc,`biblio` b "
					." WHERE (bc.`barcode_nmbr` = $barcd)"
					."	 AND (b.`bibid` = bc.`bibid`)";
		//echo "sql=$sql<br />";
		$rcd = $this->db->select01($sql);
		$this->barCd = $barcd;
		$this->bibid = $rcd[bibid];
		return $rcd;
	}
	## ========================= ##
	function getBiblioByPhrase($mode, $jsonSpec) {
	  $spec = json_decode($jsonSpec, true);
	  if ($mode == 'words')
			$keywords = explode(' ',$_REQUEST[searchText]);
		else
			$keywords[] = $_REQUEST[searchText];

//print_r($_REQUEST[searchText]);echo "<br />";
//print_r($keywords);echo "<br />";

	  $sql = "SELECT DISTINCT bs.bibid "
					."  FROM `biblio_field` bf, `biblio_subfield` bs "
					." WHERE (1=1) AND ";
		$firstLine = true;
		foreach ($keywords as $kwd) {
		foreach ($spec as $item) {
		  if (!$firstLine)
				$sql .= " OR ";
			else
				$firstLine = false;
			$sql .= "   ( (bf.`tag` = '$item[tag]') "
			      . "	AND (bs.`bibid` = bf.`bibid`) "
			      . "	AND (bs.`fieldid` = bf.`fieldid`) "
			      . "	AND (bs.`subfield_cd` = '$item[suf]') "
//			      . " AND (bs.`subfield_data` LIKE '%$_REQUEST[searchText]%') "
			      . " AND (bs.`subfield_data` LIKE '%$kwd%') "
			      . " )";
		}
		}
//echo "sql=$sql<br />";
		$rows = $this->db->select($sql);
		while (($row = $rows->next()) !== NULL) {
			$rslt[] = $row[bibid];
		}
		return $rslt;
	}
	## ========================= ##
	function getBiblioInfo($bibid) {
	  $this->bibid =$bibid;
		$sql = "SELECT DISTINCT b.*, m.description, cd.description, cc.`days_due_back`, m.image_file "
					."	FROM `biblio` b,`material_type_dm` m,"
					."			 `collection_dm` cd, `collection_circ` cc"
					." WHERE (b.`bibid` = '$bibid')"
					."	 AND (m.`code` = b.`material_cd`)"
					."	 AND (cd.`code` = b.`collection_cd`)"
					."	 AND (cc.`code` = b.`collection_cd`)";
		$rcd = $this->db->select01($sql);
		$this->createDt = $rcd[create_dt];
		$this->daysDueBack = $rcd[days_due_back];
		$this->matlCd = $rcd[material_cd];
		$this->collCd = $rcd[collection_cd];
		$this->imageFile =$rcd[image_file];
		$this->opacFlg = $rcd[opac_flg];
		return $rcd;
	}
	## ========================= ##
	function getBiblioDetail() {
		$sql = "SELECT  CONCAT(bf.tag,bs.subfield_cd) AS marcTag, "
				 . "				m.label, bs.subfield_data AS value, "
				 . "				bs.fieldid, bs.subfieldid "
				 . "  FROM `material_fields` m, `biblio_field` bf, `biblio_subfield` bs "
				 . " WHERE (bf.`bibid` = $this->bibid) "
				 . "	 AND (bs.`bibid` = bf.`bibid`) "
				 . "	 AND (bs.`fieldid` = bf.`fieldid`) "
				 . "	 AND (m.`material_cd` = $this->matlCd) "
				 . "	 AND (m.`tag` = bf.`tag`) "
				 . "	 AND (m.`subfield_cd` = bs.`subfield_cd`) "
				 . " ORDER BY m.position ";
		//echo "sql=$sql<br />";
		$rows = $this->db->select($sql);
		while (($row = $rows->next()) !== NULL) {
			$rslt[] = json_encode($row);
		}
		return $rslt;
	}
	## ========================= ##
	function getCopyInfo ($bibid) {
		$copies = new Copies; // needed later
		$bcopies = $copies->getMatches(array('bibid'=>$bibid));
		$copy_states = new CopyStates;
		$states = $copy_states->getSelect();
		$history = new History;
		$bookings = new Bookings;

		while ($copy = $bcopies->next()) {
			$status = $history->getOne($copy['histid']);
			$booking = $bookings->getByHistid($copy['histid']);
	  	if ($_SESSION['show_copy_site'] == 'Y') {
				$sites_table = new Sites;
				$sites = $sites_table->getSelect();
				$copy['site'] = $sites[$copy[siteid]];
			}
			$copy['status'] = $states[$status[status_cd]];
			if($_SESSION['show_checkout_mbr'] == "Y" && $status[status_cd] == "out"){
				$checkout_mbr = $copies->getCheckoutMember($copy[histid]);
				$copy['mbrId'] = $checkout_mbr[mbrid];
				$copy['mbrName'] = "$checkout_mbr[first_name] $checkout_mbr[last_name]";
			}
			$rslt[] = json_encode($copy);
		}
		return $rslt;
	}
	## ========================= ##
	function insertCopy($bibid,$copyid) {
		$this->db->lock();
		$sql = "INSERT `biblio_copy` SET "
		      ."`bibid` = $bibid,"
		      ."`barcode_nmbr` = '$_POST[barcode_nmbr]',"
		      ."`create_dt` = NOW(),"
		      ."`last_change_dt` = NOW(),"
		      ."`last_change_userid` = $_SESSION[userid],"
		      ."`copy_desc` = '$_POST[copy_desc]' ";
		//echo "sql=$sql<br />";
		$rows = $this->db->act($sql);
		$copyid = $this->db->getInsertID();
		$sql = "Insert `biblio_status_hist` SET "
		      ."`bibid` = $bibid,"
		      ."`copyid` = $copyid,"
		      ."`status_cd` = '$_POST[status_cd]',"
		      ."`status_begin_dt` = NOW()";
		//echo "sql=$sql<br />";
		$rows = $this->db->act($sql);
		$histid = $this->db->getInsertID();
		$sql = "Update `biblio_copy` SET "
		      ."`histid` = '$histid' "
					." WHERE (`bibid` = $bibid) AND (`copyid` = $copyid) ";
		//echo "sql=$sql<br />";
		$rows = $this->db->act($sql);
		$this->db->unlock();
		return T('Update completed');
	}
	## ========================= ##
	function updateCopy($bibid,$copyid) {
		$this->db->lock();
		$sql = "UPDATE `biblio_copy` SET "
		      ."`barcode_nmbr` = '$_POST[barcode_nmbr]',"
		      ."`copy_desc` = '$_POST[copy_desc]' "
					." WHERE (`bibid` = $bibid) AND (`copyid` = $copyid) ";
		//echo "sql=$sql<br />";
		$rows = $this->db->act($sql);

		$sql = "SELECT `status_cd` FROM `biblio_status_hist` "
					." WHERE (`bibid` = $bibid) AND (`copyid` = $copyid)";
		//echo "sql=$sql<br />";
		$rcd = $this->db->select1($sql);
		if ($rcd[status_cd] != $_POST[status_cd]) {
			$sql = "UPDATE `biblio_status_hist` SET "
			      ."`status_cd` = '$_POST[status_cd]',"
			      ."`status_begin_dt` = NOW() "
						." WHERE (`bibid` = $bibid) AND (`copyid` = $copyid) ";
			//echo "sql=$sql<br />";
			$rows = $this->db->act($sql);
		}
		$this->db->unlock();
		return T('Update completed');
	}
	## ========================= ##
	function deleteCopy($bibid,$copyid) {
		$this->db->lock();
		$sql = "DELETE FROM `biblio_copy` "
					." WHERE (`bibid` = $bibid) AND (`copyid` = $copyid) ";
		//echo "sql=$sql<br />";
		$rows = $this->db->act($sql);
		$this->db->unlock();
		return T('Delete completed');
	}
	## ========================= ##
	function getBiblioFields() {
		function getlabel($f) {
			global $LOC;
			$label = "";
			if ($f['label'] != "") {
				$label = $f['label'];
			} elseif ($f['subfield'] != "") {
				$idx = sprintf("%03d$%s", $f['tag'], $f['subfield']);
				$label = $LOC->getMarc($idx);
			} else {
				$label = $LOC->getMarc($f['tag']);
			}
			return $label;
		}
		function mkinput($fid, $sfid, $data, $f) {
//print_r($f);echo "<br />";
			return array('fieldid' => $fid,
				'subfieldid' => $sfid,
				'data' => $data,
				'tag' => $f['tag'],
				'subfield' => $f['subfield_cd'],
				'label' => getlabel($f),
				'required' => $f['required'],
				'form_type' => $f['form_type'],
				'repeat' => $f['repeatable']);
		}
		function mkFldSet($n, $i, $marcInputFld, $mode) {
			echo "	<td valign=\"top\" class=\"primary\"> \n";
		  if ($mode == 'onlnCol') {
				$namePrefix = "onln[$n]";
		    echo "<input type=\"button\" value=\"accept\" id=\"$namePrefix"."_btn\" /> \n";
			}
			else if ($mode == 'editCol') {
				$namePrefix = 'fields['.H($n).']';
				echo inputfield('hidden', $namePrefix."[tag]",         H($i['tag']))." \n";
				echo inputfield('hidden', $namePrefix."[subfield_cd]", H($i['subfield']))." \n";
				echo inputfield('hidden', $namePrefix."[fieldid]",     H($i['fieldid']),
												array('id'=>$marcInputFld.'_fieldid'))." \n";
				echo inputfield('hidden', $namePrefix."[subfieldid]",  H($i['subfieldid']),
												array('id'=>$marcInputFld.'_subfieldid'))." \n";
			}
			
			$attrs = array("id"=>"$marcInputFld");
			$attrStr = "marcBiblioFld";
			if ($i['required'])
			  $attrStr .= " reqd";
			if ($i['repeat'])
			  $attrStr .= " rptd";
			else
			  $attrStr .= " only1";
			$attrs["class"] = $attrStr;

			if ($i['form_type'] == 'text') {
			  $attrs["size"] = "50"; $attrs["maxLength"] = "75";
				echo inputfield('text', $namePrefix."[data]", H($i['data']),$attrs)." \n";
			} else {
				// IE seems to make the font-size of a textarea overly small under
				// certain circumstances.  We force it to a sane value, even
				// though I have some misgivings about it.  This will make
				// the font smaller for some people.
				$attrs["style"] = "font-size:10pt; font-weight: normal;";
				$attrs["rows"] = "7"; $attrs["cols"] = "38";
				echo inputfield('textarea', $namePrefix."[data]", H($i['data']),$attrs)." \n";
			}
			echo "</td> \n";
		}
		
		$mf = new MaterialFields;

		// get field specs in 'display postition' order
		$fields = $mf->getMatches(array('material_cd'=>$_REQUEST[matlCd]), 'position');

		## anything to process for current media type (material_cd) ?
		if ($fields->count() == 0) {
			echo "<tr><td colspan=\"2\" class=\"primary\">.T('No fields to fill in.').</td></tr>\n";
		}

		## build an array of fields to be displayed on user form
		$inputs = array();
		while (($f=$fields->next())) {
		  #  make multiples of those so flagged
			for ($n=0; $n<=$f['repeatable']; $n++) {
				array_push($inputs, mkinput(NULL, NULL, NULL, $f));
			}
		}

		## now build html for those input fields
		foreach ($inputs as $n => $i) {
			$marcInputFld = H($i['tag']).H($i['subfield']);
			echo "<tr> \n";
			echo "	<td class=\"primary\" valign=\"top\"> \n";
			if ($i['required']) {
				echo '	<sup>*</sup>';
			}
			echo "		<label for=\"$marcInputFld\">".H($i['label'].":")."</label>";
			echo "	</td> \n";
			
			mkFldSet($n, $i, $marcInputFld, 'editCol');	// normal local edit column
			mkFldSet($n, $i, $marcInputFld, 'onlnCol');  // update on-line column

		echo "</tr> \n";
		}
	}
}
	#****************************************************************************
	switch ($_REQUEST[mode]) {
	case 'getCrntMbrInfo':
		require_once(REL(__FILE__, "../functions/info_boxes.php"));
		echo currentMbrBox();
	  break;

	case 'getMaterialList':
		require_once(REL(__FILE__, "../model/MaterialTypes.php"));
		$mattypes = new MaterialTypes;
		echo inputfield('select', 'mediaType', 'all', NULL, $mattypes->getSelect(true));
	  break;

	case 'getCollectionList':
		require_once(REL(__FILE__, "../model/Collections.php"));
		$collections = new Collections;
		echo inputfield('select', "collectionCd", $value, NULL, $collections->getSelect());
	  break;

	case 'doBarcdSearch':
	  $theDb = new SrchDB;
	  $rslt = $theDb->getBiblioByBarcd($_REQUEST[searchText]);
	  if ($rslt != NULL) {
	  	$theDb->getBiblioInfo($theDb->bibid);
			echo "{'barCd':'$theDb->barCd','bibid':'$theDb->bibid','imageFile':'$theDb->imageFile',"
					."'daysDueBack':'$theDb->daysDueBack', 'createDt':'$theDb->createDt',"
					."'matlCd':'$theDb->matlCd', 'collCd':'$theDb->collCd', 'opacFlg':'$theDb->opacFlg',"
					."'data':".json_encode($theDb->getBiblioDetail())
					."}";
		} else {
			echo "{'data':null}";
		}
	  break;

	case 'doPhraseSearch':
	  $theDb = new SrchDB;
	  switch ($_REQUEST[searchType]) {
	    case 'title': 		$biblioLst = $theDb->getBiblioByPhrase('phrase','[{"tag":"245","suf":"a"},
																											 {"tag":"245","suf":"b"}]'); break;
			case 'author': 		$biblioLst = $theDb->getBiblioByPhrase('phrase','[{"tag":"100","suf":"a"},
					 																						 {"tag":"245","suf":"c"}]'); break;
			case 'subject': 	$biblioLst = $theDb->getBiblioByPhrase('words','[{"tag":"650","suf":"a"}]'); break;
			case 'keyword': 	$biblioLst = $theDb->getBiblioByPhrase('words','[{"tag":"245","suf":"a"},
																											 {"tag":"650","suf":"a"},
																											 {"tag":"100","suf":"a"},
					 																						 {"tag":"245","suf":"c"}]'); break;
//		case 'series': 		$rslts = $theDb->getBiblioByPhrase('[{"tag":"000","suf":"a"}]'); break;
			case 'publisher': $biblioLst = $theDb->getBiblioByPhrase('phrase','[{"tag":"260","suf":"b"}]'); break;
			case 'callno': 		$biblioLst = $theDb->getBiblioByPhrase('phrase','[{"tag":"099","suf":"a"}]'); break;
	    
	  	default:
	  		echo "<h5>Invalid Search Type: $_REQUEST[srchBy]</h5>";
	  		exit;
		}
		if (sizeof($biblioLst) > 0) {
			foreach ($biblioLst as $bibid) {
				$theDb->getBiblioInfo($bibid);
				$biblio[] =  "{'barCd':'$theDb->barCd','bibid':'$theDb->bibid','imageFile':'$theDb->imageFile',"
										."'daysDueBack':'$theDb->daysDueBack', 'createDt':'$theDb->createDt',"
										."'matlCd':'$theDb->matlCd', 'collCd':'$theDb->collCd', 'opacFlg':'$theDb->opacFlg',"
										."'data':".json_encode($theDb->getBiblioDetail())
										."}";
			}
			echo json_encode($biblio);
		} else {
			echo '[]';
		}
		break;
		
	case 'addToCart':
		require_once(REL(__FILE__, "../model/Cart.php"));
		$name = $_REQUEST['name'];
		$cart = getCart($name);
		if (isset($_REQUEST['id'])) {
			foreach ($_REQUEST['id'] as $id) {
				$rslt = $cart->contains($id);
				if (!$rslt) $cart->add($id);
			}
		}
	  break;

	case 'getBarcdNmbr':
		require_once(REL(__FILE__, "../model/Copies.php"));
		$copies = new Copies;
		$CopyNmbr= $copies->getNextCopy();
		echo "{'barcdNmbr':'".sprintf("%05s",$_REQUEST[bibid])."$CopyNmbr'}";
	  break;

	case 'getBiblioFields':
		require_once(REL(__FILE__, "../model/MaterialFields.php"));
		$theDb = new SrchDB;
		$theDb->getBiblioFields();
		break;
		
	case 'getCopyInfo':
	  $theDb = new SrchDB;
	  echo json_encode($theDb->getCopyInfo($_REQUEST[bibid]));
	  break;

	case 'updateBiblio':
	  require_once(REL(__FILE__,"biblio_updater.php"));
	  break;
	  
	case 'updateCopy':
	  $theDb = new SrchDB;
		echo $theDb->updateCopy($_REQUEST[bibid],$_REQUEST[copyid]);
		break;

	case 'newCopy':
	  $theDb = new SrchDB;
		echo $theDb->insertCopy($_REQUEST[bibid],$_REQUEST[copyid]);
		break;

	case 'deleteCopy':
	  $theDb = new SrchDB;
		echo $theDb->deleteCopy($_REQUEST[bibid],$_REQUEST[copyid]);
		break;

	default:
	  echo "<h5>Invalid mode: $_REQUEST[mode]</h5>";
	}
