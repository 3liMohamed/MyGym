<!-- Main Footer -->
<footer class="main-footer style-two">
    <div class="main-footer_image" style="background-image:url(assets/images/background/footer-bg.jpg)"></div>
    <div class="auto-container">
        <!-- Widgets Section -->
        <div class="widgets-section">
            <div class="row clearfix">

                <!-- Big Column -->
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">

                        <!-- Footer Column -->
                        <div class="footer_column col-lg-7 col-md-6 col-sm-12">
                            <div class="footer-widget logo-widget">
                                <div class="footer-logo"><a href="@route('home')"><img
                                            src="@settingAsset('logo:light')" alt="@setting('site:name')"
                                            title="@setting('site:name')"></a></div>
                                <div class="footer-text">@t('sections', 'footer.description')</div>
                                <!-- Social Box -->
                                <div class="footer-social_box">
                                    @settingAvailable('social:facebook')
                                        <a href="@setting('social:facebook')"><i class="fa-brands fa-facebook-f"></i></a>
                                    @endsettingAvailable

                                    @settingAvailable('social:twitter')
                                        <a href="@setting('social:twitter')"><i class="fa-brands fa-twitter"></i></a>
                                    @endsettingAvailable

                                    @settingAvailable('social:youtube')
                                        <a href="@setting('social:youtube')"><i class="fa-brands fa-youtube"></i></a>
                                    @endsettingAvailable

                                    @settingAvailable('social:instagram')
                                        <a href="@setting('social:instagram')"><i class="fa-brands fa-instagram"></i></a>
                                    @endsettingAvailable
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Big Column -->
                <div class="big-column col-lg-6 col-md-12 col-sm-12">
                    <div class="row clearfix">

                        <!-- Footer Column -->
                        <div class="footer_column col-lg-6 col-md-6 col-sm-12">
                            <div class="footer-widget links-widget">
                                <h3 class="footer-title">CONTACT</h3>
                                @settingAvailable('contact:address')
                                    <div class="contact-text">@setting('contact:address')</div>
                                @endsettingAvailable
                                <ul class="footer-contact_list">
                                    @settingAvailable('contact:phone')
                                        <li>Phone:<a href="tel:@setting('contact:phone')"> @setting('contact:phone')</a></li>
                                    @endsettingAvailable

                                    @settingAvailable('contact:email')
                                        <li>EMAIL:<a href="mailto:@setting('contact:email')"> @setting('contact:email')</a></li>
                                    @endsettingAvailable
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="footer-bottom">
            <!-- Copyright -->
            <div class="main-footer_copyright">2026 &copy; All rights reserved. Designed & Developed by Ali Mohamed</div>
        </div>

    </div>
</footer>
<!-- End Main Footer -->
