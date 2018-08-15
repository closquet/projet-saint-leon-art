<?php
/*
 * Template Name: À propos
 */
?>


<?php get_header(); ?>
<div class="content">
    <h1 class="current-page-title" role="heading" aria-level="1">
        <span>
            <?php the_title() ?>
        </span>
    </h1>
    <section class="main-section description-section main-section--alone-on-top" aria-labelledby="description-section__title">
        <h2 class="main-section__title" id="description-section__title" role="heading" aria-level="2">
            <span>
                Description
            </span>
        </h2>
        <div class="description-section__content container">
            <div class="description-section__content__text">
                <?= get_field('description')['description-text'] ?>
            </div>
            <div class="description-section__content__image-container">
                <img class="description-section__content__image-container__image" <?= ec_get_image_attr_from_acf_field('740_prev', get_field('description')['description-image']) ?>>
            </div>
        </div>
    </section>
    <?php if(get_field( 'organizers-enable')): ?>
        <section class="main-section" aria-labelledby="organizers-section__title">
            <h2 class="main-section__title" id="organizers-section__title" role="heading" aria-level="2">
                <span>
                    Les organisateurs
                </span>
            </h2>
            <div class="main-section__content container">
                <div class="main-section__content__organizers-list">
                    <?php if( have_rows('organizers') ): while ( have_rows('organizers') ) : the_row(); ?>
                        <div class="main-section__content__organizers-list__organizer">
                            <div class="main-section__content__organizers-list__organizer__info-container">
                                <h3 class="main-section__content__organizers-list__organizer__info-container__name"
                                    role="heading" aria-level="3">
                                    <?php the_sub_field('organizer-name') ?>
                                </h3>
	                            <?php if(get_sub_field('organizer-info-enable')): ?>
                                    <ul class="main-section__content__organizers-list__organizer__info-container__url-and-other-list">
	                                    <?php if(get_sub_field('organizer-phone')): ?>
                                            <li class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__item
                                                main-section__content__organizers-list__organizer__info-container__url-and-other-list__item--phone">
                                                <a class="link" href="tel:<?php the_sub_field( 'organizer-phone' ) ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__phone-icon">
                                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                    </svg><?php the_sub_field('organizer-phone') ?>
                                                </a>
                                            </li>
	                                    <?php endif; ?>
	                                    <?php if(get_sub_field('organizer-email')): ?>
                                            <li class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__item
                                                main-section__content__organizers-list__organizer__info-container__url-and-other-list__item--email">
                                                <a class="link" href="mailto:<?php the_sub_field( 'organizer-email' ) ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__email-icon">
                                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                        <polyline points="22,6 12,13 2,6"></polyline>
                                                    </svg><?php the_sub_field('organizer-email') ?>
                                                </a>
                                            </li>
	                                    <?php endif; ?>
	
	                                    <?php if( have_rows('organizer-url') ): while ( have_rows('organizer-url') ) : the_row(); ?>
                                            <li class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__item
                                                main-section__content__organizers-list__organizer__info-container__url-and-other-list__item--other-url">
                                                <a class="link" href="<?= get_sub_field('organizer-url-address') ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"fill="none" stroke="currentColor"
                                                         stroke-width="2" class="other-link-icon">
                                                        <path class="st0" d="M9.8,6.5H5.9C3.2,6.5,1.1,9,1.1,12s2.2,5.5,4.8,5.5h3.9 M14.2,17.5h3.9c2.7,0,4.8-2.5,4.8-5.5s-2.2-5.5-4.8-5.5h-3.9 M16.4,11.8H7.6"/>
                                                    </svg><?= get_sub_field('organizer-url-title') ?>
                                                </a>
                                            </li>
	                                    <?php endwhile; endif; ?>
                                    </ul>
	                            <?php endif; ?>
                            </div>
                            <div>
                                <div class="main-section__content__organizers-list__organizer__image-container">
                                    <img class="main-section__content__organizers-list__organizer__image-container__image" <?= ec_get_image_attr_from_acf_field('avatar', get_sub_field('organizer-image')) ?>>
                                </div>
                            </div>
                           
                                <div class="main-section__content__organizers-list__organizer__introduction">
	                            <?php if(get_sub_field('organizer-introduction')): ?>
			                        <p>
                                        <?php the_sub_field('organizer-introduction') ?>
                                    </p>
                                <?php endif; ?>
	                                <?php
	                                $facebook = get_sub_field('organizer-facebook');
	                                $twitter = get_sub_field('organizer-twitter');
	                                $instagram = get_sub_field('organizer-instagram');
	                                if($facebook || $twitter || $instagram): ?>
                                        <ul class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list">
			                                <?php if(get_sub_field('organizer-facebook')): ?>
                                                <li class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__item
                                            main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__item--facebook">
                                                    <a class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__link
                                                            main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__link--facebook"
                                                       href="<?= get_sub_field('organizer-facebook') ?>">
                                                        <span class="visually-hidden">Facebook</span>
                                                    </a>
                                                </li>
			                                <?php endif; ?>
			                                <?php if(get_sub_field('organizer-twitter')): ?>
                                                <li class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__item
                                            main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__item--twitter">
                                                    <a class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__link
                                                            main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__link--twitter"
                                                       href="<?= get_sub_field('organizer-twitter') ?>">
                                                        <span class="visually-hidden">Twitter</span>
                                                    </a>
                                                </li>
			                                <?php endif; ?>
			                                <?php if(get_sub_field('organizer-instagram')): ?>
                                                <li class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__item
                                            main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__item--instagram">
                                                    <a class="main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__link
                                                            main-section__content__organizers-list__organizer__info-container__url-and-other-list__social-links-list__link--instagram"
                                                       href="<?= get_sub_field('organizer-instagram') ?>">
                                                        <span class="visually-hidden">Instagram</span>
                                                    </a>
                                                </li>
			                                <?php endif; ?>
                                        </ul>
	                                <?php endif; ?>
                                </div>
	                        
                        </div>
                    <?php endwhile; endif; ?>
                    
                </div>
            </div>
        </section>
    <?php endif; ?>
	
	<?php if(have_rows( 'press-area')): while( have_rows('press-area') ) : the_row(); ?>
        <section class="main-section press-area-section" aria-labelledby="press-area-section__title">
            <h2 class="main-section__title" id="press-area-section__title" role="heading" aria-level="2">
                <span>
                    Et la presse&nbsp;?
                </span>
            </h2>
            <div class="main-section__content container">
                <div class="press-area-section__content__intro">
                    <div class="press-area-section__content__intro__text">
		                <?= get_sub_field('press-area-introduction') ?>
                    </div>
                    <div class="press-area-section__content__intro__image-container">
                        <img class="press-area-section__content__intro__image-container__image" <?= ec_get_image_attr_from_acf_field('740_prev_banner', get_sub_field('press-area-image') ) ?>>
                    </div>
                </div>
	            <?php if( have_rows('press-area-post') ): ?>
                    <div class="press-area-section__content__posts">
                        <h3 class="press-area-section__content__posts__title" role="heading" aria-level="3">
                            <span>
                               Les articles de presse
                            </span>
                        </h3>
                        <div class="press-area-section__content__posts-content">
	                        <?php while( have_rows('press-area-post') ) : the_row(); ?>
                                <div class="press-area-section__content__posts__post">
                                    <h4 class="press-area-section__content__posts__post__title" role="heading" aria-level="4">
				                        <?= get_sub_field('press-area-post-title') ?>
                                    </h4>
	                                <?php if( get_sub_field('press-area-post-description') ): ?>
                                        <p class="press-area-section__content__posts__post__description">
			                                <?= get_sub_field('press-area-post-description') ?>
                                        </p>
	                                <?php endif; ?>
	                                <?php if( get_sub_field('press-area-post-file') ): ?>
                                        <div>
			                                <?php $file = get_sub_field('press-area-post-file') ?>
                                            <a type="<?= $file['mime_type'] ?>"
                                               class="link"
                                               href="<?= $file['url'] ?>"
                                               title="Télécharger le fichier <?= $file['filename'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"fill="currentColor" stroke="none"
                                                     stroke-width="2" class="other-link-icon">
                                                    <path d="M19.4,9c-0.7-3.4-3.7-6-7.4-6C9.1,3,6.6,4.6,5.3,7C2.3,7.4,0,9.9,0,13c0,3.3,2.7,6,6,6h13c2.8,0,5-2.2,5-5	C24,11.4,22,9.2,19.4,9z M17,12l-5,5l-5-5h3V8h4v4H17z"/>
                                                </svg><?= $file['title'] ?></a> (fichier «&nbsp;<?= str_replace( $file['name'] . '.', '', $file['filename']) ?>&nbsp;» de <?= intval($file['filesize']/1024) ?> Ko)
                                        </div>
	                                <?php endif; ?>
	                                <?php if( get_sub_field('press-area-post-url') ): ?>
                                        <div>
			                                <?php $url = get_sub_field('press-area-post-url') ?>
                                            <a title="Lire l'article&nbsp;: «&nbsp;<?= get_sub_field('press-area-post-title') ?>&nbsp;» (Site extern)"
                                               class="link"
                                               href="<?= $url ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"fill="none" stroke="currentColor"
                                                     stroke-width="2" class="other-link-icon">
                                                    <path class="st0" d="M9.8,6.5H5.9C3.2,6.5,1.1,9,1.1,12s2.2,5.5,4.8,5.5h3.9 M14.2,17.5h3.9c2.7,0,4.8-2.5,4.8-5.5s-2.2-5.5-4.8-5.5h-3.9 M16.4,11.8H7.6"/>
                                                </svg>Lire l'article</a>
                                        </div>
	                                <?php endif; ?>
                                 
                                </div>
	                        <?php endwhile; ?>
                        </div>
                    </div>
		            
	            <?php endif; ?>
            </div>
        </section>
	<?php endwhile; endif; ?>
    
</div>

<?php get_footer(); ?>