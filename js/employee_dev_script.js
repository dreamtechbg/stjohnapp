jQuery(document).ready(function($){
	// refresh page in every 10 minute
	var time = new Date().getTime();
	
    function refresh() {
        if(new Date().getTime() - time >= 1200000){ 
            window.location.reload(true);
        }else {
            setTimeout(refresh, 300000);
        }
    }

    setTimeout(refresh, 300000);

//Getting server time on button click
	$('.reportStartTime').click(function(){
		var $this = $(this);
		$.ajax({ 			
			url:'/ajax/getServerTime',
			success:function(response){
				if(response){
					 $this.parent().find('span').html(response);
					 $this.hide();
					//$('#contentArea').html(response);
				}
			}
		});
	});
	$('#timepicker').live('click', function(){
		$(this).parent().find('.timeList').show();
		$(this).parent().find('input').attr('value',$(this).parent().find('.timeList').val());
	});
	$('.timeList').live('change', function(){
		$(this).parent().find('input').attr('value',$(this).val());
		$(this).fadeOut();
	});
	
	
	
	
	$('.leaveApply').live('click', function(){ 
	   var fromDate = $('#fromDate').attr('value');
	   var toDate = $('#toDate').attr('value');
	   
	   /* checking for different years */ 
	   
   	   var frYear = fromDate.split('-');
           fromYear = frYear[0];
           fromMonth = frYear[1];
	   var tYear = toDate.split('-');
	       toYear = tYear[0];
	       toMonth = tYear[1];
	       
	  // alert(fromMonth+' and '+toMonth);    
	       
	   if(fromYear != toYear)   {
	       alert('Leave in different year in one leave application is not allowed !! ');
	       return false;
	   }
	   
	   if(fromMonth != toMonth) {
	   	   alert('Sorry !! Leave in different month is not allowed !!');
	       return false;
	   }
	   
	   /* checking leave applying  day is 3 day before or not */
	   
	   var start = new Date(fromDate);
	   var end   = new Date();
	   
	   // start - end returns difference in milliseconds 
	   
       var diff = new Date(start - end);
       var days = Math.ceil(diff/1000/60/60/24);
       
       // alert(days);
       
        if(days < 3){
              alert('You have to apply 3 working days before for any leave.');
              return false;
        }else if( days < 5 && days > 3){
               var i = 1;
               while(days > 0){ 
					start.setDate(start.getDate() - i);
					var day = start.getDay();
					if(day == 0 || day == 6){
					  // alert(i + "sun/sat found");
					  alert('You have to apply 3 working days before for taking leave.');
              		  return false;
					  
					}
					days = days - 1;
				}
        }

	});
	
	
	
	
	$('#isHalfday').live('click', function(){ 
		if($(this).attr('checked')){			
			$('.noon').show();
		}else{			
			$('.noon').hide();
		}		
	});
	
	$('.projectList').live('change', function (){ 		
		var pId = $(this).attr('value');
		var $this = $(this);
		var param='pId='+pId;
		$.ajax({
			type: 'post',
			url: '/ajax/getIssues',
			data: param,
			success: function(response) {
				if(response) {
					$('.issueId').html(response);
					
				}
				
			}
		});
	});
	
	$('.issueId').live('change', function (){ 		
		var issueId = $(this).attr('value');
		var $this = $(this);
		var param='issueId='+issueId;
		$.ajax({
			type: 'post',
			url: '/ajax/getIssueDetails',
			data: param,
			success: function(response) {
				if(response) {
					$('.issueDetails').html(response);
					
				}
				
			}
		});
	});
	
	$('.chatHeader').toggle(function(){
		$('.chatBox').animate({bottom:'0px'},800);
		},function(){
		$('.chatBox').animate({bottom:'-340px'},800);
	});
	$('.emoticon').live('click', function (){ 
		var chatBoxId = $(this).parent().parent().parent().attr('id');
		
		$('#'+chatBoxId).find('.chatboxcontent').append(chatBoxStr);
		
		if($('#'+chatBoxId).find('.emotIcons').is(":visible")){
			$('#'+chatBoxId).find('.emotIcons').hide();
			$('#'+chatBoxId).find('.emotIcons').remove();
		}else{
			$('#'+chatBoxId).find(".chatboxcontent").find('.emotIcons').show();
		} 
		$('#'+chatBoxId).find(".chatboxcontent").animate({ scrollTop: $(document).height() }, "slow");
		

	});	
	$('.eIcon').live('click', function (){ 
		var chatBoxId = $(this).parent().parent().parent().parent().attr('id');
		var symbol = $(this).find('img').attr('alt'); 		
		$('#'+chatBoxId).find('#output').insertAtCaret(symbol);
		$('#'+chatBoxId).find('.emotIcons').hide();
		$('#'+chatBoxId).find('.emotIcons').remove();
	});	
	$('.showMoreIcons').live('click', function (){ 
		var chatBoxId = $(this).parent().parent().parent().parent().attr('id');
		
		$('#'+chatBoxId).find('.moreIcons').show();
		$('#'+chatBoxId).find('.showMoreIcons').hide();
		$('#'+chatBoxId).find(".chatboxcontent").animate({ scrollTop: $(document).height() }, "slow");
	});
	$('.hideMoreIcons').live('click', function (){ 
		var chatBoxId = $(this).parent().parent().parent().parent().attr('id');		
		$('#'+chatBoxId).find('.moreIcons').hide();
		$('#'+chatBoxId).find('.showMoreIcons').show();
	});
	
	
	$('.chatboxtextarea').live('click keyup keydown', function (){ 
		var chatBoxId = $(this).parent().parent().attr('id');
		if($('#'+chatBoxId).find('.emotIcons').is(":visible")){
			$('#'+chatBoxId).find('.emotIcons').hide();
			$('#'+chatBoxId).find('.emotIcons').remove();
		}

	});	
	
	
	
});

jQuery.fn.extend({
    insertAtCaret: function(valueToInsertAtCaret){
        return this.each( function(i) {
            if ( document.selection ) {
                this.focus();
                selection = document.selection.createRange();
                selection.text = valueToInsertAtCaret;
                this.focus();
            } else if ( this.selectionStart || this.selectionStart == "0" ) {
                var startPosition = this.selectionStart;
                var endPosition = this.selectionEnd;
                var scrollTop = this.scrollTop;
                this.value = this.value.substring(0, startPosition) + valueToInsertAtCaret + this.value.substring(endPosition, this.value.length);
                this.focus();
                this.selectionStart = startPosition + valueToInsertAtCaret.length;
                this.selectionEnd = startPosition + valueToInsertAtCaret.length;
                this.scrollTop = scrollTop;
            } else {
                this.value += valueToInsertAtCaret;
                this.focus();
            }
        })
    }
});

function checkYear(){

   alert('hai');
}


function insert(str,id) {
    $("textarea#output").insertAtCaret(str);
    return true;
}

chatBoxStr = '<div class="emotIcons" ><ul>';
chatBoxStr += '<li class="eIcon"><img title="Smile" alt=":)" src="/images/emoticons/smile.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Sad" alt=":(" src="/images/emoticons/sadsmile.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Bigsmile" alt=":D" src="/images/emoticons/bigsmile.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Cool" alt="8)" src="/images/emoticons/cool.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Wink" alt=":o" src="/images/emoticons/wink.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Crying" alt=";(" src="/images/emoticons/crying.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Tongue Out" alt=":P" src="/images/emoticons/tongueout.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Wondering" alt=":^)" src="/images/emoticons/wondering.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Sleepy" alt="|-)" src="/images/emoticons/sleepy.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Dull" alt="|(" src="/images/emoticons/dull.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Evil grin" alt="(grin)" src="/images/emoticons/evilgrin.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Talking" alt="(talk)" src="/images/emoticons/talking.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Yawn" alt="(yawn)" src="/images/emoticons/yawn.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Angry" alt=":@" src="/images/emoticons/angry.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Worried" alt=":S" src="/images/emoticons/worried.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Mmm…" alt="(mm)" src="/images/emoticons/mmm.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Nerd" alt="8-|" src="/images/emoticons/nerd.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Lips Sealed" alt=":x" src="/images/emoticons/lipssealed.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Hi" alt="(hi)" src="/images/emoticons/hi.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Call" alt="(call)" src="/images/emoticons/call.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Devil" alt="(devil)" src="/images/emoticons/devil.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Wait" alt="(wait)" src="/images/emoticons/wait.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Covered Laugh" alt="(giggle)" src="/images/emoticons/giggle.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Clapping Hands" alt="(clap)" src="/images/emoticons/clapping.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Thinking" alt="(think)" src="/images/emoticons/thinking.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Rolling on the floor laughing" alt="(rofl)" src="/images/emoticons/rofl.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Happy" alt="(happy)" src="/images/emoticons/happy.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Smirking" alt="(smirk)" src="/images/emoticons/smirk.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Nodding" alt="(nod)" src="/images/emoticons/nod.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Shaking" alt="(shake)" src="/images/emoticons/shake.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Punch" alt="(punch)" src="/images/emoticons/punch.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Yes" alt="(y)" src="/images/emoticons/yes.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="No" alt="(n)" src="/images/emoticons/no.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Shaking Hands" alt="(handshake)" src="/images/emoticons/handshake.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Coffee" alt="(coffee)" src="/images/emoticons/coffee.gif"></li>';

chatBoxStr += '<li class="showMoreIcons">more>></li>';

chatBoxStr += '</ul><ul class="moreIcons">';

chatBoxStr += '<li class="eIcon"><img title="Sweating" alt="(sweat)" src="/images/emoticons/sweating.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Speechless" alt=":|" src="/images/emoticons/speechless.gif"></li>';
//chatBoxStr += '<li class="eIcon"><img title="Kiss" alt=":*" src="/images/emoticons/kiss.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Blush" alt=":$" src="/images/emoticons/blush.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="In love" alt="(inlove)" src="/images/emoticons/inlove.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Puke" alt="(puke)" src="/images/emoticons/puke.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Doh!" alt="(doh)" src="/images/emoticons/doh.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="It wasn’t me" alt="(wasntme)" src="/images/emoticons/itwasntme.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Party!!!" alt="(party)" src="/images/emoticons/party.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Angel" alt="(angel)" src="/images/emoticons/angel.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Envy" alt="(envy)" src="/images/emoticons/envy.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Bear" alt="(bear)" src="/images/emoticons/bear.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Make-up" alt="(makeup)" src="/images/emoticons/makeup.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Broken heart" alt="(whew)" src="/images/emoticons/whew.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="" alt="(u)" src="/images/emoticons/brokenheart.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Rain" alt="(rain)" src="/images/emoticons/rain.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Music" alt="(music)" src="/images/emoticons/music.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Phone" alt="(mp)" src="/images/emoticons/phone.gif"></li>';
chatBoxStr += '<li class="eIcon"><img title="Bug" alt="(bug)" src="/images/emoticons/bug.gif"></li>';

chatBoxStr += '<li class="hideMoreIcons">hide>></li>';
chatBoxStr += '</ul></div>';