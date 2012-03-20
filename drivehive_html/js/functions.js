jQuery(function(){
	$('#index-countdown li').eq(0).addClass('active');
	var ul_width = 1279 * $('#baner-images > ul > li').size();
	$('#baner-images > ul').css('width', ul_width);
	
	$('#faq h4 a').click(function(){
		var clickedPar = $(this).parent().siblings('p');
		if(clickedPar.hasClass('active')){
			clickedPar.slideUp().removeClass('active');
		}else{
			$('p.active').slideUp().removeClass('active');
			//$('#faq p.active').removeClass('active');
			clickedPar.slideDown();
			clickedPar.addClass('active');
		}
		return false;
	});
	
	var col_width = $('#news-col2').width();
	var news_ul_width = col_width * $('#news-col2 > ul > li').size();
	$('#news-col2 > ul').css('width', news_ul_width);
	$('#news-next-page').click(function(){
		var pos = (parseInt($('#news-col2 ul').css('left')) / col_width * -1)+1;
		if(pos>=$('#news-col2 > ul > li').size()) pos = 0;
		$('#news-col2 ul').animate({left: -720 * pos}, 300, 'swing');
		return false;
	});
	
	$('#index-countdown ul li a').mouseenter(function(){
		var currentIndex = $(this).parent().prevAll().length;
		slideNext(currentIndex);
		clearInterval( Loop );
		Loop = setInterval('loop()', 6000);
	});
	
	Loop = setInterval('loop()', 6000);
	
	dateFuture = new Date(2011,12,1,24,00,00);
	GetCount();
	
});

function slideNext(currentIndex){
	$('#baner-images > ul').animate({left: -1279 * currentIndex}, 300, 'swing');
	$('#index-countdown .active').removeClass('active');
	$('#index-countdown li').eq(currentIndex).addClass('active');
}

function loop(){
	var thisSlide = $('#index-countdown li.active').prevAll().length;
	var li_count = $('#baner-images > ul > li').size();
	if(thisSlide>=li_count-1){
		slideNext(0);
	}else{
		slideNext(thisSlide+1);
	}
}

function GetCount(){

    dateNow = new Date();
    amount = dateFuture.getTime() - dateNow.getTime();
    delete dateNow;

    if(amount < 0){
		 $('#seconds').html("0");
		 $('#minutes').html("0");
    }
    else{
		 days=0;hours=0;mins=0;secs=0;out="";

		 amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

		 days=Math.floor(amount/86400);//days
		 amount=amount%86400;

		 hours=Math.floor(amount/3600);//hours
		 amount=amount%3600;

		 mins=Math.floor(amount/60);//minutes
		 amount=amount%60;

		 secs=Math.floor(amount);//seconds

		 if(days != 0){out += days +" dni"+((days!=1)?"":"")+", ";}
		 if(days != 0 || hours != 0){out += hours +" godzin"+((hours==1)?"a":"")+", ";}
		 if(days != 0 || hours != 0 || mins != 0){out += mins +" minut"+((mins==1)?"a":"")+", ";}
		 out += secs +" sekund";
		 mins = zeroPad(mins,2);
		 secs = zeroPad(secs,2);
		 $('#seconds').html(secs+"S");
		 $('#minutes').html(mins+"M");

		 setTimeout("GetCount()", 1000);
    }
}

function zeroPad(num,count){
	var numZeropad = num + '';
	while(numZeropad.length < count) {
		numZeropad = "0" + numZeropad;
	}
	return numZeropad;
}