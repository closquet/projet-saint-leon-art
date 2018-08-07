<?php
/*
 * Template Name: Les Partenaire
 */
?>

<?php get_header(); ?>
<?php
$cat = null;
$date = null;
$place = null;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

isset($_REQUEST['cat']) && $_REQUEST['cat'] != '' && $cat = $_REQUEST['cat'];
isset($_REQUEST['date']) && $_REQUEST['date'] != '' && $date = $_REQUEST['date'];
isset($_REQUEST['place']) && $_REQUEST['place'] != '' && $place = $_REQUEST['place'];

$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = ec_get_posts_from_filters( $cat, $date, $place, $paged, 'artistes');
?>

<h1 class="current-page-title" role="heading" aria-level="1">
    <span>
        Les artistes (<?= $wp_query->found_posts ?>)
    </span>
</h1>
<div class="content">
    <div class="main-section main-section--alone-on-top">
        <div class="main-section__posts-container">
        
        </div>
    </div>
</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
