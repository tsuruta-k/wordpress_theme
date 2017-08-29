(function($){

	//matchHeight.jsの使用
	$(window).on('load', function(){
		$('.matchbox').matchHeight();
		$('.matchcontents').matchHeight();
	});
	var timer = false;
	var winWidth = $(window).width();
	var winWidth_resized;
	$(window).on("resize", function(){
		if (timer !== false) {
			clearTimeout(timer);
		}
		timer = setTimeout(function() {
			winWidth_resized = $(window).width();
			if ( winWidth != winWidth_resized ) {
				$('.matchbox').matchHeight();
				$('.matchcontents').matchHeight();
				winWidth = $(window).width();
			}
		}, 200);
	});

})(jQuery);