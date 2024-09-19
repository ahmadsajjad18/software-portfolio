<section class="section" id="testmonial">
    <div class="container text-center">
        <p class="section-subtitle">What Do Clients Think About Me?</p>
        <h6 class="section-title mb-6">Testimonials</h6>

        <div id="default-carousel" class="swiper">
            <!-- Carousel wrapper -->
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $testimonial->image ?? 'No image') }}"
                             class="rounded-circle shadow-1-strong mb-4"
                             alt="{{ $testimonial->name }}"
                             style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #695aa6; box-shadow: 0 4px 8px rgba(0.3, 0.3, 0.3, 0.3);" />
                        <div class="text-center">
                            <h5 class="mb-3">{{ $testimonial->name ?? 'No name' }}</h5>
                            <p></p>
                            <div style="border: 1px solid #ddd; padding: 15px; border-radius: 10px; background-color: #f9f9f9; margin: 10px 0;">
                                <p class=" mb-0">
                                    <i class="fas fa-quote-left pe-2"></i>
                                    {{ $testimonial->description ?? 'No description' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Slider controls -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div> <!-- end of container -->
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('#default-carousel', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>
