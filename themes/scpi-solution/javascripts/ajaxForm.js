(function($){


  var rules = {
    name: {
      required: true,
      minlength: 5,
      maxlength: 20,
      lettersonly: true
    },
   email: {
      required: true,
      minlength: 6,
      email: true
    }
  };



  $('#scpiajaxform').validate({
    rules:rules,
    submitHandler:function(form){


      console.debug('submited');
      $.post(
        ajaxurl,
        {
          'action': 'scpi_action',
          'ajax_param': stringToJson('#scpiajaxform')
        },
        function (response) {
          $('#scpiajaxform').html(response);
        }
      );

    }
  });



  function stringToJson(form){
    var data = '{"';
    data += $(form).serialize().split('&').join('","');
    data = data.split('=').join('":"');
    data += '"}';
    return data;
  }

})(jQuery);