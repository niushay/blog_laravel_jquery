@include("layouts.header")
<div class="main-wrapper">

    <section class="blog-list px-3 py-8 p-md-5">
    <div class="container single-col-max-width">
        <h5 style="margin-bottom: 5%">Create New Post</h5>

        <form enctype="multipart/form-data" id="create_post"  class="login-form" >
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

            <div class="file-field" style="margin-top: 5%">
                <div class="btn btn-secondary btn-sm float-left">
                    <span>Choose file</span>
                    <input type="file" id="photo_url" name="photo_url">
                </div>
            </div>

            <div class="form-group" style="margin-top: 5%">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
</div>

<script src="{{url("assets/vendor/jquery/jquery.min.js")}}"></script>
<script>
    $(document).ready(function () {

        // $("form").submit( function (e) {
        //     e.preventDefault();
        //
        //     var token = localStorage.getItem('token');
        //     var title = $('#title').val()
        //     var post_content = $('#content').val()
        //     var time = $('#time').val()
        //     var photo_url = $('#photo_url').val()
        //
        //     var data = {title, post_content, time, photo_url}
        //
        //     create_post(data);
        //     return false;
        // });

        $('form').on('submit', function (e) {
            var token = localStorage.getItem('token');
            e.preventDefault();
            data = $('form').serialize();
            console.log(data)

            $.ajax({
                type: 'post',
                url: "{{route('create')}}",
                data: data,
                headers: {
                    Authorization: "Bearer " + token,
                    Accept: "application/json",
                    'Content-Type': 'application/json',
                },
                success: function () {
                    alert('form was submitted');
                }
            });
        });

        // var token = localStorage.getItem('token');
        {{--$("#create_post").ajaxForm({--}}
        {{--    url: "{{route("create")}}",--}}
        {{--    type: 'post',--}}
        {{--    headers: {--}}
        {{--        Authorization: "Bearer " + token,--}}
        {{--        Accept: "application/json",--}}
        {{--        'Content-Type': 'application/json',--}}
        {{--    },--}}
        {{--    success: function (response){--}}
        {{--        console.log(response)--}}
        //     }

      // function create_post(data) {
      //
      // }
      //
      //       $.ajax({
      //           type: 'post',
      //           url: 'post.php',
      //           data: $('form').serialize(),
      //           success: function () {
      //               alert('form was submitted');
      //           }
      //       });
      //
      //   });
    })

{{--function create_post(email, password) {--}}
{{--$.ajax({--}}
{{--    method: 'POST',--}}
{{--    url: "{{route('login')}}",--}}
{{--    data: {'email': email, 'password': password},--}}
{{--    success: function(response){--}}
{{--        localStorage.setItem('token', response.access_token);--}}
{{--        if(response.status == 1) {--}}
{{--            window.location.href = "{{route("posts_list")}}"--}}
{{--        }else {--}}
{{--            alert('Email and/or Password Incorrect');--}}
{{--        }--}}
{{--        // main_page();--}}
{{--    },--}}
{{--    error: function(jqXHR, textStatus, errorThrown) {--}}
{{--        alert('Email and/or Password Incorrect');--}}
{{--        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);--}}
{{--    }--}}
{{--});--}}
{{--}--}}
// })
</script>
@include("layouts.footer")
