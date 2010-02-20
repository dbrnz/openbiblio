<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

	require_once("../shared/common.php");

	session_cache_limiter(null);

	$tab = "admin";
	$nav = "materials";
	$focus_form_name = "newmaterialform";
	$focus_form_field = "description";

	require_once(REL(__FILE__, "../functions/inputFuncs.php"));
	require_once(REL(__FILE__, "../shared/logincheck.php"));
	require_once(REL(__FILE__, "../shared/get_form_vars.php"));
	Page::header(array('nav'=>$tab.'/'.$nav, 'title'=>''));

?>

<form name="newmaterialform" method="post" action="../admin/materials_new.php">
<table class="primary">
	<tr>
		<th colspan="2" nowrap="yes" align="left">
			<?php echo T("Add New Material Type");?>
		</th>
	</tr>
	<tr>
		<td nowrap="true" class="primary">
			<?php echo T("Description"); ?>
		</td>
		<td valign="top" class="primary">
			<?php printInputText("description",40,40,$postVars,$pageErrors); ?>
		</td>
	</tr>
	<tr>
		<td nowrap="true" class="primary">
			<?php echo T("Adult Checkout Limit:");?><br /><span class="small"><?php echo T("(enter 0 for unlimited)"); ?></span>
		</td>
		<td valign="top" class="primary">
			<?php printInputText("adult_checkout_limit",2,2,$postVars,$pageErrors); ?>
		</td>
	</tr>
	<tr>
		<td nowrap="true" class="primary">
			<?php echo T("Juvenile Checkout Limit:"); ?><br /><span class="small"><?php echo T("(enter 0 for unlimited)"); ?></span>
		</td>
		<td valign="top" class="primary">
			<?php printInputText("juvenile_checkout_limit",2,2,$postVars,$pageErrors); ?>
		</td>
	</tr>
	<tr>
		<td nowrap="true" class="primary">
			<sup>*</sup><?php echo T("Image File:");?>
		</td>
		<td valign="top" class="primary">
			<?php printInputText("image_file",40,128,$postVars,$pageErrors); ?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2" class="primary">
			<input type="submit" value="<?php echo T("Submit"); ?>" class="button" />
			<input type="button" onClick="parent.location='../admin/materials_list.php'" value="<?php echo T("Cancel"); ?>" class="button" />
		</td>
	</tr>

</table>
</form>

<p class="note">
<sup>*</sup><?php echo T("Note:");?><br />
<?php echo T("Image file located in directory");?></p>

<?php

	Page::footer();
