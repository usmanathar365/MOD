@php $table = "Brand"; @endphp
@extends('admin.layouts.app')


@section('pageCss')

<link href="{{ url('/') }}/admin/css/dropzone.min.css" rel="stylesheet">

<style>
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
            <a href="javascript:void(0)" class="create_modal">New {{$table}}</a>
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
                    <label> Name </label>
                    <input type="text" name="search_name" placeholder="Name">
                  </div>
                </div>
                <div class="col-6 col-sm-4">
                  <div class="pop-field-input">
                    <label> Email </label>
                    <input type="text" name="search_email" placeholder="Email">
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
                  <th> <span>Logo</span> </th>
                  <th> <span>Name</span> </th>
                  <th> <span>Assigned Resources</span> </th>
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
              New {{$table}}
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
                  <label for=""> Logo</label>

                  <div class="image-preview">
                  </div>
                  <span id="logo_err" class="text-danger laravel_validation"> </span>

                </div>
                <div class="col-12">

                  <form id="uploaderForm" action="{{route('brands.upload')}}" class='dropzone'>
                    @csrf

                  </form>
                </div>



                <form id="clientForm">
                  <div class="row">



                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Name</label>
                        <input type="text" name="name" placeholder="Name">
                        <span id="name_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    
                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Slug</label>
                        <input type="text" name="slug" placeholder="Brand Slug">
                        <span id="slug_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label for=""> Email</label>

                        <input type="text" name="email" placeholder="Email">
                        <span id="email_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label for=""> Website URL</label>

                        <input type="text" name="website_url" placeholder="Website URL">
                        <span id="website_url_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>


                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label for=""> Phone</label>
                        <input type="text" name="phone" placeholder="Phone">
                        <span id="phone_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>
                    
                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label for=""> Brand Suffix</label>
                        <input type="text" name="suffix" placeholder="Suffix">
                        <span id="suffix_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>



                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">

                        <label for=""> Address</label>
                        <input type="text" name="address" placeholder="Address">
                        <span id="address_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>


                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label for=""> Country</label>
                        <input type="text" name="country" placeholder="Country">
                        <span id="country_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>


                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Invoice Starting Number</label>
                        <input type="text" name="invoice_starting_number" placeholder="Invoice Starting Number">
                        <span id="invoice_starting_number_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>



                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">

                        <label for=""> Terms & Conditions</label>
                        <input type="text" name="terms" placeholder="Terms & Conditions">

                        <span id="terms_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>








                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">
                        <label for=""> Assign Resources</label>

                        <select class=" form-control multi-resources" name="resources[]" multiple="multiple">
                          @foreach($users as $record)
                          <option value="{{$record->id}}">{{$record->name}}</option>
                          @endforeach
                        </select>

                        <span id="resources_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>



                    <div class="col-12 col-sm-6">

                      <hr>

                      <div class="pop-field-input">
                        <label for=""> Mail Host</label>
                        <input type="text" name="mail_host" placeholder="smtp.gmail.com">
                        <span id="mail_host_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>


                    <div class="col-12 col-sm-6">

                      <hr>

                      <div class="pop-field-input">
                        <label for=""> Mail Driver</label>
                        <input type="text" name="mail_driver" placeholder="smtp">
                        <span id="mail_driver_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>




                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Mail Port</label>
                        <input type="text" name="mail_port" placeholder="587">
                        <span id="mail_port_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>


                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Mail User Name</label>
                        <input type="text" name="mail_user_name" placeholder="support@canvasdigital.net">
                        <span id="mail_user_name_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>


                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Mail User Password</label>
                        <input type="text" name="mail_password" placeholder="be12BQu#">
                        <span id="mail_password_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>



                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Mail Encryption</label>
                        <input type="text" name="mail_encryption" placeholder="tls">
                        <span id="mail_encryption_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>


                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Mail From Email Address</label>
                        <input type="text" name="mail_email_address" placeholder="support@canvasdigital.net">
                        <span id="mail_email_address_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>



                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Mail From Name</label>
                        <input type="text" name="mail_name" placeholder="Canvas Digital">
                        <span id="mail_name_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>










                    <input type="hidden" name="logo">
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
        $("input[name=logo]").val(response.image_name)
      }
    },

  };
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
      url: "{{ route('brands.list') }}",
      data: function(d) {
        d.search_id = $('input[name="search_id"]').val();
        d.search_name = $('input[name="search_name"]').val();
        d.search_email = $('input[name="search_email"]').val();
        d.search_date = dateRange;
      }
    },
    columns: [{
        data: 'id',
        name: 'id'
      },
      {
        data: 'logo',
        name: 'logo'
      },
      {
        data: 'brand',
        name: 'brand'
      },
      {
        data: 'resources',
        name: 'resources'
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
    var settings = {
      "url": "{{route('brands.create')}}",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify({
        "name": $("input[name=name]").val(),
        "slug": $("input[name=slug]").val(),
        "email": $("input[name=email]").val(),
        "website_url": $("input[name=website_url]").val(),
        "logo": $("input[name=logo]").val(),
        "phone": $("input[name=phone]").val(),
        "suffix": $("input[name=suffix]").val(),        
        "address": $("input[name=address]").val(),
        "country": $("input[name=country]").val(),
        "terms": $("input[name=terms]").val(),
        "invoice_starting_number": $("input[name=invoice_starting_number]").val(),
        "mail_host": $("input[name=mail_host]").val(),
        "mail_driver": $("input[name=mail_driver]").val(),
        "mail_port": $("input[name=mail_port]").val(),
        "mail_user_name": $("input[name=mail_user_name]").val(),
        "mail_password": $("input[name=mail_password]").val(),
        "mail_encryption": $("input[name=mail_encryption]").val(),
        "mail_email_address": $("input[name=mail_email_address]").val(),
        "mail_name": $("input[name=mail_name]").val(),
        "resources": $(".multi-resources").val(),
      }),
    };

    $.ajax(settings).done(function(response) {
      if (response.status == false) {
        for (let key of Object.entries(response.data)) {
          $(`#${key[0]}_err`).html(key[1]);
        }
      } else {


        $('.image-preview').html('');
        $("input[name=name]").val('');
        $("input[name=slug]").val('');
        $("input[name=email]").val('');
        $("input[name=phone]").val('');
        $("input[name=suffix]").val('');        
        $("input[name=address]").val('');
        $("input[name=country]").val('');
        $("input[name=terms]").val('');
        $("input[name=invoice_starting_number]").val('');
        $("input[name=mail_host").val('');
        $("input[name=mail_driver").val('');
        $("input[name=mail_port").val('');
        $("input[name=mail_user_name").val('');
        $("input[name=mail_password").val('');
        $("input[name=mail_encryption").val('');
        $("input[name=mail_email_address").val('');
        $("input[name=mail_name").val('');

        $(".multi-resources").val(),


          $("input[name=website_url]").val('');
        $("input[name=logo]").val('');
        $("input[name=id]").val('');
        $('#createModal').modal('hide');

        swal("Created Successfully!", response.message, "success");

        $('#listTable').DataTable().ajax.reload();

      }

    });

  }




  function View(id) {
    var columns = ['created_at', 'name', 'id', 'phone', 'suffix', 'logo', 'address', 'link', 'country', 'terms', 'invoice_starting_number', 'mail_host', 'mail_driver', 'mail_port', 'mail_user_name', 'mail_password', 'mail_encryption', 'mail_email_address', 'mail_name'];

    $('#modalViewTitle').html('Please wait..');
    $('#modalViewBody').html('');
    $('#ModalView').modal('show');
    var viewSettings = {
      "url": `${baseUrl}/brands/${id}`,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      }
    };

    $.ajax(viewSettings).done(function(response) {
      console.log(response.status);
      if (response.status == false) {
        swal("Error!", "Something went wrong", "error");
      } else {
        $('#modalViewTitle').html(response.data.name);

        $('#modalViewBody').append(`<div class="row">`);
        for (let key of Object.entries(response.data)) {

          console.log("table", tableName);

          if (columns.find(element => (element == key[0]) ? true : false)) {
            key[0] = key[0].replace("_", " ");

            if (key[0] == "logo") {
              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName} ${key[0]}</label>
                    <div class="view-img"> 
                    <img  src='{{URL("/public/uploads/brands");}}/${key[1]}'
                    </div>
                  </div>
                  `);


            } else if (key[0] == "created at") {
              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName} ${key[0]}</label>
                    <p class=".text-secondary"> ${moment(key[1]).format('dddd, MMMM Do YYYY, h:mm:ss a')} </p>
                  </div>
                  `);

              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName} tenure</label>
                    <p class=".text-secondary"> ${moment(key[1]).fromNow()} </p>
                  </div>
                  `);



            } else if (key[0] == "link") {

              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName} Website Url</label>
                    <p class=".text-secondary"> ${key[1]} </p>
                  </div>
                  `);

            } else {

              $('#modalViewBody').append(`
                <div class="col-12 col-sm-12">
                    <label class="m-0"> ${tableName} ${key[0]}</label>
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
      "url": `${baseUrl}/brands/${id}`,
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      }
    };

    $.ajax(viewSettings).done(function(response) {
      console.log(response.status);
      if (response.status == false) {
        swal("Error!", "Something went wrong", "error");
      } else {

        $('.image-preview').html(`<div class="view-img text-center mb-5">
                        <img src="${baseUrl}/public/uploads/brands/${response.data.logo}" alt="">
                      </div>`);





        $("input[name=name]").val(response.data.name);
        $("input[name=email]").val(response.data.email);
        $("input[name=phone]").val(response.data.phone);
        $("input[name=suffix]").val(response.data.suffix);
        
        $("input[name=slug]").val(response.data.slug);
        $("input[name=address]").val(response.data.address);
        $("input[name=country]").val(response.data.country);
        $("input[name=terms]").val(response.data.terms);
        $("input[name=invoice_starting_number]").val(response.data.invoice_starting_number);
        $("input[name=mail_host]").val(response.data.mail_host);
        $("input[name=mail_driver]").val(response.data.mail_driver);
        $("input[name=mail_port]").val(response.data.mail_port);
        $("input[name=mail_user_name]").val(response.data.mail_user_name);
        $("input[name=mail_password]").val(response.data.mail_password);
        $("input[name=mail_encryption]").val(response.data.mail_encryption);
        $("input[name=mail_email_address]").val(response.data.mail_email_address);
        $("input[name=mail_name]").val(response.data.mail_name);
        $("input[name=website_url]").val(response.data.link);
        $("input[name=logo]").val(response.data.logo);
        $("input[name=id]").val(response.data.id);





        if (response.data.resources.length) {

          let resourcesArray = JSON.parse(response.data.resources);

          resources.val(resourcesArray);
          resources.trigger('change');

          // for (var i = 0; i < resourcesArray.length; i++) {
          //  var option = new Option('test', resourcesArray[i].value, true, true);
          //  resources.append(option).trigger('change');

          // }

        }






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
          "url": `${baseUrl}/brands/${id}`,
          "method": "DELETE",
          "timeout": 0,
          "headers": {
            "Content-Type": "application/json",
            "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
          }
        };
        $.ajax(viewSettings).done(function(response) {
          console.log(response.status);
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
          "url": `${baseUrl}/brands/1`,
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
          console.log(response.status);
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
    $("input[name=name]").val('');
    $("input[name=slug]").val('');
    $("input[name=email]").val('');
    $("input[name=phone]").val('');
    $("input[name=suffix]").val('');
    
    $("input[name=address]").val('');
    $("input[name=country]").val('');
    $("input[name=terms]").val('');
    $("input[name=invoice_starting_number]").val('');
    $("input[name=mail_host]").val('');
    $("input[name=mail_driver]").val('');
    $("input[name=mail_port]").val('');
    $("input[name=mail_user_name]").val('');
    $("input[name=mail_password]").val('');
    $("input[name=mail_encryption]").val('');
    $("input[name=mail_email_address]").val('');
    $("input[name=mail_name]").val('');
    $("input[name=website_url]").val('');
    $("input[name=logo]").val('');
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
    var settings = {
      "url": `${baseUrl}/brands`,
      "method": "PUT",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify({
        "name": $("input[name=name]").val(),
        "email": $("input[name=email]").val(),
        "website_url": $("input[name=website_url]").val(),
        "logo": $("input[name=logo]").val(),
        "phone": $("input[name=phone]").val(),
        "suffix": $("input[name=suffix]").val(),
        
        "slug": $("input[name=slug]").val(),
        "address": $("input[name=address]").val(),
        "country": $("input[name=country]").val(),
        "terms": $("input[name=terms]").val(),
        "invoice_starting_number": $("input[name=invoice_starting_number]").val(),
        "mail_host": $("input[name=mail_host]").val(),
        "mail_driver": $("input[name=mail_driver]").val(),
        "mail_port": $("input[name=mail_port]").val(),
        "mail_user_name": $("input[name=mail_user_name]").val(),
        "mail_password": $("input[name=mail_password]").val(),
        "mail_encryption": $("input[name=mail_encryption]").val(),
        "mail_email_address": $("input[name=mail_email_address]").val(),
        "mail_name": $("input[name=mail_name]").val(),
        "id": $("input[name=id]").val(),
        "resources": $(".multi-resources").val(),
      })
    };

    $.ajax(settings).done(function(response) {
      if (response.status == false) {
        for (let key of Object.entries(response.data)) {
          $(`#${key[0]}_err`).html(key[1]);
        }
      } else {




        $('.image-preview').html('');
        $("input[name=name]").val('');
        $("input[name=email]").val('');
        $("input[name=phone]").val('');
        $("input[name=suffix]").val('');        
        $("input[name=slug]").val('');
        $("input[name=address]").val('');
        $("input[name=country]").val('');
        $("input[name=terms]").val('');
        $("input[name=invoice_starting_number]").val('');
        $("input[name=mail_host]").val('');
        $("input[name=mail_driver]").val('');
        $("input[name=mail_port]").val('');
        $("input[name=mail_user_name]").val('');
        $("input[name=mail_password]").val('');
        $("input[name=mail_encryption]").val('');
        $("input[name=mail_email_address]").val('');
        $("input[name=website_url]").val('');
        $("input[name=logo]").val('');
        $("input[name=id]").val('');
        $('#createModal').modal('hide');

        swal("Updated Successfully!", response.message, "success");

        $('#listTable').DataTable().ajax.reload();
      }

    });

  }
</script>


<script>
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


  $(function(){
      $('input').on('keyup',function(){
          var brand_name = $('input[name=name]').val();
          var slug = brand_name.split(' ').join('_');
          $('input[name=slug]').val(slug.toUpperCase());
      });
  });


</script>




@endsection