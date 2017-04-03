
<?PHP 

$l = getCurrentLang();

$cgv = [1 =>279, 4=>91];

$getCurrentArtemisePage =  get_permalink( $post->ID ); 


?>

<article class="art-chambre">
    <header class="header-colipsable" data-state="inactive"  
            style="background-image : url(<?= getImageHeader(); ?>);">
        <div class="overlay"></div>
        <h1><?php 
        _e( get_post_meta(get_the_ID(), '_type-chambre', true), 'artemise');
        echo ' ';
        the_title(); 
        ?></h1>
        <span class="detail-header"><?php getPriceRange(); ?> </span>
        
    </header>
    
    <section class="sec-chambre" style="display: none ">
        <div class="row">
            <div class="col-lg-6 chambre-icon-set"> <!--  left column-->
                <div class="row"> 
                    <div><i class="fa fa-bed fa-2x"></i><?php _e('Lit Double', 'artemise'); ?> 2x2m</div>
                    <div><i class="fa fa-users fa-2x "></i>2 <?php _e('Personnes', 'artemise'); ?></div>
                </div >
                <div class="row">
                    <div><i class="fa fa-arrows-alt fa-2x"></i> <?php echo get_post_meta(get_the_ID(), '_surface-chambre', true) ?>M&sup2;  </div>    
                    <div><i class="fontcustom icon-safe"></i><?php _e('coffre fort', 'artemise'); ?>  </div>    
                </div>
                <div class="row">
                    <div><i class="fontcustom icon-shower"></i><?php _e('Douche et Bain', 'artemise'); ?> </div>    
                    <div><i class="fontcustom icon-sofa"></i><?php _e('coin salon', 'artemise'); ?></div>    
                </div>
                <div class="row">
                    <div><i class="fontcustom icon-screen"></i><?php _e('Ecran plat', 'artemise'); ?> </div>    
                    <div><i class="fontcustom icon-fan"></i><?php _e('Clim', 'artemise'); ?></div>    
                </div>
                <span><?php the_content(); ?></span>
            </div>
            <div class="col-lg-6" ><!--  right column-->
                <div class="col-lg-12" ><!--  photo -->
                    <?= getGallery('chambre');?>
                    
                    
                    
                    
                </div>
                <div class="col-lg-12 price-info" ><!--  price&info -->
                    <div class="col-lg-7 sec-prix">
                        <div class="">
                            <h3><?php getPriceRange(); ?>
                            </h3>
                        </div>
                        <div class="btn-grp-offres-resp" role="group" >
                       
                        <a target="_blank"  href="<?=  getBookingUrl();?>" class="btn-resa"><?php _e('Reserver', 'artemise'); ?></a>
                        
                        <?=getVisite360('chambre'); ?>
                       
		</div>
                        
                    </div>
                    <div class="col-lg-5 sec-info" >
                        
                        <span class="cgv"><a href="<?=get_permalink( $cgv[$l]); ?>"><?php _e('Conditions Generales de Vente', 'artemise'); ?></a></span>
                        <div class="social-icon-set">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $getCurrentArtemisePage  ?>"><i class="fa fa-facebook-official fa-2x"></i></a>
                            <a href="https://twitter.com/share?url=<?=  $getCurrentArtemisePage  ?>&text=<?= bloginfo('description');?>"><i class="fa fa-twitter-square fa-2x"></i></a>
                            <a href="https://plus.google.com/share?url=<?=  $getCurrentArtemisePage  ?>"><i class="fa fa-google-plus-square fa-2x"></i></a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    
</article>


