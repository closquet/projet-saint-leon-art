<?php
/*
 * Template Name: Contacter
 */
?>

<?php get_header(); ?>
    <div class="content">
        <h1 class="current-page-title" role="heading" aria-level="1">
            <span>
                <?php the_title() ?>
            </span>
        </h1>
        <section class="main-section contact-form-section main-section--alone-on-top" aria-labelledby="contact-form-section__title">
            <h2 class="main-section__title" id="contact-form-section__title" role="heading" aria-level="2">
                <span>
                    Formulaire de contact
                </span>
            </h2>
            <div class="contact-form-section__content container">
                <div class="contact-form-section__content__left">
                    <div class="contact-form-section__intro">
		                <?= get_field('contact-form-introduction') ?>
                    </div>
                    <div class="contact-form-section__form-container">
                        <?= get_field('contact-form') ?>
                    </div>
                </div>
                <div class="contact-form-image-container">
                    <img class="contact-form-image" <?= ec_get_image_attr_from_acf_field('740_prev', get_field('contact-form-image')) ?>>
                </div>
            </div>
            
        </section>

        <section class="main-section contact-info-section" aria-labelledby="contact-info-section__title">
            <h2 class="main-section__title" id="contact-info-section__title" role="heading" aria-level="2">
                <span>
                    Information de contact
                </span>
            </h2>
            <div class="contact-info-section__content container">
                <div class="contact-info-section__content__left">
                    <div class="contact-info-section__intro">
					    <?= get_field('contact-info-introduction') ?>
                    </div>
                </div>
                <div class="contact-info-section__contact-list">
	                <?php if( have_rows('contact-info') ): while ( have_rows('contact-info') ) : the_row(); ?>
                        <ul class="contact-list__contact__info-list">
                            <li class="contact-list__contact__info-list__item
                                       contact-list__contact__info-list--name">
                                <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="main-section__post__info-list__person-icon">
                                    <path d="M12,12c2.2,0,4-1.8,4-4s-1.8-4-4-4S8,5.8,8,8S9.8,12,12,12z M12,14c-2.7,0-8,1.3-8,4v2h16v-2C20,15.3,14.7,14,12,14z"></path>
                                </svg><?php the_sub_field('contact-info-name') ?>
                            </li>
                            <li class="contact-list__contact__info-list__item
                                       contact-list__contact__info-list__item--address">
                                <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="main-section__post__info-list__place-icon">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                </svg><?php the_sub_field('contact-info-address') ?>
                            </li>
			                <?php if(get_sub_field('contact-info-phone')): ?>
                                <li class="contact-list__contact__info-list__item
                                       contact-list__contact__info-list__item--phone">
                                    <a class="link" href="tel:<?php the_sub_field( 'contact-info-phone' ) ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__phone-icon">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg><?php the_sub_field('contact-info-phone') ?>
                                    </a>
                                </li>
			                <?php endif; ?>
			                <?php if(get_sub_field('contact-info-email')): ?>
                                <li class="contact-list__contact__info-list__item
                                           contact-list__contact__info-list__item--email">
                                    <a class="link" href="mailto:<?php the_sub_field( 'contact-info-email' ) ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="main-section__post__info-list__email-icon">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg><?php the_sub_field('contact-info-email') ?>
                                    </a>
                                </li>
			                <?php endif; ?>
                        </ul>
	                <?php endwhile; endif; ?>
                 
                </div>
            </div>

        </section>
    </div>
<?php get_footer(); ?>