

$(function(){
			$('.showImg').hover(function(){    
    
				$(".showImg").removeClass("active");
				$(this).addClass("active");
    
				var imgURL = $(this).find('img').attr("src");    
				$('#imgHolder').find('img').attr("src", imgURL);    
			});
		});//]]>  
