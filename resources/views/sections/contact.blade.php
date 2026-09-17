	@settingAvailable('contact:email')
            <!-- Discuss One -->
            <section class="discuss-one" id="{{ $section }}">
                <div class="auto-container">
                    <h1 class="discuss-one_title">@t('sections', 'contact.title')</h1>
                    <div class="discuss-one_button">
                        <a class="discuss-one_contact" href="mailto:@setting('contact:email')">
                            <span></span>
                            <div class="content">
                                <i class="flaticon-arrow-pointing-to-right"></i>
                                @t('sections', 'contact.content')

                            </div>
                        </a>
                    </div>
                </div>
            </section>
            <!-- End Discuss One -->
    @endsettingAvailable


