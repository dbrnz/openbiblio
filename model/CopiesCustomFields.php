<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
require_once(REL(__FILE__, "../classes/DmTable.php"));

class CopiesCustomFields extends DBTable {
	public function __construct() {
		parent::__construct();
		$this->setName('biblio_copy_fields');
		$this->setFields(array(
			'copyid'=>'number',
			'bibid'=>'number',
			'code'=>'string',
			'data'=>'string',
		));
		$this->setKey('code');
	}
	protected function validate_el($rec, $insert) {
	}
}
class CopiesCustomFields_DM extends DmTable {
	public function __construct() {
		parent::__construct();
		$this->setName('biblio_copy_fields_dm');
		$this->setFields(array(
			'code'=>'string',
			'description'=>'string',
			'default_flg'=>'string',
		));
		$this->setKey('code');
	}
	protected function validate_el($rec, $insert) {
	}
}
