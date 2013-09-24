<?php
	/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
	 * See the file COPYRIGHT.html for more details.
	 */

	#### --- For those unable to set their time zone in PHP.ini --- ####
	#### for valid entries see: http://www.php.net/manual/en/timezones.php
	//date_default_timezone_set ( "America/New_York" );
	
	# Forcibly disable register_globals
	if (ini_get('register_globals')) {
		foreach ($_REQUEST as $k=>$v) {
			unset(${$k});
		}
		foreach ($_ENV as $k=>$v) {
			unset(${$k});
		}
		foreach ($_SERVER as $k=>$v) {
			unset(${$k});
		}
	}
	
## Active assert and make it quiet
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);
## Create a handler function
function obAssertHandler($file, $line, $code, $desc = null) {
    echo "Assertion failed at file:'{$file}', line:'{$line}', code:'{$code}";
    if ($desc) echo ": $desc";
    echo "<br/>\n";
}
## Set up the callback
assert_options(ASSERT_CALLBACK, 'obAssertHandler');


	#apd_set_pprof_trace();
	## TODO - will not work with db models and classes as currently written - FL
	//error_reporting(E_ALL ^ E_NOTICE); 
	error_reporting((E_ALL ^ E_NOTICE) & ~E_STRICT);

	if (isset($cache)) {
		session_cache_limiter($cache);
	} else {
		session_cache_limiter('nocache');
	}
	
	function getOBroot() {
		/* obtain OpenBiblio path ref to wep pages root */
		/* may be useful later in system (thinking plug-ins, etc.) */
		$thisApp = $_SERVER[PHP_SELF];
		$thisPath = pathinfo($thisApp, PATHINFO_DIRNAME);
		$pathParts = explode('/',$thisPath);
		$OBroot = '/'.$pathParts[1].'/';
		return $OBroot;
	}
	
	/* Convenience functions for everywhere */
	/* Work around PHP's braindead include_path stuff. */
	function REL($sf, $if) {
		return dirname($sf)."/".$if;
	}
	
	/* This one should be used by all the form handlers that return errors. */
	function _mkPostVars($arr, $prefix) {
		$pv = array();
		foreach ($arr as $k => $v) {
			if ($prefix !== NULL) {
				$k = $prefix."[$k]";
			}
			if (is_array($v)) {
				$pv = array_merge($pv, _mkPostVars($v, $k));
			} else {
				$pv[$k] = $v;
			}
		}
		return $pv;
	}
	function mkPostVars() {
		return _mkPostVars($_REQUEST, NULL);
	}
	
	### needs to be here so changes in settings are picked up when changes are entered
	function setSessionFmSettings() {
		$_SESSION['itemBarcode_flg'] = Settings::get('item_barcode_flg');
		$_SESSION['item_autoBarcode_flg'] = Settings::get('item_autoBarcode_flg');
		$_SESSION['item_barcode_width'] = Settings::get('item_barcode_width');
		$_SESSION['mbrBarcode_flg'] = Settings::get('mbr_barcode_flg');
		$_SESSION['mbr_autoBarcode_flg'] = Settings::get('mbr_autoBarcode_flg');
		$_SESSION['allow_plugins_flg'] = Settings::get('allow_plugins_flg');
		$_SESSION['plugin_list'] = Settings::get('plugin_list');
		$_SESSION['show_checkout_mbr'] = Settings::get('show_checkout_mbr');
		$_SESSION['show_detail_opac'] = Settings::get('show_detail_opac');
		$_SESSION['multi_site_func'] = Settings::get('multi_site_func');
		$_SESSION['show_item_photos'] = Settings::get('show_item_photos');
	  $_SESSION['site_login'] = Settings::get('site_login');
	  $_SESSION['checkout_interval'] = Settings::get('checkout_interval');
	}

	require_once(REL(__FILE__, '../database_constants.php'));
	require_once(REL(__FILE__, '../shared/global_constants.php'));
	require_once(REL(__FILE__, '../classes/Error.php'));
	require_once(REL(__FILE__, "../classes/Nav.php"));
	require_once(REL(__FILE__, "../classes/Localize.php"));
	require_once(REL(__FILE__, 'templates.php'));
	
	global $LOC, $CharSet, $Locale, $OBroot;
	global $ThemeId, $ThemeDirUrl, $ThemeDir, $SharedDirUrl;
	global $LocaleDirUrl, $LocaleDir, $SharedDirUrl, $HTMLHead;

	$LOC = new Localize;
	if (!isset($doing_install) or !$doing_install) {
		include_once(REL(__FILE__, "../model/Settings.php"));
		Settings::load();
		$CharSet = Settings::get('charset');
		$ThemeId = Settings::get('theme_name');
		$ThemeDirUrl = trim(Settings::get('theme_dir_url'));
		$Locale = Settings::get('locale');
	}
	else {
		$CharSet = "UTF-8";
		$ThemeId = '1';
		$ThemeDirUrl = "../themes/default";
		//$localeStrs = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
		//$Locale = substr($localeStrs[0],0,2);
		$locale = 'en';
	}
	$ThemeDir = REL(__FILE__, $ThemeDirUrl);
	$SharedDirUrl = "../shared";
	$HTMLHead = "";
	$LocaleDirUrl = "../locale/".$Locale;
	$LocaleDir = REL(__FILE__, $LocaleDirUrl);
	
	if (!isset($doing_install) or !$doing_install) {
		## Get the current Session Timeout Value
		$currentTimeoutInSecs = ini_get(�session.gc_maxlifetime�);

		## Change the session timeout value to 60 minutes,  8*60*60 = 8 hours
		ini_set(�session.gc_maxlifetime�, 60*60);

		session_start();
		# Forcibly disable register_globals if php.ini does not do it already
		if (ini_get('register_globals')) {
			foreach ($_SESSION as $k=>$v) {
				unset(${$k});
			}
		}
	
	  setSessionFmSettings();
	}

	$LOC->init($Locale);

	include_once(REL(__FILE__, "../classes/Page.php"));

  ###################################################################
  ## plugin Support
  ###################################################################
  function getPlugIns($wanted) {
		## determine what is allowed
    if ($_SESSION['allow_plugins_flg'] != 'Y') return NULL;
		$list = $_SESSION['plugin_list'];
		$aray = explode(',', $list);

		## make connections where allowed
		clearstatcache();
		$pluginSet = array();
  	if (is_dir('../plugins')) {
  	  ## find all plugin directories
			if ($dirHndl = opendir('../plugins')) {
		    # look at all plugin dirs
		    while (false !== ($plug = readdir($dirHndl))) {
		      if (($plug == '.') || ($plug == '..')) continue;
  	      $plugPath = "../plugins/$plug";
  	      if (is_dir($plugPath)) {
  	        if (!in_array($plug, $aray)) continue; // not allowed
						if ($filHndl = opendir($plugPath)) {
		    			while (false !== ($file = readdir($filHndl))) {
		    			  if (($file == '.') || ($file == '..')) continue;
  	      			if ($file == $wanted) {
									$pluginSet[] = "$plugPath/$file";
								}
  	      		}
  	      		closedir($filHndl);
						}
					}
  		  }
  		  closedir($dirHndl);
			}
		}
		return $pluginSet;
	}

	// Deprecated below, use the template-based functions - MS
	function H($s) {
		return htmlspecialchars($s, ENT_QUOTES);
	}
	function U($s) {
		return urlencode($s);
	}
	function HURL($s) {
		return H(U($s));
	}
	function JS($s) {
		$r=""; 
		$l=strlen($s); 
		$subs = array(
			'<' => '\\u003c',
			'>' => '\\u003e',
			'&' => '\\u0026',
			'\'' => '\\u0027',
			'"' => '\\u0022',
			'\\' => '\\\\',
			"\n" => '\\n',
			"\r" => '\\r',
		);
		for($i=0;$i<$l;$i++) {
			if (isset($subs[$s[$i]])) {
				$r .= $subs[$s[$i]];
			} else if(ord($s[$i]) < 32) {
				$r .= sprintf("\\u%04x", ord($s[$i]));
			} else {
				$r .= $s[$i];
			}
		} 
		return $r; 
	}
	function nT($n, $s, $v=NULL) {
		return T($s, $v);
	}
