<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

/* A report should always be created with Report::load(), Report::create(),
 * or Report::create_e(), never with new Report().  
 * Create_e() makes a new report of the given type.  If the report is given a 
 *   name, it will be cached in the session in a way that does not depend on
 *   storing objects in the session.  
 * Load() loads a named report from data cached in the session.
 *
 * Create() calls create_e(), but treats any error as fatal.
 * Link() returns an URL for linking to the results of a cached named report.  An
 *   optional message may be supplied for display on the results page.
 *
 * Public instance methods:
 *   title(), layouts(), paramDefs(), init(), init_el(), initCgi(),
 *   initCgi_el(), variant() ,variant_el(), columns(), columnNames(),
 *   count(), curPage(), row(), each(), table(), and pageTable()
 */

	require_once(REL(__FILE__, "../classes/Params.php"));
	require_once(REL(__FILE__, "../classes/Iter.php"));

class Report {
	public $name;
	public $params;

	private $rpt;
	private $iter;
	private $cache;
	private $pointer = 0;
	private $statrAt;
	private $howMany;

	## ------------------------------------------------------------------------ ##
	public function __construct ($startAt=NULL, $howMany=NULL) {
    $this->startAt = $startAt;
		$this->howMany = $howMany;
	}
	public static function create($type, $name=NULL) {
//echo "report: in create: creating report for {$type}<br />\n";
		list($rpt, $err) = Report::create_e($type, $name);
		if($err) {
			Fatal::internalError(T("ReportCreatingReport", array('error'=>$err->toStr())));
		}
		return $rpt;
	}
	public static function load($name) {
//echo "report: in load<br />\n";
		if (!isset($_SESSION['rpt_'.$name])) {
			return NULL;
		}
		$rpt = new Report($startAt, $howMany);
		$err = $rpt->_load_e($name, $_SESSION['rpt_'.$name]);
		if ($err) {
			unset($_SESSION['rpt_'.$name]);
			Fatal::internalError(T("ReportNoLoadReport", array('name'=>$name)));
		}
		return $rpt;
	}
	public function title() {
		return $this->rpt->title();
	}
	public function type() {
		return $this->cache['type'];
	}
	public function paramDefs() {
		return $this->rpt->paramDefs();
	}
	public function columns() {
		return $this->rpt->columns();
	}
	public function initCgi_el($prefix='rpt_') {
//echo "report: in initCgi_el'<br />\n";
		$p = new Params;
		$errs = $p->loadCgi_el($this->rpt->paramDefs(), $prefix);
		if (!empty($errs)) {
			return $errs;
		}
		$rslt = $this->_init_el($p);
		return $rslt;
	}
	public function getVariant($newParams, $newName=NULL) {
		list($rpt, $errs) = $this->variant_el($newParams, $newName);
		if(!empty($errs)) {
			Fatal::internalError(T("ReportMakingVariant", array('error'=>Error::listToStr($errs))));
		}
		return $rpt;
	}
	public function category() {
		return $this->rpt->category();
	}
	public function count() {
//echo "report: in count'<br />\n";
		if ($this->cache['count'] === NULL) {
			$this->_getIter();
			$this->cache['count'] = $this->iter->count();
			$this->_save();
		}
		return $this->cache['count'];
	}
	public function pageIter($page) {
		$this->_cachePage($page);
		return new ArrayIter(array_values($this->cache['rows']));
	}
	public function each() { # FIXME - get rid of this
		return $this->next();
	}
	public function layouts() {
		return $this->rpt->layouts();
	}
	public function curPage() {
		if ($this->cache['page']) {
			return $this->cache['page'];
		} else {
			return 1;
		}
	}
	public function create_e($type, $name=NULL) {
//echo "report: in create_e<br />\n";
		$cache = array('type'=>$type);
		$rpt = new Report();
		$err = $rpt->_load_e($name, $cache);
		return array($rpt, $err);
	}

	## ------------------------------------------------------------------------ ##
	private function _load_e($name, $cache) {
//echo "report: in load_e<br />\n";
		$this->name = $name;
		assert('preg_match("{^[-_/A-Za-z0-9]+\$}", $cache["type"])');
		$fname = '../reports/defs/'.$cache['type'];
//echo "report: using file {$fname}<br />\n";
		if (is_readable($fname.'.php')) {
//echo "report: its .php<br />\n";
			## for hard-coded reports
			$err = $this->_load_php_e($cache['type'], $fname.'.php');
		} elseif (is_readable($fname.'.rpt')) {
//echo "report: its .rpt<br />\n";
		  ## for scripted reports
			$err = $this->_load_rpt_e($cache['type'], $fname.'.rpt');
		} else {
			die ("unrecognized file");
		}
		if ($err) {
			return $err;
		}
//echo "Report: checking for params in cache<br />\n";
		$this->cache = $cache;
		if (array_key_exists('params', $cache) and is_array($cache['params'])) {
//echo "Report: params exist in cache<br />\n";
			$this->params = new Params;
			$this->params->loadDict($cache['params']);
		}
		return NULL;
	}
	private function _load_php_e($type, $fname) {
//echo "report: in load_php_e<br />\n";
		$classname = $type.'_rpt';
//echo "including {$fname}<br />\n";
		include_once($fname);
		$this->rpt = new $classname;
		return NULL;		# Can't error non-fatally
	}
	private function _load_rpt_e($type, $fname) {
//echo "report: in load_rpt_e<br />\n";
		include_once(REL(__FILE__, '../classes/Rpt.php'));
		$rpt = new Rpt;
		$err = $rpt->load_e($fname);
		if ($err) {
			return $err;
		} else {
			$this->rpt = $rpt;
		}
	}
	private function link($name, $msg='', $tab='') {
		$urls = array(
			'Report'=>'../reports/run_report.php?type=previous&msg=',
			//'BiblioSearch'=>'../shared/biblio_search.php?searchType=previous&msg=',
			'BiblioCart'=>'../shared/req_cart.php?msg=',
		);
		if (isset($urls[$name])) {
			$url = $urls[$name];
		} else {
			$url = '../reports/index.html?msg=';
		}
		$url .= U($msg);
		if ($tab) {
			$url .= '&tab='.U($tab);
		}
		return $url;
	}
	private function columnNames() {
		return array_map(create_function('$x', 'return $x["name"];'), $this->columns());
	}
	private function init($params) {
		$errs = $this->init_el($params);
		if(!empty($errs)) {
			Fatal::internalError(T("ReportInitReport", array('error'=>Error::listToStr($errs))));
		}
	}
	private function init_el($params) {
//echo "report: in init_el<br />\n";
		assert('is_array($params)');
		$p = new Params;
		$errs = $p->load_el($this->rpt->paramDefs(), $params);
		if (!empty($errs)) {
			return $errs;
		}
		return $this->_init_el($p);
	}
	private function initCgi($prefix='rpt_') {
		$errs = $this->initCgi_el($prefix);
		if(!empty($errs)) {
			Fatal::internalError(T("ReportInitReport", array('error'=>Error::listToStr($errs))));
		}
	}
	private function _init_el($params) {
//echo "report: in _init_el<br />\n";
		unset($this->cache['params']);
//echo "report: in _init_el===>";print_r($params);echo"<br />\n";
		$this->params = $params;
//echo "report: in _init_el===>";print_r($params->getDict());echo"<br />\n";
		$this->cache['params'] = $params->getDict();
//echo "report: in _init_el===>";print_r($this->cache['params']);echo"<br />\n";
		$this->_save();
		return array();
	}
	private function variant_el($newParams, $newName=NULL) {
		if(!is_array($this->cache["params"])) {
			Fatal::internalError(T("ReportNoParams"));
		}
		if ($newName === NULL) {
			$newName = $this->name;
		}
		$rpt = Report::create($this->cache['type'], $newName);
		if(!$rpt) {
			Fatal::internalError(T("ReportCreationFailed"));
		}
		$params = new Params;
		$params->loadDict($this->cache['params']);
		$errs = $params->load_el($rpt->rpt->paramDefs(), $newParams);
		if (!empty($errs)) {
			return array(NULL, $errs);
		}
		$errs = $rpt->_init_el($params);
		if (!empty($errs)) {
			return array(NULL, $errs);
		}
		return array($rpt, array());
	}
	private function _getIter() {
//echo "report: in _getIter'<br />\n";
		if (isset($this->iter) && $this->iter) {
//echo "report: iter exists'<br />\n";
			return;
		} else {
//echo "report: getting new iter'<br />\n";
			$this->iter = new NumberedIter($this->rpt->select($this->params));
		}
	}
	private function next() {
		$this->_getIter();
		return $this->iter->count();
	}
	private function row($num) {
		if (isset($this->cache['rows'][$num])) {
			return $this->cache['rows'][$num];
		}
		$first = max(0, $num - floor(Settings::get('items_per_page')/2));
		$this->_cacheSlice($first);
		if (isset($this->cache['rows'][$num])) {
			return $this->cache['rows'][$num];
		} else {
			return NULL;
		}
	}
	private function _cacheSlice($skip, $len=NULL) {
		if ($len === NULL) {
			$len = Settings::get('items_per_page');
		}
		$first = min($skip, $this->count()-1);
		$last = min($skip+$len-1, $this->count()-1);
		if (isset($this->cache['rows'])
				and isset($this->cache['rows'][$first])
				and isset($this->cache['rows'][$last])) {
			return;
		}
		$this->iter = NULL;
		$this->_getIter();
		$this->iter = new SliceIter($skip, $len, $this->iter);
		$this->cache['rows'] = array();
		while (($row = $this->iter->next()) !== NULL) {
			$this->cache['rows'][$row['.seqno']] = $row;
		}
		$this->_save();
	}
	private function _cachePage($page) {
		$this->_cacheSlice(($page-1)*Settings::get('items_per_page'));
	}
	private function _save() {
		if ($this->name) {
			$_SESSION['rpt_'.$this->name] = $this->cache;
		}
	}
}

