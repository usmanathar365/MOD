@php $table = "Client"; @endphp
@extends('admin.layouts.app')


@section('pageCss')

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

<style>
  .dataTables_filter {
    display: none;
  }

  .advanced-search-toggle {
    border-radius: 10px;
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



  @if(Session::has('brand_id'))

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-sm-6">
          <h1 class="m-0">{{$table}}s</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">

            @can('client-create')
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


                  @can('client-create')
                  <a class="create_modal" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a>
                  @endcan


                  @can('client-delete')
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
                    <label> First Name </label>
                    <input type="text" name="search_first_name" placeholder="First Name">
                  </div>
                </div>


                <div class="col-6 col-sm-4">
                  <div class="pop-field-input">
                    <label> Last Name </label>
                    <input type="text" name="search_last_name" placeholder="Last Name">
                  </div>
                </div>



                <div class="col-6 col-sm-4">
                  <div class="pop-field-input">
                    <label> Email </label>
                    <input type="text" name="search_email" placeholder="Email">
                  </div>
                </div>



                <div class="col-6 col-sm-4">
                  <div class="pop-field-input">
                    <label> Country </label>
                    <input type="text" name="search_country" placeholder="Country">
                  </div>
                </div>



                <div class="col-6 col-sm-4">
                  <div class="pop-field-input">
                    <label> Package Name </label>
                    <input type="text" name="search_package_name" placeholder="Package Name">
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
                  <th>
                    <span>Id</span>
                  </th>
                  <th>Name</th>
                  <th>Assigned Resources</th>
                  <th>Country</th>
                  <th>Package</th>
                  <th>Date</th>
                  <th>Action</th>
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
              <div class="details-pop-field">
                <form id="clientForm">
                  <div class="row">


                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label> First Name </label>
                        <input type="text" name="first_name" placeholder="First Name">
                        <span id="first_name_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Last Name </label>
                        <input type="text" name="last_name" placeholder="Last Name">
                        <span id="last_name_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Email </label>
                        <input type="text" name="email" placeholder="Email">
                        <span id="email_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Company </label>
                        <input type="text" name="company" placeholder="Company">
                        <span id="company" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Phone </label>

                        <input type="text" name="phone" placeholder="Phone Number">
                        <span id="phone_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Mobile </label>
                        <input type="text" name="mobile" placeholder="Mobile Phone Number">
                        <span id="mobile_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Business Phone </label>
                        <input type="text" name="business_phone" placeholder="Business Phone Number">
                        <span id="business_phone_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Postal Code </label>
                        <input type="text" name="postal" placeholder="Postal Code">
                        <span id="postal_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <input type="hidden" name="source" value="manual">
                    <input type="hidden" name="created_by" value="{{Auth::user()->id }}">

                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Address </label>
                        <input type="text" name="address" placeholder="Address">
                        <span id="address_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label> Country </label>
                        <input type="text" name="country" placeholder="Country">
                        <span id="country_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>




                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Package Name </label>
                        <input type="text" name="package_name" placeholder="Package Name">
                        <span id="package_name_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>



                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">

                        <label> Package Price </label>
                        <input type="text" name="package_price" placeholder="Package Price">
                        <span id="package_price_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>


                    <!-- <div class="col-12 col-sm-6">
                    <div class="pop-field-input">
                      <input type="text" name="city" placeholder="City">
                    </div>
                  </div> -->
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

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
  var dateRange = '';


  var table = $('.data-table').DataTable({
    processing: true,
    paging: true,
    serverSide: true,
    searching: true,
    ajax: {
      url: "{{ route('clients.list') }}",
      data: function(d) {
        d.search_id = $('input[name="search_id"]').val();
        d.search_first_name = $('input[name="search_first_name"]').val();
        d.search_last_name = $('input[name="search_last_name"]').val();
        d.search_email = $('input[name="search_email"]').val();
        d.search_country = $('input[name="search_country"]').val();
        d.search_package_name = $('input[name="search_package_name"]').val();
        d.search_date = dateRange;
      }
    },
    columns: [{
        data: 'id',
        name: 'id'
      },
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'assigned_resource',
        name: 'assigned_resource'
      },
      {
        data: 'country',
        name: 'country',
        render: function(data, type, row) {
          return (data == null) ? '' : `<div class="text-primary font-weight-bold"> ${data} </div> 
          `
        }
      },
      {
        data: 'package',
        name: 'package'
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







  function Create() {

    $(`.laravel_validation`).html('');
    var settings = {
      "url": "{{route('clients.create')}}",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify({
        "first_name": $("input[name=first_name]").val(),
        "last_name": $("input[name=last_name]").val(),
        "company": $("input[name=company]").val(),
        "email": $("input[name=email]").val(),
        "address": $("input[name=address]").val(),
        "package_name": $("input[name=package_name]").val(),
        "package_price": $("input[name=package_price]").val(),
        "phone": $("input[name=phone]").val(),
        "mobile": $("input[name=mobile]").val(),
        "business_phone": $("input[name=business_phone]").val(),
        "source": "manual",
        "city": $("input[name=city]").val(),
        "postal": $("input[name=postal]").val(),
        "country": $("input[name=country]").val(),
      }),
    };

    $.ajax(settings).done(function(response) {
      if (response.status == false) {
        for (let key of Object.entries(response.data)) {
          $(`#${key[0]}_err`).html(key[1]);
        }
      } else {





        $("input[name=first_name]").val('');
        $("input[name=last_name]").val('');
        $("input[name=company]").val('');
        $("input[name=email]").val('');
        $("input[name=address]").val('');
        $("input[name=package_name]").val('');
        $("input[name=package_price]").val('');
        $("input[name=phone]").val('');
        $("input[name=mobile]").val('');
        $("input[name=business_phone]").val('');
        $("input[name=city]").val('');
        $("input[name=postal]").val('');
        $("input[name=country]").val('');
        $('#createModal').modal('hide');

        swal("Created Successfully!", response.message, "success");

        $('#listTable').DataTable().ajax.reload();

      }

    });

  }













  function View(id) {
    var columns = ['created_at', 'first_name', 'last_name', 'company',
      'business_phone', 'source', 'city', 'postal', 'country',
      'email', 'address', 'mobile', 'phone', 'package_name', 'package_price'
    ];


    $('#modalViewTitle').html('Please wait..');
    $('#modalViewBody').html('');
    $('#ModalView').modal('show');
    var viewSettings = {
      "url": `${baseUrl}/clients/${id}`,
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
        $('#modalViewTitle').html(response.data.first_name + ' ' + response.data.last_name);

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
                    <img  src='{{URL("/public/uploads/clients");}}/${key[1]}'
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


    $('#saveBtn').html('Update');
    $('#modalViewTitle').html('Please wait..');
    $('#modalViewBody').html('');
    $(`.laravel_validation`).html('');
    $('.modal-title').html($('.modal-title').html().replace("New", "Edit"));

    $('#createModal').modal('show');
    var viewSettings = {
      "url": `${baseUrl}/clients/${id}`,
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
                        <img src="${baseUrl}/public/uploads/clients/${response.data.logo}" alt="">
                      </div>`);






        $("input[name=first_name]").val(response.data.first_name);
        $("input[name=last_name]").val(response.data.last_name);
        $("input[name=company]").val(response.data.company);
        $("input[name=email]").val(response.data.email);
        $("input[name=address]").val(response.data.address);
        $("input[name=package_name]").val(response.data.package_name);
        $("input[name=package_price]").val(response.data.package_price);
        $("input[name=phone]").val(response.data.phone);
        $("input[name=mobile]").val(response.data.mobile);
        $("input[name=business_phone]").val(response.data.business_phone);
        $("input[name=city]").val(response.data.city);
        $("input[name=postal]").val(response.data.postal);
        $("input[name=country]").val(response.data.country);
        $('#createModal').modal('hide');
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
          "url": `${baseUrl}/clients/${id}`,
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
              title: 'Deleted!',
              text: 'Deleted Successfully!',
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
          "url": `${baseUrl}/clients/1`,
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
    //button value
    $('#saveBtn').html('Save');
    ///validations
    $(`.laravel_validation`).html('');
    ///image preview
    $('.image-preview').html('');



    $('.modal-title').html($('.modal-title').html().replace("Edit", "New"));

    ////fields
    $("input[name=first_name]").val("");
    $("input[name=last_name]").val("");
    $("input[name=company]").val("");
    $("input[name=email]").val("");
    $("input[name=package_name]").val("");
    $("input[name=package_price]").val("");
    $("input[name=phone]").val("");
    $("input[name=mobile]").val("");
    $("input[name=business_phone]").val("");
    $("input[name=city]").val("");
    $("input[name=postal]").val("");
    $("input[name=country]").val("");
    $('#createModal').modal('hide');
    $("input[name=id]").val("");



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
      "url": `${baseUrl}/clients`,
      "method": "PUT",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify({
        "first_name": $("input[name=first_name]").val(),
        "last_name": $("input[name=last_name]").val(),
        "company": $("input[name=company]").val(),
        "email": $("input[name=email]").val(),
        "address": $("input[name=address]").val(),
        "package_name": $("input[name=package_name]").val(),
        "package_price": $("input[name=package_price]").val(),
        "phone": $("input[name=phone]").val(),
        "mobile": $("input[name=mobile]").val(),
        "business_phone": $("input[name=business_phone]").val(),
        "city": $("input[name=city]").val(),
        "postal": $("input[name=postal]").val(),
        "country": $("input[name=country]").val(),
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
        $("input[name=name]").val('');
        $("input[name=email]").val('');
        $("input[name=phone]").val('');
        $("input[name=address]").val('');
        $("input[name=country]").val('');
        $("input[name=package_name]").val('');
        $("input[name=package_price]").val('');
        $("input[name=link]").val('');
        $("input[name=logo]").val('');
        $("input[name=id]").val('');
        $('#createModal').modal('hide');

        swal("Updated Successfully!", tableName + " " + response.message, "success");

        $('#listTable').DataTable().ajax.reload();
      }

    });

  }




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




$(document).on("change", "#assigned_sales_resource", function(){
  assign_resource(this.value,'sales',this.parentElement.querySelectorAll(".resource-client")[0].value)
});


$(document).on("change", "#assigned_account_manager", function(){
  assign_resource(this.value,'account_manager',this.parentElement.querySelectorAll(".resource-client")[0].value)
});


function assign_resource(resource_id,type,client_id){

    var settings = {
      "url": "{{ route('clients.assign-resource') }}",
      "method": "PUT",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify({
        "resource": resource_id,
        "type": type,
        "client_id": client_id,
      })
    };

    $.ajax(settings).done(function(response) {

      console.log("response",response);

      if (response.status == false) {

        swal("Access Denied", response.message, "error");

      } else {
        swal("Assigned Successfully!",response.message, "success");
      }
    });

}




</script>




@else


<script>
  swal("Brand selection is necessary!", "Sorry, You need to select brand first.", "error");
</script>
@endif




@endsection