	@if ($posts->isNotEmpty())

    <!-- News Two -->
	<section class="news-two" id="blog">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title light centered">
				<div class="sec-title_title">@t('sections', 'post.small_title')</div>
				<div class="sec-title_big-title">@t('sections', 'post.big_title')</div>
				<h2 class="sec-title_heading">@t('sections', 'post.heading')</h2>
			</div>
			<div class="row clearfix">

				<!-- News Block One -->
                @foreach ($posts as $post)
                    <div class="news-block_two col-lg-6 col-md-6 col-sm-12">
                        <div class="news-block_two-inner">
                            <div class="news-block_two-image">
                                <a href="blog-detail.html"><img src="{{ $post->image_url }}" alt="{{ $post->title }}" /></a>
                            </div>
                            <div class="news-block_two-content">
                                <div class="news-block_two-title">{{ $post->category }} <span>{{ $post->published_at?->format('F d, Y') }}</span></div>
                                <h4 class="news-block_two-heading"><a href="blog-detail.html">{{ $post->title }}</a></h4>
                            </div>
                        </div>
                    </div>
                @endforeach



			</div>
		</div>
	</section>
	<!-- End News Two -->

    @endif
