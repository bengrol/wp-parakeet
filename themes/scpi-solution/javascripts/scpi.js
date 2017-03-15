(function($){	

var $panel =$('#respond').find('.question-panel');
    
$panel.find('input').each(function (index) {
    $(this).addClass('pristine');
});

console.debug('DEBUG', $panel);

jQuery.extend(jQuery.validator.messages,{required: "Ce champs est requis .",
  email: "Merci de renseigner une adresse mail valide",
  date: "Merci de renseigner une date valide",
  number: "Merci de renseigner un nombre valide",
  maxlength: $.validator.format( "Merci de taper moins de {0} characters." ),
  minlength: $.validator.format( "Merci de taper plus de  {0} characters." ),
  rangelength: $.validator.format( "Merci de rentrer une valeur comprise entre {0} et {1} ." ),
  range: $.validator.format( "Merci de rentrer une valeur comprise entre {0} et {1} " ),
  max: $.validator.format( "Merci de rentrer une valeur inférieur ou égale à {0}." ),
  min: $.validator.format( "Merci de rentrer une valuer inférieur ou égale à  {0}." ),

} )


var validator = $('#simulation-form').validate();

$panel.each(function(){

	var inputs =$(this).find('input');
    var $button = $(this).find('button');
    inputs.on('click',function(e){
        $(this).removeClass('pristine');
    });

    inputs.on('focusout',function(e){

		var lenght = inputs.filter('[required]').length;
		var index = 0;

        inputs.each(function(k,e){
        	if( !$(e).hasClass('pristine') && $(e).attr('required') || $(e).val() !== ''){
        		console.debug('debug required or not empty ', e);

                if( validator.element( e ) && $(e).attr('required') ){
                    index += 1;
                }
			}

		})

        $button.prop('disabled', index === lenght ? false : true);
	})


})


$(".question-panel-header").click(function(){
	if($(this).parent().hasClass( "active" )){
        $(this).next().slideToggle();
	}
});


$(".valider").click(function(e){
	e.preventDefault();
	var target = $(this).attr('data-target');
	$('.panel-'+target).addClass('active').removeClass('not-active');

	$('.panel-'+(target-1)).find('.question-panel').slideToggle();


	$(this).next().slideToggle();
});




})(jQuery);