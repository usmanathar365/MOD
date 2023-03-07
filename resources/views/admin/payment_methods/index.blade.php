@php $table = "Payment Method"; @endphp
@extends('admin.layouts.app')


@section('pageCss')

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

<style>
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


            @can('payment-methods-create')
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


                  @can('payment-methods-create')
                  <a class="create_modal" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a>
                  @endcan

                  @can('payment-methods-delete')
                  <a class="" href="javascript:void(0)"><i class="fa fa-trash bg-danger" onclick="DeleteAll(1)" aria-hidden="true"></i></a>
                  @endcan

                </h6>
              </div>
              <!-- <div class="invoices-search">
                <div class="feild">
                  <div class="invoices-icon">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </div>
                  <input type="text" name="" placeholder="Search">
                </div>
                <div class="feild-s advanced-search-toggle">
                  <div class="feild-i">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                  </div>
                  <h6>
                    Advanced Search
                  </h6>
                </div>
              </div> -->
            </div>
            <!-- <div class="search-details">
              <div class="row">
                <div class="col-sm-4">
                  <label>Multiple</label>
                  <select id="status">
                    <option>All Clients</option>
                    <option>All Clients</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Invoice Status</label>
                  <select>
                    <option>All Clients</option>
                    <option>All Clients</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Date Range</label>
                  <select>
                    <option>All Clients</option>
                    <option>All Clients</option>
                  </select>
                </div>
              </div>
            </div> -->
            <table id="listTable" class="table table-hover data-table">
              <thead>
                <tr>
                  <th> <span>Id</span> </th>
                  <th> <span>image</span> </th>
                  <th> <span>Name</span> </th>
                  <th> <span>Status </span></th>
                  <th> <span>Type </span></th>
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



                <form id="clientForm">
                  <div class="row">



                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">
                        <label for=""> Name</label>
                        <input type="text" name="name" placeholder="Name">
                        <span id="name_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>






                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">
                        <label for=""> Public key</label>
                        <input type="text" name="public_key" placeholder="public key">
                        <span id="public_key_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">

                        <label for=""> Private key</label>
                        <input type="text" name="private_key" placeholder="private key">
                        <span id="private_key_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">

                        <label for=""> Mode</label>
                        <input type="text" name="mode" placeholder="sandbox">
                        <span id="mode_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>




                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> status</label>
                        <select name="status">
                          <option value=""> Select Status </option>
                          <option value="Active"> Active </option>
                          <option value="Inactive"> Inactive </option>
                        </select>
                        <span id="status_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>

                    <div class="col-12 col-sm-6">
                      <div class="pop-field-input">
                        <label for=""> Type</label>
                        <select name="type">
                          <option value=""> Select Type </option>
                          <option value="Stripe"> Stripe </option>
                          <option value="Paypal"> Paypal </option>
                        </select>
                        <span id="type_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>



                    <div class="col-12 col-sm-12">
                      <div class="pop-field-input">
                        <label for=""> Assign Brands</label>

                        <select class=" form-control multi-brands" name="brands[]" multiple="multiple">


                          @php
                          $brands = get_brands();
                          @endphp
                          @if($brands)
                          @foreach($brands as $brand)

                          @if($brand->resources)
                          @if(in_array( Auth::user()->id,json_decode($brand->resources) ))

                          <option value="{{$brand->id}}">{{$brand->name}}</option>
                          @endif
                          @endif
                          @endforeach
                          @endif


                        </select>

                        <span id="brands_err" class="text-danger laravel_validation"> </span>
                      </div>
                    </div>



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




<script type="text/javascript">
  $(document).ready(function() {
    $('.multi-brands').select2();
  });



  var tableName = "{{$table}}";
  var baseUrl = "{{url('/')}}";

  var brands = $(".multi-brands");

  var table = $('.data-table').DataTable({
    processing: true,
    paging: true,
    serverSide: true,
    searching: true,
    ajax: {
      url: "{{ route('payment/methods.list') }}"
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
        data: 'name',
        name: 'name'
      },
      {
        data: 'status',
        name: 'status'
      },
      {
        data: 'type',
        name: 'type'
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
      "url": "{{route('payment/methods.create')}}",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify({
        "name": $("input[name=name]").val(),
        "status": $("select[name=status]").val(),
        "type": $("select[name=type]").val(),
        "public_key": $("input[name=public_key]").val(),
        "private_key": $("input[name=private_key]").val(),
        "mode": $("input[name=mode]").val(),
        "brands": $(".multi-brands").val(),
      }),
    };

    $.ajax(settings).done(function(response) {
      if (response.status == false) {
        for (let key of Object.entries(response.data)) {
          $(`#${key[0]}_err`).html(key[1]);
        }
      } else {


        $("input[name=name]").val('');
        $("select[name=status]").val('');
        $("select[name=type]").val('');
        $("input[name=public_key]").val('');
        $("input[name=private_key]").val('');
        $("input[name=mode]").val('');
        $("input[name=id]").val('');


        $(".multi-brands").val(),


          $('#createModal').modal('hide');

        swal("Created Successfully!", tableName + " " + response.message, "success");

        $('#listTable').DataTable().ajax.reload();

      }

    });

  }




  function View(id) {
    var columns = ['created_at', 'name', 'id', 'public_key', 'private_key', 'mode'];
    $('#modalViewTitle').html('Please wait..');
    $('#modalViewBody').html('');
    $('#ModalView').modal('show');
    var viewSettings = {
      "url": `${baseUrl}/payment/methods/${id}`,
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

            if (key[0] == "created at") {
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


    brands.val([]);
    brands.trigger('change');



    $('#saveBtn').html('Update');
    $('#modalViewTitle').html('Please wait..');
    $('#modalViewBody').html('');
    $(`.laravel_validation`).html('');
    $('.modal-title').html($('.modal-title').html().replace("New", "Edit"));

    $('#createModal').modal('show');
    var viewSettings = {
      "url": `${baseUrl}/payment/methods/${id}`,
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


        $("input[name=name]").val(response.data.name);
        $("select[name=status]").val(response.data.status);
        $("select[name=type]").val(response.data.type);
        $("input[name=public_key]").val(response.data.public_key);
        $("input[name=private_key]").val(response.data.private_key);
        $("input[name=mode]").val(response.data.mode);
        $("input[name=id]").val(response.data.id);



        if (response.data.brands.length) {

          let brandsArray = JSON.parse(response.data.brands);

          brands.val(brandsArray);
          brands.trigger('change');

          // for (var i = 0; i < brandsArray.length; i++) {
          //  var option = new Option('test', brandsArray[i].value, true, true);
          //  brands.append(option).trigger('change');

          // }

        }



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
          "url": `${baseUrl}/payment/methods/1`,
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
          "url": `${baseUrl}/payment/methods/${id}`,
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



  $('.create_modal').click(function() {


    brands.val([]);
    brands.trigger('change');

    //button value
    $('#saveBtn').html('Save');
    ///validations
    $(`.laravel_validation`).html('');

    $('.modal-title').html($('.modal-title').html().replace("Edit", "New"));


    $('.modal-title').html($('.modal-title').html().replace("Edit", "New"));


    ////fields
    $("input[name=name]").val('');
    $("select[name=status]").val('');
    $("select[name=type]").val('');
    $("input[name=public_key]").val('');
    $("input[name=private_key]").val('');
    $("input[name=mode]").val('');
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
      "url": `${baseUrl}/payment/methods`,
      "method": "PUT",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify({
        "name": $("input[name=name]").val(),
        "status": $("select[name=status]").val(),
        "type": $("select[name=type]").val(),
        "public_key": $("input[name=public_key]").val(),
        "private_key": $("input[name=private_key]").val(),
        "mode": $("input[name=mode]").val(),
        "id": $("input[name=id]").val(),
        "brands": $(".multi-brands").val(),
      })
    };

    $.ajax(settings).done(function(response) {
      if (response.status == false) {
        for (let key of Object.entries(response.data)) {
          $(`#${key[0]}_err`).html(key[1]);
        }
      } else {




        $("input[name=name]").val('');
        $("select[name=status]").val('');
        $("input[name=public_key]").val('');
        $("input[name=private_key]").val('');
        $("input[name=mode]").val('');
        $("input[name=id]").val('');
        $('#createModal').modal('hide');

        swal("Updated Successfully!", "Payment method has updated successfully", "success");

        $('#listTable').DataTable().ajax.reload();
      }

    });

  }
</script>




@endsection