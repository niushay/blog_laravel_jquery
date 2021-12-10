@include("layouts.header")
<div class="main-wrapper">
    <section class="blog-list px-3 py-8 p-md-5">
    <div class="container single-col-max-width">
        <h5 style="margin-bottom: 5%">Create New Post</h5>

        <form action="{{route('create')}}" method="POST" enctype="multipart/form-data" id="create_post"  class="login-form" >
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="post_content">Content</label>
                <textarea class="form-control" id="post_content" rows="3" name="post_content"></textarea>
            </div>

            <div class="form-group">
                <label for="time">Time to read in minute</label>
                <input type="number" class="form-control" id="time" name="time">
            </div>

            <div class="form-group" style="margin-top: 5%">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>
</section>
</div>

<script src="{{url("assets/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{url("assets/vendor/jquery_validator/jquery.validate.js")}}"></script>

<script>
    $(function () {
        var $registrationForm = $("form")
        $.validator.addMethod("noSpace", function(value, element) {
            return value == '' || value.trim().length != 0
        }, "Spaces are not allowed");

        if($registrationForm.length){
            $registrationForm.validate({
                rules:{
                    title: {required: true, noSpace: true},
                    post_content: {required: true, minlength : 10},
                    time: {required: true, minlength : 4},
                },
                messages:{
                    title: {required: 'Title is required!'},
                    post_content: {required: 'Content is required!'},
                    time: {required: 'Time is required!'},
                }
            })
        }

        $('form').on('submit', function (e) {
            e.preventDefault();
            var token = localStorage.getItem('token');

            $.ajax({
                type: 'POST',
                url: "{{route('create')}}",
                headers:{Authorization: "Bearer " + token},
                data: $('form').serializeArray(),
                success: function () {
                    alert('New Post has been created');
                }
            });
        });
    });
</script>
@include("layouts.footer")
