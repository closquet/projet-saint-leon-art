<?php //setlocale(LC_ALL, 'fr_BE.utf8'); ?>
<?php get_header(); ?>
    <div class="intro">
        <ul class="intro__info-list">
            <li class="intro__info-list__item intro-cta__date"><?php the_field('date', 129); ?></li>
            <li class="intro__info-list__item intro-cta__place"><?php the_field('lieu', 129); ?></li>
        </ul>
        <p class="p-summary intro__teasing container">
            <?php the_field( 'presentation', 129); ?>
        </p>
        <div class="btn1-container cta__link-container">
            <a class="u-url btn1" href="/a-propos">
                En savoir plus
            </a>
        </div>
    </div>

    <div class="content">
        <section class="main-section activities-section" aria-labelledby="activities-section__title">
            <h2 class="main-section__title activities-section__title" id="activities-section__title" role="heading" aria-level="2">
                <span>
                    Activités
                </span>
            </h2>
			<?php
            $items = new WP_Query();
			$items->query([
				'post_type' => 'activites',
				'showposts' => '3',
				'orderby' => 'rand'
			]);
			?>
            <div class="main-section__posts-container container">
				<?php if( $items->have_posts() ): while( $items->have_posts() ): $items->the_post();?>
                    <a class="main-section__permalink activities-section__permalink" href="<?php the_permalink(); ?>">
                        <article class="main-section__post activities-section__post" aria-labelledby="activities-section__post__title">
                            <div class="main-section__post__top">
								<?php $img_320 =  get_field('thumbnail'); ?>
                                <div class="main-section__post__title-container<?= !($img_320)? ' no-image' : '' ?>">
                                    <h3 class="main-section__post__title activities-section__post__title" id="activities-section__post__title" role="heading" aria-level="3">
										<?php the_title(); ?>
                                    </h3>
                                </div>
								<?php if ($img_320): ?>
                                    <img
                                            class="main-section__post__thumbnail activities-section__post__thumbnail"
                                            src="<?php echo $img_320['sizes']['320_prev']; ?>"
                                            width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                                            height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                                            alt="<?php echo ($img_320['alt']??'') ?>"
                                    >
								<?php endif; ?>
                            </div>
                            <ul class="main-section__post__info-list activities-section__post__info-list">
								<?php foreach(get_field('quand') as $item): ?>
                                    <li class="main-section__post__info-list__info activities-section__post__info-list__info  activities-section__post__info-list__date">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__calendar-icon">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg><!--
                                     --><time class="main-section__post__info-list__date__day activities-section__post__info-list__date__day" datetime="<?= $item['date'] ?>"><?php ec_the_human_date_from_html_date( $item['date']); ?></time>
                                        <svg fill="currentColor" stroke="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="main-section__post__info-list__clock-icon">
                                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                                            <path d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                        </svg><!--
                                     --><span class="main-section__post__info-list__date__time "> de <time class="main-section__post__info-list__date__time__from" datetime="<?= $item['heure_de_debut'] ?>"><?= $item['heure_de_debut'] ?></time> à <time class="main-section__post__info-list__date__time__to" datetime="<?= $item['heure_de_fin'] ?>"><?= $item['heure_de_fin'] ?></time></span>
                                    </li>
								<?php endforeach; ?>
								<?php
								$places_terms_list = ec_get_terms_for_current_activity('places');
								$cat_terms_list = ec_get_terms_for_current_activity('cat');
								?>
								<?php if ( count( $places_terms_list ) > 0 ): ?>
                                    <li class="main-section__post__info-list__info">
                                        <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="main-section__post__info-list__place-icon">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                            <path d="M0 0h24v24H0z" fill="none"/>
                                        </svg><!--
                                        <?php if ( count( $places_terms_list ) > 1 ): ?>
                                            <?php for( $i = 0; $i < count( $places_terms_list ); $i++ ): ?>
                                                --><span class="main-section__post__info-list__info__term
                                                            main-section__post__info-list__terms__term
                                                            activities-section__post__info-list__info__term
                                                            activities-section__post__info-list__terms__term"><?= ($i == 0 ? $places_terms_list[$i] : ', ' . $places_terms_list[$i]) ?></span><!--
                                            <?php endfor; ?>
                                        <?php else: ?>
                                            --><span class="main-section__post__info-list__info__term
                                                        main-section__post__info-list__terms__term
                                                        activities-section__post__info-list__info__term
                                                        activities-section__post__info-list__terms__term"><?= $places_terms_list[0] ?></span><!--
                                        <?php endif; ?>
                                 --></li>
								<?php endif; ?>
								<?php if ( count( $cat_terms_list ) > 0 ): ?>
                                    <li class="main-section__post__info-list__info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__cat-icon">
                                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                            <line x1="7" y1="7" x2="7" y2="7"/>
                                        </svg><!--
                                     --><span class="main-section__post__info-list__info__term-container"><!--
                                            <?php if ( count( $cat_terms_list ) > 1 ): ?>
                                                <?php for( $i = 0; $i < count( $cat_terms_list ); $i++ ): ?>
                                                    --><span class="main-section__post__info-list__info__term"><?= ($i == 0 ? $cat_terms_list[$i] : ', ' . $cat_terms_list[$i]) ?></span><!--
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                --><span class="main-section__post__info-list__info__term"><?= $cat_terms_list[0] ?></span><!--
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

            <div class="btn1-container activities-section__all-posts-page-link-container main-section__all-posts-page-link-container">
                <a class="btn1 main-section__all-posts-page-link activities-section__all-posts-page-link" href="<?php echo get_page_link(13); ?>">
                    Toutes les activités
                </a>
            </div>
        </section>

        <section class="main-section artists-section" aria-labelledby="artists-section__title">
            <h2 class="main-section__title artists-section__title" id="artists-section__title" role="heading" aria-level="2">
                <span>
                    Artistes
                </span>
            </h2>
			<?php
			$items->query([
				'post_type' => 'artistes',
				'showposts' => '3',
				'orderby' => 'rand'
			]);
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
								$places_terms_list = ec_get_terms_for_current_artist($post->ID, 'places');
								$cat_terms_list = ec_get_terms_for_current_artist($post->ID, 'cat');
								?>
								<?php if ( count( $places_terms_list ) > 0 ): ?>
                                    <li class="main-section__post__info-list__info
                                    main-section__post__info-list__terms
                                    activities-section__post__info-list__info
                                    activities-section__post__info-list__terms">
                                        <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="main-section__post__info-list__place-icon">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                            <path d="M0 0h24v24H0z" fill="none"/>
                                        </svg><!--
                            <?php if ( count( $places_terms_list ) > 1 ): ?>
                                <?php for( $i = 0; $i < count( $places_terms_list ); $i++ ): ?>
                                    --><span class="main-section__post__info-list__info__term
                                                main-section__post__info-list__terms__term
                                                activities-section__post__info-list__info__term
                                                activities-section__post__info-list__terms__term"><?= ($i == 0 ? $places_terms_list[$i] : ', ' . $places_terms_list[$i]) ?></span><!--
                                <?php endfor; ?>
                            <?php else: ?>
                                --><span class="main-section__post__info-list__info__term
                                            main-section__post__info-list__terms__term
                                            activities-section__post__info-list__info__term
                                            activities-section__post__info-list__terms__term"><?= $places_terms_list[0] ?></span><!--
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
		
		
		<?php $instagram_data = ec_get_instagram_feed(); ?>
		<?php if ($instagram_data): ?>
            <section class="main-section instagram-section" aria-labelledby="instagram-section__title">
                <h2 class="main-section__title instagram-section__title" id="instagram-section__title" role="heading" aria-level="2">
                    <span>
                        Nos derniers posts Instagram
                    </span>
                </h2>
                <div class="main-section__feed instagram-section__feed container">
					<?php foreach ($instagram_data as $item): ?>
						<?php $width = $item->images->low_resolution->width;
						$height = $item->images->low_resolution->height;
						$url = $item->images->low_resolution->url; ?>
                        <a class="main-section__feed__image instagram-section__feed__image" href="<?= $item->link ?>" title="Afficher cette image sur instagram">
                            <img src="<?= $url ?>"
                                 width="<?= $width ?>"
                                 height="<?= $height ?>"
                                 alt="<?= ($item->caption->text??'Image récente provenant du compte Instagram de Saintléonart') ?>">
                        </a>
					<?php endforeach; ?>
                </div>
				<?php foreach (wp_get_nav_menu_items(ec_get_nav_id('other')) as $item): ?>
					<?php if ($item->title == 'Instagram'): ?>
                        <div class="btn1-container instagram-section__all-posts-page-link-container main-section__all-posts-page-link-container">
                            <a class="btn1 main-section__all-posts-page-link instagram-section__all-posts-page-link" href="<?= $item->url ?>">
                                Voir le reste sur Instagram
                            </a>
                        </div>
					<?php endif; ?>
				<?php endforeach; ?>
            </section>
		<?php endif; ?>
    </div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>