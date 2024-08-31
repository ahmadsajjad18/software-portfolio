
<section class="section" id="portfolio">
    <div class="container text-center">
        <p class="section-subtitle">What I Did ?</p>
        <h6 class="section-title mb-6">Portfolio</h6>
        <!-- row -->

        <div class="row">
            @foreach($portfolios as $portfolio)
                <div class="col-md-4">
                    <a href="{{ $portfolio->url }}" class="portfolio-card">
                        <img src="{{ asset('storage/' . $portfolio->image) }}" class="portfolio-card-img"
                             alt="Download free bootstrap 4 landing page, free boootstrap 4 templates, Download free bootstrap 4.1 landing page, free boootstrap 4.1.1 templates, meyawo Landing page">
                        <span class="portfolio-card-overlay">
                                <span class="portfolio-card-caption">
                                    <h5>{{ $portfolio->name }}</h5>
                                        <p class="font-weight-normal">Category: {{ $portfolio->category }}</p>
                                </span>
                            </span>
                    </a>
                </div>
            @endforeach

        </div><!-- end of row -->
    </div><!-- end of container -->
</section>
