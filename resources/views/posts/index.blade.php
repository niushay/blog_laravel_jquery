@include('layouts.header')

<div class="main-wrapper">

    <section class="cta-section theme-bg-light py-5">
        <div class="container text-center single-col-max-width">
            <div class="single-form-max-width pt-3 mx-auto">
                <form class="signup-form row g-2 g-lg-2 align-items-center">
                    <div class="col-12 col-md-2">
                        <label class="sr-only" for="writer">Writer</label>
                        <input type="text" id="writer" class="form-control me-md-1 semail" placeholder="Writer">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="sr-only" for="date">Date</label>
                        <input type="date" id="date" class="form-control me-md-1 semail" placeholder="Enter date">
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

            <section class="blog-list px-3 py-5 p-md-5">

                <div class="container single-col-max-width">
                    <div class="item mb-5">
                        <div class="row g-3 g-xl-0">
                            <div class="col-2 col-xl-3">
                                <img class="img-fluid post-thumb " src="{{url("assets/images/post.jpg")}}" alt="image">
                            </div>
                            <div class="col">
                                <h3 class="title mb-1"><a class="text-link" href="blog-post.html">Top 3 JavaScript Frameworks</a></h3>
                                <div class="meta mb-1"><span class="date">Published 2 days ago</span><span class="time">5 min read</span><span class="comment"><a class="text-link" href="#">8 comments</a></span></div>
                                <div class="intro">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies...</div>
                                <a class="text-link" href="blog-post.html">Read more &rarr;</a>
                            </div>
                        </div>
                    </div>

                    <nav class="blog-nav nav nav-justified my-5">
                        <a class="nav-link-prev nav-item nav-link d-none rounded-left" href="#">Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
                        <a class="nav-link-next nav-item nav-link rounded" href="#">Next<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
                    </nav>

                </div>
            </section>
</div>

@include("layouts.footer")

