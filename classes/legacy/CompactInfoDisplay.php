<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once(REL(__FILE__, "../classes/Buttons.php"));

class CompactInfoDisplay {
	var $title;
	var $author;
	function CompactInfoDisplay() {
		$this->title = NULL;
		$this->author = NULL;
		$this->buttons = array();
	}
	function begin() {
		$s = "<div class=\"compact_info_display\">\n";
		if ($this->title) {
			$s .= "<table class=\"header\">\n";
			$s .= "<tr>\n";
			$s .= "	<th class=\"title\">".$this->title."</th>\n";
			if ($this->buttons) {
				$s .= "	<td class=\"buttons\">".Buttons::display($this->buttons)."</td>\n";
			}
			$s .= "</tr>\n";
			if ($this->author) {
				$s .= "<tr>\n";
				$s .= "	<th class=\"author\" >".$this->author."</th>\n";
				$s .= "</tr>\n";
			}
			$s .= "</table>\n";
		}
		$s .= "<ul>\n";
		return $s;
	}
	function row($heading, $value) {
		return "<li><span class=\"heading\">".$heading."</span>".$value."</li>\n";
	}
	function end() {
		return "</ul>\n</div>\n";
	}
}

