jQuery(document).ready(function($){
	$('.mobileToggle').toggle(
		function(){
			$('.menuItemMobile .item').css({
				'display':'block'
			});
			$(this).css({'background-color' : '#F74E49'});
		},
		function(){
			$('.menuItemMobile .item').css({
				'display':'none'
			});
			$(this).css({'background-color' : 'transparent'});
		}
	);
	$('.closeSearch').toggle(
		function(){
			$('.closeSearch').addClass('focus');
			$('.searchWrapp #searchform').css({
				'display':'block'
			});
			setTimeout(function () {
				$('.searchWrapp #s').focus();
			}, 400);
		},
		function(){
			$('.closeSearch').removeClass('focus');
			$('.searchWrapp #searchform').css({
				'display':'none'
			});
			$('.searchWrapp #s').blur();
		}
	);
	$('.respondWrapp .titleWrapp .title').click(function(){
		$('.respondWrapp').addClass('active');
	});
	$('.respondWrapp .titleWrapp .close').click(function(){
		$('.respondWrapp').removeClass('active');
	});
	$('.comment .avatar').toggle(
		function(){
			$(this).parent().siblings('.right').children('.information').children('.reply').css({'display' : 'block'});
			$(this).parent().siblings('.right').children('.information').children('.date').css({'display' : 'none'})
		},
		function(){
			$(this).parent().siblings('.right').children('.information').children('.reply').css({'display' : 'none'});
			$(this).parent().siblings('.right').children('.information').children('.date').css({'display' : 'block'})
		}
	);
	jQuery(window).scroll(function() {
		respondNotice();
	});
})
var countOnce = 0;
function respondNotice() {
	var thisTopVar = $('html').position().top;

	if (countOnce == 0) {
		if (thisTopVar < "0") {
			var countTimer = 3;
			var timerNotice = setInterval(function(){
				if (countTimer > 0) {
					$(".respondWrapp .titleWrapp").addClass('titleNotice');
					setTimeout(function () {
						$(".respondWrapp .titleWrapp").removeClass('titleNotice');
					}, 300);
					countTimer--;
				}else {
					clearInterval(timerNotice);
				}
			},500);
		}
		countOnce = 1;
	}
}