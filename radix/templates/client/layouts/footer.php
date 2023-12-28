<?php

$linkTwitter = 'https://twitter.com/' . getOption('footer_twitter_3');
?>
<!-- Footer -->
<footer id="footer" class="footer wow fadeIn">
    <!-- Top Arrow -->
    <div class="top-arrow">
        <a href="#header" class="btn"><i class="fa fa-angle-up"></i></a>
    </div>
    <!--/ End Top Arrow -->
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- About Widget -->
                    <div class="single-widget about">
                        <h2><?php echo getOption('footer_title_1') ?></h2>
                        <?php echo html_entity_decode(getOption('footer_content_1')) ?>
                        <ul class="list">
                            <li><i class="fa fa-map-marker"></i>Address: <?php echo getOption('general_address') ?></li>
                            <li><i class="fa fa-headphones"></i>Phone: <?php echo getOption('general_hotline') ?></li>
                            <li><i class="fa fa-headphones"></i>Email: <a
                                    href="mailto:<?php echo getOption('general_email') ?>"><?php echo getOption('general_email') ?></a>
                            </li>
                        </ul>
                    </div>
                    <!--/ End About Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Links Widget -->
                    <div class="single-widget links">
                        <h2><?php echo getOption('footer_title_2') ?></h2>
                        <?php

                        $footerLinks = html_entity_decode(getOption('footer_content_2'));
                        $footerLinks = str_replace('<ul>', '', $footerLinks);
                        $footerLinks = str_replace('</ul>', '', $footerLinks);

                        echo '<ul class="list">' . $footerLinks . '</ul>';
                        ?>
                    </div>
                    <!--/ End Links Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Twitter Widget -->
                    <div class="single-widget twitter">
                        <h2><?php echo getOption('footer_title_3') ?></h2>

                        <a class="twitter-timeline" data-height="270" data-theme="dark"
                            href="<?php echo $linkTwitter; ?>"></a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                    <!--/ End Twitter Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Newsletter Widget -->
                    <div class="single-widget newsletter">
                        <h2><?php echo getOption('footer_title_4') ?></h2>
                        <?php echo html_entity_decode(getOption('footer_content_4')) ?>
                        <form>
                            <input placeholder="Your Name" type="text">
                            <input placeholder="your email" type="email">
                            <button type="submit" class="button primary">Subscribe Now!</button>
                        </form>
                    </div>
                    <!--/ End Newsletter Widget -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Top -->
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bottom-top">
                        <!-- Social -->
                        <ul class="social">
                            <li><a target="_blank" href="<?php echo getOption('general_twitter') ?>"><i
                                        class="fa fa-twitter"></i></a></li>
                            <li><a target="_blank" href="<?php echo getOption('general_facebook') ?>"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" href="<?php echo getOption('general_linkedin') ?>"><i
                                        class="fa fa-linkedin"></i></a></li>
                            <li><a target="_blank" href="<?php echo getOption('general_behance') ?>"><i
                                        class="fa fa-behance"></i></a></li>
                            <li><a target="_blank" href="<?php echo getOption('general_youtube') ?>"><i
                                        class="fa fa-youtube"></i></a></li>
                        </ul>
                        <!--/ End Social -->
                        <!-- Copyright -->
                        <div class="copyright">
                            <p>&copy; 2020 All Right Reserved. Design & Development By <a target="_blank"
                                    href="http://themelamp.com">ThemeLamp.com</a>, Theme Provided By <a target="_blank"
                                    href="https://codeglim.com">CodeGlim.com</a></p>
                        </div>
                        <!--/ End Copyright -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Footer Bottom -->
</footer>
<!--/ End footer -->

<!-- Jquery -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/jquery.min.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/jquery-migrate.min.js"></script>
<!-- Popper JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/bootstrap.min.js"></script>
<!-- Colors JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/colors.js"></script>
<!-- Modernizer JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/modernizr.min.js"></script>
<!-- Nice select JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/niceselect.js"></script>
<!-- Tilt Jquery JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/tilt.jquery.min.js"></script>
<!-- Fancybox  -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/jquery.fancybox.min.js"></script>
<!-- Jquery Nav -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/jquery.nav.js"></script>
<!-- Owl Carousel JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/owl.carousel.min.js"></script>
<!-- Slick Slider JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/slickslider.min.js"></script>
<!-- Cube Portfolio JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/cubeportfolio.min.js"></script>
<!-- Slicknav JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/jquery.slicknav.min.js"></script>
<!-- Jquery Steller JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/jquery.stellar.min.js"></script>
<!-- Magnific Popup JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/magnific-popup.min.js"></script>
<!-- Wow JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/wow.min.js"></script>
<!-- CounterUp JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/jquery.counterup.min.js"></script>
<!-- Waypoint JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/waypoints.min.js"></script>
<!-- Jquery Easing JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/easing.min.js"></script>
<!-- Google Map JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnhgNBg6jrSuqhTeKKEFDWI0_5fZLx0vM"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/gmap.min.js"></script>
<!-- Main JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/client/js/main.js?ver=<?php echo rand() ?>"></script>
</body>

</html>