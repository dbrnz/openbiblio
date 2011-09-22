<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

		# prepare user search criteria
		require_once(REL(__FILE__, 'olSrchVals.php'));
		
		# perform the search
		$numHosts = $postVars[numHosts];
		//print("will be trying $numHosts host(s)<br />");

//	  if ($postVars[protocol] == 'YAZ') {
//			//print("using YAZ protocol<br />");
			require_once (REL(__FILE__, 'olYazSrch.php'));
//		} else if ($postVars[protocol] == 'SRU') {
//			//print("using SRU protocol<br />");
//			require_once (REL(__FILE__, 'olSruSrch.php'));
//		} else {
//			echo "Invalid protocol specified.<br />";
//		}

		$initialCond = false;

		//echo "ttl hits= $ttlHits<br />";
		## TOO FEW
		if ($ttlHits == 0) {
		  /*
		  $s =  "{'ttlHits':$ttlHits,'maxHits':$postVars[maxHits],".
						"'msg':'$msg1',".
						"'srch1':{'byName':'$srchByName','lookupVal':'$lookupVal'},".
						"'srch2':{'byName':'$srchByName2','lookupVal':'$lookupVal2'}".
					  "}";
			echo $s;
			*/
		  $rcd['ttlHits'] = $ttlHits;
		  $rcd['maxHits'] = $postVars['maxHits'];
		  $rcd['msg'] = T('Nothing Found');
		  $srch['byName'] = $srchByName;
		  $srch['lookupVal'] = $lookupVal;
		  $rcd['srch1'] = json_encode($srch);
		  $srch['byName'] = $srchByName2;
		  $srch['lookupVal'] = $lookupVal2;
		  $rcd['srch2'] = json_encode($srch);
		  echo json_encode($rcd);
		}
		## TOO MANY
		else if ($ttlHits > $postVars[maxHits]) {
			/*
			$msg1 = T('lookup_tooManyHits');
			$msg2 = T('lookup_refineSearch');
		  $s =  "{'ttlHits':'$ttlHits','maxHits':'$postVars[maxHits]',".
						"'msg':'$msg1', 'msg2':'$msg2' ".
						"}";
			echo $s;
			*/
		  $rcd['ttlHits'] = $ttlHits;
		  $rcd['maxHits'] = $postVars['maxHits'];
		  $rcd['msg'] = T('lookup_tooManyHits');
		  $rcd['msg2'] = T('lookup_refineSearch');
		  echo json_encode($rcd);
		}
		## GOOD COUNT
		else if ($ttlHits > 0) {
			if ($numHosts > 0) {
				$postit = true;
				$_POST['ttlHits'] = $ttlHits;
				$_POST['numHosts'] = $numHosts;
				//$_POST['postVars'] = $postVars; // for debugging
				$rslt = array();
				$xml_parser = xml_parser_create();
				for ($h=0; $h<$numHosts; $h++) {
						$rslt[$h] = doOneHost($h, $hits, $id);
				}
				xml_parser_free($xml_parser);
				$_POST[data] = $rslt;
			}
      echo json_encode($_POST);
	}
	
	//error_reporting($err_level);		## restore original value
	//set_error_handler($err_fnctn);	## restore original handler
?>
