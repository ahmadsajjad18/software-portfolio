<section class="section" id="service">
    <div class="container text-center">
        <p class="section-subtitle">What I Do?</p>
        <h6 class="section-title mb-6">Service</h6>

        <!-- Carousel -->
        <div class="py-5 service-24">
            <div class="container">
                <!-- Row -->
                <div class="row wrap-service-24">
                    <!-- Loop through services -->
                    @foreach($services as $service)
                        <div  class="col-lg-4 col-md-6 mb-4"> <!-- Adjusted column size -->
                            <div class="card rounded card-shadow border-0 h-100">
                                <a href="javascript:void(0)" class="card-hover py-4 text-center d-block rounded"
                                   data-title="{{ $service->name ?? 'No name' }}"
                                   data-description="{{ $service->description ?? 'No description'}}"
                                   data-image="{{ asset('storage/' . $service->image ?? 'No image') }}">
                                    <img src="{{ asset('storage/' . $service->image ?? 'No image') }}" alt="{{ $service->name ?? 'No name' }}" class="img-fluid modal-logo mb-3" /><br>
                                    <h6 class="card-title">{{ $service->name ?? 'No name' }}</h6>
                                    <span class="ser-title">Click Me!</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Carousel -->
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Service Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <!-- Image will be inserted here dynamically -->
                <img src="" alt="" class="img-fluid modal-logo mb-3" id="modalImage" />
                <!-- Description will be inserted here dynamically -->
                <div id="modalDescription"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.card-hover');
        const modal = new bootstrap.Modal(document.getElementById('serviceModal'));
        const modalTitle = document.querySelector('#serviceModal .modal-title');
        const modalBody = document.querySelector('#serviceModal .modal-body');
        const modalImage = document.querySelector('#serviceModal #modalImage');

        cards.forEach(card => {
            card.addEventListener('click', function () {
                const title = this.getAttribute('data-title');
                const description = this.getAttribute('data-description');
                const image = this.getAttribute('data-image');

                modalTitle.textContent = title;
                modalBody.innerHTML = `<img src="${image}" alt="${title}" class="img-fluid modal-logo mb-3" /><br>${description}`;
                modalImage.src = image;
                modalImage.alt = title;

                modal.show();
            });
        });
    });



</script>

