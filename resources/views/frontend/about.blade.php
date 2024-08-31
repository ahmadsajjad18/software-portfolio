<section class="section pt-0" id="about">
    <!-- container -->
    <div class="container text-center">
        <!-- about wrapper -->
        <div class="about">
            <div class="about-img-holder image-upload-container">
                <img src="{{ asset('storage/' . $about->profile_image) }}" class="about-img rounded-full shadow-2xl" alt="Profile Image">
            </div>
            <div class="about-caption">
                <p class="section-subtitle">Who Am I ?</p>
                <h2 class="section-title mb-3">About Me</h2>
                <p>
                    {{ $about->description }}
                </p>
                @if($about->user_cv)
                    <a href="{{ route('about.download-cv') }}" class="btn-rounded btn btn-outline-primary mt-4">Download CV</a>
                @else
                    <span class="text-red-500">No CV Available</span>
                @endif
            </div>
        </div><!-- end of about wrapper -->
    </div><!-- end of container -->
</section>
