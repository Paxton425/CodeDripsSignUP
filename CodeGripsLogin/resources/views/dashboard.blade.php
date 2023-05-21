<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />

                @if(Route::has('dashboard.set_c'))
                <div id="cookie_card" class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Cookie Consent</h5>
                        <p class="card-text">
                             We use cookies to enhance your experience on our website. By continuing to browse, you agree to the use of cookies as described in our <a href="/privacy-policy">privacy policy</a>.
                        </p>
                        <form id="cookieForm" method="POST" action="{{ route('addCookie') }}">
                            @csrf
                            <div class="form-check">
                                <input class="fade form-control" type="text" value="{{ auth()->user()->id }}" id="cookieConsentCheck">
                            </div>
                            <div class="col-md-*">
                                <button type="submit" class="btn btn-primary">Accept Cookie</button>
                                <a id="close_cookie" class="btn btn-primary">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#cookieForm').submit(function(event) {
        event.preventDefault(); 
        $(this).toggleClass('fade');

        const form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                $('#cookie_card').hide();
                alert('Cookie set successfully.');
            },
            error: function(xhr, status, error) {
                alert('An error occurred while setting cookie.');
            }
        });
    });
    
    $('#close_cookie').click(function() {
        $('#cookie_card').hide();
    });
});
</script>
