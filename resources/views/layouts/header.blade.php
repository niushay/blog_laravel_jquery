<!DOCTYPE html>
<html lang="en">
<head>
    <title>List of Posts</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">

    <script defer src="{{url("assets/fontawesome/all.min.js")}}"></script>
    <link id="theme-style" rel="stylesheet" href="{{url("assets/css/theme-1.css")}}">
    <style>
        .error{
            color: red;
            font-style: italic;
        }
        .item{
            padding: 15px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <script>
        //check if user is not Authenticated redirected to login page
        var token = localStorage.getItem('token');
        if (token === null){
            window.location.href = "{{route('main')}}"
        }
    </script>

    <header class="header text-center">
        <h1 class="blog-name pt-lg-4 mb-0"><a class="no-text-decoration" href="{{route('posts_list')}}">Daily Blog</a></h1>

        <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navigation" class="collapse navbar-collapse flex-column" >
                <div class="profile-section pt-3 pt-lg-0">
                    <img class="profile-image mb-3 rounded-circle mx-auto" src="{{url("assets/images/profile.png")}}" alt="image" >

                    <ul class="social-list list-inline py-3 mx-auto">
                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in fa-fw"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-github-alt fa-fw"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-stack-overflow fa-fw"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-codepen fa-fw"></i></a></li>
                    </ul>
                    <hr>
                </div>

                <div class="my-2 my-md-3">
                    <a class="btn btn-primary" href="{{route('create_post')}}" target="_blank">Create New Post</a>
                </div>

                <ul class="navbar-nav flex-column text-start">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('posts_list')}}"><svg class="svg-inline--fa fa-home fa-w-18 fa-fw me-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="home" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"></path></svg>All posts <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="excelExport"><svg class="svg-inline--fa fa-bookmark fa-w-12 fa-fw me-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bookmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M0 512V48C0 21.49 21.49 0 48 0h288c26.51 0 48 21.49 48 48v464L192 400 0 512z"></path></svg>Export My Posts</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

<script src="{{url("assets/vendor/jquery/jquery.min.js")}}"></script>

<script>
    var token = localStorage.getItem('token');

    $(function () {
        //Get User Name to show in the Navbar
        $.ajax({
            method: 'GET',
            url: "{{route('get_username')}}",
            headers: {Authorization: "Bearer " + token},
            success: function (response) {
                $(".blog-name").empty()
                $(".blog-name").append(response.user_name + "'s blog");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        })

        //Export Excel button
        $("#excelExport").click(function (e) {
            e.preventDefault();

            $.ajax({
                method: 'GET',
                url: "{{route('excel_export')}}",
                headers: {Authorization: "Bearer " + token},
                xhrFields: {
                    responseType: 'blob',
                },
                success: function (data) {
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(data);
                    link.download = `Posts.xlsx`;
                    link.click();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        })
    })
</script>

