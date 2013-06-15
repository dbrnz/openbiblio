<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
?>

<script language="JavaScript" defer>
// JavaScript Document
//------------------------------------------------------------------------------
"use strict";

// If a circulation user and NOT a cataloging user the system should treat the user as opac
<?php
if($_SESSION["hasCircAuth"] && !$_SESSION["hasCatalogAuth"])
  echo "var opacMode = true;";
else
  echo "var opacMode = false;";
?>

var chk = {
	init: function () {
		chk.url = 'circulationServer.php';

		// get header stuff going first
		chk.initWidgets();
		chk.resetForms();
		chk.fetchOpts();
		chk.fetchShelvingCart();
		
		$('form').on('submit',null,function (e) {
			var theId = $('input[type="submit"]:focus').attr('id');
			//console.log('the btn id is: '+theId);
			if (theId != 'logoutBtn') {
				e.preventDefault();
				e.stopPropagation();
				switch (theId) {
					case 'addToCrtBtn':		chk.doCheckin();		break;
				}
			}
		});

		$('.markAllBtn').on('click',null,function (e) {
			$(':checkbox[value=copyid]').prop('checked',true);
		});
		$('.clerAllBtn').on('click',null,function (e) {
			$(':checkbox[value=copyid]').prop('checked',false);
		});
		$('.shelvItemBtn').on('click',null,chk.doShelvSelected);
		$('#barcodeNmbr').on('change',null,chk.getCopyTitle);
	},
	//------------------------------
	initWidgets: function () {
	},
	
	resetForms: function () {
	  //console.log('resetting Search Form');
		$('p.error, input.error').html('').hide();
	  $('#ckinDiv').show();
		$('#msgDiv').hide();
	},

	//------------------------------
	fetchOpts: function () {
	  $.getJSON(chk.url,{'mode':'getOpts'}, function(jsonData){
	    chk.opts = jsonData;
		});
	},
	getCopyTitle: function () {
		var barcd = $.trim($('#barcodeNmbr').val());
		barcd = flos.pad(barcd,chk.opts.item_barcode_width,'0');
		$('#barcodeNmbr').val(barcd); // redisplay expanded value

	  $.getJSON(chk.url,{'mode':'getBarcdTitle', 'barcodeNmbr':barcd}, function(jsonData){
	    $('#ckinTitle').val(jsonData.title);
		});
	},
	
	//------------------------------
	doShelvSelected: function (e) {
		$('#shelveMode').val('doShelveItem');
		var parms = $('#shelvingForm').serialize();
		$.post(chk.url, parms, function(response) {
			if (response.substr(0,1)=='<') {
				//console.log('rcvd error msg from server :<br />'+response);
				$('#msgArea').html(response);
				$('#msgDiv').show();
			}
			else {
				$('#msgArea').html('Shelved!');
				$('#msgDiv').show().hide(10000);
				chk.fetchShelvingCart();
			}
		});
	}	,
	
	//------------------------------
	doCheckin: function () {
		var parms = $('#chekinForm').serialize();
		$.post(chk.url, parms, function(response) {
			if (response.substr(0,1)=='<') {
				//console.log('rcvd error msg from server :<br />'+response);
				$('#msgArea').html(response);
				$('#msgDiv').show();
			}
			else {
				$('#msgArea').html('Added!');
				$('#msgDiv').show().hide(10000);
				chk.fetchShelvingCart();
			}
		});
		return false;
	},
	
	//------------------------------
	fetchShelvingCart: function () {
	  $.getJSON(chk.url,{'mode':'fetchShelvingCart'}, function(jsonData){
	    chk.cart = jsonData;
			var txt = '';

			for (var nCpy in chk.cart) {
				var cpy = chk.cart[nCpy];
				var beginDate = cpy.beginDt.split(' ')[0];
				txt += '<tr>\n';
				txt += '	<td><input type="checkbox" name="bibid='+cpy.bibid+'&amp;copyid='+cpy.copyid+'" value="copyid" /></td>\n';
				txt += '	<td>'+beginDate+'</td>\n';
				txt += '	<td>'+cpy.barcd+'</td>\n';
				txt += '	<td>'+cpy.title+'</td>';
				txt += '</tr>\n';
			}
			$('#shelvingList tbody').html(txt);
			$('#shelvingList tbody.striped tr:odd td').addClass('altBG');
			$('#shelvingList tbody.striped tr:even td').addClass('altBG2');	
		});
	},
	
};
$(document).ready(chk.init);

</script>
