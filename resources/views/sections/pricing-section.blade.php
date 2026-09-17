@if ($plans->isNotEmpty())
    <!-- Pricing One -->
    <section class="pricing-one" id="{{ $section }}">
        <div class="pricing-one_pattern-layer" style="background-image:url(@galleryImage('sections:plans-bg'))">
        </div>
        <div class="auto-container">
            <div class="sec-title centered light">
                <div class="sec-title_title">@t('sections', 'plans.small_title')</div>
                <div class="sec-title_big-title">@t('sections', 'plans.big_title')</div>
                <h2 class="sec-title_heading">@t('sections', 'plans.heading')</h2>
            </div>
            <div class="row clearfix">

                @foreach ($plans as $plan)
                    <div class="price-block_one col-lg-4 col-md-6 col-sm-12">
                        <div class="price-block_one-inner wow fadeInLeft" data-wow-delay="0ms"
                            data-wow-duration="1500ms">
                            <div class="price-block_one-title">{{ $plan->title }}</div>
                            <div class="price-block_one-price" style="background-image:url({{ $plan->image_url }})">
                                {{ $plan->price }} <span>/MONTH</span>
                            </div>
                            <ul class="price-block_one-list">
                                @foreach ($plan->features as $feature)
                                    <li>{{ $feature->text }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- End Pricing One -->
@endif
@if ($marketingItem->isNotEmpty())
    <!-- Marketing One -->
    <section class="marketing-one">
        <div class="outer-container">
            @foreach ([1, 2] as $animation)
                <div class="animation_mode{{ $animation === 2 ? '-two' : '' }}">

                    @foreach ($marketingItem as $item)
                        <h1 @class(['light' => $item->is_highlighted])>
                            {{ $item->text }}
                        </h1>

                        <span class="marketing-one_icon flaticon-star-1"></span>
                    @endforeach

                </div>
            @endforeach
        </div>
    </section>
    <!-- End Agency One -->
@endif

@if ($choose)

    <!-- Choose One -->
    <section class="choose-one">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Image Column -->
                <div class="choose-one_image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="choose-one_image-outer">
                        <div class="choose-one_image">
                            <span class="choose-one_color-one"></span>
                            <span class="choose-one_color-two"></span>
                            <img src="{{ $choose->image_url }}" alt="{{ $choose->title }}" />
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="choose-one_content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="choose-one_content-outer">
                        <div class="sec-title light">
                            <div class="sec-title_title">@t('sections', 'choose.small_title')</div>
                            <div class="sec-title_big-title">@t('sections', 'choose.big_title')</div>
                            <h2 class="sec-title_heading">{{ $choose->title }}</h2>
                            <div class="sec-title_text">{{ $choose->description }}</div>
                        </div>
                        <ul class="choose-one_list">
                            @foreach ($choose->items as $item)
                                <li>{{ $item->text }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Choose One -->

@endif
