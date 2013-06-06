<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	require_once("../shared/common.php");

	session_cache_limiter(null);

	$tab = "working";
	$nav = "webcamForm";
	$focus_form_name = "fotoForm";
	$focus_form_field = "capture";

	require_once(REL(__FILE__, "../shared/logincheck.php"));
	Page::header(array('nav'=>$tab.'/'.$nav, 'title'=>'Cover Photo Capture'));

	//print_r($_SESSION); // for debugging
?>

	<div id="crntMbrDiv">to be filled by server</div>
	<p id="errSpace" class="error">to be filled by server</p>

	<div id="fotoDiv" role="main">
	  <video id="camera" autoplay width="150" height="100" autoplay  style="display:none"></video>
		<form id="fotoForm" name="fotoForm">
			<input type="button" id="capture" name="capture" value="Capture" />
		</form>
		<hr />
	 	<canvas id="canvasIn" width="150" height="150" style="display:none"></canvas>
	 	<canvas id="canvasOut" width="100" height="150"></canvas>
		<hr />
	</div>

<?php
  require_once(REL(__FILE__,'../shared/footer.php'));
	include "./webcamJs.php";
?>

</body>
</html>
