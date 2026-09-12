@if ($sliders->isNotEmpty())
    <section class="slider-two" id="{{ $section }}">
        <div class="main-slider swiper-container">
            <div class="swiper-wrapper">

                @foreach ($sliders as $slide)
                    <!-- Slide -->
                    <div class="swiper-slide">
                        <div class="slider-two_image-layer"
                            style="background-image:url('{{ $slide->image_url) }}'"></div>
                        <div class="slider-two_pattern"
                            style="background-image:url('@asset('assets/images/style/slider-two_pattern.png')'">
                        </div>
                        <div class="auto-container">
                            <!-- Content Column -->
                            <div class="slider-two_content d-flex justify-content-end">
                                <div class="slider-two_content-inner">
                                    @if ($slide->title)
                                        <div class="slider-two_title">{{ $slide->title }}</div>
                                    @endif

                                    @if ($slide->heading)
                                        <h1 class="slider-two_heading">
                                            {{ $slide->heading }}
                                            @if ($slide->heading_highlight)
                                                <span>{{ $slide->heading_highlight }}</span>
                                            @endif
                                        </h1>
                                    @endif

                                    <div class="slider-two_button d-flex align-items-center flex-wrap">
                                        @if ($slide->button_url && $slide->button_label)
                                            <a href="{{ $slide->button_url }}" class="theme-btn btn-style-two">
                                                <span class="btn-wrap">
                                                    <span class="text-one">{{ $slide->button_label }} <i
                                                            class="fa-solid fa-plus fa-fw"></i></span>
                                                    <span class="text-two">{{ $slide->button_label }} <i
                                                            class="fa-solid fa-plus fa-fw"></i></span>
                                                </span>
                                            </a>
                                        @endif

                                        @if ($slide->video_url)
                                            <div class="slider-two_video">
                                                <a href="{{ $slide->video_url }}" class="lightbox-video play-box">
                                                    <span class="fa fa-play"></span><i>@t('sections', 'slider.btn-video')</i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- Slider Two Arrows -->
            <div class="slider-two-arrow">
                <div class="main-slider-prev fas fa-arrow-left fa-fw"></div>
                <div class="main-slider-next fas fa-arrow-right fa-fw"></div>
            </div>
        </div>
    </section>
@endif
