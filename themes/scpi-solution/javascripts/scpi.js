(function($){	

var $panel =$('#respond .question-panel input');


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
var	$panel = $(this).parents('.question-panel');
var $button = $panel.find('button');

    $(this).change(function(){
			let index = 0;
			let lenght = $panel.find('input').length;

			$panel.find('input').each(function(k,e){
				if($(e).val() !== '' && validator.element( e ) ){
					index += 1;
				}
			})

			$button.prop('disabled', index === lenght ? false : true);
		})
})


$(".question-panel-header").click(function(){
	$(this).next().slideToggle();
});


$(".valider").click(function(e){
	e.preventDefault();
	console.log($(this).attr('data-panel'));

	//$(this).next().slideToggle();
});




})(jQuery);