<?php //setlocale(LC_ALL, 'fr_BE.utf8'); ?>
<?php get_header(); ?>
    <div class="cta-container intro-cta">
		<?php
		$items = new WP_Query();
		$items->query([
			'post_type' => 'cta',
			'p' => '23'
		]);
		?>
		<?php if( $items->have_posts() ): $items->the_post(); ?>
            <ul class="intro-cta__info-list">
                <li class="intro-cta__date"><?php the_field('date'); ?></li>
                <li class="intro-cta__place"><?php the_field('lieu'); ?></li>
            </ul>
            <p class="p-summary project-cta__article__teasing">
                <?php the_field( 'presentation'); ?>
            </p>
            <a class="u-url link read-more project-cta__article__link" href="/a-propos">
                En savoir plus
            </a>
	    <?php else: ?>
            <p>
                CTA manquant
            </p>
	    <?php endif; ?>
    </div>
    <section class="main-section activities-section" aria-labelledby="main-section__title activities-section__title">
        <h2 class="main-section__title activities-section__title" id="main-section__title activities-section__title" role="heading" aria-level="2">
            Activités
        </h2>
        <?php
            $items = new WP_Query();
            $items->query([
                'post_type' => 'activites',
                'showposts' => '3',
                'orderby' => 'rand'
            ]);
        ?>
        <?php if( $items->have_posts() ): while( $items->have_posts() ): $items->the_post();?>
            <a class="main-section__permalink activities-section__permalink" href="<?php the_permalink(); ?>">
                <article class="main-section__permalink__post activities-section__permalink__post" aria-labelledby="main-section__permalink__post__title activities-section__permalink__post__title">
                    <h3 class="main-section__permalink__post__title activities-section__permalink__post__title" id="main-section__permalink__post__title activities-section__permalink__post__title" role="heading" aria-level="3">
			            <?php the_title(); ?>
                    </h3>
		            <?php $img_320 =  get_field('thumbnail'); ?>
                    <img
                            class="main-section__permalink__post__thumbnail activities-section__permalink__post__thumbnail"
                            src="<?php echo $img_320['sizes']['320_prev']; ?>"
                            width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                            height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                            alt="<?php echo $img_320['alt']; ?>"
                    >
                    <ul class="main-section__permalink__post__info-list activities-section__permalink__post__info-list">
			            <?php foreach(get_field('quand') as $item): ?>
                            <li class="main-section__permalink__post__info-list__info activities-section__permalink__post__info-list__info  activities-section__permalink__post__info-list__date">
                                <time class="main-section__permalink__post__info-list__date__day activities-section__permalink__post__info-list__date__day" datetime="<?php echo $item['date']; ?>"><?php ec_the_human_date_from_html_date( $item['date']); ?></time><span class="main-section__permalink__post__info-list__date__time activities-section__permalink__post__info-list__date__time"> de <time class="main-section__permalink__post__info-list__date__time__from activities-section__permalink__post__info-list__date__time__from" datetime="<?php echo $item['heure_de_debut']; ?>"><?php echo $item['heure_de_debut']; ?></time> à <time class="main-section__permalink__post__info-list__date__time__to activities-section__permalink__post__info-list__date__time__to" datetime="<?php echo $item['heure_de_fin']; ?>"><?php echo $item['heure_de_fin']; ?></time></span>
                            </li>
			            <?php endforeach; ?>
                        <?php
                        $artists_list = get_field('artistes');
                        $terms_list = [];
                        $places_list = [];
                            foreach ($artists_list as $an_artist){
                                foreach (wp_get_post_terms($an_artist->ID, 'cat') as $a_term){
                                    !in_array( $a_term->name, $terms_list) && $terms_list[] =  $a_term->name;
                                }
                                foreach (wp_get_post_terms($an_artist->ID, 'places') as $a_place){
                                    !in_array( $a_place->name, $places_list) && $places_list[] =  $a_place->name;
                                }
                            }
                        ?>
	                    <?php if ( count( $places_list ) > 0 ): ?>
                            <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms activities-section__permalink__post__info-list__info activities-section__permalink__post__info-list__terms"><!--
                            <?php if ( count( $places_list ) > 1 ): ?>
                                <?php for( $i = 0; $i < count( $places_list ); $i++ ): ?>
                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $places_list[$i] : ', '.$places_list[$i]); ?></span><!--
                                <?php endfor; ?>
                            <?php else: ?>
                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo $places_list[0]; ?></span><!--
	                        <?php endif; ?>
                            --></li>
	                    <?php endif; ?>
                     
			            <?php if ( count( $terms_list ) > 0 ): ?>
                            <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms activities-section__permalink__post__info-list__info activities-section__permalink__post__info-list__terms"><!--
                            <?php if ( count( $terms_list ) > 1 ): ?>
                                <?php for( $i = 0; $i < count( $terms_list ); $i++ ): ?>
                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $terms_list[$i] : ', '.$terms_list[$i]); ?></span><!--
                                <?php endfor; ?>
                            <?php else: ?>
                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo $terms_list[0]; ?></span><!--
	                        <?php endif; ?>
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
        <a class="main-section__all-posts-page-link activities-section__all-posts-page-link" aria-labelledby="main-section__title activities-section__title" href="<?php echo get_page_link(13); ?>">Toutes les activités</a>
    </section>

    <section class="main-section artists-section" aria-labelledby="main-section__title artists-section__title">
        <h2 class="main-section__title artists-section__title" id="main-section__title artists-section__title" role="heading" aria-level="2">
            Artistes
        </h2>
		<?php
		$items = new WP_Query();
		$items->query([
			'post_type' => 'artistes',
			'showposts' => '3',
			'orderby' => 'rand'
		]);
		?>
		<?php if( $items->have_posts() ): while( $items->have_posts() ): $items->the_post(); ?>
            <a class="main-section__permalink artists-section__permalink" href="<?php the_permalink(); ?>">
                <article class="main-section__permalink__post artists-section__permalink__post" aria-labelledby="main-section__permalink__post__title artists-section__permalink__post__title">
                    <h3 class="main-section__permalink__post__title artists-section__permalink__post__title" id="main-section__permalink__post__title artists-section__permalink__post__title" role="heading" aria-level="3">
			            <?php the_title(); ?>
                    </h3>
		            <?php $img_320 =  get_field('thumbnail'); ?>
                    <img
                            class="main-section__permalink__post__thumbnail artists-section__permalink__post__thumbnail"
                            src="<?php echo $img_320['sizes']['320_prev']; ?>"
                            width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                            height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                            alt="<?php echo $img_320['alt']; ?>"
                    >
                    <ul class="main-section__permalink__post__info-list artists-section__permalink__post__info-list">
                        <li class="main-section__permalink__post__info-list__info artists-section__permalink__post__info-list__info artists-section__permalink__post__info-list__place">
                            <span><?= $terms_list = wp_get_post_terms($post->ID, 'places')[0]->name; ?></span>
                        </li>
			            <?php $terms_list = wp_get_post_terms($post->ID, 'cat'); if ( count( $terms_list ) > 0 ): ?>
                            <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms artists-section__permalink__post__info-list__info artists-section__permalink__post__info-list__terms"><!--
                        <?php if ( count( $terms_list ) > 1 ): ?>
                            <?php for( $i = 0; $i < count( $terms_list ); $i++ ): ?>
                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $terms_list[$i]->name : ', '.$terms_list[$i]->name); ?></span><!--
                            <?php endfor; ?>
                        <?php else: ?>
                            --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo $terms_list[0]->name; ?></span><!--
                        <?php endif; ?>
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
        <a class="main-section__all-posts-page-link activities-section__all-posts-page-link" aria-labelledby="main-section__title activities-section__title" href="<?php echo get_page_link(17); ?>">Tous les artistes</a>
    </section>
    <?php $data = ec_get_instagram_feed(); ?>
    <?php if ($data): ?>
        <section class="main-section instagram-section" aria-labelledby="main-section__title instagram-section__title">
            <h2 class="main-section__title instagram-section__title" id="main-section__title instagram-section__title" role="heading" aria-level="2">
                Nos derniers posts Instagram
            </h2>
            <div class="main-section__feed instagram-section__feed">
	            <?php foreach ($data as $item): ?>
		            <?php $width = $item->images->low_resolution->width; $height = $item->images->low_resolution->height; $url = $item->images->low_resolution->url; ?>
                    <img class="main-section__feed__image instagram-section__feed__image" src="<?= $url ?>" alt="Image récente provenant du compte instagram de Saintléonart" width="<?= $width ?>" height="<?= $height ?>">
		            <?php //var_dump( $item->images->low_resolution ); ?>
                <?php endforeach; ?>
            </div>
	        <?php foreach (wp_get_nav_menu_items(ec_get_nav_id('other')) as $item): ?>
                <?php if ($item->title == 'Instagram'): ?>
                    <a href="<?= $item->url ?>">Voir le reste sur Instagram</a>
                <?php endif; ?>
	        <?php endforeach; ?>
         
        </section>
    <?php endif; ?>
<?php get_footer(); ?>