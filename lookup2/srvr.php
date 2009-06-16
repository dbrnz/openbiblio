<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  require_once("../shared/common.php");
  require_once(REL(__FILE__, "../shared/logincheck.php"));
  require_once(REL(__FILE__, "../functions/errorFuncs.php"));

	require_once(REL(__FILE__, 'lookupDBs.php'));
	require_once(REL(__FILE__, 'lookupFunc.php'));	## general support functions

	## fetch user options and post to $postVars
	# MUST BE FIRST !!!!!
	$optr = new Opts;
	$opts = $optr->getAll();
	$postVars = $opts->next();

####################################################################
####################################################################
  ## not yet in database or user opts screens, but should be!!!!
  $postVars["timeout"] = 60;
  $postVars["noiseWords"] = 'a an and for of the this those';
####################################################################
####################################################################

	## get default collection name
	$cptr = new myColl;
	$coll = $cptr->getDefault();
 	$postVars['defaultCollect'] = $coll['description'];

	## prepare list of hosts
	# results are in $postVars[hosts] & $postVars[numHosts]
	$hptr = new Hosts;
	$hosts = array();
	$hSet = $hptr->getAll();
	$n=0;
	while ($row = $hSet->next()) {
		if ($row['active'] == 'y') {
	  	$hosts[] = $row;
	  	$n++;
		}
	}
	$postVars['hosts'] = $hosts;
	$postVars['numHosts'] = $n;

	## set protocol flag for local use
	if ($postVars[protocol] == 'YAZ') {
		//echo " want to use YAZ protocol <br />";
	  $useYAZ = true;
	  $useSRU = false;
	}
	else if ($postVars[protocol] == 'SRU'){
		//echo " want to use SRU protocol <br />";
	  $useSRU = true;
	  $useYAZ = false;
	} else {
		echo "invalid protocol '$postVars[protocol]' specified.";
	}

## main body of code
switch ($_REQUEST[mode]){
  #-.-.-.-.-.-.-.-.-.-.-.-.-
	case 'getHosts':
		echo json_encode($postVars[hosts]);
		break;

  #-.-.-.-.-.-.-.-.-.-.-.-.-
	case 'getOpts':
		echo json_encode($postVars);
		break;

  #-.-.-.-.-.-.-.-.-.-.-.-.-
	case 'getCutter':
		if ($postVars[cutterType] == 'LoC') {
			require_once('lookupCutterLoc.php');
		}
		elseif ($postVars[cutterType] == 'CS3') {
			require_once('lookupCutterCs3.php');
		}
		else {
			echo "Invalid cutter type selection - '$postVars[cutterType]'. <br />";
		}

		echo "{'cutter':'".getCutter($_REQUEST[author])."'}";
		break;

  #-.-.-.-.-.-.-.-.-.-.-.-.-
	case 'search':
		include('lookupSrchPrep.php'); ## will respond directly, depending on what is received
		break;

  #-.-.-.-.-.-.-.-.-.-.-.-.-
	case 'abandon':
		for ($n=0; $n<$postVars[numHosts]; $n++) {
			yaz_close($id[$n]);
		}
		break;

  #-.-.-.-.-.-.-.-.-.-.-.-.-
	default:
	  echo "invalid mode: $_POST[mode] <br />";
		break;
}

?>
