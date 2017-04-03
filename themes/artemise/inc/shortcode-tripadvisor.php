<?php

add_shortcode('artemise_tripadvisor', function() {
    $lang = getCurrentLang();
    
    $firstDiv = '<div class="tripadvisor-container border-bottom-radius" >'
            . '<img  class="tripadvisor " src="' .get_template_directory_uri(). '/images/tripadvisor-150.jpeg" />';
            
    
    
    
     $code = '<div id="TA_selfserveprop624" class="TA_selfserveprop" style="display:none">'
             . '<ul id="dB7E8IsOPDF" class="TA_links awMReTaE">'
                . '<li id="Hthwb8gzpazY" class="CzXGFH8x">'
                    . '<a target="_blank" href="http://www.tripadvisor.co.uk/">'
                        . '<img src="http://www.tripadvisor.co.uk/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/>'
                    . '</a>'
                . '</li>'
             . '</ul>'
             . '</div></div>'
             
             . '<script src="http://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=624&amp;locationId=2216532&amp;lang=en_UK&amp;rating=true&amp;nreviews=3&amp;writereviewlink=false&amp;popIdx=true&amp;iswide=false&amp;border=false&amp;display_version=2"></script>';
    switch ($lang) {
        case 1: //en 
           
            break;

        case 4 : //fr
            $code = '<div id="TA_selfserveprop423" class="TA_selfserveprop"><ul id="ytz504gcSs"  class="TA_links pW8FFVZ"> <li id="VuNuIyYVT"    class="zjpwufHIP"><a target="_blank" href="http://www.tripadvisor.fr/"><img src="http://www.tripadvisor.fr/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a></li></ul></div>     <script src="http://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=423&amp;locationId=2216532&amp;lang=fr&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=false&amp;display_version=2"></script>';
            break;
        
        default:
           
            break;
    }
    

    
    return $firstDiv.$code;
    }
);


?>




