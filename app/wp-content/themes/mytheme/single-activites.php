<?php get_header(); ?>

    <div class="content container">
        <div class="main-section current-post-section current-activity-section">
            <h1 class="main-section__title current-post-section__title current-activity-section__title" id="current-activity-section__title" role="heading" aria-level="1">
                <span>
                    <?php the_title(); ?>
                </span>
            </h1>
            <div class="main-section__posts-container current-post-section__posts-container">
                <div class="current-post-container current-activity-container">
	                <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
                    <article class="main-section__post current-section__post current-activity-section__post" aria-labelledby="current-activity-section__title">
                        <?php $img_740 =  get_field('thumbnail'); ?>
                        <?php if ($img_740): ?>
                            <img
                                    class="main-section__post__thumbnail current-section__post__thumbnail current-activity-section__post__thumbnail"
                                    src="<?php echo $img_740['sizes']['740_prev']; ?>"
                                    width="<?php echo $img_740['sizes']['740_prev-width']; ?>"
                                    height="<?php echo $img_740['sizes']['740_prev-height']; ?>"
                                    alt="<?php echo $img_740['alt']; ?>"
                            >
                        <?php endif; ?>
                        <ul class="main-section__post__info-list current-section__post__info-list">
			                <?php foreach(get_field('quand') as $item): ?>
                                <li class="main-section__post__info-list__info current-post-section__post__info-list__info  current-post-section__post__info-list__date">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__calendar-icon">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg><!--
                         --><time class="main-section__post__info-list__date__day current-activity-section__post__info-list__date__day" datetime="<?php echo $item['date']; ?>"><?php ec_the_human_date_from_html_date( $item['date']); ?></time>
                                    <svg fill="currentColor" stroke="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="main-section__post__info-list__clock-icon">
                                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                    </svg><!--
                         --><span class="main-section__post__info-list__date__time"> de <time class="main-section__post__info-list__date__time__from" datetime="<?= $item['heure_de_debut'] ?>"><?= $item['heure_de_debut'] ?></time> à <time class="main-section__post__info-list__date__time__to " datetime="<?= $item['heure_de_fin'] ?>"><?= $item['heure_de_fin'] ?></time></span>
                                </li>
			                <?php endforeach; ?>
			                <?php
                                $main_post_artists_list = get_field('artistes');
                                $main_post_cat_terms_list = ec_get_terms_for_current_activity('cat');
                                $main_post_places_terms_list = ec_get_terms_for_current_activity('places');
                                $main_post_id = $post->ID;
                                $main_post_dates_list = ec_get_current_activity_dates();
			                ?>
			                <?php if ( count( $main_post_places_terms_list ) > 0 ): ?>
                                <li class="main-section__post__info-list__info current-post-section__post__info-list__info">
                                    <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="main-section__post__info-list__place-icon">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                    </svg><!--
                                <?php if ( count( $main_post_places_terms_list ) > 1 ): ?>
                                    <?php for( $i = 0; $i < count( $main_post_places_terms_list ); $i++ ): ?>
                                        --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term current-activity-section__post__info-list__info__term current-activity-section__post__info-list__terms__term"><?php echo ($i == 0 ? $main_post_places_terms_list[$i] : ', '.$main_post_places_terms_list[$i]); ?></span><!--
                                    <?php endfor; ?>
                                <?php else: ?>
                                    --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term current-activity-section__post__info-list__info__term current-activity-section__post__info-list__terms__term"><?php echo $main_post_places_terms_list[0]; ?></span><!--
                                <?php endif; ?>
                                --></li>
			                <?php endif; ?>
			                <?php if ( count( $main_post_cat_terms_list ) > 0 ): ?>
                                <li class="main-section__post__info-list__info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__cat-icon">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                        <line x1="7" y1="7" x2="7" y2="7"/>
                                    </svg><!--
                                 --><span class="main-section__post__info-list__info__term-container"><!--
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
	                        <?php if (get_field( 'presentation')): ?>
                                <li class="main-section__post__info-list__info main-section__post__info-list__presentation ">
			                        <?= get_field( 'presentation') ?>
                                </li>
	                        <?php endif; ?>
                        </ul>
	                    <?php if (get_field( 'artistes')): ?>
                            <ul class="main-section__post__artists-list current-post-section__post__artists-list">
                                Par <?php foreach(get_field('artistes') as $item): ?><!--
                                 --><li class="main-section__post__artists-list__artist current-post-section__post__artists-list__artist">
                                        <a class="main-section__post__artists-list__artist__permalink" href="<?= get_permalink($item) ?>"><?= get_post($item)->post_title ?></a>
                                    </li><!--
			                    <?php endforeach; ?>
                            --></ul>
	                    <?php endif; ?>
                    </article>
                </div>
            </div>
        </div>
				
        <?php
        $items = ec_get_activities_from_terms($main_post_cat_terms_list, 'cat', $main_post_id);
        ?>
        <?php if( $items->have_posts() ): ?>
            <section class="main-section same-term-section same-category-section" aria-labelledby="same-category-section__title">
                <h2 class="main-section__title same-term-section__title" id="same-category-section__title" role="heading" aria-level="2">
                    <span>
                        Dans la même catégorie
                    </span>
                </h2>
                <div class="main-section__posts-container">
	                <?php while( $items->have_posts() ): $items->the_post(); ?>
                        <a class="main-section__permalink activities-section__permalink" href="<?php the_permalink(); ?>">
                            <article class="main-section__post artists-section__post" aria-labelledby="main-section__post__title artists-section__post__title">
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
                                                alt="<?php echo $img_320['alt']; ?>"
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
	                <?php endwhile; ?>
                </div>
                <div class="btn1-container activities-section__all-posts-page-link-container main-section__all-posts-page-link-container">
                    <a class="btn1 main-section__all-posts-page-link activities-section__all-posts-page-link" href="<?php echo get_page_link(13); ?>">
                        Toutes les activités
                    </a>
                </div>
            </section>
        <?php endif; ?>


        <?php
        $items = ec_get_activities_from_terms($main_post_places_terms_list, 'places', $main_post_id);
        ?>
        <?php if( $items->have_posts() ): ?>
            <section class="main-section same-term-section same-place-section" aria-labelledby="same-place-section__title">
                <h2 class="main-section__title same-term-section__title" id="same-place-section__title" role="heading" aria-level="2">
                    <span>
                        Dans le même endroit
                    </span>
                </h2>
                <div class="main-section__posts-container">
	                <?php while( $items->have_posts() ): $items->the_post(); ?>
                        <a class="main-section__permalink activities-section__permalink" href="<?php the_permalink(); ?>">
                            <article class="main-section__post artists-section__post" aria-labelledby="main-section__post__title artists-section__post__title">
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
                                                alt="<?php echo $img_320['alt']; ?>"
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
	                <?php endwhile; ?>
                </div>
                <div class="btn1-container activities-section__all-posts-page-link-container main-section__all-posts-page-link-container">
                    <a class="btn1 main-section__all-posts-page-link activities-section__all-posts-page-link" href="<?php echo get_page_link(13); ?>">
                        Toutes les activités
                    </a>
                </div>            </section>
        <?php endif; ?>
    
    
    
        <?php
        //build meta query to have a dynamic array of what we search
        $meta_query = ['relation' => 'OR'];
    
        $meta_query[] = [
            'key'       => 'quand_%_date',
            'value'     => '2017-11-20',
            'compare'   => 'LIKE',
        ];
    
    
        //build the arg for the get_posts instruction
        $arg = [
            'post_type' => 'activites',
            'post__not_in' => [$main_post_id],
            'showposts' => '3',
            'orderby' => 'rand',
            'meta_query' => $meta_query
        ];
        $items = new wp_query([
            'post_type' => 'activites',
            'showposts' => '3',
            'orderby' => 'rand',
            'meta_query' => [
                [
                    'key'       => 'quand_%_date',
                    'value'     => '',
                    'compare'   => 'LIKE',
                ],
        
            ]
        ]);
        //$items = ec_get_activities_from_dates($main_post_dates_list, $main_post_id)
        ?>
        <?php if( $items->have_posts() ): ?>
            <section class="main-section same-term-section same-date-section" aria-labelledby="same-date-section__title">
                <h2 class="main-section__title same-term-section__title" id="same-date-section__title" role="heading" aria-level="2">
                    <span>
                        Le même jour
                    </span>
                </h2>
                <div class="main-section__posts-container">
	                <?php while( $items->have_posts() ): $items->the_post(); ?>
                        <a class="main-section__permalink activities-section__permalink" href="<?php the_permalink(); ?>">
                            <article class="main-section__post artists-section__post" aria-labelledby="main-section__post__title artists-section__post__title">
                                <div class="main-section__post__top">
	                                <?php $img_320 =  get_field('thumbnail'); ?>
                                    <div class="main-section__post__title-container<?= !($img_320)? ' no-image' : '' ?>">
                                        <h3 class="main-section__post__title artists-section__post__title" id="main-section__post__title artists-section__post__title" role="heading" aria-level="3">
		                                    <?php the_title(); echo ' ' . get_field( 'quand')[0]['date'] . ' ' . get_field( 'quand')[0]['date']??'';?>
                                        </h3>
                                    </div>
		                            <?php if ($img_320): ?>
                                        <img
                                                class="main-section__post__thumbnail artists-section__post__thumbnail"
                                                src="<?php echo $img_320['sizes']['320_prev']; ?>"
                                                width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                                                height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                                                alt="<?php echo $img_320['alt']; ?>"
                                        >
		                            <?php endif; ?>
                                </div>
                                <ul class="main-section__post__info-list artists-section__post__info-list">
					                <?php
					                $places_terms_list = ec_get_terms_for_current_activity('places');
					                $cat_terms_list = ec_get_terms_for_current_activity('cat');
					                ?>
					                <?php if ( count( $places_terms_list ) > 0 ): ?>
                                        <li class="main-section__post__info-list__info main-section__post__info-list__terms activities-section__post__info-list__info activities-section__post__info-list__terms"><!--
                                    <?php if ( count( $places_terms_list ) > 1 ): ?>
                                        <?php for( $i = 0; $i < count( $places_terms_list ); $i++ ): ?>
                                            --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term activities-section__post__info-list__info__term activities-section__post__info-list__terms__term"><?php echo ($i == 0 ? $places_terms_list[$i] : ', '.$places_terms_list[$i]); ?></span><!--
                                        <?php endfor; ?>
                                    <?php else: ?>
                                        --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term activities-section__post__info-list__info__term activities-section__post__info-list__terms__term"><?php echo $places_terms_list[0]; ?></span><!--
                                    <?php endif; ?>
                                --></li>
					                <?php endif; ?>
					
					                <?php if ( count( $cat_terms_list ) > 0 ): ?>
                                        <li class="main-section__post__info-list__info main-section__post__info-list__terms artists-section__post__info-list__info artists-section__post__info-list__terms"><!--
                                    <?php if ( count( $cat_terms_list ) > 1 ): ?>
                                        <?php for( $i = 0; $i < count( $cat_terms_list ); $i++ ): ?>
                                            --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term artists-section__post__info-list__info__term artists-section__post__info-list__terms__term"><?php echo ($i == 0 ? $cat_terms_list[$i] : ', '.$cat_terms_list[$i]); ?></span><!--
                                        <?php endfor; ?>
                                    <?php else: ?>
                                        --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term artists-section__post__info-list__info__term artists-section__post__info-list__terms__term"><?php echo $cat_terms_list[0]; ?></span><!--
                                    <?php endif; ?>
                                --></li>
					                <?php endif; ?>
                                </ul>
                            </article>
                        </a>
	                <?php endwhile; ?>
                </div>
                <div class="btn1-container activities-section__all-posts-page-link-container main-section__all-posts-page-link-container">
                    <a class="btn1 main-section__all-posts-page-link activities-section__all-posts-page-link" href="<?php echo get_page_link(13); ?>">
                        Toutes les activités
                    </a>
                </div>            </section>
        <?php endif; ?>
    
        <?php endwhile; endif; ?>
    </div>

<?php get_footer(); ?>
