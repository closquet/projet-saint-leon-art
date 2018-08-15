        <?php wp_footer(); ?>
        </main>
        <?php $cta = get_field('cta-text'); ?>
        <?php global $page_ID; if(get_field('cta-enable', $page_ID)): ?>
            <div class="cta">
                <div class="cta-backgroung-visibility">
                    <p class="p-summary cta__teasing container">
				        <?php the_field( 'cta-text', $page_ID); ?>
                    </p>
                    <div class="btn1-container cta__link-container">
                        <a class="btn1 cta__link" href="<?php the_field( 'cta-link-url', $page_ID); ?>">
					        <?php the_field( 'cta-link-title', $page_ID); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <footer class="site-footer">
            <div class="top">
                <section class="newsletter-section container" aria-labelledby="newsletter-section__title">
                    <h2 class="newsletter-section__title" id="newsletter-section__title" role="heading" aria-level="2">
                        S&rsquo;inscrire à la newsletter
                    </h2>
                    <!-- Begin MailChimp Signup Form -->
                    <div id="mc_embed_signup">
                        <div class="newsletter-section__form">
	                        <?php the_field( 'newsletter', 303) ?>
                        </div>
                    </div>
                    <!--End mc_embed_signup-->
                </section>
                <section class="footer-info-and-links-section" aria-labelledby="footer-info-and-links-section__title">
                    <h2 class="footer-info-and-links-section__title visually-hidden" id="footer-info-and-links-section__title" role="heading" aria-level="2">
                        Réseaux sociaux
                    </h2>
                    <ul class="footer-info-and-links-section__links-list">
			            <?php foreach (wp_get_nav_menu_items(ec_get_nav_id('footer')) as $item): ?>
                            <li class="footer-info-and-links-section__links-list__item footer-info-and-links-section__links-list__item--<?= lcfirst($item->title) ?>">
                                <a class="footer-info-and-links-section__links-list__item__link footer-info-and-links-section__links-list__item__link--<?= lcfirst($item->title) ?>" href="<?= $item->url ?>"><?= $item->title ?></a>
                            </li>
			            <?php endforeach; ?>
                    </ul>
                </section>
            </div>
            <div class="bottom">
                <div class="footer__partners-list-container">
                    <div class="footer__partners-list container">
		                <?php $partners = get_field( 'partners', 66); ?>
		                <?php foreach ( $partners as $partner ) : ?>
                            <a class="footer__partners-list__partner" href="<?= get_sub_field('partner-url'); ?>" title="Se rendre sur le site web de&nbsp;: <?= $partner['partner-name'] ?>">
				                <?php
				                $size = 'logo';
				                $svg_width = 150;
				                $img = $partner['partner-logo'];
				                $img_width = $img['sizes'][$size . '-width'] > 1 ? 'width="' . $img['sizes'][$size . '-width'] . '"' : 'width="'. $svg_width .'"';
				                $img_height = $img['sizes'][$size . '-height'] > 1 ? 'height="' . $img['sizes'][$size . '-height'] . '"' : '';
				                $img_src = 'src="' . $img['sizes'][$size] . '"';
				                ?>
                                <img class="footer__partners-list__partner-logo" <?= $img_src . ' ' . $img_width . ' ' . $img_height ?>>
                            </a>
		                <?php endforeach;?>
                    </div>
                </div>
                <p class="footer-info-and-links-section__copyright">
                    &copy; 2018 - Saint Léon'art designed by <a class="link" href="https://eric-closquet.be">Eric Closquet</a>
                </p>
            </div>
            
           
        </footer>
        <script src="<?php ec_asset('js/jquery-3.3.1.min.js');?>"></script>
        <script src="<?php ec_asset('js/easeScroll.js');?>"></script>
        <script src="<?php ec_asset('js/app.js');?>"></script>
    </body>
</html>
