<?php
// creation du post-type chambres
add_action( 'init', 'artemise_chambre_type' );
function artemise_chambre_type() {
    
    
    	$labels = array(
		'name'               =>  'chambres' ,
		'singular_name'      =>  'chambre' ,
		'menu_name'          =>  'chambres',
		'name_admin_bar'     =>  'chambre',
		'add_new'            =>  'creer chambre',
		'add_new_item'       =>  'Creer une chambre',
		'new_item'           =>  'nouvelle chambre', 
		'edit_item'          =>  'Edit chambre',
		'view_item'          =>  'View chambre',
		'all_items'          =>  'All chambre',
		'search_items'       =>  'Search chambre',
		'parent_item_colon'  =>  'Parent chambre:',
		'not_found'          =>  'No chambre found.',
		'not_found_in_trash' =>  'No chambre found in Trash.', 
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
                'show_in_nav_menus'  => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'chambre' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail',  'comments' )
	);
    
    
    
    
  register_post_type( 'chambres', $args);
}





add_action( 'add_meta_boxes', 'artemise_meta_boxes_chambre' );

// add meta boxes - customs fields to post type chambre
function artemise_meta_boxes_chambre(){
    $screens = array( 'post', 'chambres' );
    
    add_meta_box('prix-chambre', 'Prix de la Chambre', 'artemise_displ_html_prix', 'chambres', 'normal', 'high'  );
    add_meta_box('prix-bas-chambre', 'Prix bas de la Chambre', 'artemise_displ_html_prix_bas', 'chambres', 'normal', 'high'  );
    add_meta_box('surface-chambre', 'Surface de la Chambre', 'artemise_displ_html_surface', 'chambres', 'normal'  );
    add_meta_box('slider-chambre', 'Slider de la Chambre', 'artemise_displ_html_gallery', 'chambres', 'normal'  );
    add_meta_box('visite-chambre', 'Visite360 de la Chambre', 'artemise_displ_html_visite', 'chambres', 'normal'  );
    add_meta_box('id-chambre', 'Id de la Chambre', 'artemise_displ_html_id_chambre', 'chambres', 'normal', 'high'  );
    add_meta_box('type-chambre', 'type d\hebergement', 'artemise_displ_html_type_chambre', 'chambres', 'side' );
    
}



// display html code pour le label 
function artemise_displ_html_type_chambre(){
    global $post;
    $prix = get_post_meta($post->ID, '_type-chambre', true);
    
    ?>
    <label for="_type-chambre" >type d'hebergement</label><br/>
<select name = "_type-chambre">
    <option value="chambre" <?= $prix=="chambre"? 'selected':''?>>chambre</option>
    <option value="suite" <?= $prix=="suite"? 'selected':''?> >suite</option>
</select>
    <?php
    
}
function artemise_displ_html_visite(){
    global $post;
    $prix = get_post_meta($post->ID, '_visite-chambre', true);
    
    echo '<label for="_visite-chambre" >Url HD Media de la visite</label><br/>';
    echo '<input type="text"   style="width:100%" name="_visite-chambre" value="'.$prix.'" />';
}
function artemise_displ_html_prix(){
    global $post;
    $prix = get_post_meta($post->ID, '_prix-chambre', true);
    
    echo '<label for="_prix-chambre" >Prix chambre</label><br/>';
    echo '<input type="text" name="_prix-chambre" value="'.$prix.'" /> &euro; / nuit';
}
function artemise_displ_html_prix_bas(){
    global $post;
    $prix = get_post_meta($post->ID, '_prix-bas-chambre', true);
    
    echo '<label for="_prix-bas-chambre" >Prix bas chambre</label><br/>';
    echo '<input type="text" name="_prix-bas-chambre" value="'.$prix.'" /> &euro; / nuit';
}
function artemise_displ_html_id_chambre(){
    global $post;
    $prix = get_post_meta($post->ID, '_id-chambre', true);
    
    echo '<label for="_id-chambre" >Reservation SuperBooking</label><br/>';
    echo '<input type="text" name="_id-chambre" value="'.$prix.'" />';
}

function artemise_displ_html_surface(){
    global $post;
    $surface = get_post_meta($post->ID, '_surface-chambre', true);
    
    echo '<label for="_surface-chambre" >Surface chambre</label><br/>';
    echo '<input type="text" name="_surface-chambre" value="'.$surface.'" /> &sup2;';
}
function artemise_displ_html_gallery(){
    global $post;
    $surface = get_post_meta($post->ID, '_gallery-chambre', true);
    
    echo '<label for="_gallery-chambre" >Gallerie chambre</label>'
    . '<p> entrer le short-code du slider directement <br/> si vide - l\'image a la une sera affiché</p>' ;
    echo '<input type="text" name="_gallery-chambre" value="'.$surface.'" />';
}


// Save the Metabox Data
function wpt_save_events_meta($post_id, $post) {
        // Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID )){
		return $post->ID;
        }
	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
        if(isset($_POST['_prix-chambre']) 
                && isset($_POST['_prix-bas-chambre']) 
                && isset($_POST['_type-chambre']) 
                && isset($_POST['_surface-chambre']) 
                && isset($_POST['_gallery-chambre'])
                && isset($_POST['_visite-chambre'])
                && isset($_POST['_id-chambre'])){
        
        
$chambre_meta['_type-chambre'] = $_POST['_type-chambre'];
$chambre_meta['_prix-chambre'] = $_POST['_prix-chambre'];
$chambre_meta['_prix-bas-chambre'] = $_POST['_prix-bas-chambre'];
$chambre_meta['_surface-chambre'] = $_POST['_surface-chambre'];
$chambre_meta['_gallery-chambre'] = $_POST['_gallery-chambre'];
$chambre_meta['_id-chambre'] = $_POST['_id-chambre'];
$chambre_meta['_visite-chambre'] = $_POST['_visite-chambre'];
	
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

add_action('save_post', 'wpt_save_events_meta', 1, 2); // save the custom fields



// creation du post-type evenement
add_action( 'init', 'evenement_type' );
function evenement_type() {
    
    
    	$labels = array(
		'name'               =>  'evenements' ,
		'singular_name'      =>  'evenement' ,
		'menu_name'          =>  'evenements',
		'name_admin_bar'     =>  'evenement',
		'add_new'            =>  'creer evenement',
		'add_new_item'       =>  'Creer un evenement',
		'new_item'           =>  'nouvel evenement', 
		'edit_item'          =>  'Edit evenement',
		'view_item'          =>  'View evenement',
		'all_items'          =>  'Tous les evenements',
		'search_items'       =>  'Rechercher evenement',
		'parent_item_colon'  =>  'Parent evenement:',
		'not_found'          =>  'Pas d\'evenement.',
		'not_found_in_trash' =>  'Pas d\'evenement dans la corbeille.', 
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
                'show_in_nav_menus'  => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'evenement' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail',  'comments' )
	);
    
    
    
    
  register_post_type( 'evenements', $args);
}


