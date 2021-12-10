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
    </style>
</head>

<body>

<header class="header text-center">
    <h1 class="blog-name pt-lg-4 mb-0"><a class="no-text-decoration" href="{{route('posts_list')}}">Daily Blog</a></h1>

    <nav class="navbar navbar-expand-lg navbar-dark" >

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
        </div>
    </nav>
</header>
