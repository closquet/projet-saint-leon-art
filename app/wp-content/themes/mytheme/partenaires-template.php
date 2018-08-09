<?php
/*
 * Template Name: Les Partenaire
 */
?>

<?php get_header(); ?>
<h1 class="current-page-title" role="heading" aria-level="1">
    <span>
        <?php the_title() ?>
    </span>
</h1>
<div class="content">
    <div class="main-section main-section--alone-on-top">
        <?php if(get_field('introduction')): ?>
            <div class="main-section__introduction container">
		        <?php the_field('introduction') ?>
            </div>
        <?php endif; ?>
	    <?php if(get_field('partners')): ?>
            <div class="main-section__partners-list container">
	            <?php while ( have_rows('partners') ) : the_row();?>
                    <a class="main-section__partners-list__partner" href="<?= get_sub_field('partner-url'); ?>" title="Se rendre sur le site web de&nbsp;: <?= get_sub_field('partner-name') ?>">
                        <?php
                            $size = 'logo';
                            $svg_width = 150;
                            $img = get_sub_field('partner-logo');
                            $img_width = $img['sizes'][$size . '-width'] > 1 ? 'width="' . $img['sizes'][$size . '-width'] . '"' : 'width="'. $svg_width .'"';
                            $img_height = $img['sizes'][$size . '-height'] > 1 ? 'height="' . $img['sizes'][$size . '-height'] . '"' : '';
                            $img_src = 'src="' . $img['sizes'][$size] . '"';
                        ?>
                        <img class="main-section__partners-list__partner-logo" <?= $img_src . ' ' . $img_width . ' ' . $img_height ?>>
                    </a>
	            <?php endwhile;?>
            </div>
	    <?php endif; ?>

     
    </div>
</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
