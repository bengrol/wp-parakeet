$(function() {
    
    /* variables */
    
    /* options pour toogle */
    var optResa =  {
        anim : "drop",
        direction : "up",
        speed : 500
    };
    var optMenu =  {
        anim : "blind",
        direction : "up",
        speed : "easeOutExpo"
    };
    var $widthSrceen =   $(window).width();
    var heightScreen = $(window).height();
    /* end variables */

    /* functions */
    
    // toogle fonction avec les options
    function toogleElement(el, opt){
        $(el).toggle(opt.anim,  {direction: opt.direction}, opt.speed );
    }
    /**
     *  retourne la date du jour
     * @returns {String}
     */
    function getCurrentDate(){
        var date = new Date();
        var d = date.getDate();
        var day = (d < 10) ? '0' + d : d;
        var m = date.getMonth() + 1;
        var month = (m < 10) ? '0' + m : m;
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        var currDate = day + "." + month + "." + year;
        return currDate;
    }

    function adapteScreen(){
        $widthSrceen =   $(window).width();
        allImages = $('#primary').find('img');
        $.each(allImages, function(index, el){
            $(el).css('width', $widthSrceen+15);
        });
    };
    function rotateEl(el){
        if($(el).hasClass('icone-rotate')){
            $(el).removeClass('icone-rotate');
        }else{
            $(el).addClass('icone-rotate');
        }
    };
    
    function removeIfram(){
        $('iframe.visite360').remove();
    }
    
    function collapseElement($self, $state){
        //console.log($self , $state);
        
        var classExpanded = "col-md-offset-1 col-md-10";
        var classCollapsed = "col-md-offset-3 col-md-8";
    
        if($widthSrceen<1150){
            classCollapsed = "col-md-offset-4 col-md-8";
        }
        $site_content = $('.site-content');
        stateExpanded = $site_content.hasClass('col-md-offset-1');
        
        
        if($state === true ){
            if($self.hasClass('boxpulse')){
                $self.removeClass('boxpulse');
            }
            if($widthSrceen>1000 &&  stateExpanded ){
                $site_content
                  .removeClass(classExpanded)
                  .addClass(classCollapsed, optMenu.speed);
              }
        }else{
            if(!$self.hasClass('boxpulse')){
                $self.addClass('boxpulse');
            }
            
            if($widthSrceen>1000){
                $site_content
                  .addClass(classExpanded, optMenu.speed)
                  .removeClass(classCollapsed);
            }
        }           
        
        
    }
    /* End Functions */
    
    
    /* loader de la page */
    $('#loaderDiv').detach();
    
    /* animation header page des chambres & evenements ... */
    $( ".header-colipsable" ).on('click' , function(){
    var animationSpeed = 800;
    var $header = $(this);
    var $overlay = $header.children('.overlay');
    var $sectionCollipsable = $header.siblings('.sec-chambre');
    var state = $header.attr('data-state');

    if (state === 'active') {
      $header.attr('data-state' , 'inactive');
      $overlay.animate({
        opacity: 0.5,
        backgroundColor: 'rgb(0,0,0)'
       }, animationSpeed );

    }else{
      
      $header.attr('data-state' , 'active');
      $overlay.animate({
        opacity: 1,
        backgroundColor: "#759590"    
      }, animationSpeed );
    };

    $sectionCollipsable.slideToggle( animationSpeed);

  });
  
    $(".resa-toogle").click(function(){
        toogleElement('.resa-container', optResa);
    });

    $('#resa-container-close').on('click', function (){
        toogleElement('.resa-container', optResa);
    });
  
    /* menu toogle */
    $('#menu-header').on('click', function(){
       toogleElement('#main-nav-container', optMenu);
       collapseElement($(this), $(this).hasClass('boxpulse'));

        rotateEl('span.glyphicon.glyphicon-chevron-up');

    });

    $('#tdate').val(getCurrentDate());

    $(window).on('resize', function(){
        adapteScreen();
    });
    
    adapteScreen();



    $('#content').css('min-height',  heightScreen*50/100);
    
    $('.visite360HD').on('click', function(){
       console.log('visite360HD');
        var $url =  $(this).attr('data-url');
        $(this)
                .append('<span id="closeIframe"><i class="fa fa-times  fa-3x"></i></span>')
                .append('<iframe align="top" scrolling="no"  class="wrapper visite360" src='+$url+'  name="" id="blockrandom">No Iframes</iframe>')
                //.append('</div>')
                ;

    });

    $('#closeIframe').on('click', function(event){
            removeIfram(); 
            return false;
    });

    $('.tripadvisor').siblings('div').css('display', 'none');
  
    $('.tripadvisor-container').on('click', function (){
        var $trip = $('.tripadvisor').siblings('div');    
        toogleElement($trip, optResa);
    });
});
