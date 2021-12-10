<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <link rel="stylesheet" href="{{url("assets/fonts/material-icon/css/material-design-iconic-font.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/style.css")}}">
</head>

<body>
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" id="register-form">
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{url("assets/images/signup-image.jpg")}}" alt="sing up image"></figure>
                    <a href="{{route('main')}}" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
</div>

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
                    name : {required: true, minlength : 2, noSpace: true},
                    email: {required: true, email: true, noSpace: true},
                    pass: {required: true, minlength : 4, noSpace: true},
                    re_pass: {required: true, minlength : 4, equalTo : "#pass", noSpace: true}
                },
                messages:{
                    name: {required: 'Name is required!'},
                    email: {required: 'email is required!'},
                    pass: {required: 'pass is required!', },
                    re_pass: {required: 'password confirmation is required!', equalTo: 'Password confirmation doesn\'t match Password'}
                }
            })
        }

            $("form").submit( function (e) {
                var name = $('#name').val()
                var email = $('#email').val()
                var password = $('#pass').val()
                var password_confirmation = $('#re_pass').val()
                e.preventDefault();

                register(name, email, password, password_confirmation);
                return false;
            });

    })


    function register(name, email, password, re_pass) {
        $.ajax({
            method: 'POST',
            url: "{{route('register')}}",
            data: {'name': name, 'email': email, 'password': password, password_confirmation: re_pass},
            success: function(response){
                if(response.status == 1) {
                    window.location.href = "{{route("main")}}"
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
    }
</script>


</body>
</html>
