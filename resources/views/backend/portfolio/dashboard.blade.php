@extends('backend.portfolio.layouts.app')

@section('portfolio_dashboard')
    <div>
        <div class="bg-gray-100 pl-5 pt-3 pb-3 text-4xl flex items-start">
            <h1>Welcome to Portfolio Dashboard...</h1>
        </div>

        <div class="min-h-screen bg-gray-100 flex flex-col items-center">

            <button data-bs-toggle="modal" data-bs-target="#portfolioModal" id="createButton" class="mt-4 create-btn px-6 py-2 bg-purple-700 text-white text-base font-semibold rounded-md hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Open Modal
            </button>

            <!-- Create/Edit Modal -->
            <div class="modal fade" id="portfolioModal" tabindex="-1" aria-labelledby="portfolioModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-purple-700 text-white">
                            <h5 class="modal-title" id="portfolioModalLabel">Create/Edit Portfolio Section</h5>
                            <button type="button" class="btn-close bg-white" aria-label="Close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="portfolio-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="portfolio_id" name="portfolio_id">

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
                                    <input type="text" id="name" name="name" class="mt-1 block w-full border p-2 rounded @error('name') is-invalid @enderror" placeholder="Enter Portfolio Name">
                                    @error('name')
                                    <div id="imageError" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>

                                <!-- Portfolio Section -->
                                <div class="mb-4">
                                    <label for="category" class="block text-gray-700 font-bold">Category</label>
                                    <input type="text" id="category" name="category" class="mt-1 block w-full border p-2 rounded @error('category') is-invalid @enderror" placeholder="Enter Category Name">
                                    @error('category')
                                    <div id="categoryError" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>

                                <!-- URL Section -->
                                <div class="mb-4">
                                    <label for="url" class="block text-gray-700 font-bold">URL</label>
                                    <input type="url" id="url" name="url" class="mt-1 block w-full border p-2 rounded @error('url') is-invalid @enderror" placeholder="Enter URL">
                                    @error('url')
                                    <div id="urlError" class="invalid-feedback">
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
                        <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Image</th>
                        <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Category</th>
                        <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">URL</th>
                        <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @if($portfolios->isNotEmpty())
                        @foreach($portfolios as $portfolio)
                            <tr>
                                <td class="w-1/5 text-left py-3 px-4">
                                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="Portfolio Image" class="w-10 h-10 object-cover ">
                                </td>
                                <td class="w-1/5 text-left py-3 px-4">{{ $portfolio->name }}</td>
                                <td class="w-1/5 text-left py-3 px-4">{{ $portfolio->category }}</td>
                                <td class="w-1/5 text-left py-3 px-4">
                                    <a class="btn text-white bg-green-500 hover:bg-green-700" href="{{ $portfolio->url }}">URL</a>
                                </td>
                                <td class="w-1/5 text-left py-3 px-4">
                                    <button data-id="{{ $portfolio->id }}" class="btn btn-primary edit-btn">Edit</button>
                                    <button data-id="{{ $portfolio->id }}" class="btn btn-danger ml-2 delete-btn">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-3 px-4 text-red-500">No services available</td>
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
            $('#portfolio-form').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let portfolioId = $('#portfolio_id').val();
                let url = portfolioId ? "{{ route('portfolio.update', ':id') }}".replace(':id', portfolioId) : "{{ route('portfolio.store') }}";

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
                        $('#portfolioModal').modal('hide');
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
                let portfolioId = $(this).data('id');
                $.get("{{ route('portfolio.edit', '') }}/" + portfolioId, function(data) {
                    if (data) {
                        $('#portfolio_id').val(data.id);
                        $('#name').val(data.name);
                        $('#category').val(data.category);
                        $('#url').val(data.url);

                        if (data.image) {
                            $('#current-image').html('<img src="{{ asset('storage/') }}/' + data.image + '" alt="Portfolio Image" class="w-24 h-24 object-cover rounded">');
                        } else {
                            $('#current-image').html('<span>No Image Available</span>');
                        }

                        $('#portfolioModal').modal('show');
                    } else {
                        alert('Failed to retrieve data. Please try again.');
                    }
                }).fail(function() {
                    alert('Failed to retrieve data. Please try again.');
                });
            });


            // Delete button click event
            $('.delete-btn').on('click', function() {
                if (confirm('Are you sure you want to delete this portfolio?')) {
                    let portfolioId = $(this).data('id');
                    $.ajax({
                        url: "{{ route('portfolio.destroy', ':id') }}".replace(':id', portfolioId),
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
