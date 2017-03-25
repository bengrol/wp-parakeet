(function($){

/*
  first_name :{},
  last_name :{},
  mail :{},
  tel :{},
  zip_code :{},
  date_naissance :{},
  situation :{},
  montant :{},
  obj :{},
  renom :{},
*/


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
      required:'Merci de renseigner vite ce champ',
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



  $('#scpiajaxform').validate({
  errorLabelContainer: "#messageBox",

    // showErrors: function(errorMap, errorList) {
    //   $("#messageBox").html("Your form contains "
    //     + this.numberOfInvalids()
    //     + " errors, see details below.");
    //   this.defaultShowErrors();
    // },

    rules:rules,
    messages:messages,
    submitHandler:function(form){


      console.debug('submited');
      $.post(
        ajaxurl,
        {
          'action': 'scpi_action',
          'ajax_param': stringToJson('#scpiajaxform')
        },
        function (response) {

            $('#messageBox').toggle().html(response);

            $('#scpiajaxform').toggle();

            setTimeout(function(){
                // toggle back after 1 second
                $('#scpiajaxform').toggle();
                $('#scpiajaxform')[0].reset();
            },5000);


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