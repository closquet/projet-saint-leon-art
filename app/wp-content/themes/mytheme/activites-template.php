<?php
/*
 * Template Name: Les activités
 */
?>

<?php get_header(); ?>
<?php
$cat = null;
$date = null;
$place = null;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

isset($_REQUEST['cat']) && $_REQUEST['cat'] != '' && $cat = $_REQUEST['cat'];
isset($_REQUEST['date']) && $_REQUEST['date'] != '' && $date = $_REQUEST['date'];
isset($_REQUEST['place']) && $_REQUEST['place'] != '' && $place = $_REQUEST['place'];

$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = ec_get_posts_from_filters( $cat, $date, $place, $paged, 'activites');
?>

<h1 class="current-page-title" role="heading" aria-level="1">
    <span>
        <?php the_title() ?> (<?= $wp_query->found_posts ?>)
    </span>
</h1>
<div class="content">
    <div class="main-section  main-section--alone-on-top">
        <form class="main-section__filters-form container" method="get" action="">
        <input type="hidden" name="page_id" value="13">
        <input type="hidden" name="paged" value="1">
            <div class="main-section__filters-form__item">
                <div class="main-section__filters-form__field-container">
                    <label class="main-section__filters-form__field-container__label" for="cat-field">La catégorie</label>
		            <?php
		            $arg = [
			            'taxonomy' => 'cat',
			            'hide_empty' => false,
			            'field'    => 'slug',
		            ];
		            $cat_terms = get_terms($arg);
		            ?>
                    <select class="main-section__filters-form__field-container__field" name="cat" id="cat-field">
                        <option value="">Toutes</option>
			            <?php foreach($cat_terms as $cat_term): ?>
                            <option value="<?= $cat_term->slug ?>"<?= $cat_term->slug === $cat ? ' selected' : '' ?>><?= $cat_term->name ?></option>
			            <?php endforeach; ?>
                    </select>
                </div>
                <button class="main-section__filters-form__field-container__reset-field-button" title="&#10148; Vider le champ catégorie!" onclick="document.getElementById('cat-field').selectedIndex=0; return false">
                    <span class="visually-hidden">Vider le champ Catégorie!</span>
                    <svg class="main-section__filters-form__field-container__reset-field-button-icon"
                         version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                    <g class="main-section__filters-form__field-container__reset-field-button-icon__cross" id="cross">
                        <line x1="7.1" y1="7.1" x2="16.9" y2="16.9"/>
                        <line x1="16.9" y1="7.1" x2="7.1" y2="16.9"/>
                    </g>
                        <g class="main-section__filters-form__field-container__reset-field-button-icon__circle" id="circle">
                            <path d="M12,1c6.1,0,11,4.9,11,11s-4.9,11-11,11S1,18.1,1,12S5.9,1,12,1 M12,0C5.4,0,0,5.4,0,12s5.4,12,12,12s12-5.4,12-12S18.6,0,12,0L12,0z"/>
                        </g>
                </svg>
                </button>
            </div>

            <div class="main-section__filters-form__item">
                <div class="main-section__filters-form__field-container">
                    <label class="main-section__filters-form__field-container__label" for="place-field">Le lieu</label>
		            <?php
		            $arg = [
			            'taxonomy' => 'places',
			            'hide_empty' => false,
			            'field'    => 'slug',
		            ];
		            $place_terms = get_terms($arg);
		            ?>
                    <select class="main-section__filters-form__field-container__field" name="place" id="place-field">
                        <option value="">Tous</option>
			            <?php foreach($place_terms as $place_term): ?>
                            <option value="<?= $place_term->slug ?>"<?= $place_term->slug === $place ? ' selected' : '' ?>><?= $place_term->name ?></option>
			            <?php endforeach; ?>
                    </select>
                </div>
                <button class="main-section__filters-form__field-container__reset-field-button" title="&#10148; Vider le champ lieu!" onclick="document.getElementById('place-field').selectedIndex=0; return false">
                    <span class="visually-hidden">Vider le champ Lieu!</span>
                    <svg class="main-section__filters-form__field-container__reset-field-button-icon"
                         version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                    <g class="main-section__filters-form__field-container__reset-field-button-icon__cross" id="cross">
                        <line x1="7.1" y1="7.1" x2="16.9" y2="16.9"/>
                        <line x1="16.9" y1="7.1" x2="7.1" y2="16.9"/>
                    </g>
                        <g class="main-section__filters-form__field-container__reset-field-button-icon__circle" id="circle">
                            <path d="M12,1c6.1,0,11,4.9,11,11s-4.9,11-11,11S1,18.1,1,12S5.9,1,12,1 M12,0C5.4,0,0,5.4,0,12s5.4,12,12,12s12-5.4,12-12S18.6,0,12,0L12,0z"/>
                        </g>
                </svg>
                </button>
            </div>

            <div class="main-section__filters-form__item">
                <div class="main-section__filters-form__field-container date">
                    <label class="main-section__filters-form__field-container__label date" for="date-field">La date</label>
                    <input class="main-section__filters-form__field-container__field" type="date" name="date" id="date-field" value="<?= $date??'' ?>">
                </div>
                <button class="main-section__filters-form__field-container__reset-field-button" title="&#10148; Vider le champ date!" onclick="document.getElementById('date-field').value=''; return false">
                    <span class="visually-hidden">Vider le champ Date!</span>
                    <svg class="main-section__filters-form__field-container__reset-field-button-icon"
                         version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                    <g class="main-section__filters-form__field-container__reset-field-button-icon__cross" id="cross">
                        <line x1="7.1" y1="7.1" x2="16.9" y2="16.9"/>
                        <line x1="16.9" y1="7.1" x2="7.1" y2="16.9"/>
                    </g>
                        <g class="main-section__filters-form__field-container__reset-field-button-icon__circle" id="circle">
                            <path d="M12,1c6.1,0,11,4.9,11,11s-4.9,11-11,11S1,18.1,1,12S5.9,1,12,1 M12,0C5.4,0,0,5.4,0,12s5.4,12,12,12s12-5.4,12-12S18.6,0,12,0L12,0z"/>
                        </g>
                </svg>
                </button>
            </div>
            
            <div class="btn1-container main-section__filters-form__submit-container">
                <button class="btn1">
                    Filtrer
                </button>
            </div>
        </form>
        
        <div class="main-section__posts-container container">
			<?php if( $wp_query->have_posts() ): while( $wp_query->have_posts() ): $wp_query->the_post();?>
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
			<?php endwhile; else: ?>
                <p class="main-section__posts-container__no-result">
                    Aucun résultat &#9785;
                </p>
			<?php endif; ?>
        </div>
	    <?php if ( $wp_query->found_posts > 3 ):
            $paged == $wp_query->max_num_pages ? $next = false : $next = true;
            $paged == 1 ? $previous = false : $previous = true;
            ?>
            <nav class="main-section__pagination">
	            <?php if($previous): ?>
                    <a class="main-section__pagination__link previous btn1" href="/activites/page/<?= $paged-1 . '/?' ?><?php echo 'place='.$place??''; echo '&cat='.$cat??''; echo '&date='.$date??''; ?>">Précédent</a>
	            <?php else: ?>
                    <span class="main-section__pagination__link previous btn1 disable">Précédent</span>
	            <?php endif; ?>
                <span class="main-section__pagination__current-page"><?= $paged ?></span>
	            <?php if($next): ?>
                    <a class="main-section__pagination__link next btn1" href="/activites/page/<?= $paged+1 . '/?' ?><?php echo 'place='.$place??''; echo '&cat='.$cat??''; echo '&date='.$date??''; ?>">Suivant</a>
	            <?php else: ?>
                    <sapn class="main-section__pagination__link next btn1 disable">Suivant</sapn>
	            <?php endif; ?>
            </nav>
	    <?php endif; ?>
    </div>
</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
