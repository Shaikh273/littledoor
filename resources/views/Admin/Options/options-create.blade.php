@extends('Admin.layouts.base')

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item"><a href="">Options</a></li>
                        {{-- <li class="breadcrumb-item active">Create</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Options Details</h5>
                    </div>
                    <form class="widget-contact-form" id="aboutusAdd" action="" enctype="multipart/form-data">
                    {{-- <form method="post" action="" class="form theme-form needs-validation" novalidate="" enctype="multipart/form-data" > --}}
                        @csrf
                        <div class="card-body">
                            <div class="" id="formDiv">
                    
                            </div>
            
                            <div class=""><span class="">
                                    <a id="addButton" onclick="addSection()" class="btn btn-primary text-white"><i
                                            class="icon-plus"></i>
                                        Add new Optons</a></span></div>
                            <div class="notification-popup hide">
                                <p><span class="task"></span><span class="notification-text"></span></p>
                            </div>
                            <br><br>
                        </div>
                        <div class="card-footer">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-light" type="submit">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@endsection


@section('js')
<script src="{{asset('Assets/Admin/js/form-validation-custom.js')}}"></script>
<script src="{{asset('Asset/website/js/functions.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    $(function(){

        $('#aboutusAdd').on('submit', function(e){
            e.preventDefault();
            var form = this;
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(response){
                    $(form).find('span.error-text').text('');
                },

                success:function(data){
                    if(data.status == false){
                        $.each(data.errors, function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    }else{
                        $(form)[0].reset();

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });

                        }
                    }
            });

        });

        //Reset input file
        $('input[type="file"][name="image"]').val('');
        // Image preview
        $('input[type="file"][name="image"]').on('change', function(){
            var img_path = $(this)[0].value;
            var img_holder = $('.img-holder');
            var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();

            if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                if(typeof(FileReader) != 'undefined'){
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('<img/>',{'src':e.target.result,'class':'img-fluid','style':'max-width:100px;margin-bottom:10px'}).
                        appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                }else{
                    $(img_holder).html('This browser does not support FileReader.');
                }
            }
        });

    });




    var count = 0;

function addSection() {
    var text = document.createElement('div');
    text.className = "form-group row mb-4";
    text.id = "fdiv"+count;
    text.innerHTML = `
    <label class="col-md-3 col-form-label">Options ${count}</label>
                                        <div class="col-md-8">
                                            <textarea type="text" name="Options[${count}]" id="Options${count}"
                                                class="form-control" placeholder="Enter Options"></textarea>
                                            <span class="text-danger error-text features_error"></span>
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-danger mt-3" onclick="removeSection(this.parentNode.parentNode)">
                                                delete
                                            </button>
                                        </div>
                                    <br> <br> <br>
        `;
        document.getElementById('formDiv').appendChild(text);
        count = count + 1;
}


function removeSection(element) {
   element.remove();
}




</script>

@endsection
