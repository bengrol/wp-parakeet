<?php
// creation du post-type chambres
add_action( 'init', function () {
    
    
    	$labels = array(
		'name'               =>  'offres' ,
		'singular_name'      =>  'offre' ,
		'menu_name'          =>  'offres',
		'name_admin_bar'     =>  'offre',
		'add_new'            =>  'creer offre',
		'add_new_item'       =>  'Creer une offre',
		'new_item'           =>  'nouvelle offre', 
		'edit_item'          =>  'Editer offre',
		'view_item'          =>  'Voir offres',
		'all_items'          =>  'Toutes les offres',
		'search_items'       =>  'Cherchez offre',
		'parent_item_colon'  =>  'Parent offre:',
		'not_found'          =>  'Pas d\'offre trouvé',
		'not_found_in_trash' =>  'Pas d\'offre trouvé dans la poubelle.', 
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
                'show_in_nav_menus'  => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'offre' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' )
	);
    
    
    
    
  register_post_type( 'offres', $args);
} );





// creation des meta boxes
add_action('add_meta_boxes', function () {
  //  $screens = array('post', 'offres');
    global $post;
    
    add_meta_box('prix-offre', 'Prix de l\'offre',
            function () use($post){
                // display html code pour le label 
                $prix = get_post_meta($post->ID, '_prix-offre', true);

                echo '<label for="_prix-offre" >Prix offre</label><br/>';
                echo '<input type="number" name="_prix-offre" value="'.$prix.'" /> &euro; / nuit';
            }, 'offres', 'side', 'high');
    
    
    add_meta_box('gallery-offre', 'Gallerie photo de l\'offre',
            function () use($post){
                // display html code pour le label 
                $prix = get_post_meta($post->ID, '_gallery-offre', true);

                echo '<label for="_gallery-offre" >gallery offre</label><br/>';
                echo '<input type="text" name="_gallery-offre" value="'.$prix.'" /> - entrer le short-code directement';
            }, 'offres', 'normal', 'high');
    
    add_meta_box('id-offre', 'Id SupeBooking de l\'offre',
            function () use($post){
                // display html code pour le label 
                $prix = get_post_meta($post->ID, '_id-offre', true);

                echo '<label for="_id-offre" >id offre</label><br/>';
                echo '<input type="text" name="_id-offre" value="'.$prix.'" />';
            }, 'offres', 'side', 'high');
    
    
}
);



//// Save the Metabox Data
function artemise_save_offres_meta($post_id, $post) {
        // Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID )){
		return $post->ID;
        }
	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
        if(isset($_POST['_prix-offre']) 
               && isset($_POST['_gallery-offre']) 
                && isset($_POST['_id-offre'])){
        
        
$chambre_meta['_prix-offre'] = $_POST['_prix-offre'];
$chambre_meta['_gallery-offre'] = $_POST['_gallery-offre'];
$chambre_meta['_id-offre'] = $_POST['_id-offre'];

	
	// Add values of $events_meta as custom fields
        foreach ($chambre_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			 update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

        } 

}

add_action('save_post', 'artemise_save_offres_meta', 1, 2); // save the custom fields

