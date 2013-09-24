<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  require_once("../shared/common.php");
	//print_r($_REQUEST);echo "<br />";

/**
 * back-end API for various pull-down lists based on DB tables
 * @author Fred LaPlante
 */

	function getDbData ($db) {
		$set = $db->getSelect();
		foreach ($set as $val => $desc) {
			$list[$val] = $desc;
		}
		return $list;
	}
	function getDmData ($db) {
		$set = $db->getAll('description');
		while ($row = $set->fetch_assoc()) {
		  $list[$row['code']] = $row['description'];
		}
		return $list;
	}
	
	switch ($_REQUEST['mode']) {
	case 'getOpts':
		$opts = Settings::getAll();
		echo json_encode($opts);
		break;

	case 'getCalendarList':
		require_once(REL(__FILE__, "../model/Calendars.php"));
		$db = new Calendars;
		$list = getDmData($db);
		echo json_encode($list);
	  break;

	case 'getCollectionList':
		require_once(REL(__FILE__, "../model/Collections.php"));
		$db = new Collections;
		$list = getDmData($db);
		echo json_encode($list);
	  break;

	case 'getInputTypes':
		require_once(REL(__FILE__, "../model/MaterialFields.php"));
		$db = new MaterialFields;
		$sql = "SHOW COLUMNS FROM material_fields";
		$rslt = $db->select($sql);
		while ($col = $rslt->fetch_assoc()) {
			if ($col['Field'] == 'form_type') break;
		}
		$enum = $col['Type'];
		echo $enum;
	  break;
	case 'getMediaMarcTags':
		require_once(REL(__FILE__, "../model/MaterialFields.php"));
		$db = new MaterialFields;
		$sql = "SELECT * FROM `material_fields` WHERE `material_cd`={$_REQUEST['media']} ORDER BY tag,subfield_cd";
		$rslt = $db->select($sql);
		while ($row = $rslt->fetch_assoc()) {
			$tags[$row['tag'].'$'.$row['subfield_cd']] = $row['label'];
		}
		echo json_encode($tags);
		break;

	case 'getLocaleList':
		$arr_lang = Localize::getLocales();
		foreach ($arr_lang as $langCode => $langDesc) {
			//echo '<option value="'.H($langCode).'">'.H($langDesc)."</option>\n";
			$list[$langCode] = $langDesc;
		}
		echo json_encode($list);
		break;
	case 'getThemeList':
		require_once(REL(__FILE__, "../model/Themes.php"));
		$db = new Themes;
		$set = $db->getAll('theme_name');
		while ($row = $set->fetch_assoc()) {
		  $list[$row['themeid']] = $row['theme_name'];
		}
		echo json_encode($list);
	  break;

	case 'getMediaList':
		require_once(REL(__FILE__, "../model/MediaTypes.php"));
		$db = new MediaTypes;
		$list = getDmData($db);
		echo json_encode($list);
	  break;
	case 'getMediaIconUrls':
		require_once(REL(__FILE__, "../model/MediaTypes.php"));
		$db = new MediaTypes;
		$rslt = $db->getIcons();
		while ($row = $rslt->fetch_assoc()) {
		  $list[$row['code']] = $row['image_file'];
		}
		echo json_encode($list);
	  break;

	case 'getMbrTypList':
		require_once(REL(__FILE__, "../model/MemberTypes.php"));
		$db = new MemberTypes;
		$list = getDmData($db);
		echo json_encode($list);
	  break;

	case 'getSiteList':
		require_once(REL(__FILE__, "../model/Sites.php"));
		$db = new Sites;
		$list = getDbData($db);
		echo json_encode($list);
	  break;

	case 'getStateList':
		require_once(REL(__FILE__, "../model/States.php"));
		$db = new States;
		$list = getDmData($db);
		echo json_encode($list);
	  break;

	case 'getValidations':
		require_once(REL(__FILE__, "../model/Validations.php"));
		$db = new Validations;
		$list = getDmData($db);
		echo json_encode($list);
	  break;

	default:
		  echo "<h4>".T("invalid mode")."@listSrvr.php: &gt;".$_REQUEST['mode']."&lt;</h4><br />";
		break;
	}

?>
