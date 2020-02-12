function html5Tags(){
	document.createElement('header');  
	document.createElement('section');  
	document.createElement('nav');  
	document.createElement('footer');  
	document.createElement('menu');  
	document.createElement('hgroup');  
	document.createElement('article');  
	document.createElement('aside');  
	document.createElement('details'); 
	document.createElement('figure');
	document.createElement('time');
	document.createElement('mark');
}

html5Tags();

	
var projectName;


jQuery(document).ready(function($){

	projectName = {
		
		common : {
			commonLoad : function(){
				$('body').append('<div class="overlay"></div>');
				$('body').append('<div class="modal_wrapper"></div>');
				$('.overlay').css('opacity', 0.6);
				
				/*$('.getDirection').live('click',function(){ 				
					$.ajax({
						url:'modalDirections.html',
						success:function(loadContent){
							$('.modal_wrapper').html(loadContent);
							$('.modal_wrapper, .overlay').fadeIn(1000);
							$('html,body').stop().animate({scrollTop: 0},{queue: false, duration:1000, easing:'easeOutExpo'});
						}
					});
				});*/
				
				
				$('.pageContent .pageNav li').click(function(){
					$('.pageContent .pageNav li').find('ul').stop(true, true).slideUp(800, 'easeOutQuint');
					$(this).find('ul').stop(true, true).slideDown(800, 'easeOutQuint');
				});




				

				
			},
			
			modalClose : function(){
				$('.close').live('click', function(){
					$('.modal_wrapper, .overlay, .overlaySign').fadeOut(1000);
					$('.openerVideo, .modalFrame object').hide();
					Join=1;
				});
			},
						
			commonInput : function(){
				
				var $inputText = $('.queryInput input, .queryInput textarea');
				$inputText.each(function(){
					var $thisHH = $(this);
					if(!$(this).val()){
						$(this).parent().find('label').show();
					}else{
						setTimeout(function(){
						$thisHH.parent().find('label').hide();
						},100);
					}
				});
				$inputText.live('focus',function(){
					if(!$(this).val()){
						$(this).parent().find('label').addClass('showLab');
					}
				});
				$inputText.live('keydown',function(){
					if(!$(this).val()){
						$(this).parent().find('label').hide();
					}
				});
				$inputText.live("blur",function(){
					var $thisH = $(this);
					if(!$(this).val()){
						$(this).parent().find('label').show().removeClass('showLab');
					}else{
						$thisH.parent().find('label').hide();
					}
					
				});
				
			}
			
		}//end commonLoad
			
	};

	projectName.common.commonLoad();
	projectName.common.commonInput();
	projectName.common.modalClose();

});