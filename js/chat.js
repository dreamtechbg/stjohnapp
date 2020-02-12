/*

Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)

This script may be used for non-commercial purposes only. For any
commercial purposes, please contact the author at 
anant.garg@inscripts.com

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

*/

var windowFocus = true;
var username;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 1000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;

var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();

$(document).ready(function(){
	originalTitle = document.title;
	checkStatus();
	startChatSession();

	$([window, document]).blur(function(){
		windowFocus = false;
	}).focus(function(){
		windowFocus = true;
		document.title = originalTitle;
	});
});

function restructureChatBoxes() {
	align = 0;
	for (x in chatBoxes) {
		chatboxtitle = chatBoxes[x];

		if ($("#chatbox_"+chatboxtitle).css('display') != 'none') {
			if (align == 0) {
				$("#chatbox_"+chatboxtitle).css('right', '250px');
			} else {
				width = (align)*(225+5)+250;
				$("#chatbox_"+chatboxtitle).css('right', width+'px');
			}
			align++;
		}
	}
}

function chatWith(chatuser) {
	createChatBox(chatuser);
	$("#chatbox_"+chatuser+" .chatboxtextarea").focus();
}

function createChatBox(chatboxtitle,minimizeChatBox) {
	if ($("#chatbox_"+chatboxtitle).length > 0) {
		if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
			$("#chatbox_"+chatboxtitle).css('display','block');
			restructureChatBoxes();
		}
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		return;
	}
	var chatBoxStr = '<div class="chatboxhead">';
	chatBoxStr += '<div class="chatboxtitle">'+chatboxtitle+'</div>';
	chatBoxStr += '<div class="chatboxoptions">';
		chatBoxStr += '<a href="javascript:void(0)" onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle+'\')">-</a>'; 
		chatBoxStr += '<a href="javascript:void(0)" onclick="javascript:closeChatBox(\''+chatboxtitle+'\')">X</a>';
		chatBoxStr += '</div>';
	chatBoxStr += '<br clear="all"/>';
	chatBoxStr += '</div>';
	chatBoxStr += '<div class="chatboxcontent">';	
	chatBoxStr += '</div>';			
	chatBoxStr += '<div class="chatboxinput">';
	
	chatBoxStr += '<div>';
	chatBoxStr += '<a class="emoticon" ><img alt="smile" src="/images/emoticons/smile.gif"></a>';
	chatBoxStr += '<a class="chatHistory"  href="javascript:void(0)" onClick="window.open(\'chatHistory?with='+chatboxtitle+'\',\'chat history\',\'width=400,height=600,scrollbars=1\')">chat history</a>';
	chatBoxStr += '</div>';
	chatBoxStr += '<textarea  id="output"  class="chatboxtextarea" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\');"></textarea>';
	chatBoxStr += '</div>';
	$(" <div />" ).attr("id","chatbox_"+chatboxtitle)
	.addClass("chatbox")
	
	.html(chatBoxStr)
	.appendTo($( "body" ));
			   
	$("#chatbox_"+chatboxtitle).css('bottom', '0px');
	
	chatBoxeslength = 0;

	for (x in chatBoxes) {
		if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
			chatBoxeslength++;
		}
	}

	if (chatBoxeslength == 0) {
		$("#chatbox_"+chatboxtitle).css('right', '250px');
	} else {
		width = (chatBoxeslength)*(225+5)+250;
		$("#chatbox_"+chatboxtitle).css('right', width+'px');
	}
	
	chatBoxes.push(chatboxtitle);

	if (minimizeChatBox == 1) {
		minimizedChatBoxes = new Array();

		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}
		minimize = 0;
		for (j=0;j<minimizedChatBoxes.length;j++) {
			if (minimizedChatBoxes[j] == chatboxtitle) {
				minimize = 1;
			}
		}

		if (minimize == 1) {
			$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
			$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
		}
	}

	chatboxFocus[chatboxtitle] = false;

	$("#chatbox_"+chatboxtitle+" .chatboxtextarea").blur(function(){
		chatboxFocus[chatboxtitle] = false;
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
	}).focus(function(){
		chatboxFocus[chatboxtitle] = true;
		newMessages[chatboxtitle] = false;
		$('#chatbox_'+chatboxtitle+' .chatboxhead').removeClass('chatboxblink');
		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
	});

	$("#chatbox_"+chatboxtitle).click(function() {
		if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') != 'none') {
			$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		}
	});

	$("#chatbox_"+chatboxtitle).show();
}


function chatHeartbeat(){

	var itemsfound = 0;
	
	if (windowFocus == false) {
 
		var blinkNumber = 0;
		var titleChanged = 0;
		var popUp = 0;
		for (x in newMessagesWin) {
			if (newMessagesWin[x] == true) {
				++blinkNumber;
				if (blinkNumber >= blinkOrder) {
					document.title = x+' says...';
					window.open('/employee/messageAlert?from='+x,'window','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=350,height=10');
					
					titleChanged = 1;
					++popUp;
					break;	
				}
			}
		}
		
		if (titleChanged == 0) {
			document.title = originalTitle;
			blinkOrder = 0;
		} else {
			++blinkOrder;
		}

	} else {
		for (x in newMessagesWin) {
			newMessagesWin[x] = false;
		}
	}

	for (x in newMessages) {
		if (newMessages[x] == true) {
			if (chatboxFocus[x] == false) {
				//FIXME: add toggle all or none policy, otherwise it looks funny
				$('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
			}
		}
	}
	
	$.ajax({
	  url: "/ajax/chat?action=chatheartbeat",
	  cache: false,
	  dataType: "json",
	  success: function(data) {

		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;

				if ($("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle);
				}
				if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
					$("#chatbox_"+chatboxtitle).css('display','block');
					restructureChatBoxes();
				}
				
				if (item.s == 1) {
					item.f = username;
				}

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {
					newMessages[chatboxtitle] = true;
					newMessagesWin[chatboxtitle] = true;
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.f+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
				}

				$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				itemsfound += 1;
			}
		});

		chatHeartbeatCount++;

		if (itemsfound > 0) {
			chatHeartbeatTime = minChatHeartbeat;
			chatHeartbeatCount = 1;
		} else if (chatHeartbeatCount >= 10) {
			chatHeartbeatTime *= 2;
			chatHeartbeatCount = 1;
			if (chatHeartbeatTime > maxChatHeartbeat) {
				chatHeartbeatTime = maxChatHeartbeat;
			}
		}
		
		setTimeout('chatHeartbeat();',chatHeartbeatTime);
	}});
}

function closeChatBox(chatboxtitle) {
	$('#chatbox_'+chatboxtitle).css('display','none');
	restructureChatBoxes();

	$.post("/ajax/chat?action=closechat", { chatbox: chatboxtitle} , function(data){	
	});

}

function toggleChatBoxGrowth(chatboxtitle) {
	if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {  
		
		var minimizedChatBoxes = new Array();
		
		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}

		var newCookie = '';

		for (i=0;i<minimizedChatBoxes.length;i++) {
			if (minimizedChatBoxes[i] != chatboxtitle) {
				newCookie += chatboxtitle+'|';
			}
		}

		newCookie = newCookie.slice(0, -1)


		$.cookie('chatbox_minimized', newCookie);
		$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');
		$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');
		$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
	} else {
		
		var newCookie = chatboxtitle;

		if ($.cookie('chatbox_minimized')) {
			newCookie += '|'+$.cookie('chatbox_minimized');
		}


		$.cookie('chatbox_minimized',newCookie);
		$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
		$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
	}
	
}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle) {
	 
	if(event.keyCode == 13 && event.shiftKey == 0)  {
		message = $(chatboxtextarea).val();
		message = message.replace(/^\s+|\s+$/g,"");
		
		$(chatboxtextarea).val('');
		$(chatboxtextarea).focus();
		$(chatboxtextarea).css('height','44px');
		if (message != '') {
			$.post("/ajax/chat?action=sendchat", {to: chatboxtitle, message: message} , function(data){
				message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
				// replace Emoticons start
				var find = new Array(':)',':=)',':-)',
						':(',':=(',':-(',
						':D',':=D',':-D',':d',':=d',':-d',
						'8)','8=)', '8-)', 'B)', 'B=)', 'B-)', '(cool)',
						':o',':=o',':-o',':O',':=O',':-O',
						';(',';-(',';=(',
						'(sweat)','(:|',
						':|',':=|',':-|',
						':*',':=*',':-*',
						':P',':=P',':-P',':p',':=p',':-p',
						':$',':-$',':=$',
						':^)',
						'|-)','I-)','I=)','(snooze)',
						'|(','|-(','|=(',
						'(inlove)',
						'(grin)',
						'(talk)',
						'(yawn)',
						'(puke)',':&',':-&',':=&',
						'(doh)',
						':@',':-@',':=@','x(','x-(','x=(','X(','X-(','X=(',
						'(wasntme)',
						'(party)',
						':S',':-S',':=S',':s',':-s',':=s',
						'(mm)',
						'8-|','B-|','8|','B|','8=|','B=|','(nerd)',
						':x',':-x',':X',':-X',':#',':-#',':=x',':=X',':=#',
						'(hi)',
						'(call)',
						'(devil)',
						'(angel)',
						'(envy)',
						'(wait)',
						'(bear)','(hug)',
						'(makeup)','(kate)',
						'(giggle)','(chuckle)',
						'(clap)',
						'(think)',':?',':-?',':=?',
						'(rofl)',
						'(whew)',
						'(happy)',
						'(smirk)',
						'(nod)',
						'(shake)',
						'(punch)',
						'(y)','(Y)','(ok)',
						'(n)','(N)',
						'(handshake)',
						'(u)','(U)',
						'(rain)','(london)','(st)',
						'(music)',
						'(coffee)',
						'(mp)','(ph)',
						'(bug)'
						);
				var replace = new Array('smile.gif','smile.gif','smile.gif',
						'sadsmile.gif','sadsmile.gif','sadsmile.gif',
						'bigsmile.gif','bigsmile.gif','bigsmile.gif','bigsmile.gif','bigsmile.gif','bigsmile.gif',
						'cool.gif','cool.gif','cool.gif','cool.gif','cool.gif','cool.gif','cool.gif',
						'wink.gif','wink.gif','wink.gif','wink.gif','wink.gif','wink.gif',
						'crying.gif','crying.gif','crying.gif',
						'sweating.gif','sweating.gif',
						'speechless.gif','speechless.gif','speechless.gif',
						'kiss.gif','kiss.gif','kiss.gif',
						'tongueout.gif','tongueout.gif','tongueout.gif','tongueout.gif','tongueout.gif','tongueout.gif',
						'blush.gif','blush.gif','blush.gif',
						'wondering.gif',
						'sleepy.gif','sleepy.gif','sleepy.gif','sleepy.gif',
						'dull.gif','dull.gif','dull.gif',
						'inlove.gif',
						'evilgrin.gif',
						'talking.gif',
						'yawn.gif',
						'puke.gif','puke.gif','puke.gif','puke.gif',
						'doh.gif',
						'angry.gif','angry.gif','angry.gif','angry.gif','angry.gif','angry.gif','angry.gif','angry.gif','angry.gif',
						'itwasntme.gif',
						'party.gif',
						'worried.gif','worried.gif','worried.gif','worried.gif','worried.gif','worried.gif',
						'mmm.gif',
						'nerd.gif','nerd.gif','nerd.gif','nerd.gif','nerd.gif','nerd.gif','nerd.gif',
						'lipssealed.gif','lipssealed.gif','lipssealed.gif','lipssealed.gif','lipssealed.gif','lipssealed.gif','lipssealed.gif','lipssealed.gif','lipssealed.gif',
						'hi.gif',
						'call.gif',
						'devil.gif',
						'angel.gif',
						'envy.gif',
						'wait.gif',
						'bear.gif','bear.gif',
						'makeup.gif','makeup.gif',
						'giggle.gif','giggle.gif',
						'clapping.gif',
						'thinking.gif','thinking.gif','thinking.gif','thinking.gif',
						'rofl.gif',
						'whew.gif',
						'happy.gif',
						'smirk.gif',
						'nod.gif',
						'shake.gif',
						'punch.gif',
						'yes.gif','yes.gif','yes.gif',
						'no.gif','no.gif',
						'handshake.gif',
						'brokenheart.gif','brokenheart.gif',
						'rain.gif','rain.gif','rain.gif',
						'music.gif',
						'coffee.gif',
						'phone.gif','phone.gif',
						'bug.gif'
				);
				
				   for (var i = 0; i < find.length; i++) {
					  var replaceEmot = "<img alt='"+find[i]+"' src='/images/emoticons/"+replace[i]+"'>";
					  message = message.replace(find[i], replaceEmot);
					  
				  }

				// replace Emoticons end	
				$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+username+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+message+'</span></div>');
				$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			});
		}
		chatHeartbeatTime = minChatHeartbeat;
		chatHeartbeatCount = 1;

		return false;
	}

	var adjustedHeight = chatboxtextarea.clientHeight;
	var maxHeight = 94;

	if (maxHeight > adjustedHeight) {
		adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
		if (maxHeight)
			adjustedHeight = Math.min(maxHeight, adjustedHeight);
		if (adjustedHeight > chatboxtextarea.clientHeight)
			$(chatboxtextarea).css('height',adjustedHeight+8 +'px');
	} else {
		$(chatboxtextarea).css('overflow','auto');
	}
	 
}













function checkStatus(){	
	$.ajax({
		type:'post',
		url:'/ajax/chat?action=checkStatus',
		success: function(response) {
			var obj = jQuery.parseJSON(response);
			if(obj.length > 0) {
				$('.suggestionBox').show();
				var obj = jQuery.parseJSON(response);
				var html = '';
				var status = '';
				
				for(var i=0 ; i<obj.length; i++) {
					//alert(obj[i]['id']);
					//alert(obj[i]['status']);
					
					
					if(obj[i]['status'] == 0){
						status = 'offline';
					}
					if(obj[i]['status'] == 1){
						status = 'available';
					}
					if(obj[i]['status'] == 2){
						status = 'away';
					}
					if(obj[i]['status'] == 3){
						status = 'busy';
					}
					$('#idn'+obj[i]['id']).attr('class','status '+status);
					
				}
				
			}
		}
	});	
	setTimeout('checkStatus();',chatHeartbeatTime);
	
}



























function startChatSession(){  
	$.ajax({
	  url: "/ajax/chat?action=startchatsession",
	  cache: false,
	  dataType: "json",
	  success: function(data) {
 
		username = data.username;

		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;

				if ($("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle,1);
				}
				
				if (item.s == 1) {
					item.f = username;
				}

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.f+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
				}
			}
		});
		
		for (i=0;i<chatBoxes.length;i++) {
			chatboxtitle = chatBoxes[i];
			$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
		}
	
	setTimeout('chatHeartbeat();',chatHeartbeatTime);
	//setTimeout('checkStatus();',chatHeartbeatTime);
		
	}});
}

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};