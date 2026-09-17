@if ($about)
    <!-- About Two -->
    <section class="about-two" id="{{ $section }}">
        <div class="auto-container">
            <div class="sec-title light">
                <div class="sec-title_title">@t('sections', 'about.title')</div>
                <div class="sec-title_big-title">@t('sections', 'about.sub_title')</div>
                <h2 class="sec-title_heading">{{ $about->title }}</h2>
            </div>
            <div class="inner-container">
                <div class="row clearfix">

                    <!-- Content Column -->
                    <div class="about-one_content-column col-lg-8 col-md-12 col-sm-12">
                        <div class="about-one_content-outer">
                            <h3 class="about-one_heading">{{ $about->sub_title }}</h3>
                            <p>{{ $about->description }}</p>
                            <div class="row clearfix">
                                <div class="column col-lg-4 col-lg-4 col-sm-12">
                                    <div class="about-two_image">
                                        <img src="{{ $about->image_url }}" alt="{{ $about->title }}" />
                                    </div>
                                </div>
                                <div class="column col-lg-8 col-lg-8 col-sm-12">
                                    <p>{{ $about->paragraph }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="about-two_image-column col-lg-4 col-md-12 col-sm-12">
                        <div class="about-two_image-outer">
                            <div class="about-two_image-two">
                                @galleryAvailable('sections:about')
                                    <img src="@galleryImage('sections:about')" alt="@galleryTitle('sections:about')" />
                                @endgalleryAvailable
                                <div class="about-two_year">@t('sections', 'about.year')</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End About One -->
@endif

@if ($items->isNotEmpty())
    <!-- Fitness One -->
    <section class="fitness-one">
        <div class="outer-container">
            <div class="animation_mode">
                @foreach ($items as $item)
                    <h1 @class(['light' => $item->is_highlighted])>{{ $item->text }}</h1>
                    <span class="fitness-one_icon flaticon-star-1"></span>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Fitness One -->
@endif
