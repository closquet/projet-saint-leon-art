<?php get_header(); ?>
<div class="main-section single-activity-container" aria-labelledby="main-section__title single-activity-container__title">
	<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
        <section class="main-section__post single-activity-container__post" aria-labelledby="main-section__post__title single-activity-container__post__title">
            <h1 class="main-section__post__title single-activity-container__post__title" id="main-section__post__title single-activity-container__post__title" role="heading" aria-level="1">
				<?php the_title(); ?>
            </h1>
			<?php $img_320 =  get_field('thumbnail'); ?>
            <img
                    class="main-section__post__thumbnail single-activity-container__post__thumbnail"
                    src="<?php echo $img_320['sizes']['320_prev']; ?>"
                    width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                    height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                    alt="<?php echo $img_320['alt']; ?>"
            >
            <ul class="main-section__post__info-list single-activity-container__post__info-list">
				<?php foreach(get_field('quand') as $item): ?>
                    <li class="main-section__post__info-list__info single-activity-container__post__info-list__info  single-activity-container__post__info-list__date">
                        <time class="main-section__post__info-list__date__day__post__info-list__date__day single-activity-container__post__info-list__date__day" datetime="<?php echo $item['date']; ?>"><?php ec_the_human_date_from_html_date( $item['date']); ?></time><span class="main-section__post__info-list__date__day__post__info-list__date__time single-activity-container__post__info-list__date__time"> de <time class="main-section__post__info-list__date__day__post__info-list__date__time__from single-activity-container__post__info-list__date__time__from" datetime="<?php echo $item['heure_de_debut']; ?>"><?php echo $item['heure_de_debut']; ?></time> à <time class="main-section__post__info-list__date__day__post__info-list__date__time__to single-activity-container__post__info-list__date__time__to" datetime="<?php echo $item['heure_de_fin']; ?>"><?php echo $item['heure_de_fin']; ?></time></span>
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
                    <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms single-activity-container__permalink__post__info-list__info single-activity-container__permalink__post__info-list__terms"><!--
                            <?php if ( count( $main_post_places_terms_list ) > 1 ): ?>
                                <?php for( $i = 0; $i < count( $main_post_places_terms_list ); $i++ ): ?>
                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term single-activity-container__permalink__post__info-list__info__term single-activity-container__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $main_post_places_terms_list[$i] : ', '.$main_post_places_terms_list[$i]); ?></span><!--
                                <?php endfor; ?>
                            <?php else: ?>
                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term single-activity-container__permalink__post__info-list__info__term single-activity-container__permalink__post__info-list__terms__term"><?php echo $main_post_places_terms_list[0]; ?></span><!--
	                        <?php endif; ?>
                            --></li>
				<?php endif; ?>
				<?php if ( count( $main_post_cat_terms_list ) > 0 ): ?>
                    <li class="main-section__post__info-list__info main-section__post__info-list__terms single-activity-container__post__info-list__info single-activity-container__post__info-list__terms"><!--
                    <?php if ( count( $main_post_cat_terms_list ) > 1 ): ?>
                        <?php for( $i = 0; $i < count( $main_post_cat_terms_list ); $i++ ): ?>
                            --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term single-activity-container__post__info-list__info__term single-activity-container__post__info-list__terms__term"><?php echo ($i == 0 ? $main_post_cat_terms_list[$i] : ', '.$main_post_cat_terms_list[$i]); ?></span><!--
                        <?php endfor; ?>
                    <?php else: ?>
                        --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term single-activity-container__post__info-list__info__term single-activity-container__post__info-list__terms__term"><?php echo $main_post_cat_terms_list[0]; ?></span><!--
                    <?php endif; ?>
                    --></li>
				<?php endif; ?>
            </ul>
            <div class="main-section__post__presentation single-activity-container__post__presentation">
				<?= get_field( 'presentation') ?>
            </div>
            <ul class="main-section__post__artists-list single-activity-container__post__artists-list">
				<?php foreach(get_field('artistes') as $item): ?>
                    <li class="main-section__post__artists-list__artist single-activity-container__post__artists-list__artist">
                        <a href="<?= get_permalink($item) ?>"><?= get_post($item)->post_title ?></a>
                    </li>
				<?php endforeach; ?>
            </ul>
			
			<?php
			$items = ec_get_activities_from_terms($main_post_cat_terms_list, 'cat', $main_post_id);
			?>
			<?php if( $items->have_posts() ): ?>
                <section class="main-section__post__same-cat-section single-activity-container__post__same-cat-section" aria-labelledby="main-section__post__same-cat-section__title single-activity-container__post__same-cat-section__title">
                    <h2 class="main-section__post__same-cat-section__title single-activity-container__post__same-cat-section__title" id="main-section__post__same-cat-section__title single-activity-container__post__same-cat-section__title" role="heading" aria-level="2">
                        Dans la même catégorie
                    </h2>
					<?php while( $items->have_posts() ): $items->the_post(); ?>
                        <a class="main-section__permalink activities-section__permalink" href="<?php the_permalink(); ?>">
                            <article class="main-section__permalink__post artists-section__permalink__post" aria-labelledby="main-section__permalink__post__title artists-section__permalink__post__title">
                                <h3 class="main-section__permalink__post__title artists-section__permalink__post__title" id="main-section__permalink__post__title artists-section__permalink__post__title" role="heading" aria-level="3">
									<?= the_title(); ?>
                                </h3>
								<?php $img_320 =  get_field('thumbnail', $post->ID); ?>
                                <img
                                        class="main-section__permalink__post__thumbnail artists-section__permalink__post__thumbnail"
                                        src="<?php echo $img_320['sizes']['320_prev']; ?>"
                                        width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                                        height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                                        alt="<?php echo $img_320['alt']; ?>"
                                >
                                <ul class="main-section__permalink__post__info-list artists-section__permalink__post__info-list">
									<?php
									$places_terms_list = ec_get_terms_for_current_activity('places');
									$cat_terms_list = ec_get_terms_for_current_activity('cat');
									?>
									<?php if ( count( $places_terms_list ) > 0 ): ?>
                                        <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms activities-section__permalink__post__info-list__info activities-section__permalink__post__info-list__terms"><!--
                                            <?php if ( count( $places_terms_list ) > 1 ): ?>
                                                <?php for( $i = 0; $i < count( $places_terms_list ); $i++ ): ?>
                                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $places_terms_list[$i] : ', '.$places_terms_list[$i]); ?></span><!--
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo $places_terms_list[0]; ?></span><!--
                                            <?php endif; ?>
                                        --></li>
									<?php endif; ?>
									
									<?php if ( count( $cat_terms_list ) > 0 ): ?>
                                        <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms artists-section__permalink__post__info-list__info artists-section__permalink__post__info-list__terms"><!--
                                            <?php if ( count( $cat_terms_list ) > 1 ): ?>
                                                <?php for( $i = 0; $i < count( $cat_terms_list ); $i++ ): ?>
                                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $cat_terms_list[$i] : ', '.$cat_terms_list[$i]); ?></span><!--
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo $cat_terms_list[0]; ?></span><!--
                                            <?php endif; ?>
                                        --></li>
									<?php endif; ?>
                                </ul>
                            </article>
                        </a>
					<?php endwhile; ?>
                    <a class="main-section__all-posts-page-link activities-section__all-posts-page-link" href="<?php echo get_page_link(13); ?>">Toutes les activités</a>
                </section>
			<?php endif; ?>
			<?php
	        $items = ec_get_activities_from_terms($main_post_places_terms_list, 'places', $main_post_id);
	        ?>
	        <?php if( $items->have_posts() ): ?>
                <section class="main-section__post__same-cat-section single-activity-container__post__same-cat-section" aria-labelledby="main-section__post__same-cat-section__title single-activity-container__post__same-cat-section__title">
                    <h2 class="main-section__post__same-cat-section__title single-activity-container__post__same-cat-section__title" id="main-section__post__same-cat-section__title single-activity-container__post__same-cat-section__title" role="heading" aria-level="2">
                        Dans le même endroit
                    </h2>
			        <?php while( $items->have_posts() ): $items->the_post(); ?>
                        <a class="main-section__permalink activities-section__permalink" href="<?php the_permalink(); ?>">
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
							        <?php
							        $places_terms_list = ec_get_terms_for_current_activity('places');
							        $cat_terms_list = ec_get_terms_for_current_activity('cat');
							        ?>
							        <?php if ( count( $places_terms_list ) > 0 ): ?>
                                        <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms activities-section__permalink__post__info-list__info activities-section__permalink__post__info-list__terms"><!--
                                            <?php if ( count( $places_terms_list ) > 1 ): ?>
                                                <?php for( $i = 0; $i < count( $places_terms_list ); $i++ ): ?>
                                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $places_terms_list[$i] : ', '.$places_terms_list[$i]); ?></span><!--
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo $places_terms_list[0]; ?></span><!--
                                            <?php endif; ?>
                                        --></li>
							        <?php endif; ?>
							
							        <?php if ( count( $cat_terms_list ) > 0 ): ?>
                                        <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms artists-section__permalink__post__info-list__info artists-section__permalink__post__info-list__terms"><!--
                                            <?php if ( count( $cat_terms_list ) > 1 ): ?>
                                                <?php for( $i = 0; $i < count( $cat_terms_list ); $i++ ): ?>
                                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $cat_terms_list[$i] : ', '.$cat_terms_list[$i]); ?></span><!--
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo $cat_terms_list[0]; ?></span><!--
                                            <?php endif; ?>
                                        --></li>
							        <?php endif; ?>
                                </ul>
                            </article>
                        </a>
			        <?php endwhile; ?>
                    <a class="main-section__all-posts-page-link activities-section__all-posts-page-link" href="<?php echo get_page_link(13); ?>">Toutes les activités</a>
                </section>
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
                <section class="main-section__post__same-cat-section single-activity-container__post__same-cat-section" aria-labelledby="main-section__post__same-cat-section__title single-activity-container__post__same-cat-section__title">
                    <h2 class="main-section__post__same-cat-section__title single-activity-container__post__same-cat-section__title" id="main-section__post__same-cat-section__title single-activity-container__post__same-cat-section__title" role="heading" aria-level="2">
                        Le même jour
                    </h2>
			        <?php while( $items->have_posts() ): $items->the_post(); ?>
                        <a class="main-section__permalink activities-section__permalink" href="<?php the_permalink(); ?>">
                            <article class="main-section__permalink__post artists-section__permalink__post" aria-labelledby="main-section__permalink__post__title artists-section__permalink__post__title">
                                <h3 class="main-section__permalink__post__title artists-section__permalink__post__title" id="main-section__permalink__post__title artists-section__permalink__post__title" role="heading" aria-level="3">
							        <?php the_title(); echo ' ' . get_field( 'quand')[0]['date'] . ' ' . get_field( 'quand')[0]['date']??'';?>
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
							        <?php
							        $places_terms_list = ec_get_terms_for_current_activity('places');
							        $cat_terms_list = ec_get_terms_for_current_activity('cat');
							        ?>
							        <?php if ( count( $places_terms_list ) > 0 ): ?>
                                        <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms activities-section__permalink__post__info-list__info activities-section__permalink__post__info-list__terms"><!--
                                            <?php if ( count( $places_terms_list ) > 1 ): ?>
                                                <?php for( $i = 0; $i < count( $places_terms_list ); $i++ ): ?>
                                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $places_terms_list[$i] : ', '.$places_terms_list[$i]); ?></span><!--
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term activities-section__permalink__post__info-list__info__term activities-section__permalink__post__info-list__terms__term"><?php echo $places_terms_list[0]; ?></span><!--
                                            <?php endif; ?>
                                        --></li>
							        <?php endif; ?>
							
							        <?php if ( count( $cat_terms_list ) > 0 ): ?>
                                        <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms artists-section__permalink__post__info-list__info artists-section__permalink__post__info-list__terms"><!--
                                            <?php if ( count( $cat_terms_list ) > 1 ): ?>
                                                <?php for( $i = 0; $i < count( $cat_terms_list ); $i++ ): ?>
                                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $cat_terms_list[$i] : ', '.$cat_terms_list[$i]); ?></span><!--
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo $cat_terms_list[0]; ?></span><!--
                                            <?php endif; ?>
                                        --></li>
							        <?php endif; ?>
                                </ul>
                            </article>
                        </a>
			        <?php endwhile; ?>
                    <a class="main-section__all-posts-page-link activities-section__all-posts-page-link" href="<?php echo get_page_link(13); ?>">Toutes les activités</a>
                </section>
	        <?php endif; ?>
         
        </section>
	<?php endwhile; endif; ?>
</div>
















<?php get_footer(); ?>
