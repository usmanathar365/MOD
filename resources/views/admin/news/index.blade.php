@php $table = "New"; @endphp
@extends('admin.layouts.app')


@section('pageCss')

<link href="{{ url('/') }}/admin/css/dropzone.min.css" rel="stylesheet">
<style>
  .container-toggle {
    display: flex;
    align-items: center;
  }

  .container-toggle div {
    margin: 5px;
  }

  .switch {
    position: relative;
    display: inline-block;
      width: 80px;
      height: 40px;
    overflow: hidden;
    background: #253b52;
    border-radius: 5px;
  }

  .switch input {
    display: none;
  }

  .toggle {
    position: absolute;
    background: '#fff5f';
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .toggle:after {
  content: " ";
      z-index: 99;
      width: 40%;
      height: 40%;
      position: absolute;
      top: 0;
      left: 0;
  }

  .toggle:before {
      position: absolute;
      content: " ";
      height: 80%;
      width: 60%;
      background: #fff;
      top: 10%;
      left: -20%;
      transition: left .4s ease-in-out, background .4s ease;
  }

  .switch:hover .toggle:before {
    
    cursor: pointer;
  }

  .off {
    color: green;
    transition: all .5s ease;
  }

  .on {
    color: #253b52;
    transition: all .5s ease;
  }

  input:checked + .toggle:before {
    left: 52px;
  }
    .dataTables_filter {
      display: none;
    }

  .advanced-search-toggle {
    border-radius: 10px;
  }


  span.select2.select2-container.select2-container--default {
    width: 100% !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #2c6db1;
  }

  td .client-group img {
    height: 100%;
    width: 100%;
    max-width: 100px;
    max-height: 100px;
  }

  .view-img img {

    height: 100%;
    width: 100%;
    max-width: 100px;
    max-height: 100px;
  }

  .image-preview img {
    height: 100%;
    width: 100%;
    max-width: 200px;
  }




  .custom-modal .modal-body {
    overflow-y: scroll;
    max-height: 800px;
    border: none;
    box-shadow: none;
    border-radius: 5px;
  }

  .custom-modal .modal-dialog {
    height: 100%;
    max-width: 800px;
    display: flex;
    align-items: center;
    margin: 0px auto;
  }

  .custom-modal .modal-body::-webkit-scrollbar-track {
    background-color: #fff;
  }

  .custom-modal .modal-body::-webkit-scrollbar {
    width: 5px;
    background-color: #30415e;
  }

  .custom-modal .modal-body::-webkit-scrollbar-thumb {
    background-color: #30415e;
  }

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 80vh;
    overflow-y: auto;
}
</style>





@endsection


@section('mainContent')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-sm-6">
          <h1 class="m-0">{{$table}}s</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">

            @can('brand-create')
            <a href="javascript:void(0)" class="create_modal">Add {{$table}}s</a>
            @endcan
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12">
          <div class="row">





          </div>
        </div>
        <div class="col-12 col-sm-12">
          <div class="client-head invoices-head mt-5">
            <div class="invoices-head-flex">
              <div class="invoices-h">
                <h6>
                  All {{$table}}s

                  @can('brand-create')
                  <a class="create_modal" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a>
                  @endcan


                  @can('brand-delete')
                  <a class="" href="javascript:void(0)"><i class="fa fa-trash bg-danger" onclick="DeleteAll(1)" aria-hidden="true"></i></a>
                  @endcan
                </h6>
              </div>
              <div class="invoices-search">
                <!-- <div class="feild">
                  <div class="invoices-icon">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </div>
                  <input type="text" name="" placeholder="Search">
                </div> -->
                <div class="feild-s advanced-search-toggle">
                  <div class="feild-i">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                  </div>
                  <h6>
                    Advanced Search
                  </h6>
                </div>
              </div>
            </div>
            <div class="search-details">
              <div class="row">




                <div class="col-6 col-sm-4">
                  <div class="pop-field-input">
                    <label> ID </label>
                    <input type="text" name="search_id" placeholder="ID">
                  </div>
                </div>


                <div class="col-6 col-sm-4">
                  <div class="pop-field-input">
                    <label> Title </label>
                    <input type="text" name="search_title" placeholder="Title">
                  </div>
                </div>
              
                <div class="col-6 col-sm-12">

                  <div class="pop-field-input">
                    <label> Date </label>
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-sm-12 ">
                  <div class="float-right">
                    <button class="btn btn-primary" id="searchBtn">Search</button>
                  </div>
                </div>

              </div>
            </div>
            <table id="listTable" class="table table-hover data-table">
              <thead>
                <tr>
                  <th> <span>Id</span> </th>
                  <th> <span>Image</span> </th>
                  <th> <span>Title</span> </th>
                  <th> <span>Content</span> </th>
                  <th> <span>Created Date </span></th>
                  <th> <span>Action</span></th>
                </tr>
              </thead>
              <tbody>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>




<!-- Create Modal -->
<div class="modal custom-modal modal-custom-1 fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <h5 class="modal-title" id="exampleModalLabel">
              Add {{$table}}s
            </h5>
          </div>
          <div class="col-sm-6">
            <ul class="breadcrumb">
              <li>
                <a data-dismiss="modal" href="javascript:void(0)">Cancel</a>
              </li>
              <li>
                <a id="saveBtn" href="javascript:void(0)"></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="row m-2">
          <div class="col-12 col-sm-12">
            <div class="client-details-pop">




              <div class="row ">


                <div class="col-12">
                  <label for=""> Image</label>

                  <div class="image-preview">
                  </div>
                  <span id="image_err" class="text-danger laravel_validation"> </span>

                </div>
                <div class="col-12">

                  <form id="uploaderForm" action="{{route('news.upload')}}" class='dropzone'>
                    @csrf

                  </form>
                </div>



                <form id="clientForm">
                  <div class="row">



                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">
                        <label for=""> Title</label>
                        <input type="text" name="title" placeholder="Title">
                        <span id="title_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>
                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">
                        <label for=""> Slug</label>
                        <input type="text" name="slug" placeholder="Slug">
                        <span id="slug_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">
                        <label for="">Availability Start/End Date</label>
                        <input type="text" name="news_date">
                        <span id="news_date_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>
                    <div class="pop-field-input col-6 col-sm-6">
                      <label for=""> Is Featured</label>
                      <div class="container-toggle">
                           <label class="switch m-0">
                               <input id="is_featured" class="toggle-check" name="is_featured" onclick="onOff(this)" type="checkbox">
                             <span class="toggle"></span>
                           </label>
                           <div class="on"></div>
                      </div>
                      <span id="featured_err" class="text-danger laravel_validation"> </span>
                    </div>
                    <div class="pop-field-input col-6 col-sm-6">
                      <label for=""> Is Visible</label>
                      <div class="container-toggle">                      
                                              
                        <label class="switch m-0">
                                <input id="is_visible" class="toggle-check" name="is_visible" onclick="onOff(this)" type="checkbox">
                              <span class="toggle"></span>
                            </label>
                            <div class="on"></div>
                      </div>
                      <span id="visible_err" class="text-danger laravel_validation"> </span>
                    </div>
                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">

                        <label for=""> Content</label>
                        <!-- <input type="text" name="content" placeholder="Content"> -->
                        <textarea id="content" name="content" placeholder="">
                        </textarea>
                        <span id="content_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <input type="hidden" name="image">
                    <input type="hidden" name="id">

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<!-- View Modal -->
<div class="modal custom-modal  modal-custom-1 fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 75%;">
      <div class="modal-header">
        <div class="row align-items-center">
          <div class="col-sm-12">
            <h5 class="modal-title text-center" id="modalViewTitle">
              VIEW
            </h5>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div id="modalViewBody">

        </div>
      </div>
    </div>
  </div>
</div>




@endsection



@section('pageJs')



<script src="{{ url('/') }}/admin/js/dropzone.min.js"></script>

<script type="text/javascript">
  Dropzone.options.uploaderForm = {
    maxFilesize: 1,
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg",
    init: function() {
      this.on("addedfile", function() {

        if (this.files[1] != null) {
          this.removeFile(this.files[0]);
        }
      });
    },
    success: function(file, response) {
      if (response.success) {
        $("input[name=image]").val(response.image_name)
      }
    },

  };
</script>
<!-- CKEditor --> 
<script src="{{ url('/') }}/admin/ckeditor/ckeditor.js"></script>
    

    <script type="text/javascript">

    // Initialize CKEditor
    CKEDITOR.replace( 'content',{
      width: "100%",
      height: "100%"
    });

    function insertIntoCkeditor(element,str){
      CKEDITOR.instances[element].insertText(str);
    }

  $(document).ready(function() {
    $('textarea').each(function(){
        $(this).on('change',function(){
            $(this).height( $(this)[0].scrollHeight );
        });
    });

  });

  function onOff(th){
  var z = document.getElementById('check');
  var on = th.parentElement.parentElement.querySelectorAll('.on')[0]; //document.getElementsByClassName('on');
  var off = th.parentElement.parentElement.querySelectorAll('.off')[0]; //document.getElementsByClassName('off');
  
  if (th.checked == false) {
    on.innerHTML="No";
    on.style.color="#253b52";
  } else {
    on.style.color="green";
    on.innerHTML="Yes";   
   
  }
}




</script>
<script type="text/javascript">
  var tableName = "{{$table}}";
  var baseUrl = "{{url('/')}}";
  var resources = $(".multi-resources");
  var dateRange = '';

  var table = $('.data-table').DataTable({
    processing: true,
    paging: true,
    serverSide: true,
    searching: true,
    ajax: {
      url: "{{ route('news.list') }}",
      data: function(d) {
        d.search_id = $('input[name="search_id"]').val();
        d.search_title = $('input[name="search_title"]').val();
        d.search_date = dateRange;
      }
    },
    columns: [{
        data: 'id',
        name: 'id'
      },
      {
        data: 'image',
        name: 'image'
      },
      {
        data: 'title',
        name: 'title'
      },
      {
        data: 'content',
        name: 'content'
      },
      {
        data: 'created_at',
        name: 'created_at',
        render: function(data, type, row) {
          return `<div>  ${moment(data).format('Do MMMM YYYY')} </div>   
          <div>  ${moment(data).format('h:mm:ss a')} </div>
          <div><span class="badge badge-secondary">${moment(data).fromNow()}</span></div>
          `
        }
      },
      {
        data: 'action',
        name: 'action'
      },
    ]
  });

  $('#status').change(function() {
    table.draw();
  });




  function Create() {
    $(`.laravel_validation`).html('');
    
    var is_visible = document.getElementById('is_visible');
    var is_featured = document.getElementById('is_featured');
    if(is_featured.checked == true){
      is_featured = 1;
    }else{
      is_featured = 0;
    }
    if(is_visible.checked == true){
      is_visible = 1;
    }else{
      is_visible = 0;
    }

    var settings = {
      "url": "{{route('news.create')}}",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify({
        "title": $("input[name=title]").val(),
        "slug": $("input[name=slug]").val(),
        "news_content": CKEDITOR.instances.content.getData(),
        "news_date": $("input[name=news_date]").val(),
        "is_featured": is_featured,
        "is_visible": is_visible,
        "image": $("input[name=image]").val(),
      }),
    };

    $.ajax(settings).done(function(response) {
      if (response.status == false) {
        for (let key of Object.entries(response.data)) {
          $(`#${key[0]}_err`).html(key[1]);
        }
      } else {


        $('.image-preview').html('');
        $("input[name=title]").val('');
        $("input[name=content]").val('');
        CKEDITOR.instances.content.setData('');
        $('#is_featured').prop('checked', false);
        $('#is_visible').prop('checked', false);
        $('.on').html('');
        $(".multi-resources").val(),
        $("input[name=image]").val('');
        $("input[name=id]").val('');
        $('#createModal').modal('hide');
        swal("Created Successfully!", response.message, "success");
        $('#listTable').DataTable().ajax.reload();
      }
    });
  }
  function View(id) {
    var columns = ['created_at', 'title', 'content','image'];

    // $('#modalViewTitle').html('a');
    $('#modalViewBody').html('');
    $('#ModalView').modal('show');
    var viewSettings = {
      "url": `${baseUrl}/news/${id}`,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      }
    };

    $.ajax(viewSettings).done(function(response) {
    
      if (response.status == false) {
        swal("Error!", "Something went wrong", "error");
      } else {
        $('#modalViewTitle').html(response.data.title);

        $('#modalViewBody').append(`<div class="row">`);
        for (let key of Object.entries(response.data)) {

          

          if (columns.find(element => (element == key[0]) ? true : false)) {
            key[0] = key[0].replace("_", " ");

            if (key[0] == "image") {
              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName}s ${key[0]}</label>
                    <div class="view-img"> 
                    <img  src='{{URL("/public/uploads/news");}}/${key[1]}'
                    </div>
                  </div>
                  `);


            } else if (key[0] == "created at") {
              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName}s ${key[0]}</label>
                    <p class=".text-secondary"> ${moment(key[1]).format('dddd, MMMM Do YYYY, h:mm:ss a')} </p>
                  </div>
                  `);

              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName}s tenure</label>
                    <p class=".text-secondary"> ${moment(key[1]).fromNow()} </p>
                  </div>
                  `);



            } else if (key[0] == "link") {

              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName}s Website Url</label>
                    <p class=".text-secondary"> ${key[1]} </p>
                  </div>
                  `);

            } else {

              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName}s ${key[0]}</label>
                    <p class=".text-secondary"> ${key[1]} </p>
                  </div>
                  `);
            }
          }
        }
        $('#modalViewBody').append(`</div>`);
      }

    });

  }
  function Edit(id) {
    resources.val([]);
    resources.trigger('change');
    $('#saveBtn').html('Update');
    $('#modalViewTitle').html('Please wait..');
    $('.modal-title').html($('.modal-title').html().replace("New", "Edit"));
    $('#modalViewBody').html('');
    $(`.laravel_validation`).html('');

    $('#createModal').modal('show');
    var viewSettings = {
      "url": `${baseUrl}/news/${id}`,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      }
    };
    $.ajax(viewSettings).done(function(response) {
      if (response.status == false) {
        swal("Error!", "Something went wrong", "error");
      } else {

        $('.image-preview').html(`<div class="view-img text-center mb-5">
                        <img src="${baseUrl}/public/uploads/news/${response.data.image}" alt="">
                      </div>`);
                      var is_visible = document.getElementById('is_visible');
                      var is_featured = document.getElementById('is_featured');
                      var is_visible1 = is_visible.parentElement.parentElement.querySelectorAll('.on')[0]; //document.getElementsByClassName('on');
                      var is_featured1 = is_featured.parentElement.parentElement.querySelectorAll('.on')[0]; //document.getElementsByClassName('off');
  
                     
              if(response.data.is_featured == 0){
                $('#is_featured').prop('checked', false); // Unchecks it
                        is_featured1.innerHTML="No";
                        is_featured1.style.color="#253b52";
              }else{
                $('#is_featured').prop('checked', true); // Checks it
                        is_featured1.style.color="green";
                        is_featured1.innerHTML="Yes";   
              }
              if(response.data.is_visible == 0){
                $('#is_visible').prop('checked', false); // unChecks it  
                        is_visible1.innerHTML="No";
                        is_visible1.style.color="#253b52";              
              }else{
                $('#is_visible').prop('checked', true); // Checks it 
                        is_visible1.style.color="green";
                        is_visible1.innerHTML="Yes";                
              }
        $("input[name=title]").val(response.data.title);
        $("input[name=slug]").val(response.data.slug);
        CKEDITOR.instances.content.setData(response.data.content);
        $("input[name=news_date]").val(response.data.start_date+' - '+response.data.end_date);
        $("input[name=image]").val(response.data.image);
        $("input[name=id]").val(response.data.id);
      }

    });

  }

  function Delete(id) {
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this record!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
        var viewSettings = {
          "url": `${baseUrl}/news/${id}`,
          "method": "DELETE",
          "timeout": 0,
          "headers": {
            "Content-Type": "application/json",
            "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
          }
        };
        $.ajax(viewSettings).done(function(response) {
         
          if (response.status == true) {
            swal({
              title: 'Deleted Successfully!',
              text: response.message,
              icon: 'success'
            });

            $('#listTable').DataTable().ajax.reload();

          } else {
            swal("Cancelled", "Something went wrong :)", "error");
          }
        });

      } else {
        swal("Cancelled", "Your record is safe :)", "error");
      }
    });
  }
  function DeleteAll() {

    var ids = [];

    var checkboxes = document.querySelectorAll('.multidelete:checked')

    for (var i = 0; i < checkboxes.length; i++) {
      ids.push(checkboxes[i].value)
    }
    if (!ids.length > 0) {
      swal("No Records selected", "You need to select records first.", "error");
      return false;
    }


    swal({
      title: "Are you sure?",
      text: "You will not be able to recover these records!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
        var viewSettings = {
          "url": `${baseUrl}/news/1`,
          "method": "DELETE",
          "data": JSON.stringify({
            "ids": ids
          }),
          "timeout": 0,
          "headers": {
            "Content-Type": "application/json",
            "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
          }
        };
        $.ajax(viewSettings).done(function(response) {
          
          if (response.status == true) {
            swal({
              title: 'Records Deleted!',
              text: 'Deleted Successfully!',
              icon: 'success'
            });

            $('#listTable').DataTable().ajax.reload();

          } else {
            swal("Cancelled", "Something went wrong :)", "error");
          }
        });

      } else {
        swal("Cancelled", "Your records are safe :)", "error");
      }
    });
  }
  $('.create_modal').click(function() {


    resources.val([]);
    resources.trigger('change');

    //button value
    $('#saveBtn').html('Save');
    ///validations
    $(`.laravel_validation`).html('');
    ///image preview
    $('.image-preview').html('');

    $('.modal-title').html($('.modal-title').html().replace("Edit", "New"));



    ////fields
    $("input[name=title]").val('');
    $("input[name=news_content]").val('');
    $("input[name=image]").val('');
    $("input[name=slug]").val('');
    $("input[name=news_date]").val('');
    $('#is_featured').prop('checked', false);
    $('#is_visible').prop('checked', false);
    $('.on').html('');
    CKEDITOR.instances.content.setData('');
    $("input[name=id]").val('');
    ///show
    $('#createModal').modal('show');
  });


  $('#saveBtn').click(function() {
    if ($('#saveBtn').html() == "Update") {
      Update();
    } else {
      Create();
    }
  });

  function Update() {

    $(`.laravel_validation`).html('');
    var is_visible = document.getElementById('is_visible');
    var is_featured = document.getElementById('is_featured');
    if(is_featured.checked == true){
      is_featured = 1;
    }else{
      is_featured = 0;
    }
    if(is_visible.checked == true){
      is_visible = 1;
    }else{
      is_visible = 0;
    }

    var settings = {
      "url": `${baseUrl}/news`,
      "method": "PUT",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify({
        "title": $("input[name=title]").val(),
        "slug": $("input[name=slug]").val(),
        "news_content": CKEDITOR.instances.content.getData(),
        "news_date": $("input[name=news_date]").val(),
        "is_featured": is_featured,
        "is_visible": is_visible,
        "image": $("input[name=image]").val(),
        "id": $("input[name=id]").val(),
       
      })
    };

    $.ajax(settings).done(function(response) {

      if (response.status == false) {
        for (let key of Object.entries(response.data)) {
          $(`#${key[0]}_err`).html(key[1]);
        }
      } else {

        $('.image-preview').html('');
        $("input[name=title]").val('');
        $("input[name=content]").val('');
        $("input[name=image]").val('');
        $('#is_featured').prop('checked', false);
        $('#is_visible').prop('checked', false);
        $('.on').html('');
        CKEDITOR.instances.content.setData('');
        $("input[name=id]").val('');
        $('#createModal').modal('hide');

        swal("Updated Successfully!", response.message, "success");

        $('#listTable').DataTable().ajax.reload();
      }

    });

  }

  $(document).ready(function() {
    $('.multi-resources').select2();
  });

  $('#searchBtn').click(() => {
    dateRange = $('#reportrange span').html();
    table.draw();
  });

  $(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);

    cb(start, end);

  });

  $(function() {
    $('input[name="news_date"]').daterangepicker({
      timePicker: true,
      // startDate: moment().startOf('hour'),
      // endDate: moment().startOf('hour').add(32, 'hour'),
      locale: {
        format: 'YYYY-MM-DD hh:mm:ss'
      }
    });
  });

</script>

@endsection