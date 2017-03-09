<?php

if ( ! function_exists( 'lambda_translate_meta' ) ) :
	
    function lambda_translate_meta($content) {
        
         if( function_exists ( 'qtrans_useCurrentLanguageIfNotFoundShowAvailable' ) ) {
            return qtrans_useCurrentLanguageIfNotFoundShowAvailable($content);
        }
        
        if( function_exists ( 'ppqtrans_useCurrentLanguageIfNotFoundShowAvailable' ) ) {
            return ppqtrans_useCurrentLanguageIfNotFoundShowAvailable($content);
        }
        
        if( function_exists ( 'qtranxf_useCurrentLanguageIfNotFoundShowAvailable' ) ) {
            return qtranxf_useCurrentLanguageIfNotFoundShowAvailable($content);
        }
        
        return $content;
        
	}
    
endif;

?>