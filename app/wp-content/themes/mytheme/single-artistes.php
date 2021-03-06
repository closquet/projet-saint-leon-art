<?php get_header(); ?>

<h1 class="current-page-title" role="heading" aria-level="1">
        <span>
            <?php the_title(); ?>
        </span>
</h1>
<div class="content">
    <div class="main-section current-post-section current-artist-section">
        <div class="main-section__posts-container current-post-section__posts-container">
            <div class="current-post-container container current-artist-container">
				<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
                    <article class="main-section__post current-section__post current-artist-section__post" aria-labelledby="current-artist-section__title">
                        <?php $img_740 =  get_field('thumbnail'); ?>
                        <?php if ($img_740): ?>
                            <img
                                    class="main-section__post__thumbnail current-section__post__thumbnail current-artist-section__post__thumbnail"
                                    src="<?php echo $img_740['sizes']['740_prev']; ?>"
                                    width="<?php echo $img_740['sizes']['740_prev-width']; ?>"
                                    height="<?php echo $img_740['sizes']['740_prev-height']; ?>"
                                    alt="<?php echo ($img_740['alt']??''); ?>"
                            >
                        <?php endif; ?>
                        <ul class="main-section__post__info-list current-section__post__info-list">
                            <?php
                            $main_post_id = $post->ID;
                            $main_post_cat_terms_list = ec_get_terms_for_current_artist($main_post_id, 'cat');
                            $main_post_places_terms_list = ec_get_terms_for_current_artist($main_post_id, 'places');
                            ?>
                            <?php if ( count( $main_post_places_terms_list ) > 0 ): ?>
                                <li class="main-section__post__info-list__info current-post-section__post__info-list__info">
                                    <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="main-section__post__info-list__place-icon">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                    </svg><!--
                                    <?php if ( count( $main_post_places_terms_list ) > 1 ): ?>
                                        <?php for( $i = 0; $i < count( $main_post_places_terms_list ); $i++ ): ?>
                                            --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term current-artist-section__post__info-list__info__term current-artist-section__post__info-list__terms__term"><?php echo ($i == 0 ? $main_post_places_terms_list[$i] : ', '.$main_post_places_terms_list[$i]); ?></span><!--
                                        <?php endfor; ?>
                                    <?php else: ?>
                                        --><span class="main-section__post__info-list__info__term "><?= $main_post_places_terms_list[0] ; ?></span><!--
                                    <?php endif; ?>
                                    --></li>
                            <?php endif; ?>
                            <?php if ( count( $main_post_cat_terms_list ) > 0 ): ?>
                                <li class="main-section__post__info-list__info">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__cat-icon">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                        <line x1="7" y1="7" x2="7" y2="7"></line>
                                    </svg><!--
                                     --><span class="main-section__post__info-list__info__term-container current-post-section__post__info-list__info__term-container"><!--
                                            <?php if ( count( $main_post_cat_terms_list ) > 1 ): ?>
                                                <?php for( $i = 0; $i < count( $main_post_cat_terms_list ); $i++ ): ?>
                                                --><span class="main-section__post__info-list__info__term"><?php echo ($i == 0 ? $main_post_cat_terms_list[$i] : ', '.$main_post_cat_terms_list[$i]); ?></span><!--
                                                <?php endfor; ?>
                                            <?php else: ?>
                                             --><span class="main-section__post__info-list__info__term"><?php echo $main_post_cat_terms_list[0]; ?></span><!--
                                            <?php endif; ?>
                                     --></span><!--
                                 --></li>
                            <?php endif; ?>
                            <?php if (get_field( 'email')): ?>
                                <li class="main-section__post__info-list__info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__email-icon">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg><!--
                                    --><a class="link" href="mailto:<?= get_field( 'email') ?>"><?= get_field( 'email') ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (get_field( 'presentation')): ?>
                                <li class="main-section__post__info-list__info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__phone-icon">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg><!--
                                    --><a class="link" href="tel:<?= get_field( 'telephone') ?>"><?= get_field( 'telephone') ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
	                    <?php if (get_field( 'presentation')): ?>
                            <div class="main-section__post__presentation">
                                <?= get_field( 'presentation') ?>
                            </div>
	                    <?php endif; ?>
                        <?php if( have_rows('exemples_oeuvres') ): $current_row = 0; ?>
                            <h2 class="current-post-section__sub-title" role="heading" aria-level="2">
                                Quelques-unes de ses réalisations
                            </h2>
                            <div class="current-artist-section__post__works">
                                    <?php while(have_rows( 'exemples_oeuvres')): the_row(); $current_row++ ?>
                                        <?php if($current_row === 1): ?>
                                            <div class="current-artist-section__post__works__images-top-container">
                                        <?php endif; ?>
                                        <?php $img =  get_sub_field('image_oeuvre'); ?>
                                            <img
                                                class="current-artist-section__post__works__image<?= ' current-artist-section__post__works__image--' . $current_row?>"
                                                src="<?= $img['sizes']['320_prev']; ?>"
                                                width="<?= $img['sizes']['320_prev-width']; ?>"
                                                height="<?= $img['sizes']['320_prev-height']; ?>"
                                                alt="<?= ($img['alt']??'') ?>"
                                            >
                                        <?php if($current_row === 2): ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>

    <section class="main-section artists-section" aria-labelledby="artists-section__title">
        <h2 class="main-section__title artists-section__title" id="artists-section__title" role="heading" aria-level="2">
                <span>
                    Dans la même catégorie
                </span>
        </h2>
		<?php
		$items = new WP_Query();
		$items = ec_get_artists_from_terms($main_post_cat_terms_list, 'cat', $main_post_id);
		?>
        <div class="main-section__posts-container container">
			<?php if( $items->have_posts() ): while( $items->have_posts() ): $items->the_post(); ?>
                <a class="main-section__permalink artists-section__permalink" href="<?php the_permalink(); ?>">
                    <article class="main-section__post artists-section__post" aria-labelledby="artists-section__post__title">
                        <div class="main-section__post__top">
							<?php $img_320 =  get_field('thumbnail'); ?>
                            <div class="main-section__post__title-container<?= !($img_320)? ' no-image' : '' ?>">
                                <h3 class="main-section__post__title artists-section__post__title" id="artists-section__post__title" role="heading" aria-level="3">
									<?php the_title(); ?>
                                </h3>
                            </div>
							<?php if ($img_320): ?>
                                <img
                                        class="main-section__post__thumbnail artists-section__post__thumbnail"
                                        src="<?php echo $img_320['sizes']['320_prev']; ?>"
                                        width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                                        height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                                        alt="<?php echo ($img_320['alt']??'') ?>"
                                >
							<?php endif; ?>
                        </div>
                        <ul class="main-section__post__info-list artists-section__post__info-list">
							<?php
							$places_terms_list = ec_get_terms_for_current_activity('places', $post);
							$cat_terms_list = ec_get_terms_for_current_activity('cat', $post);
							?>
							<?php if ( count( $places_terms_list ) > 0 ): ?>
                                <li class="main-section__post__info-list__info
                                    main-section__post__info-list__terms
                                    artists-section__post__info-list__info
                                    artists-section__post__info-list__terms">
                                    <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="main-section__post__info-list__place-icon">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                    </svg><!--
                            <?php if ( count( $places_terms_list ) > 1 ): ?>
                                <?php for( $i = 0; $i < count( $places_terms_list ); $i++ ): ?>
                                    --><span class="main-section__post__info-list__info__term
                                                main-section__post__info-list__terms__term
                                                artists-section__post__info-list__info__term
                                                artists-section__post__info-list__terms__term"><?= ($i == 0 ? $places_terms_list[$i] : ', ' . $places_terms_list[$i]) ?></span><!--
                                <?php endfor; ?>
                            <?php else: ?>
                                --><span class="main-section__post__info-list__info__term
                                            main-section__post__info-list__terms__term
                                            artists-section__post__info-list__info__term
                                            artists-section__post__info-list__terms__term"><?= $places_terms_list[0] ?></span><!--
	                        <?php endif; ?>
                            --></li>
							<?php endif; ?>
							
							<?php if ( count( $cat_terms_list ) > 0 ): ?>
                                <li class="main-section__post__info-list__info
                                    main-section__post__info-list__terms
                                    main-section__post__info-list__cat-terms
                                    artists-section__post__info-list__info
                                    artists-section__post__info-list__terms">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__cat-icon">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                        <line x1="7" y1="7" x2="7" y2="7"/>
                                    </svg><!--
                                --><span class="main-section__post__info-list__info__term-container"><!--
                            <?php if ( count( $cat_terms_list ) > 1 ): ?>
                                <?php for( $i = 0; $i < count( $cat_terms_list ); $i++ ): ?>
                                    --><span class="main-section__post__info-list__info__term
                                                main-section__post__info-list__terms__term
                                                artists-section__post__info-list__info__term
                                                artists-section__post__info-list__terms__term"><?= ($i == 0 ? $cat_terms_list[$i] : ', ' . $cat_terms_list[$i]) ?></span><!--
                                <?php endfor; ?>
                            <?php else: ?>
                                --><span class="main-section__post__info-list__info__term
                                            main-section__post__info-list__terms__term
                                            artists-section__post__info-list__info__term
                                            artists-section__post__info-list__terms__term"><?= $cat_terms_list[0] ?></span><!--
                            <?php endif; ?>
                            --></span><!--
                        --></li>
							<?php endif; ?>
                        </ul>
                    </article>
                </a>
			<?php endwhile; else: ?>
                <p>
                    Il n&rsquo;y a pas encore d&rsquo;articles pour cette section.
                </p>
			<?php endif; ?>
        </div>

        <div class="btn1-container artists-section__all-posts-page-link-container main-section__all-posts-page-link-container">
            <a class="btn1 main-section__all-posts-page-link artists-section__all-posts-page-link" href="<?php echo get_page_link(17); ?>">
                Tous les artistes
            </a>
        </div>
    </section>
</div>

<?php get_footer(); ?>
