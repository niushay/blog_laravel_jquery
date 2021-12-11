@include("layouts.header")
<div class="main-wrapper">
    <section class="blog-list px-3 py-8 p-md-5">
        <article class="blog-post px-3 py-5 p-md-5">
            <div class="container single-col-max-width">
                <header class="blog-post-header">
                    <h2 class="title mb-2"></h2>
                    <div class="meta mb-3"><span class="date">Published at </span><span class="time"></span></div>
                </header>
                <div class="blog-post-body">
                    <p></p>
                </div>
            </div>
        </article>
    </section>
</div>

<script src="{{url("assets/vendor/jquery/jquery.min.js")}}"></script>
<script>
    $(function () {
        var token = localStorage.getItem('token');

        //Get Post details
        $.ajax({
            type: 'GET',
            url: "{{route('single', $id)}}",
            headers:{Authorization: "Bearer " + token},
            data: $('form').serializeArray(),
            success: function (response) {
                var date = new Date(response.data.created_at);

                $(".date").append(date.getDate() + "/" + (date.getMonth()+1) + "/"+date.getFullYear())
                $(".time").append(response.data.time + " min read");
                $(".title").append(response.data.title);
                $(".blog-post-body").append(response.data.post_content);
            }
        });
    });
</script>
@include("layouts.footer")
