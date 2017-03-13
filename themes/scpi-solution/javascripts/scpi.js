(function($){	

var $panel =$('#respond .question-panel input');

$panel.each(function(){

var	$panel = $(this).parents('.question-panel');
var $button = $panel.find('button');

    $(this).change(function(){
    	let index = 0;
        let lenght = $panel.find('input').length;
    	$panel.find('input').each(function(k,e){
    		if($(e).val() !== '') index += 1;
		})

		if (index === lenght){
            $button.prop('disabled', false);
        }else {
            $button.prop('disabled', true);
		}

	})

})


$(".question-panel-header").click(function(){
	$(this).next().slideToggle();
});




})(jQuery);