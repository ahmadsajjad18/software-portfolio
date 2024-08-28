@extends('backend.home.layouts.app')

@section('home_dashboard')
    <div>
        <div class="bg-gray-100 pl-3 pt-3 pb-3 text-4xl flex items-start">
            <h1>Welcome to Home Dashboard...</h1>
        </div>

        <div class="min-h-screen bg-gray-100 flex flex-col items-center">
            @if($homes->isEmpty())
                <button data-bs-toggle="modal" data-bs-target="#homeModal" id="createButton" class="mt-4 create-btn px-6 py-2 bg-purple-700 text-white text-base font-semibold rounded-md hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Open Modal
                </button>
            @endif

            <div class="modal fade" id="homeModal" tabindex="-1" aria-labelledby="homeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-purple-700 text-white">
                            <h5 class="modal-title" id="homeModalLabel">Create Home Section</h5>
                            <button type="button" class="btn-close bg-white" aria-label="Close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="homeForm">
                                @csrf
                                <input type="hidden" id="home_id" name="home_id">
                                <h2 class="text-center mb-4 font-bold">You can add only 1 data</h2>
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Enter your name" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                    @error('name')
                                    <div id="nameError" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Enter your profession" class="form-control @error('profession') is-invalid @enderror" id="profession" name="profession">
                                    @error('profession')
                                    <div id="professionError" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input type="url" placeholder="Add URL" class="form-control @error('url') is-invalid @enderror" id="url" name="url">
                                    @error('url')
                                    <div id="urlError" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div id="formError" class="alert alert-danger d-none"></div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn bg-purple-700 text-white hover:bg-purple-800">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 w-full p-4 overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-purple-700 text-white">
                    <tr>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Profession</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">URL</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @forelse($homes as $home)
                        <tr>
                            <td class="w-1/4 text-left py-3 px-4">{{ $home->name }}</td>
                            <td class="w-1/4 text-left py-3 px-4">{{ $home->profession }}</td>
                            <td class="w-1/4 text-left py-3 px-4">
                                <a class="btn text-white bg-green-500 hover:bg-green-700" href="{{ $home->url }}">URL</a>
                            </td>
                            <td class="text-left py-3 px-4">
                                <button class="btn btn-primary edit-btn" data-id="{{ $home->id }}">Edit</button>
                                <button class="btn btn-danger ml-2 delete-btn" data-id="{{ $home->id }}">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3 px-4 text-red-500">No data available</td>
                        </tr>
                    @endforelse
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
            $('#createButton').click(function() {
                $('#homeForm').trigger('reset');
                $('#home_id').val('');
                $('#homeModalLabel').text('Create Home Section');
                $('#formError').addClass('d-none');
                $('#homeModal').modal('show');
            });

            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/home/get-home/' + id,
                    type: 'GET',
                    success: function(response) {
                        $('#home_id').val(response.id);
                        $('#name').val(response.name);
                        $('#profession').val(response.profession);
                        $('#url').val(response.url);
                        $('#homeModalLabel').text('Edit Home Section');
                        $('#formError').addClass('d-none');
                        $('#homeModal').modal('show');
                    },
                    error: function(response) {
                        console.error("Error fetching data:", response);
                    }
                });
            });

            $('#homeForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var url = $('#home_id').val() ? '{{ route('home.update') }}' : '{{ route('home.store') }}';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#homeModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        $('#formError').removeClass('d-none').text(response.responseJSON.message);
                        $.each(errors, function(key, value) {
                            $('#' + key + 'Error').text(value[0]).show();
                        });
                    }
                });
            });

            $('.delete-btn').click(function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/home/delete/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function(response) {
                        alert('An error occurred while trying to delete the data.');
                    }
                });
            });
        });
    </script>
@endsection
