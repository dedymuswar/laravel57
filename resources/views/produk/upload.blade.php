@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container">
                <h3 align="center">Upload Image with Ajax</h3>
                <div class="alert" id="message" style="display:none">
                </div>
                <form method="post" id="upload_form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <table class="table ">
                            <tr>
                                <td width="40%" align="right">
                                    <label>Select File </label>
                                </td>
                                <td width="30">
                                    <input type="file" name="select_file" id="select_file">
                                </td>
                                <td width="30%" align="left">
                                    <input value="Upload" type="submit" name="upload" id="upload"
                                        class="btn btn-primary">
                                </td>
                            </tr>
                            {{-- <tr>
                                    <td width="40%" align="right">
                                    </td>
                                    <td width="30">
                                        <span class="text-muted">jpg, png, gif</span>
                                    </td>
                                    <td width="30%" align="left"></td>
                                </tr> --}}
                        </table>
                    </div>
                </form><br>
                <span id="uploaded_image"></span>
                <hr>
                <br />
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#upload_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{ route('postUpload') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                    $('#uploaded_image').html(data.uploaded_image);
                }
            })
        });
    });
</script>
@endsection