$(document).ready(function() {
	$('.cbPrivilege').click(function() {
		userId = $(this).attr('rel');
		privilageId = $(this).attr('value');
		param = 'userId='+userId+'&privilageId='+privilageId;
		$.ajax({
			type: 'post',
			url: '/admin.php/ajax/addPrivilage',
			data: param,
			complete: function(){
				location.reload();
			}
		});
	});
	$('.removePrivilage').click(function() {
		userId = $(this).attr('rel');
		privilageId = $(this).attr('rev');
		param = 'userId='+userId+'&privilageId='+privilageId;
		$.ajax({
			type: 'post',
			url: '/admin.php/ajax/removePrivilage',
			data: param,
			complete: function(){
				location.reload();
			}
		});
	});
	
	  // remove device from inventory
  
  $('#delDevice').live('click',function(){
  
  deviceId = $('#deviceid').attr('value');
  var confrm = confirm("Do you really want to delete this device ?")
  
  if(confrm){
  // alert(deviceId);
   		param = 'deviceId='+deviceId;
		$.ajax({
			type: 'post',
			url: '/admin.php/ajax/removeDevice',
			data: param,
			complete: function(){
				//location.reload();
				window.location.href = "/admin.php/admin/deviceInventory";
				
			}
		});
  }
  });
});