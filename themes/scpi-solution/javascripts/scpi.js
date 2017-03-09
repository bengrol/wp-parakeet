(function($){	

	$( "#tabs" ).tabs(
	{	disabled: [ 1, 2 ]}
	);
	

	
//var $required_tab1 = $('#tabs-1 input[aria-required="true"]');
//var $required_tab2 = $('#tabs-2 input[aria-required="true"]');


$.each([1,2], function(index){

	var required_tab = $('#tabs-'+index+' input[aria-required="true"]');
	
	required_tab.each( function(){	 
	 	if($(this).val()){

$( ".selector" ).tabs( "option", "disabled", [ index] );

	 	}
	});
})






})(jQuery);