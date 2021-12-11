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
        <div class="container single-col-max-width"  id="container">
        </div>

        <div  class="container single-col-max-width">
            <nav class="blog-nav nav nav-justified my-5">
                <a class="nav-link-prev nav-item nav-link d-none rounded-left" href="#">Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
                <a class="nav-link-next nav-item nav-link rounded" href="#">Next<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
            </nav>
        </div>
    </section>

</div>

@include("layouts.footer")

<script src="{{url("assets/vendor/jquery/jquery.min.js")}}"></script>
<script>
    $(function (){
        var token = localStorage.getItem('token');

        //Get all data
        $.ajax({
            method:'GET',
            url: "{{route('index')}}",
            headers:{Authorization: "Bearer " + token},
            success: function (response) {
                data = response.data
                appendDataToContainer(data, 'all');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        })

        $("form").submit( function (e) {
            var writer = $('#writer').val()
            var date = $('#date').val()

            e.preventDefault();
            filter(writer, date);
            return false;
        });

        function filter(writer, date){
            $.ajax({
                method: 'GET',
                url: "{{route('filter')}}",
                data: {writer: writer, date: date},
                headers: {Authorization: "Bearer " + token},
                success: function (response) {
                    var data = response.data;
                    $("#container").empty()
                    appendDataToContainer(data, 'filter');
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            })
        }

        function appendDataToContainer(data, type){
            if (data){
            data.forEach(function(item) {
                var dateObject = new Date(item.created_at);
                var date = dateObject.getDate() + "/" + (dateObject.getMonth()+1) + "/" +dateObject.getFullYear();

                var paragraph = (item.post_content).slice(0, 250)
                var url = window.location.origin;

                $("#container").append(
                    '<div class="item mb-5">'
                    + '<div class="row g-3 g-xl-0">'
                    + '<div class="col">'
                    + '<h3 class="title mb-1"><a class="text-link" href="' + url + '/single_post/' + item.id +'">' + item.title + '</a></h3>'
                    + '<div class="meta mb-1"><span class="date">Published at ' + item.date + '</span><span class="time">' + item.time + ' min read</span><span class="date">Posted by </span></div>'
                    + '<div class="intro">' + paragraph + '</div>'
                    + '<a class="text-link" href="' + url + '/single_post/' + item.id +'">Read more →</a>'
                    + '</div>'
                    + '</div>'
                    + '</div>'
                )
            })
            }else {
                let message = '';
                if(type === 'filter'){
                    message = 'Post not Found!'
                }else {
                    message = 'There is no post yet!'
                }

                $("#container").append(
                    '<div class="item mb-5">'
                        + '<div class="row g-3 g-xl-0">'
                            + '<div class="col">'
                                +'<h5>'+ message +'</h5>'
                            +'</div>'
                        + '</div>'
                        +'</div>'
                    +'</div>'
                )
            }
        }

    })
</script>

