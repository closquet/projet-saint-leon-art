        <?php wp_footer(); ?>
        </main>
        <footer class="site-footer">
            <div class="top">
                <section class="newsletter-section container" aria-labelledby="newsletter-section__title">
                    <h2 class="newsletter-section__title" id="newsletter-section__title" role="heading" aria-level="2">
                        S&rsquo;inscrire à la newsletter
                    </h2>
                    <!-- Begin MailChimp Signup Form -->
                    <div id="mc_embed_signup">
                        <form action="https://eric-closquet.us17.list-manage.com/subscribe/post?u=9ba0998c5812e6d9a4c21389e&amp;id=9f577fc4bd"
                              method="post"
                              id="mc-embedded-subscribe-form"
                              name="mc-embedded-subscribe-form"
                              class="validate newsletter-section__form"
                              novalidate>
                            <div id="mc_embed_signup_scroll">
                                <div class="newsletter-section__form__result" id="result">
                                    L'e-mail n&rsquo;est pas valide.
                                </div>
                                <div class="mc-field-group">
                                    <label for="mce-EMAIL" class="visually-hidden">Votre e-mail </label>
                                    <input type="email" value="" name="EMAIL" class="required email newsletter-section__field" id="mce-EMAIL" placeholder="Votre e-mail">
                                </div>
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_9ba0998c5812e6d9a4c21389e_9f577fc4bd" tabindex="-1" value=""></div>
                                <div class="clear">
                                    <button type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button newsletter-section__submit">
                                    <span class="visually-hidden">
                                        S&rsquo;inscrire
                                    </span>
                                        <svg class="button newsletter-section__submit__icon" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                        <style type="text/css">
                                            .newsletter-section__submit__icon__circle{fill:#861C48;}
                                            .newsletter-section__submit__icon__arrow{fill:none;stroke:#FFFFFF;stroke-width:4;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                                        </style>
                                            <g>
                                                <circle class="newsletter-section__submit__icon__circle" cx="12" cy="12" r="12"/>
                                            </g>
                                            <polyline class="newsletter-section__submit__icon__arrow" points="10.4,6.8 15.6,12 10.4,17.2 "/>
                                    </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
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
                            <a class="footer__partners-list__partner" href="<?= get_sub_field('partner-url'); ?>" title="Se rendre sur le site web de&nbsp;: <?= get_sub_field('partner-name') ?>">
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
