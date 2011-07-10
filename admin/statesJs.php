<script language="JavaScript" >
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

// JavaScript Document
st = {
	<?php
		echo "delConfirmMsg: '".T("Are you sure you want to delete ")."',\n";
		echo "listHdr: '".T("List of States & Abreviations")."',\n";
		echo "editHdr: '".T("Editing States & Abreviations")."',\n";
	?>
	
	init: function () {
		st.initWidgets();

		st.url = 'adminSrvr.php';
		st.editForm = $('#editForm');

		$('#reqdNote').css('color','red');
		$('.reqd sup').css('color','red');
		$('#updateMsg').hide();

		$('#showForm .newBtn').bind('click',null,st.doNewState);
		$('#addBtn').bind('click',null,st.doAddState);
		$('#updtBtn').bind('click',null,st.doUpdateState);
		$('#cnclBtn').bind('click',null,st.resetForms);
		$('#deltBtn').bind('click',null,st.doDeleteState);

		st.fetchStates();
		st.resetForms()
	},
	
	//------------------------------
	initWidgets: function () {
	},
	resetForms: function () {
		//console.log('resetting!');
	  $('#listHdr').html(st.listHdr);
	  $('#stateHdr').html(st.editHdr);
		$('#editDiv').hide();
	  $('#msgDiv').hide();
		$('#listDiv').show();
    $('#cnclBtn').val('Cancel');
	},
	doBackToList: function () {
		st.fetchStates();
		st.resetForms();
		$('#msgDiv').hide(3000);
	},
	
	//------------------------------
	fetchStates: function () {
	  $.getJSON(st.url,{mode:'getAllStates'}, function(data){
	    st.stateJSON = data;
			var html = '';
			for (nState in st.stateJSON) {
				//console.log(data[nState]);
	    	html += '<tr>\n';
    		html += '<td valign="top">\n';
				html += '	<input type="button" class="editBtn" value="edit" />\n';
				html += '	<input type="hidden" value="'+data[nState]['code']+'"  />\n';
				html += '</td>\n';
    		html += '<td valign="top">'+data[nState]['description']+'</td>\n';
    		html += '<td valign="top">'+data[nState]['code']+'</td>\n';
    		//var str = ((data[nState]['default_flg']=='Y')?'yes':'no');
    		//html += '<td valign="top">'+str+'</td>\n';
    		html += '<td valign="top">'+data[nState]['default_flg']+'</td>\n';
				html += '</tr>\n';
			}
			$('#showList tBody').html(html);
			$('table tbody.striped tr:odd td').addClass('altBG');
			$('table tbody.striped tr:even td').addClass('altBG2');
			$('.editBtn').bind('click',null,st.doEdit);
		});
	},

	doEdit: function (e) {
	  var code = $(e.target).next().val();
		//console.log('you wish to edit code: '+code);
		for (nState in st.stateJSON) {
		  if (st.stateJSON[nState]['code'] == code) {
				st.showState(st.stateJSON[nState]);
			}
		}
		return false;
	},
	
	showState: function (State) {
		//console.log('showing : '+State['name']);
	  $('#stateHdr').html(st.editHdr);
	  $('#addBtn').hide();
	  $('#updtBtn').show();
	  $('#description').focus();

		$('#description').val(State['description']);
		$('#code').val(State['code']);
		$('#default_flg').val(State['default_flg']);

		$('#listDiv').hide();
		$('#editDiv').show();
	},
	
	doNewState: function (e) {
	  document.forms['editForm'].reset();
	  $('#stateHdr').html(st.newHdr);
		$('#deltBtn').hide();
		$('#updtBtn').hide();
	  $('#addBtn').show();
		$('#listDiv').hide();
		$('#editDiv').show();
	  document.getElementById('description').focus();
		return false;
	},
	
	doAddState: function () {
		$('#mode').val('addNewState');
		var parms = $('#stateForm').serialize();
		//console.log('adding: '+parms);
		$.post(st.url, parms, function(response) {
			if (response.substr(0,1)=='<') {
				console.log('rcvd error msg from server :<br />'+response);
				$('#msgArea').html(response);
				$('#msgDiv').show();
			}
			else {
				$('#msgArea').html('Added!');
				$('#msgDiv').show();
			  st.doBackToList();
			}
		});
	},

	doUpdateState: function () {
		$('#updateMsg').hide();
		$('#msgDiv').hide();
		$('#mode').val('updateState');
		var parms = $('#stateForm').serialize();
		//console.log('updating: '+parms);
		$.post(st.url, parms, function(response) {
			if (response.substr(0,1)=='<') {
				console.log('rcvd error msg from server :<br />'+response);
				$('#msgArea').html(response);
				$('#msgDiv').show();
			}
			else {
				if (response.substr(0,1)=='1'){
					$('#updateMsg').html('<?php echo T('Updated');?>');
					$('#updateMsg').show();
				}
				$('#msgArea').html('Updated!');
				$('#msgDiv').show();
			  st.doBackToList();
			}
		});
	},
	
	doDeleteState: function (e) {
		var msg = st.delConfirmMsg+'\n>>> '+$('#description').val()+' <<<';
	  if (confirm(msg)) {
	  	var parms = {	mode:'d-3-L-3-tState', code:$('#code').val() };
	  	$.post(st.url, parms, function(response){
				if (($.trim(response)).substr(0,1)=='<') {
					console.log('rcvd error msg from server :<br />'+response);
					$('#msgArea').html(response);
					$('#msgDiv').show();
				}
				else {
					$('#msgArea').html('Deleted!');
					$('#msgDiv').show();
//			  	st.doBackToList();
				}
			});
		}
	},
};

$(document).ready(st.init);
</script>
