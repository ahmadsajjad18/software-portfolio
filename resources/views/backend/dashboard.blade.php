@extends('backend.layouts.app')

@section('main_dashboard')
    <div>
        <div class="bg-gray-100 pl-3 pt-3 pb-3 text-4xl flex items-start">
            <h1>Welcome to Main Dashboard...</h1>
        </div>

        <div class="min-h-screen bg-gray-100 flex mt-5 pt-lg-5 flex-col items-center">
            <div id="message-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Messages will be appended here -->
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/contacts/messages',
                method: 'GET',
                success: function(response) {
                    console.log('Response:', response); // Check the response in the console

                    $('#message-container').empty(); // Clear the container

                    response.forEach(function(contact) {
                        var messageCardHtml = `
                            <div style="background-color: rgb(110 25 190 / var(--tw-bg-opacity));" class="relative p-6 text-white border border-teal-600 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl" data-contact-id="${contact.id}">
                                <button class="close-button absolute top-2 right-2 text-white hover:text-gray-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                <div class="flex items-center space-x-4 mb-4">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.403 4.211A1 1 0 0117.811 22H4.189a1 1 0 01-.787-1.789L2 17h5m8-5V7a4 4 0 00-8 0v5m6 0H7m2 0v5a2 2 0 002 2h2a2 2 0 002-2v-5z"></path>
                                    </svg>
                                    <div>
                                        <h2 class="text-xl font-semibold">${contact.name}</h2>
                                        <p class="text-sm text-gray-200">${contact.email}</p>
                                        <p class="text-xs text-gray-300">${new Date(contact.created_at).toLocaleString()}</p>
                                    </div>
                                </div>
                                <p class="mt-2 text-base">${contact.description}</p>
                            </div>
                        `;

                        $('#message-container').prepend(messageCardHtml);
                    });

                    // Attach event handlers to dynamically created elements
                    $('.close-button').click(function() {
                        $(this).closest('.relative').hide(); // Hides the message card
                    });

                    $('.delete-button').click(function() {
                        var contactId = $(this).closest('.relative').data('contact-id'); // Get the contact ID

                        $.ajax({
                            url: '/contacts/' + contactId,
                            method: 'DELETE',
                            success: function() {
                                $(this).closest('.relative').hide(); // Hides the message card on success
                            }.bind(this),
                            error: function() {
                                console.error('Failed to delete message.');
                            }
                        });
                    });
                },
                error: function() {
                    console.error('Failed to fetch messages.');
                }
            });
        });
    </script>

@endsection
