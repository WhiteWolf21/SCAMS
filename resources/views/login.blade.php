<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SCAMS SYSTEM</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="css/app.css" rel="stylesheet">
        <link href="css/global.css" rel="stylesheet">
        <link href="css/include/floatingLabel.css" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref flex-height">
{{--            @if (Route::has('login'))--}}
{{--                <div class="top-right links">--}}
{{--                    @auth--}}
{{--                        <a href="{{ url('/home') }}">Home</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ route('login') }}">Login</a>--}}

{{--                        @if (Route::has('register'))--}}
{{--                            <a href="{{ route('register') }}">Register</a>--}}
{{--                        @endif--}}
{{--                    @endauth--}}
{{--                </div>--}}
{{--            @endif--}}

            <div class="content">
                <div class="title m-b-md">
                    SCAMS SYSTEM
                    <br>
                    <button class="tablink" onclick="openPage('Login', this, 'white')" id=@if (session('default')) @if (session('default') == 0) "defaultOpen" @else "" @endif @else "defaultOpen" @endif >Sign In</button>
                    <button class="tablink" onclick="openPage('Register', this, 'white')" id=@if (session('default')) @if (session('default') == 1) "defaultOpen" @else "" @endif @else "" @endif >Register</button>
                </div>
                <br>
                <div class="tab-content" id="tab-content" style="text-align: left">
                    <div id="Login" class="tabcontent">
                        <form action="loginRequest" target="" class="sub-content form" method="post">
                            {{csrf_field()}}

                            <h1 style="text-align: center">Login With Your Account</h1>
                            @if (session('msg'))
                                <div class="sub-title alert alert-{{session('msg_type')}}">
                                    {{session('msg')}}
                                </div>
                            @endif
                            <br />

                            <div class="floating">
                                <input id="input__username" class="floating__input custom-input" name="username" type="text" placeholder="Username" />
                                <label for="input__username" class="floating__label" data-content="Username"><span class="hidden--visually">Username</span></label>
                            </div>

                            <div class="floating">
                                <input id="input__password" type="password" class="floating__input custom-input" name="password" type="text" placeholder="Password" />
                                <label for="input__password" class="floating__label" data-content="Password"><span class="hidden--visually">Password</span></label>
                            </div>

                            <button type="submit" name="login_button" value="guest" class="guest-button">Guest</button>
                            <button type="submit" name="login_button" value="login" class="button">Log in</button>

                        </form>
                    </div>

                    <div id="Register" class="tabcontent">
                        <form action="requestAccount" target="" class="sub-content form" method="post">
                            {{csrf_field()}}

                            <h1 style="text-align: center">Request An Account</h1>
                            @if (session('msg'))
                                <div class="sub-title alert alert-{{session('msg_type')}}">
                                    {{session('msg')}}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <br />

                            <div class="floating">
                                <input id="input__username" class="floating__input custom-input" name="username" type="text" placeholder="Username" />
                                <label for="input__username" class="floating__label" data-content="Username"><span class="hidden--visually">Username</span></label>
                            </div>

                            <div class="floating">
                                <input id="input__email" class="floating__input custom-input" name="email" type="text" placeholder="Email" />
                                <label for="input__email" class="floating__label" data-content="Email"><span class="hidden--visually">Email</span></label>
                            </div>

                            <div class="dropdown">
                                <div class="select">
                                    <span>Select Role</span>
                                    <i class="fa fa-chevron-left"></i>
                                </div>
                                <input type="hidden" name="type">
                                <ul class="dropdown-menu">
                                    <li id="student">Student</li>
                                    <li id="staff">Staff</li>
                                    <li id="lecturer">Lecturer</li>
                                    <li id="admin">Admin</li>
                                </ul>
                            </div>

                            <div class="floating">
                                <input id="input__password" type="password" class="floating__input custom-input" name="password" type="text" placeholder="Password" />
                                <label for="input__password" class="floating__label" data-content="Password"><span class="hidden--visually">Password</span></label>
                            </div>

                            <div class="floating">
                                <input id="input__password" type="password" class="floating__input custom-input" name="password_confirmation" type="text" placeholder="Password Confirmation" />
                                <label for="input__password" class="floating__label" data-content="Password Confirmation"><span class="hidden--visually">Password Confirmation</span></label>
                            </div>

                            <button type="submit" name="login_button" value="register" class="button">Send Request</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="js/include/jquery-3.4.1.js"></script>
    <script src="js/include/elementController.js"></script>
</html>
