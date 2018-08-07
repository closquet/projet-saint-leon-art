<?php
/*
 * Template Name: À propos
 */
?>


<?php get_header(); ?>
<?php
$wp_query  = new WP_Query();
?>

<div class="content">
    <h1 class="current-page-title" role="heading" aria-level="1">
        <span>
            À propos
        </span>
    </h1>
    <div class="main-section current-post-section" aria-labelledby="activities-section__title">
        

        <div class="main-section__posts-container">
			<?= get_field('description') ?>
        </div>
        
		<?php if ( $wp_query->found_posts > 3 ):
			$paged == $wp_query->max_num_pages ? $next = false : $next = true;
			$paged == 1 ? $previous = false : $previous = true;
			?>
            <nav class="main-section__pagination">
				<?php if($previous): ?>
                    <a class="main-section__pagination__link previous btn1" href="/artistes/page/<?= $paged-1 . '/?' ?><?php echo 'place='.$place??''; echo '&cat='.$cat??''; echo '&date='.$date??''; ?>">Précédent</a>
				<?php else: ?>
                    <span class="main-section__pagination__link previous btn1 disable">Précédent</span>
				<?php endif; ?>
                <span class="main-section__pagination__current-page"><?= $paged ?></span>
				<?php if($next): ?>
                    <a class="main-section__pagination__link next btn1" href="/artistes/page/<?= $paged+1 . '/?' ?><?php echo 'place='.$place??''; echo '&cat='.$cat??''; echo '&date='.$date??''; ?>">Suivant</a>
				<?php else: ?>
                    <sapn class="main-section__pagination__link next btn1 disable">Suivant</sapn>
				<?php endif; ?>
            </nav>
		<?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
