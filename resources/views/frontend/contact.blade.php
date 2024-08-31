<section class="section bg-primary" id="contact">
    <div class="container text-center">
        <div class="shadow-lg  bg-primary p-4 rounded">
            <p class="section-subtitle text-white">How can you communicate?</p>
            <h6 class="section-title text-white mb-5">Contact Me</h6>
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- contact form -->
            <form action="{{ route('contact.store') }}" method="post" class="contact-form col-md-10 col-lg-8 m-auto bg-gray-800 p-6 rounded">
                @csrf
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <input type="text" size="50" name="name" class="form-control text-white @error('name') is-invalid @enderror" placeholder="Your Name">
                        @error('name')
                        <div id="nameError" class="invalid-feedback">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <input type="email" name="email" class="form-control text-white" placeholder="Enter Email">
                        @error('email')
                        <div id="emailError" class="invalid-feedback">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-12">
                        <textarea name="description" id="description" rows="6" class="form-control text-white" placeholder="Write Something"></textarea>
                        @error('description')
                        <div id="descriptionError" class="invalid-feedback">
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 mt-3">
                        <input type="submit" value="Send Message" class="btn btn-outline-light rounded">
                    </div>
                </div>
            </form><!-- end of contact form -->
        </div><!-- end of shadow div -->
    </div><!-- end of container -->
</section>
