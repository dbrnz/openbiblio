<script language="JavaScript" >
<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
   See the file COPYRIGHT.html for more details.
 */
?>
// JavaScript Document
"use strict";
var rpt = {
	init: function () {
		rpt.url = './reportSrvr.php';
		rpt.listSrvr = '../shared/listSrvr.php';
		rpt.initWidgets();

		rpt.rptType = '<?php echo $_GET['type']; ?>';
		$('#type').val(rpt.rptType);
		$('#rptType').val(rpt.rptType);

		//$('#orderBy').on('change',null,function () {
		//	rpt.fetchFotoPage(0);
		//});
		$('.nextBtn').on('click',null,rpt.getNextPage);
		$('.prevBtn').on('click',null,rpt.getPrevPage);
		$('.gobkRptBtn').on('click',null,rpt.rtnToSpecs);
		$('.gobkBiblioBtn').on('click',null,rpt.rtnToReport);

		$('#searchBtn').on('click', null, function () {
			rpt.doSearch(0);
		});

		rpt.resetForm();
    rpt.getCriteriaForm();
	},
	//------------------------------
	initWidgets: function () {
		rpt.fetchOpts();
	},
	//----//
	resetForm: function () {
		$('#specsDiv').show();
		$('#reportDiv').hide();
		$('#detailDiv').hide();
		$('#biblioDiv').hide();
		$('#workDiv').hide();
		$('#errSpace').hide();

		$('#prevBtn').disable();
		$('#nextBtn').disable();
	},
	rtnToSpecs: function () {
		rpt.resetReport();
		$('#type').val(rpt.rptType);
		$('#specsDiv').show();
		$('#reportDiv').hide();
	},
	rtnToReport: function () {
		$('#reportDiv').show();
		$('#biblioDiv').hide();
	},

	//------------------------------
	fetchOpts: function () {
	  $.getJSON(rpt.listSrvr,{mode:'getOpts'}, function(jsonData){
	    rpt.opts = jsonData;
		});
	},
	resetReport: function () {
		$.post(rpt.url, {'mode':'resetReport'}, function (response) {
			$('#errSpace').html(response).show();
		});
	},
	getCriteriaForm: function () {
		$.get(rpt.url, {'mode':'getCriteriaForm',
										'type':$('#rptType').val(),
									 }, function (resp){
			var parts = resp.split('|');
			$('#pageTitle').html(parts[0]);
			$('#type').val(parts[1]);
			$('#specs').html(parts[2]);

			if (!(Modernizr.inputtypes && Modernizr.inputtypes.date)) {
				console.log('using jQueryUI datepicker');
	  		$("input[type='date']").datepicker({
	   			dateFormat: 'yy-mm-dd',
					maxDate: -1,
				});
			} else {
				console.log('using native datepicker');
			}
		});
	},

	//------------------------------
	getNextPage:function () {
		$('.nextBtn').disable();
		rpt.doSearch(rpt.nextPageItem);
	},
	getPrevPage:function () {
		$('.prevBtn').disable();
		rpt.doSearch(rpt.prevPageItem);
	},

	doSearch: function (itemNmbr) {
    $('#errSpace').html('').hide();
		var firstItem = 0;
		if (typeof(itemNmbr) !== 'undefined') {
			firstItem = itemNmbr;
		}
		$('#firstItem').val(firstItem);

		//$('#type').val('previous');
    var params = $('#reportcriteriaform').serialize();
		$.post(rpt.url, params, function (response) {
			if (response.indexOf('|') < 0) {
        $('#errSpace').html(response).show();
				return;
			}
			var parts = response.split('|');
			var hdr = JSON.parse(parts[1]);
			rpt.type = hdr.type;
			rpt.ttlNmbr = parseInt(hdr.nmbr);
			rpt.firstItem = parseInt(hdr.firstItem);
			rpt.lastItem = parseInt(hdr.lastItem);
			rpt.perPage = parseInt(hdr.perPage);

			$('.countBox').html((rpt.firstItem+1)+' - '+rpt.lastItem+' <?php echo T("of");?> '+rpt.ttlNmbr).show();
			$('#type').val(rpt.type);
			$('#report').html(parts[2]);

			$('div#report a').on('click',null,rpt.displayBiblio);

			$('#specsDiv').hide();
			$('#reportDiv').show();

			// enable or disable next / prev buttons
			if(rpt.firstItem >= rpt.perPage){
				rpt.prevPageItem = rpt.firstItem - rpt.perPage;
				$('.prevBtn').enable();
			} else {
				$('.prevBtn').disable();
			}
			if(((rpt.perPage+rpt.firstItem) <= rpt.lastItem) && (rpt.ttlNmbr > rpt.lastItem)){
				rpt.nextPageItem = rpt.perPage + rpt.firstItem;
				$('.nextBtn').enable();
			} else {
				$('.nextBtn').disable();
			}
		});
	},

	displayBiblio: function (e) {
		e.preventDefault();
		e.stopPropagation();
		idis.init(rpt.opts); // be sure all is ready
		var href = e.currentTarget.href,
				query = href.split('?')[1],
				args = obib.urlArgs(query); //parse query into 'named' properties
		idis.doBibidSearch(args.bibid);
		$('#biblioDiv').show();
		$('#reportDiv').hide();
	},
}
$(document).ready(rpt.init);

</script>
