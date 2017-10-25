<?php
/*
* Create own thumbnails++
*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	// additional image sizes
	add_image_size( 'avatar', 150, 150, true );
	
	add_image_size( '320_prev', 320, 187, true );
	
	add_image_size( '740_prev', 740, 432, true );
	
	add_image_size( '1366_prev', 1366, 798, true );
}



/**
 * custom UI admin
 */
add_action( 'admin_menu', 'remove_links_tab_menu_pages' );
function remove_links_tab_menu_pages() {
	remove_menu_page('index.php'); //tableau de board (dashboard)
	add_filter('acf/settings/show_admin', '__return_false');
}
//function remove_acf_menu() {
//	remove_menu_page('edit.php?post_type=acf');
//}
add_action( 'admin_menu', 'remove_acf_menu', 999);
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
// __('Comments'),
// __('Plugins')
);    end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');



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
		'menu_position' => 4,
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
		'menu_position' => 5,
		'public' => true,
		'capability_type' => 'post',
		'supports' => [
			'title',
			'editor',
			'thumbnail',
			'excerpt'
		]
	]);
	
	
	register_taxonomy('cat', ['activites', 'artistes'], [
		'label' => 'Types d\'oeuvre',
		'labels' => [
			'singular_name' => 'type d\'oeuvre',
			'edit_item' => 'Éditer le type',
			'add_new_item' => 'Ajouter un nouveau type'
		],
		'description' => 'Type d\'oeuvre au quel appartiennent les activités et artistes.',
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
	'header'=>'Menu du header.'
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
 * fil d'ariane
 */
function ec_fildarian(){
	$def = "index";
	$dPath = strchr( $_SERVER['REQUEST_URI'], 'images') ? '/Galerie/' : $_SERVER['REQUEST_URI'];
	$dChunks = explode("/", $dPath);
	
	echo('<a class="link" href="/">Accueil</a><span class="arian-sep">  >  </span>');
	for($i=1; $i<count($dChunks)-1; $i++ ){
		echo('<a class="link" href="/');
		for($j=1; $j<=$i; $j++ ){
			echo($dChunks[$j]);
			if($j!=count($dChunks)-1){ echo("/");}
		}
		
		if($i==count($dChunks)-2){
			$prChunks = explode(".", $dChunks[$i]);
			if ($prChunks[0] == $def) $prChunks[0] = "";
			$prChunks[0] = ucfirst($prChunks[0]) . "</a>";
		}
		else $prChunks[0] = ucfirst($dChunks[$i]) . '</a><span class="dynNav">  >  </span>';
		echo('">');
		echo(str_replace("_" , " " , $prChunks[0]));
	}
}

/*
 * Get a converted  date format from jj/mm/aaa to jj-mm-aaaa
 */

function ec_get_html_date_field($field_name){
    $mydate = get_field($field_name);
    $mydate = str_replace( '/', '-', $mydate);
    return $mydate;
}

/*
 * Output a converted  date format from jj/mm/aaa to jj-mm-aaaa
 */

function ec_the_html_date_field($field_name){
	echo ec_get_html_date_field($field_name);
}