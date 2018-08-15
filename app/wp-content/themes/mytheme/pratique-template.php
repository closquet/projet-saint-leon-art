<?php
/*
 * Template Name: Pratique
 */
?>
<?php get_header(); ?>
    <div class="pratique-page-content content">
        <h1 class="current-page-title" role="heading" aria-level="1">
            <span>
                <?php the_title() ?>
            </span>
        </h1>
        <section class="main-section course-section main-section--alone-on-top" aria-labelledby="course-section__title">
            <h2 class="main-section__title" id="course-section__title" role="heading" aria-level="2">
                <span>
                    Le parcours
                </span>
            </h2>
            <div class="course-section__content container">
	            <?php if( have_rows('course-section') ): while ( have_rows('course-section') ) : the_row(); ?>
                    <div class="course-section__intro">
			            <?= get_sub_field('course-section-introduction') ?>
                    </div>
                    <div class="course-section__map-container">
                        <iframe class="course-section__map" src="https://www.google.com/maps/d/embed?mid=1dIVQEQhE3B0_RrDE8CcBN3J2w9o&z=14"></iframe>
                    </div>
	            <?php endwhile; endif; ?>
            </div>
        </section>
        <div class="parking-and-tec-container container">
            <section class="main-section parking-section" aria-labelledby="parking-section__title">
                <h2 class="main-section__title main-section__title--no-bar" id="parking-section__title" role="heading" aria-level="2">
                <span>
                    Parking
                </span>
                </h2>
                <div class="parking-section__content ">
			        <?php if( have_rows('parking-section') ): while ( have_rows('parking-section') ) : the_row(); ?>
                        <div class="parking-section__intro">
					        <?= get_sub_field('parking-section-introduction') ?>
                        </div>
                        <ul class="parking-section__parking-list">
					        <?php if( have_rows('parking-list') ): while ( have_rows('parking-list') ) : the_row(); ?>
                                <li class="parking-section__parking-list__parking">
							        <?= get_sub_field('parking-name') ?>
                                </li>
					        <?php endwhile; endif; ?>
                        </ul>
			        <?php endwhile; endif; ?>
                </div>
            </section>

            <section class="main-section tec-section" aria-labelledby="tec-section__title">
                <h2 class="main-section__title main-section__title--no-bar" id="tec-section__title" role="heading" aria-level="2">
                <span>
                    Transports en commun
                </span>
                </h2>
                <div class="tec-section__content ">
			        <?php if( have_rows('tec-section') ): while ( have_rows('tec-section') ) : the_row(); ?>
                        <div class="tec-section__intro">
					        <?= get_sub_field('tec-section-introduction') ?>
                        </div>
                        <ul class="tec-section__tec-list">
					        <?php if( have_rows('tec-list') ): while ( have_rows('tec-list') ) : the_row(); ?>
                                <li class="tec-section__tec-list__tec">
							        <?= get_sub_field('tec-name') ?>
                                </li>
					        <?php endwhile; endif; ?>
                        </ul>
			        <?php endwhile; endif; ?>
                </div>
            </section>
        </div>
        
    </div>
<?php get_footer(); ?>