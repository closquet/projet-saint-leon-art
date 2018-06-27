        <?php wp_footer(); ?>
        </main>
        <footer>
            <section class=" newsletter-section" aria-labelledby="newsletter-section__title">
                <h2 class="newsletter-section__title" id="newsletter-section__title" role="heading" aria-level="2">
                    S&rsquo;inscrir à la newsletter
                </h2>
                <!-- Begin MailChimp Signup Form -->
                <div id="mc_embed_signup">
                    <form action="https://eric-closquet.us17.list-manage.com/subscribe/post?u=9ba0998c5812e6d9a4c21389e&amp;id=9f577fc4bd" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate>
                        <div id="mc_embed_signup_scroll">
    
                            <div class="mc-field-group">
                                <label for="mce-EMAIL">Votre Email </label>
                                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                            </div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display:none"></div>
                                <div class="response" id="mce-success-response" style="display:none"></div>
                            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_9ba0998c5812e6d9a4c21389e_9f577fc4bd" tabindex="-1" value=""></div>
                            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                        </div>
                    </form>
                </div>
                <!--End mc_embed_signup-->
            </section>
            <section class="footer-info-and-links-section" aria-labelledby="footer-info-and-links-section__title">
                <h2 class="footer-info-and-links-section__title" id="footer-info-and-links-section__title" role="heading" aria-level="2">
                    Liens et informations de bas de page
                </h2>
                <ul class="footer-info-and-links-section__links-list">
                    <?php foreach (wp_get_nav_menu_items(ec_get_nav_id('footer')) as $item): ?>
                        <li class="footer-info-and-links-section__links-list__item">
                            <a class="footer-info-and-links-section__links-list__item__link footer-info-and-links-section__links-list__item__link--<?= $item->title ?>" href="<?= $item->url ?>"><?= $item->title ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="footer-info-and-links-section__copy">
                    &copy;2017 Saint Léon'art designed by <a href="http://eric-closquet.be">Eric Closquet</a>
                </p>
            </section>
        </footer>
        <script src="<?php ec_asset('js/jquery-3.3.1.min.js');?>"></script>
        <script src="<?php ec_asset('js/app.js');?>"></script>
    </body>
</html>
