<?php get_header(); ?>
<div class="main-section activities-section" aria-labelledby="main-section__title activities-section__title">
	<?php if( have_posts() ): while( have_posts() ): the_post(); $the_artist_id = get_field('artistes')['0']->ID; ?>
        <article class="main-section__post activities-section__post" aria-labelledby="main-section__post__title activities-section__post__title">
            <h1 class="main-section__post__title activities-section__post__title" id="main-section__post__title activities-section__post__title" role="heading" aria-level="1">
                <?php the_title(); ?>
            </h1>
            <?php $img_320 =  get_field('thumbnail'); ?>
            <img
                    class="main-section__post__thumbnail activities-section__post__thumbnail"
                    src="<?php echo $img_320['sizes']['320_prev']; ?>"
                    width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                    height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                    alt="<?php echo $img_320['alt']; ?>"
            >
            <ul class="main-section__post__info-list activities-section__post__info-list">
                <?php foreach(get_field('quand') as $item): ?>
                    <li class="main-section__post__info-list__info activities-section__post__info-list__info  activities-section__post__info-list__date">
                        <time class="activities-section__post__info-list__date__day" datetime="<?php echo $item['date']; ?>"><?php ec_the_human_date_from_html_date( $item['date']); ?></time><span class="activities-section__post__info-list__date__time"> de <time class="activities-section__post__info-list__date__time__from" datetime="<?php echo $item['heure_de_debut']; ?>"><?php echo $item['heure_de_debut']; ?></time> à <time class="activities-section__post__info-list__date__time__to" datetime="<?php echo $item['heure_de_fin']; ?>"><?php echo $item['heure_de_fin']; ?></time></span>
                    </li>
                <?php endforeach; ?>
                <li class="main-section__post__info-list__info activities-section__post__info-list__info activities-section__post__info-list__place">
                    <span><?= $term_list = wp_get_post_terms($the_artist_id, 'places')[0]->name; ?></span>
                </li>
                <?php $term_list = wp_get_post_terms($the_artist_id, 'cat'); if ( count( $term_list ) > 0 ): ?>
                    <li class="main-section__post__info-list__info main-section__post__info-list__terms activities-section__post__info-list__info activities-section__post__info-list__terms"><!--
                    <?php if ( count( $term_list ) > 1 ): ?>
                        <?php for( $i = 0; $i < count( $term_list ); $i++ ): ?>
                            --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term activities-section__post__info-list__info__term activities-section__post__info-list__terms__term"><?php echo ($i == 0 ? $term_list[$i]->name : ', '.$term_list[$i]->name); ?></span><!--
                        <?php endfor; ?>
                    <?php else: ?>
                        --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term activities-section__post__info-list__info__term activities-section__post__info-list__terms__term"><?php echo $term_list[0]->name; ?></span><!--
                    <?php endif; ?>
                    --></li>
                <?php endif; ?>
            </ul>
            <div class="main-section__post__presentation activities-section__post__presentation">
                <?= get_field( 'presentation') ?>
            </div>
            <ul class="main-section__post__artists-list activities-section__post__artists-list">
	            <?php foreach(get_field('artistes') as $item): ?>
                    <li class="main-section__post__artists-list__artist activities-section__post__artists-list__artist">
                        <a href="<?= get_permalink($item->ID) ?>"><?= get_post($item->ID)->post_title ?></a>
                    </li>
	            <?php endforeach; ?>
            </ul>

        </article>
	<?php endwhile; endif; ?>
</div>
















<?php get_footer(); ?>
