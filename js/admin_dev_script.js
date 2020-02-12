jQuery(document).ready(function($){
	$('.married').hide();
	$('.baby').hide();
	$('.baby1').hide();
	$('.baby2').hide();
	$('.morebaby').hide();
	
	if($("input:radio[name=rbMarried]:checked").val() == 1){ 
			$('.married').show(); 		
			$('.baby').show();
	}
	if($("input:radio[name=rbChildren]:checked").val() == 1){
			$('.baby1').show();		
	}
	
	/* if children */
	$("input:radio[name=rbChildren]").live('click',function() {
	  if($(this).attr('name') == 'rbChildren' ){ 
		if($(this).val() == 1){	    	
	    	$('.baby1').show();
	    	$('.morebaby').show();
	    }else{
	    	$('.baby1').hide();
	    	$('.baby2').hide();
	    	$('.morebaby').hide();
	    }
	  }
	});
	/* if married */
	$("input:radio[name=rbMarried]").live('click', function() { 
	  	if($(this).val() == 1){	    	
	    	$('.married').show(); 
	    	$('.baby').show();
	    }else{
	    	$('.married').hide();
	    	$('.baby').hide();
	    	$('.baby1').hide();
	    	$('.baby2').hide();
	    	$('.morebaby').hide();
	    }
	  
	}); 
	$('.addImg').live('click', function(){ 
		var expNumber = $('#imgNumber').attr('value');	
		var expNumberNew = parseInt(expNumber)+1;
		var i = expNumberNew;		
		var strHtml = "<tr class='liexp"+i+"'><td></td></tr>";
		
		strHtml += "<tr class='liexp"+i+"'><td align='right' class='left'><label for='Image"+i+"'>Image Name "+i+":</label></td>";
		strHtml += 	"<td class='right'><input id='image"+i+"'type='file' name='image"+i+"'>";
	    strHtml += "<td></tr>";  
	    strHtml += "<tr class='liexp"+i+"'><td align='right' class='left'><label for='Caption Image"+i+"'>Caption Image"+i+":</label></td>";
		strHtml += 	"<td class='right'><input id='captionimage"+i+"'type='text' class='textbox_style' name='captionimage"+i+"'>";
	    strHtml += "<td></tr>"; 
		strHtml += "<tr class='addImg'><td align='right' class='left'></td><td class='right'>"; 
		strHtml += "<a href='javascript:void(0)'>add more Images [+]</a></td></tr>";  
        strHtml += "<tr class='removeImg'><td align='right' class='left'></td><td class='right' >"; 
		strHtml += "<a href='javascript:void(0)'>remove Images [+]</a><td></tr>";		

		$('.addImg').remove();
		$('.removeImg').remove();
		$('#imgNumber').attr('value',expNumberNew);	
		//var share = "share"+expNumber;		
		$("#imgNumber").before(strHtml);
		
	});
	$('.removeImg').live('click', function(){ 
		var expNumber = $('#imgNumber').attr('value');	
		var expNumberNew = parseInt(expNumber)-1;
		var i = expNumber;	
		var strHtml = "";
		
		if(i>2){
			strHtml += "<tr  class='addImg'><td align='right' class='left'></td><td class='right'>"; 
			strHtml += "<a href='javascript:void(0)'>add more Images [+]</a></td></tr>";           				
	        
	        strHtml += "<tr class='removeImg'><td align='right' class='left'></td><td class='right'>"; 
			strHtml += "<a href='javascript:void(0)'>remove Images [+]</a></td></tr>";	
			//var strHtml = "<div class='addExp' style='clear:both;padding: 5px 5px 5px 20px;'><a href='javascript:void(0)' >add more Education [+]</a></div>";
			//strHtml += "<div class='removeExp' style='clear:both;padding: 5px 5px 10px 20px;'><a href='javascript:void(0)' >remove Education [-]</a></div>";
		}else{
			strHtml += "<tr class='addImg'><td align='right' class='left'></td><td class='right'>"; 
			strHtml += "<a href='javascript:void(0)'>add more Images [+]</a><td></tr>";    
			//var strHtml = "<div class='addExp' style='clear:both;padding: 5px 5px 40px 20px;'><a href='javascript:void(0)' >add more Education [+]</a></div>";
		}	
		$('.addImg').remove();
		$('.removeImg').remove();
		$('#imgNumber').attr('value',expNumberNew);		
		var exp = "liexp"+i;		
		$('.'+exp).remove();	
		//$("#shareNumber-label").remove();		
		//var share = "expdiv"+expNumberNew;
		$('#imgNumber').before(strHtml);
		//$("#shareNumber-label").before(strHtml);
		
	});
	$('.morebaby').live('click', function() { 
		$('.morebaby').hide();
		$('.baby2').show();
    
	}); 	
	$('#Latitude').focus( function() { 
		$(".tooltip").css('display','block').fadeOut(5000);  
	});
	$('#Longitude').focus( function() { 
		$(".tooltip1").css('display','block').fadeOut(5000);  
	});
});