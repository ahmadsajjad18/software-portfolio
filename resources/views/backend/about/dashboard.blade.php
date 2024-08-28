@extends('backend.about.layouts.app')

@section('about_dashboard')
    <div >
        <div class="bg-gray-100 pl-5 pt-3 pb-3 text-4xl flex items-start">
            <h1>Welcome to About Dashboard...</h1>
        </div>

        <div class="min-h-screen bg-gray-100 flex  flex-col items-center">
            @if(!$about)
                <button data-bs-toggle="modal" data-bs-target="#homeModal" id="createButton" class="mt-4 create-btn px-6 py-2 bg-purple-700 text-white text-base font-semibold rounded-md hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Open Modal
                </button>
            @endif


                <div class="modal fade" id="homeModal" tabindex="-1" aria-labelledby="homeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-purple-700 text-white">
                                <h5 class="modal-title" id="homeModalLabel">Create/Edit About Section</h5>
                                <button type="button" class="btn-close bg-white" aria-label="Close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="about-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="about_id" name="about_id">

                                    <!-- Profile Image Section -->
                                    <div class="mb-4">
                                        <label for="profile_image" class="block text-gray-700 font-bold">Profile Image</label>
                                        <div id="current-profile-image" class="mb-2">
                                            @if($about && $about->profile_image)
                                                <img src="{{ asset('storage/' . $about->profile_image) }}" alt="Profile Image" class="w-24 h-24 object-cover rounded">
                                            @else
                                                <span>No Profile Image</span>
                                            @endif
                                        </div>
                                        <input type="file" id="profile_image" name="profile_image" class="mt-1 block w-full border p-2 rounded">
                                    </div>

                                    <!-- CV File Section -->
                                    <div class="mb-4">
                                        <label for="user_cv" class="block text-gray-700 font-bold">Upload CV (PDF)</label>
                                        <div id="current-user-cv" class="mb-2">
                                            @if($about && $about->user_cv)
                                                <a href="{{ asset('storage/' . $about->user_cv) }}" class="text-blue-500" target="_blank">Current CV</a>
                                            @else
                                                <span>No CV Available</span>
                                            @endif
                                        </div>
                                        <input type="file" id="user_cv" name="user_cv" class="mt-1 block w-full border p-2 rounded">
                                    </div>

                                    <!-- Description Section -->
                                    <div class="mb-4">
                                        <label for="description" class="block text-gray-700 font-bold">About Description</label>
                                        <textarea id="description" name="description" class="mt-1 block w-full border p-3 rounded @error('description') is-invalid @enderror" rows="5" placeholder="Write something about yourself..."></textarea>
                                    </div>

                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full font-bold">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="mt-6 w-full p-4 overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-purple-700 text-white">
                    <tr>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Profile Image</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Description</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">CV</th>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @if($about)
                        <tr>
                            <td class="w-1/4 text-left py-3 px-4">
                                <img src="{{ asset('storage/' . $about->profile_image) }}" alt="Profile Image" class="w-10 h-10 rounded-full object-cover">
                            </td>
                            <td class="w-1/4 text-left py-3 px-4">
                                {!! $about->description !!}
                            </td>
                            <td class="w-1/4 text-left py-3 px-4">
                                @if($about->user_cv)
                                    <a href="{{ route('about.download-cv') }}" class="bg-green-500 text-white px-4 py-2 rounded font-bold">Download CV</a>
                                @else
                                    <span class="text-red-500">No CV Available</span>
                                @endif
                            </td>
                            <td class="w-1/4 text-left py-3 px-4">
                                <button class="btn btn-primary edit-btn" data-id="{{ $about->id }}">Edit</button>
                                <button class="btn btn-danger ml-2 delete-btn" data-id="{{ $about->id }}">Delete</button>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="4" class="text-center py-3 px-4 text-red-500">No data available</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle Edit Button Click
            $('.edit-btn').click(function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ url('about/edit') }}/" + id,
                    type: 'GET',
                    success: function(data) {
                        $('#homeModalLabel').text('Edit About Section');
                        $('#about_id').val(data.id);
                        $('#description').val(data.description);

                        // Display current profile image and CV
                        if (data.profile_image) {
                            $('#current-profile-image').html(`
                        <img src="{{ asset('storage/') }}/${data.profile_image}" alt="Profile Image" class="w-24 h-24 object-cover rounded">
                    `);
                        } else {
                            $('#current-profile-image').html('<span>No Profile Image</span>');
                        }

                        if (data.user_cv) {
                            $('#current-user-cv').html(`
                        <a href="{{ asset('storage/') }}/${data.user_cv}" class="text-blue-500" target="_blank">Current CV</a>
                    `);
                        } else {
                            $('#current-user-cv').html('<span>No CV Available</span>');
                        }

                        $('#homeModal').modal('show');
                    }
                });
            });

            // Handle Form Submission
            $('#about-form').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let aboutId = $('#about_id').val();
                let url = aboutId ? "{{ url('about/update') }}/" + aboutId : "{{ route('about.store') }}";

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        location.reload(); // Refresh the page to reflect updates
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            alert(value); // Display errors inside the modal
                        });
                    }
                });
            });

            // Handle Delete Button Click
            $('.delete-btn').click(function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ url('about/delete') }}/" + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload(); // Refresh the page to reflect deletion
                    }
                });
            });
        });
    </script>
@endsection
