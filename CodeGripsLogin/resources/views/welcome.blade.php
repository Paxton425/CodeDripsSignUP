<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ ('Sign Up') }}</title>
        @vite('resources/js/app.js', 'vendor/courier/build')
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

        <!-- Styles -->
        <style>
            body {
                font-family: "Nunito", sans-serif;
            }
            h1{
                font-size: 4em;
            }
            #welcome_content {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                margin-top: 100px;
            }
            #welcome_text{
                margin-top: -100px;
            }
            #signup_form {
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 85px;
                background-image: url('https://img.freepik.com/premium-photo/spartan-statue-gray-background_379858-10083.jpg');
                box-shadow: 1px 1px 2px black, 0 0 25px #000, 0 0 5px #000;
            }
            .btn {
                width: 200px;
            }
            form {
                margin-bottom: 35px;
            }
            .form-control::placeholder {
                color: #fff;
            }
            #welcome_content >div {
                width: 40%;
            }
            #alternatives{
                display: flex;
                flex-direction: row;
                width: 100%;
            }
            #alternatives>a{
                margin-right: 10px;
                height: 30px;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
            @if (!Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                @if (!Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif @endauth
            </div>
            @endif

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif

            <div class="container">
                <div id="welcome_content" class="row">
                    <div id="welcome_text" class="col-md-6">
                        <h1>{{ ('Welcome To CodingDrips') }}</h1>
                        <p class="text-secondary">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In cursus purus eget urna ultricies facilisis. <br />
                            In vel lorem libero. Vivamus interdum nulla quis purus consectetur commodo. <br />
                            Vivamus ultricies nunc tincidunt fringilla rhoncus. Duis ac purus id metus ultrices condimentum.
                        </p>
                    </div>
                    <div id="signup_form" class="col-md-6 mb-3 border-dark rounded">
                        <div id="login-form mx-auto">
                            <form id="signUpForm" class="flex justify-center" method="post" action="{{ route('signUp') }}">
                                @csrf
                                <div id="inputs">
                                    <div class="mb-3 input-group-lg">
                                        <input type="email" name="email" class="form-control border border-3 bg-transparent text-light" placeholder="example@gmail.com" autofocus autocomplete="email" />
                                        @error('email')
                                            <div class="error text-danger shadow">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2 input-group-lg">
                                        <input type="text" name="name" class="form-control border border-3 bg-transparent text-light" placeholder="username" />
                                        @error('name')
                                             <div class="error text-danger shadow">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-2 input-group-lg">
                                        <input type="password" name="password" class="form-control border border-3 bg-transparent text-light" placeholder="password" />
                                    </div>
                                    <div class="mb-2 input-group-lg">
                                        <input type="password" name="password_confirmation" class="form-control border border-3 bg-transparent text-light" placeholder="confirm password" />
                                        @error('password')
                                            <div class="error text-danger shadow">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button id="submit_btn" class="btn btn-danger btn-sm" style="border-radius: 0; margin-top: 35px;" type="submit" aria-describedby="btnHelpBlock">Sign up</button>
                                <div class="text-light" id="btnHelpBlock">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur elit.<br />
                                        In cursus purus eget urna ultricies facilisis.
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div id="alternatives">
                            <a class="btn btn-primary btn-sm" href="#">{{ ('Sign up with Facebook') }}</a>
                            <a class="btn btn-light btn-sm text-secondary ml-3" href="#">{{ ('Sign up with Google') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('#signUpForm').submit(function(event) {
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Send an AJAX POST request
            $.post('signUp', formData)
            .done(function(response) {
                alert('Success');
                // redirect the user to another page
                window.location.href = '{{ route("dashboard") }}';
            })
            .fail(function(xhr) {
        // Handle error response
        if (xhr.status === 422) {
            var errors = xhr.responseJSON.errors;
            var errorMessages = '';

            // Iterate over the errors object and construct error messages
            for (var field in errors) {
                if (errors.hasOwnProperty(field)) {
                    var fieldErrors = errors[field];
                    for (var i = 0; i < fieldErrors.length; i++) {
                        errorMessages += fieldErrors[i] + '\n';
                    }
                }
            }

            // Display the error messages to the user
            alert('Error:\n' + errorMessages);
        } else {
            console.log('Sign-up failed');
            console.log(xhr.statusText);
            alert('Sign-up failed. Please try again.');
        }
    });
            });
    });
    </script>
</html>
