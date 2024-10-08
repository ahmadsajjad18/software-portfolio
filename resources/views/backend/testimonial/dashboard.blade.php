@extends('backend.testimonial.layouts.app')

@section('testimonial_dashboard')
    <div>
        <div class="bg-gray-100 pl-5 pt-3 pb-3 text-4xl flex items-start">
            <h1>Welcome to Testimonial Dashboard...</h1>
        </div>

        <div class="min-h-screen bg-gray-100 flex flex-col items-center">

            <button data-bs-toggle="modal" data-bs-target="#testimonialModal" id="createButton" class="mt-4 create-btn px-6 py-2 bg-purple-700 text-white text-base font-semibold rounded-md hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Open Modal
            </button>

            <!-- Create/Edit Modal -->
            <div class="modal fade" id="testimonialModal" tabindex="-1" aria-labelledby="testimonialModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-purple-700 text-white">
                            <h5 class="modal-title" id="testimonialModalLabel">Create/Edit Testimonial Section</h5>
                            <button type="button" class="btn-close bg-white" aria-label="Close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="testimonial-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="testimonial_id" name="testimonial_id">

                                <!-- Image Upload Section -->
                                <div class="mb-4">
                                    <label for="image" class="block text-gray-700 font-bold">Upload Image</label>
                                    <div id="current-image" class="mb-2"></div>
                                    <input type="file" id="image" name="image" class="mt-1 block w-full border p-2 rounded @error('image') is-invalid @enderror">
                                    @error('image')
                                    <div id="imageError" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>

                                <!-- Name Section -->
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 font-bold">Enter Name</label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full border p-2 rounded @error('name') is-invalid @enderror" placeholder="Enter Name">
                                    @error('name')
                                    <div id="nameError" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>

                                <!-- Portfolio Section -->
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 font-bold">Description</label>
                                    <textarea type="text" id="description" name="description" class="mt-1 block w-full border p-2 rounded @error('description') is-invalid @enderror" placeholder="Enter Category Name"></textarea>
                                    @error('description')
                                    <div id="descriptionError" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>


                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full font-bold">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Table -->
            <div class="mt-6 w-full p-4 overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-purple-700 text-white">
                    <tr>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Image</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Description</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @if($testimonials->isNotEmpty())
                        @foreach($testimonials as $testimonial)
                            <tr>
                                <td class="w-1/4 text-left py-3 px-4">
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="Portfolio Image" class="w-10 h-10 object-cover rounded">
                                </td>
                                <td class="w-1/4 text-left py-3 px-4">{{ $testimonial->name }}</td>
                                <td class="w-1/4 text-left py-3 px-4">{{ $testimonial->description }}</td>
                                <td class="w-1/4 text-left py-3 px-4">
                                    <button data-id="{{ $testimonial->id }}" class="btn btn-primary edit-btn">Edit</button>
                                    <button data-id="{{ $testimonial->id }}" class="btn btn-danger ml-2 delete-btn">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-3 px-4 text-red-500">No testimonial available</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {

            // Handle form submission for create/update
            $('#testimonial-form').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let testimonialId = $('#testimonial_id').val();
                let url = testimonialId ? "{{ route('testimonial.update', ':id') }}".replace(':id', testimonialId) : "{{ route('testimonial.store') }}";

                // Clear any existing error messages
                $('.text-red-500').remove(); // Remove any previous error messages
                $('.is-invalid').removeClass('is-invalid'); // Remove invalid class from inputs

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#testimonialModal').modal('hide');
                        location.reload(); // Refresh the page to reflect changes
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                let inputField = $(`#${key}`);
                                inputField.addClass('is-invalid'); // Highlight the input with error
                                inputField.after(`<span class="text-red-500 text-sm">${value[0]}</span>`); // Display error message
                            });
                        } else {
                            alert('An unexpected error occurred. Please try again.');
                        }
                    }
                });
            });

            // Edit button click event
            $('.edit-btn').on('click', function() {
                let testimonialId = $(this).data('id');
                $.get("{{ route('testimonial.edit', '') }}/" + testimonialId, function(data) {
                    if (data) {
                        $('#testimonial_id').val(data.id);
                        $('#name').val(data.name);
                        $('#description').val(data.description); // Correctly set the description field

                        if (data.image) {
                            $('#current-image').html('<img src="{{ asset('storage/') }}/' + data.image + '" alt="Testimonial Image" class="w-24 h-24 object-cover rounded">');
                        } else {
                            $('#current-image').html('<span>No Image Available</span>');
                        }

                        $('#testimonialModal').modal('show');
                    } else {
                        alert('Failed to retrieve data. Please try again.');
                    }
                }).fail(function() {
                    alert('Failed to retrieve data. Please try again.');
                });
            });


            // Delete button click event
            $('.delete-btn').on('click', function() {
                if (confirm('Are you sure you want to delete this testimonial?')) {
                    let testimonialId = $(this).data('id');
                    $.ajax({
                        url: "{{ route('testimonial.destroy', ':id') }}".replace(':id', testimonialId),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(xhr) {
                            alert('An error occurred. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
