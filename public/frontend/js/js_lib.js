/*===============================================================================================================	
Author     : Muhammad Febriansyah
Date       : Juli 2017
 =============================================================================================================== */
function windowHeight(){
	$(window).bind("load resize",function(){
		$(".fit_height").height($(window).height());	
	});
	$(window).bind("load resize",function(){
		if ($(window).width() > 789) {
			$(".half_height").height($(window).height()/2);
		}else{
			$(".half_height").height($(window).height());	
		}
	});
}

 $.fn.generate_height = function () {
  var maxHeight = -1;
  $(this).each(function () {
    $(this).children().each(function () {
      maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
    });

    $(this).children().each(function () {
      $(this).height(maxHeight);
    });
  })

}