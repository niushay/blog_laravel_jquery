<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>

    <link rel="stylesheet" href="{{url("assets/fonts/material-icon/css/material-design-iconic-font.min.css")}}">

    <link rel="stylesheet" href="{{url("assets/css/style.css")}}">
</head>
    <body>

        <div class="main">
            <section class="sign-in">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure><img src="{{url("assets/images/signin-image.jpg")}}" alt="sing up image"></figure>
                            <a href="{{route('sign_up')}}" class="signup-image-link">Create an account</a>
                        </div>

                        <div class="signin-form">
                            <h2 class="form-title">Sign in</h2>

                            <form method="POST" action="{{route("login")}}" class="login-form" id="login-form">
                                @csrf
                                <div class="form-group">
                                    <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="email" name="email" id="email" placeholder="Your Email"/>
                                </div>
                                <div class="form-group">
                                    <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="your_pass" placeholder="Password"/>
                                </div>
                                <div class="form-group form-button">
                                    <input type="submit" id="signin" class="form-submit" value="Log in"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    <!-- JS -->
    <script src="{{url("assets/vendor/jquery/jquery.min.js")}}"></script>
    <script src="{{url("assets/vendor/jquery_validator/jquery.validate.js")}}"></script>
    <script src="{{url("assets/js/main.js")}}"></script>

    <script>
            $(document).ready(function () {
                var $registrationForm = $("form")
                $.validator.addMethod("noSpace", function(value, element) {
                    return value == '' || value.trim().length != 0
                }, "Spaces are not allowed");

                if($registrationForm.length){
                    $registrationForm.validate({
                        rules:{
                            email: {required: true, noSpace: true},
                            password: {required: true, minlength : 4, noSpace: true},
                        },
                        messages:{
                            email: {required: 'Email is required!'},
                            password: {required: 'Password is required!'},
                        }
                    })
                }
                $("form").submit(function (e) {
                    var email = $('#email').val()
                    var password = $('#your_pass').val()
                    e.preventDefault();
                    login(email, password);
                    return false;
                });

            })


            function login(email, password) {
                $.ajax({
                    method: 'POST',
                    url: "{{route('login')}}",
                    data: {'email': email, 'password': password},
                    success: function(response){
                        localStorage.setItem('token', response.access_token);
                        if(response.status == 1) {
                            window.location.href = "{{route("posts_list")}}"
                        }else {
                            alert('Email and/or Password Incorrect');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Email and/or Password Incorrect');
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
            }
        </script>
</body>
</html>
