<?php get_header(); ?>
<div class="main-section single-activity-container" aria-labelledby="main-section__title single-activity-container__title">
	<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
        <article class="main-section__post single-activity-container__post" aria-labelledby="main-section__post__title single-activity-container__post__title">
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
                    <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms single-activity-container__permalink__post__info-list__info single-activity-container__permalink__post__info-list__terms"><!--
                            <?php if ( count( $places_list ) > 1 ): ?>
                                <?php for( $i = 0; $i < count( $places_list ); $i++ ): ?>
                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term single-activity-container__permalink__post__info-list__info__term single-activity-container__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $places_list[$i] : ', '.$places_list[$i]); ?></span><!--
                                <?php endfor; ?>
                            <?php else: ?>
                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term single-activity-container__permalink__post__info-list__info__term single-activity-container__permalink__post__info-list__terms__term"><?php echo $places_list[0]; ?></span><!--
	                        <?php endif; ?>
                            --></li>
	            <?php endif; ?>
                <?php if ( count( $terms_list ) > 0 ): ?>
                    <li class="main-section__post__info-list__info main-section__post__info-list__terms single-activity-container__post__info-list__info single-activity-container__post__info-list__terms"><!--
                    <?php if ( count( $terms_list ) > 1 ): ?>
                        <?php for( $i = 0; $i < count( $terms_list ); $i++ ): ?>
                            --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term single-activity-container__post__info-list__info__term single-activity-container__post__info-list__terms__term"><?php echo ($i == 0 ? $terms_list[$i] : ', '.$terms_list[$i]); ?></span><!--
                        <?php endfor; ?>
                    <?php else: ?>
                        --><span class="main-section__post__info-list__info__term main-section__post__info-list__terms__term single-activity-container__post__info-list__info__term single-activity-container__post__info-list__terms__term"><?php echo $terms_list[0]; ?></span><!--
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
                        <a href="<?= get_permalink($item->ID) ?>"><?= get_post($item->ID)->post_title ?></a>
                    </li>
	            <?php endforeach; ?>
            </ul>
	
	        <?php
	        $items = new WP_Query();
	        $items->query([
		        'post_type' => 'activites',
		        'showposts' => '6',
		        'post__not_in' => [$post->ID],
		        'orderby' => 'rand',
		        'tax_query' => array(
			        array(
				        'taxonomy' => 'cat',
				        'field'    => 'slug',
				        'terms'    => $terms_list??'',
			        ),
		        ),
	        ]);
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
                                        <li class="main-section__permalink__post__info-list__info main-section__permalink__post__info-list__terms artists-section__permalink__post__info-list__info artists-section__permalink__post__info-list__terms"><!--
                                            <?php if ( count( $terms_list ) > 1 ): ?>
                                                <?php for( $i = 0; $i < count( $terms_list ); $i++ ): ?>
                                                    --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo ($i == 0 ? $terms_list[$i] : ', '.$terms_list[$i]); ?></span><!--
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                --><span class="main-section__permalink__post__info-list__info__term main-section__permalink__post__info-list__terms__term artists-section__permalink__post__info-list__info__term artists-section__permalink__post__info-list__terms__term"><?php echo $terms_list[0]; ?></span><!--
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
         
        </article>
	<?php endwhile; endif; ?>
</div>
















<?php get_footer(); ?>
