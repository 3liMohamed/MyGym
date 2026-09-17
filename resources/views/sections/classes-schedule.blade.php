@if ($classesByDay->isNotEmpty())
    <section class="classes-one" id="{{ $section }}">
        <div class="auto-container">
            <div class="sec-title centered light">
                <div class="sec-title_title">@t('sections', 'classes.small_title')</div>
                <div class="sec-title_big-title">@t('sections', 'classes.big_title')</div>
                <h2 class="sec-title_heading">@t('sections', 'classes.heading')</h2>
            </div>

            <div class="inner-container">
                <div class="classes-info-tabs">
                    <div class="classes-tabs tabs-box">

                        <ul class="tab-btns tab-buttons clearfix">
                            @foreach ($activeDays as $day)
                                <li data-tab="#day-{{ $day->slug() }}"
                                    class="tab-btn {{ $loop->first ? 'active-btn' : '' }}">
                                    {{ $day->getLabel() }}
                                </li>
                            @endforeach
                        </ul>

                        <div class="tabs-content">
                            @foreach ($activeDays as $day)
                                @php($dayClasses = $classesByDay->get($day->value, collect()))

                                <div class="tab {{ $loop->first ? 'active-tab' : '' }}" id="day-{{ $day->slug() }}">
                                    <div class="content">
                                        @foreach ($dayClasses as $class)
                                            <div class="classes-block_one">
                                                <div
                                                    class="classes-block_one-inner d-flex align-items-center flex-wrap">
                                                    <div class="classes-block_one-class">1st <br> Class</div>
                                                    <div class="classes-block_one-content">
                                                        <div class="row clearfix">
                                                            <div class="column col-lg-4 col-md-4 col-sm-6">
                                                                <div class="title">{{ __('system.field.name') }}
                                                                    <span>{{ $class->name }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="column col-lg-4 col-md-4 col-sm-6">
                                                                <div class="title">{{ __('system.field.time') }}
                                                                    <span>{{ $class->time_range }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="column col-lg-4 col-md-4 col-sm-6">
                                                                <div class="title">{{ __('system.field.instructor') }}
                                                                    <span>{{ $class->instructor }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if ($cta)
    <!-- CTA Two -->
    <section class="cta-two">
        <div class="cta-two_image-layer" style="background-image:url({{ $cta->image_url }})"></div>
        <div class="auto-container">
            <div class="inner-container">
                <div class="cta-two_title">{{ $cta->small_title }}</div>
                <h1 class="cta-two_heading">{{ $cta->big_title }}</h1>
                @if ($cta->items->isNotEmpty())
                    <ul class="cta-two_list">
                        @foreach ($cta->items as $item)
                            <li><i class="flaticon-star-1"></i>{{ $item->text }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>
    <!-- End CTA Two -->
@endif
