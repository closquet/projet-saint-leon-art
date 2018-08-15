<?php
/*
Plugin Name: Mailhog SMTP
Version: 1.0
License: GPL2
*/
function mailhog_phpmailer_smtp( $phpmailer ) {
	$phpmailer->Host = 'mailhog';
	$phpmailer->Port = 1025;
	$phpmailer->IsSMTP();
}
add_action( 'phpmailer_init', 'mailhog_phpmailer_smtp' );

/*
 * Allow .SVG file
 */
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//add favicon to admin
add_action('admin_head', 'show_favicon');
function show_favicon() {
	echo '<link href="/wp-content/themes/mytheme/assets/../favicon.png" rel="icon" type="image/x-icon">';
}

// filter for acf sub field (repeater) query for activities'dates
function my_activities_dates( $where ) {
	
	$where = str_replace("meta_key = 'quand_$", "meta_key LIKE 'quand_%", $where);
	
	return $where;
}
add_filter('posts_where', 'my_activities_dates');




/*
* Create own thumbnails++
*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	// additional image sizes
	add_image_size( 'logo', 150, 150, false );
	
	add_image_size( 'avatar', 150, 150, true );
	
	add_image_size( '320_prev', 320, 187, true );
	
	add_image_size( '740_prev', 740, 432, true );
	
	add_image_size( '740_prev_banner', 740, 215, true );
	
	add_image_size( '1366_prev', 1366, 798, true );
}



/**
 * custom UI admin
 */
add_action( 'admin_menu', 'remove_links_tab_menu_pages' );
function remove_links_tab_menu_pages() {
	remove_menu_page('index.php'); //tableau de board (dashboard)
	//add_filter('acf/settings/show_admin', '__return_false');
}
function remove_menus () {
	global $menu;
	$restricted = array(__('Dashboard'),
		__('Posts'),
// __('Media'),
// __('Links'),
// __('Pages'),
// __('Appearance'),
// __('Tools'),
// __('Users'),
// __('Settings'),
		__('Comments'),
// __('Plugins')
	);    end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');
function remove_menu_items(){
	remove_menu_page( 'themes.php' );
	remove_submenu_page( 'options-general.php','options-permalink.php' ); // just show this page destroy pagination and need reset previous DB state
	remove_submenu_page( 'options-general.php','options-reading.php' ); // edit the content make bug in pagination
}
add_action( 'admin_menu', 'remove_menu_items', 999 );



/**
 * Register custom post types on INIT event
 */

add_action('init','ec_init_types');
function ec_init_types()
{
	
	register_post_type('artistes', [
		'label' => 'Artistes',
		'labels' => [
			'singular_name' => 'artiste',
			'add_new' => 'Ajouter un artiste',
			'all_items' => 'Tous les artistes'
		],
		'description' => 'Type d\'article permettant d\'ajouter des artistes à la section artistes du site.',
		'public' => true,
		'capability_type' => 'post',
		'supports' => [
			'title',
			'editor',
			'thumbnail',
			'excerpt'
		]
	]);
	
	register_post_type('activites', [
		'label' => 'Activités',
		'labels' => [
			'singular_name' => 'activité',
			'add_new' => 'Ajouter une activité',
			'all_items' => 'Toutes les activités'
		],
		'description' => 'Type d\'article permettant d\'ajouter des activités à la section activités du site.',
		'public' => true,
		'capability_type' => 'post',
		'supports' => [
			'title',
			'editor',
			'thumbnail',
			'excerpt'
		]
	]);
	
	register_taxonomy('cat', [ 'artistes'], [
		'label' => 'Types d\'oeuvre',
		'labels' => [
			'singular_name' => 'type d\'oeuvre',
			'edit_item' => 'Éditer le type',
			'add_new_item' => 'Ajouter un nouveau type'
		],
		'description' => 'Type d\'oeuvres aux quelles appartiennent les activités et artistes.',
		'public' => true,
		'hierarchical' => true
	]);
	
	register_taxonomy('places', [ 'artistes'], [
		'label' => 'Endroits',
		'labels' => [
			'singular_name' => 'endroit',
			'edit_item' => 'Éditer l\'endroit',
			'add_new_item' => 'Ajouter un nouvel endroit'
		],
		'description' => 'Endroits où se produisent les artistes.',
		'public' => true,
		'hierarchical' => true
	]);
	
	
	
}

/*
 * Return the terms taxonomy for current post (in the loop)
 */
function ec_get_the_terms($glue = '', $prefix = '', $suffix = '', $taxo)
{
	$terms = wp_get_post_terms(get_the_ID(), $taxo, ['orderby' => 'name', 'order' => 'ASC', 'fields' => 'all']);
	
	if(!$terms) return '';
	
	return implode($glue,
		array_map(
			function($term) use ($prefix, $suffix){
				return str_replace(':type', get_term_meta($term->term_id)['type'][0], $prefix) . $term->name . $suffix;
			},
			$terms)
	);
}

/*
 * Output the terms taxonomy for current post (in the loop)
 */
function ec_the_terms($glue = '', $prefix = '', $suffix = '', $taxo)
{
	echo ec_get_the_terms($glue, $prefix, $suffix, $taxo);
}




/*
 * Register navigation menu
 */
register_nav_menus([
	'header'=>'Menu du header.',
	'footer'=>'Liens du footer.'
]);

/*
 * Get menu items
 */
function ec_get_nav_items($location)
{
	$id = ec_get_nav_id($location);
	if(!$id) return [];
	$nav = [];
	$children = [];
	foreach (wp_get_nav_menu_items($id) as $object) {
		$item = new stdClass();
		$item->link = $object->url;
		$item->label = $object->title;
		$item->children = [];
		
		if($object->menu_item_parent) {
			$item->parent = $object->menu_item_parent;
			$children[] = $item;
		}
		else {
			$nav[$object->ID] = $item;
		}
	}
	foreach ($children as $item) {
		$nav[$item->parent]->children[] = $item;
	}
	return $nav;
}

/*
 * Get menu ID from location
*/
function ec_get_nav_id($location)
{
	foreach (get_nav_menu_locations() as $navLocation => $id) {
		if($navLocation == $location) return $id;
	}
	return false;
}

/*
 * Get theme asset URI (pour avoir un bon chemin url pour les fichiers css/js)
*/
function ec_get_uri_asset($resource){
	return get_template_directory_uri() . '/assets/' . trim($resource, '/'); //trim, enlève le second éléments (le /) de la string du premier élément ($resouce) au début et à la fin.
}

/*
 * Output theme asset URI
 */
function ec_asset($resource){
	echo ec_get_uri_asset($resource);
}

/**
 *  Get a customizable excerpt
 */
function ec_get_the_excerpt($length = null)
{
	$excerpt_tmp = get_the_excerpt();
	if(is_null($length) || strlen($excerpt_tmp) <= $length) return $excerpt_tmp;
	$excerpt_tmp = substr( $excerpt_tmp, 0, $length);
	$excerpt_tmp_array = explode( ' ', $excerpt_tmp);
	unset( $excerpt_tmp_array[count( $excerpt_tmp_array) - 1]);
	$excerpt = implode( ' ', $excerpt_tmp_array);
	return trim( $excerpt ) . '&hellip;';
}

/**
 *  Output a customizable excerpt
 */
function ec_the_excerpt($length = null)
{
	echo ec_get_the_excerpt($length);
}

/*
 * return a converted  date format from aaaa-mm-jj to jj/mm/aaaa
 */
function ec_get_human_date_from_html_date($html_date_format, $new_delimiter = '/'){
	$mydate = explode( '-', $html_date_format);
	$mydate = $mydate[2].$new_delimiter.$mydate[1].$new_delimiter.$mydate[0];
	return $mydate;
}

/*
 * Output a converted  date format from jj/mm/aaa to jj-mm-aaaa
 */
function ec_the_human_date_from_html_date($html_date_format, $new_delimiter = '/'){
	echo ec_get_human_date_from_html_date($html_date_format, $new_delimiter);
}

/*
 * get the cta stlyle and create a <style> html tag
 */
function ec_get_the_cta_style(int $post_id, string $class_name, string $uri, string $field_name){
	
	if ( $_SERVER['REQUEST_URI'] == $uri || $uri ==='all'){
		return '
			
				' . $class_name . '{
					background-image:url( ' . get_field( $field_name, $post_id )['sizes']['1366_prev'] . ');
					background-repeat: no-repeat;
					background-position: center;
					background-size: cover;
				}
				@media (max-width: 740px) {
					' . $class_name . '{
						background-image:url( ' . get_field( $field_name, $post_id)['sizes']['740_prev'] . ');
					}
				}
				@media (max-width: 320px) {
					' . $class_name . '{
						background-image:url( ' . get_field( $field_name, $post_id)['sizes']['320_prev'] . ');
					}
				}
			';
	}
}
/*
 * output the cta stlyle and create a <style> html tag
 */
function ec_the_cta_style(int $post_id, string $class_name, string $uri, string $field_name){
	echo ec_get_the_cta_style($post_id, $class_name, $uri, $field_name);
}

function ec_get_instagram_feed()
{
	$auth_config = [
		'user_id'             => '1372181382',
		'token'             => '1372181382.043edd4.d01f98d404e8499eb21983bd7d554b01',
		'limit'             => '4',
		//'scope'             => array( 'likes', 'comments', 'relationships' )
	];
	
	$recent_media_url = sprintf( 'https://api.instagram.com/v1/users/%s/media/recent/?access_token=%s&count=%s', $auth_config['user_id'], $auth_config['token'], $auth_config['limit'] );
	$curl = curl_init($recent_media_url);
	curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false);
	$curl_return = json_decode( curl_exec( $curl) );
	
	//var_dump( $data);
	if(curl_errno($curl)){
		echo '<script>console.error(\'backend error -> Instagram API : ' . curl_error($curl) . '\')</script>';
	}elseif (isset($curl_return->meta->error_message)){
		echo '<script>console.error(\'backend error -> Instagram API : ' . $curl_return->meta->error_message . '\')</script>';
	}else{
		return $curl_return->data;
	}
	return false;
}


/*
 * get activities that have same (artist's) terms of chosen terms.
 */
function ec_get_activities_from_terms($terms_list, $taxonomy, $post_not_in = [])
{
	//find artist(s) with same terms of "cat" taxonomy
	$artists_list_for_query = new WP_Query();
	$artists_list_for_query -> query([
		'post_type' => 'artistes',
		'tax_query' => [
			[
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $terms_list??'',
			]
		],
	]);
	if (!$artists_list_for_query->have_posts()){
		return new wp_query();
	}
	
	//get only the IDs of the artists previously found
	$artist_id_list = [];
	foreach ($artists_list_for_query->posts as $artist){
		$artist_id_list[] = '"' . $artist->ID . '"';
	}
	
	//build meta query to have a dynamic array of what we search
	$meta_query = ['relation' => 'OR'];
	foreach ($artist_id_list as $value) {
		$meta_query[] = [
			'key'       => 'artistes',
			'value'     => $value,
			'compare'   => 'LIKE',
		];
	}
	
	//build the arg for the get_posts instruction
	$arg = [
		'post_type' => 'activites',
		'post__not_in' => [$post_not_in],
		'showposts' => '3',
		'orderby' => 'rand',
		'meta_query' => $meta_query
	];
	
	return new wp_query($arg);
}

/*
 * get posts from filters.
 */
function ec_get_posts_from_filters($cat, $date, $place, $paged, $post_type)
{
	switch ($post_type){
		case 'activites':
			return ec_get_activities_from_filters($cat, $date, $place, $paged);
			break;
		case 'artistes':
			return ec_get_artists_from_filters($cat, $place, $date, $paged);
			break;
	}
	return new WP_Query();
}


/*
 * get artists from filters.
 */
function ec_get_artists_from_filters($cat, $place, $date, $paged)
{
	if($date){
		$activities_list_for_query = ec_get_activities_from_date($date);
		
		//get only the IDs of the activities artists previously found
		$artists_id_list_from_date = [];
		foreach ($activities_list_for_query->posts as $activities){
			$artists_id_list_from_date[] = get_field( 'artistes', $activities->ID)[0];
		}
		
		if(!$artists_id_list_from_date){
			return new WP_Query();
		}
	}
	
	$arg = [
		'post_type' => 'artistes',
	];
	$paged && ($arg['paged'] = $paged) && $arg['posts_per_page'] = 3;
	$date && $arg['post__in'] = $artists_id_list_from_date;
	$cat || $place && $arg['tax_query'][0]['relation'] = 'AND';
	$cat && $arg['tax_query'][0][] = [
		'taxonomy' => 'cat',
		'field'    => 'slug',
		'terms'    => $cat,
	];
	$place && $arg['tax_query'][0][] = [
		'taxonomy' => 'places',
		'field'    => 'slug',
		'terms'    => $place,
	];
	return  new WP_Query($arg);
}

/*
 * get activities from date.
 */
function ec_get_activities_from_date($date)
{
	//add date filter to the query
	$date = str_replace( '-', '', $date);
	$date_filter[] = [
		'key'       => 'quand_$_date',
		'value'     => $date,
		'compare'   => 'LIKE',
	];
	
	//build the arg for the get_posts instruction
	$arg = [
		'post_type' => 'activites',
		'orderby' => 'date',
		'meta_query' => [
			$date_filter
		]
	];
	
	return new WP_Query($arg);
}


/*
 * get activities from filters.
 */
function ec_get_activities_from_filters($cat, $date, $place, $paged)
{
	if( $cat || $date || $place ){
		
		$artists_list_for_query = ec_get_artists_from_filters($cat, $place, null, null);
		
		//get only the IDs of the artists previously found
		$artist_id_list = [];
		foreach ($artists_list_for_query->posts as $artist){
			$artist_id_list[] = '"' . $artist->ID . '"';
		}
		
		if(!$artist_id_list){
			return new WP_Query();
		}
		
		//build meta query to have a dynamic array of what we search for the CAT filter
		$cat_and_place_filter = ['relation' => 'OR'];
		foreach ($artist_id_list as $value) {
			$cat_and_place_filter[] = [
				'key'       => 'artistes',
				'value'     => $value,
				'compare'   => 'LIKE',
			];
		}
		
		//add date filter to the query
		$date = str_replace( '-', '', $date);
		$date_filter[] = ['relation' => 'AND'];
		$date_filter[] = [
			'key'       => 'quand_$_date',
			'value'     => $date,
			'compare'   => 'LIKE',
		];
		
		//build the arg for the get_posts instruction
		$arg = [
			'post_type' => 'activites',
			'orderby' => 'date',
			'posts_per_page' => 3,
			'paged' => $paged,
			'meta_query' => [
				$cat_and_place_filter,
				$date_filter
			]
		];
	}else{
		$arg = [
			'post_type' => 'activites',
			'orderby' => 'date',
			'posts_per_page' => 3,
			'paged' => $paged,
		];
	}
	return new WP_Query($arg);
}


/*
 * get artists that have same terms of chosen terms.
 */
function ec_get_artists_from_terms($terms_list, $taxonomy, $post_not_in)
{
	//find artist(s) with same terms of "cat" taxonomy
	$artists_list = new WP_Query();
	$artists_list -> query([
		'post_type' => 'artistes',
		'post__not_in' => [$post_not_in],
		'showposts' => '3',
		'orderby' => 'rand',
		'tax_query' => [
			[
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $terms_list??'',
			]
		],
	]);
	return $artists_list;
}


/*
 * get terms for current activity from a taxonomy

 */
function ec_get_terms_for_current_activity($taxonomy, $artist = null)
{
	if(!$artist){
		$artists_list = get_field('artistes', get_the_ID());
	}else{
		$artists_list = $artist;
	}
	$terms_list = [];
	foreach ($artists_list as $an_artist){
		foreach (wp_get_post_terms($an_artist, $taxonomy) as $a_term){
			!in_array( $a_term->name, $terms_list) && $terms_list[] =  $a_term->name;
		}
	}
	return $terms_list;
}


/*
 * get terms for current artist from a taxonomy

 */
function ec_get_terms_for_current_artist($post_id, $taxonomy)
{
	$terms_list = [];
	foreach (wp_get_post_terms($post_id, $taxonomy) as $a_term){
		!in_array( $a_term->name, $terms_list) && $terms_list[] =  $a_term->name;
	}
	return $terms_list;
}

/*
 * Get dates of the current activity
 */
function ec_get_current_activity_dates(){
	$dates_list = [];
	foreach ( get_field( 'quand' ) as $q ) {
		!in_array( $q['date'], $dates_list) && $dates_list[] =  $q['date'];
	}
	return $dates_list;
}


/*
 * get activities that have same (artist's) terms of chosen terms.
 */
function ec_get_activities_from_dates($dates_list, $post_not_in)
{
	
	//build meta query to have a dynamic array of what we search
	$meta_query = ['relation' => 'OR'];
	foreach ($dates_list as $value) {
		$meta_query[] = [
			'key'       => 'quand_%_date',
			'value'     => $value,
			'compare'   => 'LIKE',
		];
	}
	
	//build the arg for the get_posts instruction
	$arg = [
		'post_type' => 'activites',
		'post__not_in' => [$post_not_in],
		'showposts' => '3',
		'orderby' => 'rand',
		'meta_query' => $meta_query
	];
	
	return new wp_query($arg);
}


/*
 * little debug function to show the content of a variable with html <pre>
 */
function ec_show_var($var, bool $printr = null)
{
	echo '<pre style="position:absolute;z-index: 999999;background-color:#fff;padding: 2em;top: 50px;border: 2px red solid;">[<br>';
	$printr ? print_r($var . '<br>') : var_dump($var);
	echo ']</pre>';
}

/*
 *
 */
function ec_get_image_attr_from_acf_field(string $size_name, $img)
{
	$size = $size_name;
	$img_width = 'width="' . $img['sizes'][$size . '-width'] . '"';
	$img_height = 'height="' . $img['sizes'][$size . '-height'] . '"';
	$img_src = 'src="' . $img['sizes'][$size] . '"';
	$img_alt = 'alt="' . ($img['alt']??'') . '"';
	return $img_src . ' ' . $img_width . ' ' . $img_height . ' ' . $img_alt;
}