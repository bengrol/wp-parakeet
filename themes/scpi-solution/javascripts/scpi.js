(function($){

var $panel =$('#respond').find('.question-panel');

$panel.find('input').each(function (index) {
   // $(this).addClass('pristine');
});

    var rules = {
        first_name :{
            required: true,
            minlength: 5,
            maxlength: 20,
        },
        last_name :{},
        mail :{
            required: true,
            minlength: 6,
            email: true
        },
        tel :{},
        zip_code :{},
        date_naissance :{},
        situation :{},
        montant :{},
        obj :{},
        renom :{},


    };
    var messages = {
        first_name :{
            required:'Merci de renseigner ce champ',
        },
        last_name :{},
        mail :{},
        tel :{},
        zip_code :{},
        date_naissance :{},
        situation :{},
        montant :{},
        obj :{},
        renom :{},
    };

var validator = $('#simulation-form').validate({
    rules:rules,
    messages:messages,
});

$panel.each(function(){

	var inputs =$(this).find('input');
    var $button = $(this).find('button');
    inputs.on('click',function(e){
        $(this).removeClass('pristine');
    });

    inputs.on('keyup',function(e){

		var lenght = inputs.filter('[required]').length;
		var index = 0;

        inputs.each(function(k,e){
        	if( !$(e).hasClass('pristine') && $(e).attr('required') || $(e).val() !== ''){
        		//console.debug('debug required or not empty ', e);

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


$('.simualtion-invest-moyen').click(function(){

var $input = $('.simualtion-credit-duree input');
// console.debug(' input =  ', $input);


    if($(this).hasClass('credit')){
        $('.simualtion-credit-duree').show();
    }else{
        $('.simualtion-credit-duree').hide();
    }
});



$(".valider").click(function(e){
	e.preventDefault();
	var target = $(this).attr('data-target');
	$('.panel-'+target).addClass('active').removeClass('not-active');

	$('.panel-'+(target-1)).find('.question-panel').slideToggle();


	$(this).next().slideToggle();
});



// animation chart //
    $("#chart-animation").mouseenter(function() {
        var li = $(this).find('.chart-amount');
        li.each(function(){
            $(this).animate({
                opacity: '1',
                width: $(this).data('amount') + "%"
            }, 1100);
        })


    });





})(jQuery);