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
    <section class="post-type-section activities-section" aria-labelledby="post-type-section__title activities-section__title">
        <h2 class="post-type-section__title activities-section__title" id="post-type-section__title activities-section__title" role="heading" aria-level="2">
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
        <?php if( $items->have_posts() ): while( $items->have_posts() ): $items->the_post(); $the_artist_id = get_field('artistes')['0']->ID; ?>
            <article class="post-type-section__post activities-section__post" aria-labelledby="post-type-section__post__title activities-section__post__title">
                <h3 class="post-type-section__post__title activities-section__post__title" id="post-type-section__post__title activities-section__post__title" role="heading" aria-level="2">
	                <?php the_title(); ?>
                </h3>
	            <?php $img_320 =  get_field('thumbnail'); ?>
                <img
                    class="post-type-section__post__thumbnail activities-section__post__thumbnail"
                    src="<?php echo $img_320['sizes']['320_prev']; ?>"
                    width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                    height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                    alt="<?php echo $img_320['alt']; ?>"
                >
	            <ul class="post-type-section__post__info-list activities-section__post__info-list">
                    <?php foreach(get_field('quand') as $item): ?>
                        <li class="post-type-section__post__info-list__info activities-section__post__info-list__info  activities-section__post__info-list__date">
                            <time class="activities-section__post__info-list__date__day" datetime="<?php echo $item['date']; ?>"><?php ec_the_human_date_from_html_date( $item['date']); ?></time><span class="activities-section__post__info-list__date__time"> de <time class="activities-section__post__info-list__date__time__from" datetime="<?php echo $item['heure_de_debut']; ?>"><?php echo $item['heure_de_debut']; ?></time> à <time class="activities-section__post__info-list__date__time__to" datetime="<?php echo $item['heure_de_fin']; ?>"><?php echo $item['heure_de_fin']; ?></time></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="post-type-section__post__info-list__info activities-section__post__info-list__info activities-section__post__info-list__place">
                        <span><?= $term_list = wp_get_post_terms($the_artist_id, 'places')[0]->name; ?></span>
                    </li>
                    <?php $term_list = wp_get_post_terms($the_artist_id, 'cat'); if ( count( $term_list ) > 0 ): ?>
                        <li class="post-type-section__post__info-list__info post-type-section__post__info-list__terms activities-section__post__info-list__info activities-section__post__info-list__terms"><!--
                        <?php if ( count( $term_list ) > 1 ): ?>
		                    <?php for( $i = 0; $i < count( $term_list ); $i++ ): ?>
                                --><span class="post-type-section__post__info-list__info__term post-type-section__post__info-list__terms__term activities-section__post__info-list__info__term activities-section__post__info-list__terms__term"><?php echo ($i == 0 ? $term_list[$i]->name : ', '.$term_list[$i]->name); ?></span><!--
		                    <?php endfor; ?>
                        <?php else: ?>
                            --><span class="post-type-section__post__info-list__info__term post-type-section__post__info-list__terms__term activities-section__post__info-list__info__term activities-section__post__info-list__terms__term"><?php echo $term_list[0]->name; ?></span><!--
	                    <?php endif; ?>
                        --></li>
                    <?php endif; ?>
                </ul>
            </article>
        <?php endwhile; else: ?>
            <p>
                Il n&rsquo;y a pas encore d&rsquo;articles pour cette section.
            </p>
        <?php endif; ?>
        <a href="<?php echo get_page_link(13); ?>">Toutes les activités</a>
    </section>

    <section class="post-type-section artists-section" aria-labelledby="post-type-section__title artists-section__title">
        <h2 class="post-type-section__title artists-section__title" id="post-type-section__title artists-section__title" role="heading" aria-level="2">
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
            <article class="post-type-section__post artists-section__post" aria-labelledby="post-type-section__post__title artists-section__post__title">
                <h3 class="post-type-section__post__title artists-section__post__title" id="post-type-section__post__title artists-section__post__title" role="heading" aria-level="2">
					<?php the_title(); ?>
                </h3>
				<?php $img_320 =  get_field('thumbnail'); ?>
                <img
                    class="post-type-section__post__thumbnail artists-section__post__thumbnail"
                    src="<?php echo $img_320['sizes']['320_prev']; ?>"
                    width="<?php echo $img_320['sizes']['320_prev-width']; ?>"
                    height="<?php echo $img_320['sizes']['320_prev-height']; ?>"
                    alt="<?php echo $img_320['alt']; ?>"
                >
                <ul class="post-type-section__post__info-list artists-section__post__info-list">
					
                    <li class="post-type-section__post__info-list__info artists-section__post__info-list__info artists-section__post__info-list__place">
                        <span><?= $term_list = wp_get_post_terms($post->ID, 'places')[0]->name; ?></span>
                    </li>
					<?php $term_list = wp_get_post_terms($post->ID, 'cat'); if ( count( $term_list ) > 0 ): ?>
                        <li class="post-type-section__post__info-list__info post-type-section__post__info-list__terms artists-section__post__info-list__info artists-section__post__info-list__terms"><!--
                        <?php if ( count( $term_list ) > 1 ): ?>
                            <?php for( $i = 0; $i < count( $term_list ); $i++ ): ?>
                                --><span class="post-type-section__post__info-list__info__term post-type-section__post__info-list__terms__term artists-section__post__info-list__info__term artists-section__post__info-list__terms__term"><?php echo ($i == 0 ? $term_list[$i]->name : ', '.$term_list[$i]->name); ?></span><!--
                            <?php endfor; ?>
                        <?php else: ?>
                            --><span class="post-type-section__post__info-list__info__term post-type-section__post__info-list__terms__term artists-section__post__info-list__info__term artists-section__post__info-list__terms__term"><?php echo $term_list[0]->name; ?></span><!--
                        <?php endif; ?>
                        --></li>
					<?php endif; ?>
                </ul>
            </article>
		<?php endwhile; else: ?>
            <p>
                Il n&rsquo;y a pas encore d&rsquo;articles pour cette section.
            </p>
		<?php endif; ?>
        <a href="<?php echo get_page_link(17); ?>">Tous les artistes</a>
    </section>



<?php get_footer(); ?>