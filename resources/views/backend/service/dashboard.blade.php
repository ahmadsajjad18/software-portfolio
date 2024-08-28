@extends('backend.service.layouts.app')

@section('service_dashboard')
    <div>
        <div class="bg-gray-100 pl-5 pt-3 pb-3 text-4xl flex items-start">
            <h1>Welcome to Service Dashboard...</h1>
        </div>

        <div class="min-h-screen bg-gray-100 flex flex-col items-center">

            <button data-bs-toggle="modal" data-bs-target="#serviceModal" id="createButton" class="mt-4 create-btn px-6 py-2 bg-purple-700 text-white text-base font-semibold rounded-md hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Open Modal
            </button>

            <!-- Create/Edit Modal -->
            <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-purple-700 text-white">
                            <h5 class="modal-title" id="serviceModalLabel">Create/Edit Service Section</h5>
                            <button type="button" class="btn-close bg-white" aria-label="Close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="service-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="service_id" name="service_id">

                                <!-- Image Upload Section -->
                                <div class="mb-4">
                                    <label for="image" class="block text-gray-700 font-bold">Upload Image</label>
                                    <div id="current-image" class="mb-2"></div>
                                    <input type="file" id="image" name="image" class="mt-1 block w-full border p-2 rounded">
                                    <div id="imageError" class="text-red-500"></div>
                                </div>

                                <!-- Name Section -->
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-700 font-bold">Enter Name</label>
                                    <input type="text" id="name" name="name" class="mt-1 block w-full border p-2 rounded" placeholder="Enter Service Name">
                                    <div id="nameError" class="text-red-500"></div>
                                </div>

                                <!-- Description Section -->
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 font-bold">Service Description</label>
                                    <textarea id="description" name="description" class="mt-1 block w-full border p-3 rounded" rows="5" placeholder="Write about the service..."></textarea>
                                    <div id="descriptionError" class="text-red-500"></div>
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
                    @if($services->isNotEmpty())
                        @foreach($services as $service)
                            <tr>
                                <td class="w-1/4 text-left py-3 px-4">
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="Service Image" class="w-10 h-10 object-cover">
                                </td>
                                <td class="w-1/4 text-left py-3 px-4">{{ $service->name }}</td>
                                <td class="w-1/4 text-left py-3 px-4">{!! $service->description !!}</td>
                                <td class="w-1/4 text-left py-3 px-4">
                                    <button data-id="{{ $service->id }}" class="btn btn-primary edit-btn">Edit</button>
                                    <button data-id="{{ $service->id }}" class="btn btn-danger ml-2 delete-btn">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center py-3 px-4 text-red-500">No services available</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            CKEDITOR.replace('description');

            // Handle form submission for create/update
            $('#service-form').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let serviceId = $('#service_id').val();
                let url = serviceId ? "{{ route('service.update', '') }}/" + serviceId : "{{ route('service.store') }}";

                formData.append('description', CKEDITOR.instances.description.getData());

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#serviceModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            for (let key in errors) {
                                $('#' + key + 'Error').text(errors[key][0]);
                            }
                        }
                    }
                });
            });

            // Edit button click event
            $('.edit-btn').on('click', function() {
                let serviceId = $(this).data('id');
                $.get("{{ route('service.edit', '') }}/" + serviceId, function(data) {
                    $('#service_id').val(data.id);
                    $('#name').val(data.name);
                    CKEDITOR.instances.description.setData(data.description);
                    if(data.image) {
                        $('#current-image').html('<img src="{{ asset('storage/') }}/' + data.image + '" alt="Service Image" class="w-24 h-24 object-cover rounded">');
                    } else {
                        $('#current-image').html('<span>No Image Available</span>');
                    }
                    $('#serviceModal').modal('show');
                });
            });

            // Delete button click event
            $('.delete-btn').on('click', function() {
                if(confirm('Are you sure you want to delete this service?')) {
                    let serviceId = $(this).data('id');
                    $.ajax({
                        url: "{{ route('service.destroy', '') }}/" + serviceId,
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
