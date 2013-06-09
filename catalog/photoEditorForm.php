	<h3 id="fotoHdr"><?php echo T("PhotoEditor"); ?></h3>
	<h5 id="reqdNote">*<?php echo T("Required note"); ?></h5>
	<p id="fotoMsg" class="error"></p>

	<fieldset>
		<legend id="fotoEdLegend"></legend>

		<!-- to reduce annoyance, only load video comppnents if wanted-->
		<?php if ($_SESSION['show_item_photos'] == 'Y') { ?>
		<div id="fotoDiv" style="display:none" >
		  <video id="camera" width="150" height="100" preload="none" ></video>
		 	<canvas id="canvasIn" width="150" height="150" ></canvas>
		</div>
		<?php } ?>

		<div id="fotoCntlDiv">
			<form id="fotoForm">
				<fieldset class="inline">
			 		<canvas id="canvasOut" width="100" height="150"></canvas>
				</fieldset>
				<fieldset class="inline">
					<fieldset>
						<legend>Select an image Source</legend>
						<label for="useCapture"><?php echo T("Camera"); ?></label>
						<input type="radio" id="useCapture" name="imgSrce" value="cam" checked class="fotoSrceBtns" \>
						<label for="useBrowse"><?php echo T("Browse"); ?></label>
						<input type="radio" id="useBrowse" name="imgSrce" value="brw" class="fotoSrceBtns" \>
					</fieldset>
					<input type="button" id="capture" name="capture" value="<?php echo T("Take Photograph"); ?>" />
					<input type="file" id="browse" name="browse" accept="image/png image/jpg" />
          <br />
					<label for="fotoFolder"><?php echo T("StoreAt"); ?>:</label>
					<p id="fotoFolder">../photos/<i><?php echo T("filename"); ?></i>.jpg</p>
					<br />
					<label for="fotoName"><?php echo T("FileName"); ?>:</label>
					<input type="text" id="fotoName" name="url" size="32"
								pattern="(.*?)(\.)(jpg|jpeg|png)$" required aria-required="true"
								title="<?php echo T("Only jpg or png files are acceptable."); ?>" />
								<span class="reqd">*</span>
				</fieldset>

				<input type="hidden" id="fotoBibid" name="bibid" value="" />
			</form>
		</div>
	</fieldset>

