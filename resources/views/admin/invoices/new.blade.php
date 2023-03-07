@php $table = "Brand"; @endphp
@extends('admin.layouts.app')


@section('pageCss')

<style>



span.select2-selection.select2-selection--single {
    border: 1px solid #000;
    border: 2px solid #30415e;
    border-radius: 5px;
    outline: none;
    padding: 8px 10px;
    font-family: "Rubik-Regular";
    height: 40px;
    background: transparent;

}



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






</style>



<style>


.tax-row-id{
  width: 180%;
}


@media only screen and (min-width: 700px) {


.modal-content{
  width:120%;
}

}


  img#logo_img {
    cursor: pointer;
  }

  #loading img {
    max-width: 800px;
    height: auto;
  }

  #loading {
    display: none;
  }



  /* imp */

  .line-qty {

    max-width: 60px;
  }

  .line-rate {
    max-width: 90px;
  }

  .line-total {
    max-width: 90px;
  }


 .invoice-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}


.invoice-logo {
    width: auto;
    height: 130px;
    overflow: hidden;
}

  .tax-number {
    font-size: 12px;
    font-weight: 800;
  }

  .add-line {
    border: 2px dashed #adadad;
    width: inherit;
    font-weight: 700;
    color: black;
  }

  .table td,
  .table th {
    vertical-align: middle;
  }


  .item-description-textarea::placeholder {
    font-size: 12px !important;
  }




  .tax-heading-2 {
    font-size: 24px;
    line-height: 32px;
    font-family: "Founders Grotesk", Helvetica, Arial, sans-serif;
    font-weight: 800;
  }

  .tax-header {
    background-color: #e6eaec;
  }

  /* ////////? */


  * {
    box-sizing: border-box;
  }

  body {
    font: 16px Arial;
  }

  /*the container must be positioned relative:*/
  .autocomplete {
    position: relative;
    display: inline-block;
  }

  input {
    border: 1px solid transparent;
    background-color: #f1f1f1;
    padding: 10px;
    font-size: 16px;
  }

  input[type=text] {
    background-color: #f1f1f1;
    width: 100%;
  }

  input[type=submit] {
    background-color: DodgerBlue;
    color: #fff;
    cursor: pointer;
  }

  .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
  }

  .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #d4d4d4;
  }

  /*when hovering an item:*/
  .autocomplete-items div:hover {
    background-color: #e9e9e9;
  }

  /*when navigating through the items using the arrow keys:*/
  .autocomplete-active {
    background-color: DodgerBlue !important;
    color: #ffffff;
  }
</style>



<style>
  .hoverable {
    display: none;
  }




  /* //////////////// */

  #invoice-body textarea {
    width: 100%;
  }

  .simpleTemplate .invoice-lineItem--header .invoice-lineItemCell {
    padding-bottom: 10px;
    border-bottom: none;
    border-top-width: 3px;
    border-top-style: solid;
    border-top-color: inherit;
  }

  .simpleTemplate .invoice-lineItemCell--nonNumeric {
    width: 100%;
    padding-left: 0;
  }

  .simpleTemplate .invoice-lineItemCell {
    min-width: 100px;
    padding: 10px 20px;
    padding-right: 0;
    border-bottom: 1pxsolidrgba(0, 0, 0, .1);
  }

  .simpleTemplate .invoice-label {
    font-weight: 400;
  }

  .invoice-themeColoredForeground {
    color: #3b7bca !important;
  }

  .invoice-label {
    white-space: nowrap;
  }

  .invoice-lineItemCell--nonNumeric {
    text-align: left;
    white-space: normal;
  }

  .invoice-lineItemCell {
    position: relative;
    display: table-cell;
    text-align: right;
    white-space: nowrap;
    vertical-align: top;
  }

  .invoice-themeColoredBorder {
    border-color: #3b7bca !important;
  }

  .invoice-themeColoredBorder {
    border-color: #3b7bca !important;
  }

  .invoice-lineItem--header {
    white-space: nowrap;
  }

  .invoice-lineItem {
    display: table-row;
    position: relative;
  }

  .invoice,
  .invoice * {
    transition-property: none;
  }

  ol,
  ul {
    list-style: none;
  }


  .invoice-lineItem {
    display: table-row;
  }

  .simpleTemplate .invoice-lineItemCell--nonNumeric {
    width: 100%;
    padding-left: 0;
  }

  .simpleTemplate .invoice-lineItemCell {
    min-width: 100px;
    padding: 10px 20px;
    padding-right: 0;
    border-bottom: 1px solid rgba(0, 0, 0, .1);
  }

  .invoice-lineItemCell--nonNumeric {
    text-align: left;
    white-space: normal;
  }

  .invoice-lineItemCell {
    position: relative;
    display: table-cell;
    text-align: right;
    white-space: nowrap;
    vertical-align: top;
  }

  .simpleTemplate .invoice-lineItemCell {
    min-width: 100px;
    padding: 10px 20px;
    padding-right: 0;
    border-bottom: 1px solid rgba(0, 0, 0, .1);
  }

  .invoice-lineItemCell {
    position: relative;
    display: table-cell;
    text-align: right;
    white-space: nowrap;
    vertical-align: top;
  }

  .simpleTemplate .invoice-lineItemCell {
    min-width: 100px;
    padding: 10px 20px;
    padding-right: 0;
    border-bottom: 1px solid rgba(0, 0, 0, .1);
  }

  .invoice-lineItemCell {
    position: relative;
    display: table-cell;
    text-align: right;
    white-space: nowrap;
    vertical-align: top;
  }
</style>






@endsection


@section('mainContent')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->



  @if(Session::has('brand_id'))

  <div class="content-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-sm-6">
          <h1 class="m-0">New Invoice</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{route('invoices.list')}}" class="cancel">Cancel</a>
            <a onclick="save_and_send_email()" href="javascript:void(0)">Save & Send Email</a>
            <a onclick="save_and_copy_link()" href="javascript:void(0)">Save & Copy Link</a>
          </ol>


          


        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->




  <!-- Main content -->
  <section class="content">








    <!-- Create Modal -->
    <div class="modal custom-modal modal-custom-1 fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="row align-items-center">
              <div class="col-sm-6">
                <h5 class="modal-title" id="exampleModalLabel">
                  New Client
                </h5>
              </div>
              <div class="col-sm-6">
                <ul class="breadcrumb">
                  <li>
                    <a data-dismiss="modal" href="javascript:void(0)">Cancel</a>
                  </li>
                  <li>
                    <a onclick="Create()" href="javascript:void(0)"> Save</a>
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
                            <label> First Name *</label>
                            <input type="text" name="first_name" placeholder="First Name">
                            <span id="first_name_err" class="text-danger laravel_validation"> </span>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6">
                          <div class="pop-field-input">

                            <label> Last Name *</label>
                            <input type="text" name="last_name" placeholder="Last Name">
                            <span id="last_name_err" class="text-danger laravel_validation"> </span>
                          </div>
                        </div>

                        <div class="col-12 col-sm-6">
                          <div class="pop-field-input">

                            <label> Email *</label>
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





    <div id="loading" class="mt-5">

      <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
          <img src="{{url('admin/images/invoice-creation.gif')}}">
        </div>
        <div class="col-3">
        </div>

      </div>
    </div>

    <div class="row detailsDiv">



      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-9 c-bg " id="invoice-body">
            <div class="row align-items-center">
              <div class="col-sm-5">

                <form method="post" id="upload-image-form" enctype="multipart/form-data">
                  @csrf
                  <input type='file' id="brand_logo" hidden />
                </form>

                <div class="invoice-logo" data-toggle="tooltip" data-placement="top" title="Change logo">
                  <img id="logo_img" src="{{ url('/') }}/public/uploads/brands/{{Session::get('brand_logo')}}">
                </div>
              </div>
              <div class="col-sm-7">
                <div class="d-flex justify-content-between">
                  <div class="d-1 d-c ml-4">

                    <h6 id="brand_name" contenteditable>{{Session::get('brand_name')}}</h6>
                    <h5 id="brand_phone" contenteditable>{{Session::get('brand_phone')}}</h5>
                  </div>
                  <div class="d-1 d-c">

                    <h6 id="brand_address" contenteditable> {{Session::get('brand_address')}} </h6>

                    <h5><span contenteditable>{{Session::get('brand_country')}}</span></h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="d-6">
                  <h6 class="custom-label">Billed To</h6>
                  <select name="client_id" class="form-control client_id">
                    <option value="">Select Client
                    </option>
                    @if($clients)
                    @foreach($clients as $client)

                    <option value="{{$client->id}}"> {{$client->first_name}} {{$client->last_name}}
                    </option>
                    @endforeach
                    @endif
                  </select>
                  <span id="client_id_err" class="text-danger laravel_validation"></span>

                </div>

                <div class="d-6 mt-2 hoverable float-right">
                  <button class="badge btn-primary" data-toggle="modal" data-target="#createModal"> <i class="fa fa-plus" aria-hidden="true"></i> Add New Client</button>
                </div>
              </div>
              <div class="col-sm-9">
                <div class="d-flex justify-content-between">
                  <div class="d-3">
                    <div class="d-gap mb-5">
                      <h6 class="custom-label">Date of Issue</h6>
                      <input type="date" id="issue_date" name="issue_date" value="<?php echo date('Y-m-d'); ?>" ">
                      <span id="issue_date_err" class="text-danger laravel_validation"></span>
                    </div>
                    <div class="d-gap">
                      <h6 class="custom-label">Due Date</h6>

                      <input type="date" value="<?php echo date('Y-m-d',strtotime( '+1 day')); ?>" id="due_date" name="due_date" value="<?php echo date('m/d/Y') ?>">
                      <span id="due_date_err" class="text-danger laravel_validation"></span>
                    </div>
                  </div>
                  <div class="d-4">
                    <div class="d-gap mb-5">
                      <h6 class="custom-label">Invoice Number</h6>
                      <input type="text" readonly id="invoice_number" name="invoice_number" value="{{$invoice_starting_number}}" placeholder="23832">
                      <span id="invoice_number_err" class="text-danger laravel_validation"></span>
                    </div>
                    <div class="d-gap">
                      <h6 class="custom-label">Reference</h6>
                      <input type="text" name="reference" placeholder="Enter Value (e.g. PO#)">
                      <span id="reference_err" class="text-danger laravel_validation"></span>
                    </div>
                  </div>
                  <div class="d-5">
                    <div class="d-gap">
                      <h6 class="custom-label">Amount Due (USD)</h6>
                      <h5 name="total_amount" id="total_amount">$0.00</h5>
                      <span id="total_amount_err" class="text-danger laravel_validation"></span>
                    </div>

                    <div class="d-gap">
                      <h6 class="custom-label">Currency</h6>
                        <select name="currency" selected class="form-control ">
                          <option value="USD">USD
                          </option>
                          <option value="GBP">GBP
                          </option>
                          <option value="EUR">EUR
                          </option>
                          <option value="CAD">CAD
                          </option>
                          <option value="AUD">AUD
                          </option>
                          <option value="AED">AED
                          </option>
                           <option value="PKR">PKR
                          </option>
                        </select>
                    </div>




                  </div>
                </div>
              </div>
            </div>





            <!-- ///////////////////// -->


            <hr>
            <div class="simpleTemplateinvoice is-editing
              
              simpleTemplate
              u-font--modern
              u-marginBottom--1">
              <div id="ember249" class="ember-view  ">
                <!---->
                <div class="invoice-lineItem invoice-lineItem--header invoice-themeColoredBorder js-lines-header-items">
                  <div class="invoice-lineItemCell invoice-label invoice-themeColoredForeground
            invoice-lineItemCell--nonNumeric">
                    <span>Description</span>
                  </div>
                  <div class="invoice-lineItemCell invoice-label invoice-themeColoredForeground
            ">
                    <span>Rate</span>
                  </div>
                  <div class="invoice-lineItemCell invoice-label invoice-themeColoredForeground
            ">
                    <span>Qty</span>
                  </div>
                  <div class="invoice-lineItemCell invoice-label invoice-themeColoredForeground
            ">
                    <span>Line Total</span>
                  </div>
                </div>
                <ol id="invoice-items" class="js-lines-items ui-widget-content">
                  <li class="invoice-lineRow u-position--relative js-invoice-line sortable-item" data-sortable-item="true">
                    <div class="ember-view">
                      <div class="invoice-lineItem js-invoice-line-item js-line-guid-ember614" data-ebd-id="-trigger">
                        <i class="fa fa-bars hoverable" aria-hidden="true"></i>
                        <div class="invoice-lineItemCell invoice-lineItemCell--nonNumeric">
                          <div class="js-item-select js-invoice-line-item-name ember-view"><span id="ember616" class="js-type-ahead-control ember-view">
                              <textarea aria-haspopup="listbox" aria-controls="ember616-typeahead" aria-expanded="false" aria-autocomplete="list" role="combobox" placeholder="Enter an Item Name" class=" form-control ember-text-area typeahead-filter form-unstyledInput js-selected-item ember-view item-name-textarea" aria-label="Item Name" style="overflow: hidden;height: 54px;"></textarea>
                              <!---->
                            </span>
                          </div>
                          <div class="invoice-lineItemSecondaryData">
                            <textarea placeholder="Enter an Item Description" value="" class="ember-text-area form-unstyledInput item-description-textarea  form-control"></textarea>
                          </div>
                        </div>
                        <div class="invoice-lineItemCell">
                          <input aria-label="Item Rate (USD)" placeholder="$0.00" maxlength="9" class="ember-text-field  line-rate form-unstyledInput js-item-rate ember-view" type="number">
                          <div class="invoice-lineItemSecondaryData invoice-addTaxButton link">
                            <div id="ember621" class="ember-view">
                              <!---->
                              <div class="hoverable">
                                <a onclick="addTaxes().call(this)" href="javascript:void(0)"> Add Taxes</a>
                              </div>
                              <div id="ember-basic-dropdown-content-ember623" class="ember-basic-dropdown-content-placeholder" style="display: none;"></div>
                            </div>
                          </div>
                        </div>
                        <div class="invoice-lineItemCell">
                          <div>
                            <div class="ember-view"><input aria-label="Item Quantity" value="1" maxlength="19" class="line-qty ember-text-field form-unstyledInput js-item-quantity js-ember613-item-quantity ember-view" type="number">
                            </div>
                          </div>
                          <!---->
                        </div>
                        <div class="invoice-lineItemCell js-invoice-line-item-total">
                          <div>
                            <input readonly aria-label="Line Total (USD)" placeholder="$0.00" maxlength="9" class=" line-total ember-text-field form-unstyledInput ember-view" type="number">
                          </div>
                        </div>
                        <i class="fa fa-trash hoverable" onclick="removeItem.call(this)" aria-hidden="true"></i>
                      </div>
                    </div>
                  </li>
                </ol>
              </div>
            </div>

            <hr>
            <div class="row">
              <div class="col-sm-4"></div>
              <div class="col-sm-4">
                <button class="btn btn-light add-line" id="add-invoice-items"> Add a Line</button>
              </div>
              <div class="col-sm-4"></div>
            </div>













            <div class="row">

              <div class="col-sm-4"></div>
              <div class="col-sm-4"> </div>
              <div class="col-sm-4">
                <div class="invoice-lineItems invoice-lineItems--summary ember-view">




                  <div id="subtotalDiv mb-1 mt-1">
                    <div class="row">
                      <div class="col-sm-6">
                        <span class="custom-label">Subtotal</span>

                      </div>
                      <div class="col-sm-6">
                        <span id="subtotal" class="custom-label">
                          0.00
                        </span>
                      </div>


                      <div class="col-sm-6">
                        <a href="javascript:void(0)" onclick="addDiscount().call(this)" class="hoverable">
                          Add a Discount
                        </a>
                      </div>

                    </div>
                  </div>



                  <div id="discountDiv">
                  </div>


                  <div id="taxesDiv">
                    <div class="row">
                      <div class="col-sm-6">
                        <span class="custom-label">Tax</span>
                      </div>
                      <div class="col-sm-6">
                        <span class="invoice-taxLine js-invoice-tax-total custom-label">
                          0.00
                        </span>
                      </div>
                    </div>
                  </div>




                  <hr>

                  <div id="subTotalDiv mb-1 mt-1">
                    <div class="row">
                      <div class="col-sm-6">
                        <span class="custom-label">Total</span>


                      </div>
                      <div class="col-sm-6">
                        <span id="total" class="custom-label">
                          0.00
                        </span>
                      </div>

                    </div>
                  </div>

                  <div id="amountPaidDiv mb-1 mt-1">
                    <div class="row">
                      <div class="col-sm-6">
                        <span class="custom-label">Amount Paid</span>

                      </div>
                      <div class="col-sm-6">
                        <span id="amountPaid" class="custom-label">
                          0.00
                        </span>
                      </div>

                    </div>
                  </div>

                  <hr>



                  <div id="amountPaidDiv mb-1 mt-1">
                    <div class="row">
                      <div class="col-sm-6">
                        <span>Amount Due</span> (USD)

                      </div>
                      <div class="col-sm-6">
                        <span id="amountDue">
                          0.00
                        </span>
                      </div>

                      <!--
                      <div class="col-sm-12">
                        <a href="javascript:void(0)" class="hoverable">
                          Deposit Requested
                        </a>
                      </div>

                      <div class="col-sm-12">
                        <a href="javascript:void(0)" class="hoverable">
                          Deposit Requested
                        </a>
                      </div>  -->

                    </div>
                  </div>
                </div>
                <!---->
                <!---->
              </div>
            </div>

            <!-- ////////////////// -->
            <div class="row">
              <div class="col-12 col-sm-12">
                <div class="d-7 d-gap-1">
                  <h6>Notes</h6>
                  <input type="text" name="notes" placeholder="Enter Notes or bank transfer details (optional)">
                  <span id="notes_err" class="text-danger laravel_validation"></span>
                </div>
              </div>
              <div class="col-12 col-sm-12">
                <div class="d-7">

                  <h6>Terms</h6>
                  <textarea name="terms" id="terms" placeholder="Enter your terms and conditions (Pro tip: It pays to be polite. FreshBooks invoices that include 'please' and 'thanks' get paid up to 2 days faster.)">{{Session::get('terms')}}</textarea>
                  <span id="terms_err" class="text-danger laravel_validation"></span>


                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-3">
            <div class="card-setting">
              <h6>Settings</h6>
              <h5>For This Invoice</h5>
            </div>
            <div class="card card-s-wrap">
              <div class="card-header">
                <h3>
                  Accept Online Payments
                  <span>
                    <i class="fas fa-plus" data-card-widget="collapse"></i>
                  </span>
                </h3>
              </div>
              <div class="card-body">
                <h6>Payment Methods</h6>

                <span id="payment_method_err" class="text-danger laravel_validation"></span>


                @if($payment_methods)
                @foreach($payment_methods as $method)



                @if($method->brands)
                @if(in_array( Session::get('brand_id'),json_decode($method->brands) ))




                <div class="{{$method->id}}">
                  <p>
                    <input type="radio" value="{{$method->id}}" id="{{$method->id}}" name="payment_method">
                    <label for="{{$method->id}}">
                      @if($method->type == "Stripe")
                      <img src="{{URL('/')}}/admin/dist/img/stripe.svg" width="60" height="30">
                      @elseif($method->type == "Paypal")
                      <img src="{{URL('/')}}/admin/dist/img/paypal-logo.svg" width="60" height="30">

                      @endif
                    </label>
                  </p>
                  <div class="form-group">
                    <div class="without-checkbox">

                      <label>
                        {{$method->name}}
                        <ul>
                          <li>
                            <img src="{{URL('/')}}/admin/dist/img/visa-icon.svg" width="40" height="35">
                          </li>
                          <li>
                            <img src="{{URL('/')}}/admin/dist/img/mastercard-icon.svg" width="40" height="35">
                          </li>
                          <li>
                            <img src="{{URL('/')}}/admin/dist/img/discover-icon.svg" width="40" height="35">
                          </li>
                          <li>
                            <img src="{{URL('/')}}/admin/dist/img/amex-icon.svg" width="40" height="35">
                          </li>
                          <li>
                            <img src="{{URL('/')}}/admin/dist/img/applepay-icon.svg" width="40" height="35">
                          </li>
                        </ul>
                      </label>
                    </div>
                  </div>
                </div>

                @endif
                @endif
                @endforeach
                @endif

                <div class="payment1">
                  <p>
                    <input type="radio" value="0" id="test3" name="payment_method">
                    <label for="test3">
                      None
                    </label>
                  </p>
                </div>
                <div class="payment2">
                  <h6>Partial Payment</h6>
                  <div class="form-group">

                    <div class='d-flex m-auto mb-2 '>
                                    <input class="mr-2" id="partialPayments" type="checkbox"  style="display:block">
                                    <input id="partialPaymentAmount" name="partialPaymentAmount" disabled type="number"  placeholder="$0.00" 
                                    style="display:block; background-color: #fff; width: 25%;">
                    </div>

      <span id="partialPayments_err" class="text-danger laravel_validation"></span>


      
                      <label for="partialPayments">
                        Allow Clients to make partial online payments for this Invoice.
                      </label>
                  </div>
                </div>
                <div class="payment3">
                  <a href="#!">Payments are safe and secure</a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="pb-5"></div>
        </div>
      </div><!-- /.container-fluid -->


    </div>
  </section>










  <!-- Add Tax Modal -->
  <div class="modal fade" id="taxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">



          <div class="modal-header tax-header">
            <h2 class="tax-heading-2">
              Add Taxes
            </h2>
          </div>

          <div class="container">
            <table id="tax-table" class="table">
              <thead>
                <tr class="entity-table-header">
                  <th></th>
                  <th class="taxesPopover-table-header-cell">
                    RATE
                  </th>
                  <th class="taxesPopover-table-header-cell">
                    TAX NAME
                  </th>
                  <th class="taxesPopover-table-header-cell u-whiteSpace--nowrap">
                    TAX NUMBER (OPTIONAL)
                  </th>
                </tr>
              </thead>
              <tbody id="tax-table-body">
                <tr class="js-taxes-popover-row taxesPopover-row js-pickable-tax-0 ember-view">
                  <td class="js-taxes-popover-checkbox taxesPopover-checkbox">

                  
                    <label class="m-0">
                      <span class="form-input form-input--checkbox js-tax-checkbox is-unchecked ember-view">
                        <input class="form-control tax-row-id" aria-label="Select va3" type="checkbox">

                        <span class="icon icon--check icon--standalone form-input--checkboxIcon u-invisible"></span>

                        <!---->
                      </span>
                    </label>
                  </td>
                  <td class="u-paddingBottom--half u-paddingRight--half u-verticalAlign--middle js-taxes-popover-amount">
                    <div class="form-inputIconSplit">
                      <div class="d-flex align-items-center">
                        <input aria-label="Tax Rate (Percentage)" placeholder="0" maxlength="6" class="form-control tax-row-percentage" type="text" >
                     
                           <div class="container-toggle">
                            <div class="off">%</div>
                            <label class="switch m-0">
                              <input id="check" class="toggle-check" onclick="onOff(this)" type="checkbox">
                              <span class="toggle "></span>
                            </label>
                            <div class="on">$</div>
                          </div>

                      </div>
                    </div>
                  </td>
                  <td class="u-paddingBottom--half u-paddingRight--half taxes-popover-name js-taxes-popover-name">
                    <input aria-label="Tax name" placeholder="Tax name" maxlength="15" class=" tax-row-name form-control " type="text">
                  </td>
                  <td class="u-paddingBottom--half js-taxes-popover-number" colspan="2">
                    <input aria-label="Tax number" placeholder="Tax number" maxlength="25" class=" tax-row-number form-control " type="text">
                  </td>
                  <!---->
                </tr>
              </tbody>
            </table>



            <div class="row align-items-center ">
              <div class="col-sm-4"></div>
              <div class="col-sm-4">
                <button class="btn btn-light add-line" id="add-tax-items"> Add another Tax</button>
              </div>
              <div class="col-sm-4"></div>
            </div>

          </div>

          <!---->
          <hr>




          <div class="row  align-items-center"> 


              <div class="col-sm-1"> </div>

              <div class="col-sm-1">
                <input class="form-control"  id="applyAllTaxes" onclick="applyAllTaxes()" type="checkbox">
              </div>
              <div class="col-sm-10">
              
                <h3 class="m-0" >  <i> Apply all taxes.   </i></h3>
              </div>

            </div>




          <div class="mb-2 mt-2">
            <div class="modal-footer">
              <button class="btn btn-light" data-dismiss="modal" type="button">Cancel
              </button>
              </button>
              <button class="btn btn-success" id="apply-tax" type="button" data-dismiss="modal">Apply Taxes
              </button>
            </div>
        </div>



      </div>
    </div>
  </div>
</div>






<!-- Add Discount Modal -->
<div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div id="ember1541" class="popover--taxPicker__column ember-view">

        <div class="modal-header tax-header">
          <h2 class="tax-heading-2">
            Add a Discount
          </h2>
        </div>



        <div class="mb-2 mt-2">



          <div class="row align-items-center mt-3 mb-3">

            <div class="col-sm-2">
            </div>
            <div class="col-sm-4 d-flex">
              <input aria-label="Discount (Percentage)" placeholder="0" maxlength="6" class="form-control " value="0" id="discount" type="text">
             
                           <div class="container-toggle">
                            <div class="off">%</div>
                            <label class="switch m-0">
                              <input id="discount-type" class="toggle-check" onclick="onOff(this)" type="checkbox">
                              <span class="toggle "></span>
                            </label>
                            <div class="on">$</div>
                          </div>

            </div>


            <div class="col-sm-6">
              <p class="m-0">
                Discount
              </p>
            </div>

             <div class="col-sm-1">
            </div>

          </div>



          <div class="modal-footer">
            <button class="btn btn-light" data-dismiss="modal" type="button">Cancel
            </button>
            </button>
            <button class="btn btn-success" id="apply-discount" type="button" data-dismiss="modal">Apply Discount
            </button>
          </div>
        </div>



      </div>
    </div>
  </div>
</div>







<textarea id="out"  hidden placeholder="Text to copy"></textarea>


<!-- /.content -->
</div>



@else


<script>
  swal("Brand selection is necessary!", "Sorry, You need to select brand first.", "error");
</script>
@endif

@endsection



@section('pageJs')



<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script type="text/javascript">
  $("div#invoice-body")
    .mouseout(function() {
      $('.hoverable').css('display', 'none');
    })
    .mouseover(function() {
      $('.hoverable').css('display', 'block');
    });
</script>




<!-- ///////////////// -->




<!-- ////////////////////-->



<script>
  var itemNameTextarea = document.getElementsByClassName('item-name-textarea');
  var lineTotal = document.getElementsByClassName('line-total');
  var lineRate = document.getElementsByClassName('line-rate');
  var lineQty = document.getElementsByClassName('line-qty');
  var subtotal = document.getElementById('subtotal');
  var total = document.getElementById('total');
  var discount = document.getElementById('discount');
  var taxRowIds = document.getElementsByClassName('tax-row-id');
  var discountAmount = 0;
  var discountPercentage = 0;
  var discountType = "percentage"
  var totalTax = 0;
  var amountDue = document.getElementById('amountDue');
  var amountPaid = document.getElementById('amountPaid');
  amountDue.innerHTML = 0;
  amountPaid.innerHTML = 0;
  var taxes = [];
  var items = [];
  var suggestions = [];
  var suggestionItems = [];
  var brand_logo = "";
  var myFormData = new FormData();
  var copy_link = false;
  var send_email = true;

  function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) {
        return false;
      }
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items suggestions");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {

        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].title.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].title.substr(0, val.length) + "</strong>";
          b.innerHTML += "<p class='m-0' >" + arr[i].title.substr(val.length) + "</p>";
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + i + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/

            let thisElement = this.getElementsByTagName("input")[0].value;

            inp.value = suggestions[thisElement].title;
            inp.parentElement.parentElement.parentElement.querySelectorAll(".item-description-textarea")[0].value = suggestions[thisElement].description;
            inp.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-rate")[0].value = suggestions[thisElement].rate;
            inp.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-qty")[0].value = suggestions[thisElement].quantity;
            inp.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-total")[0].value = suggestions[thisElement].total;

            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
            calculate();
          });
          a.appendChild(b);

        }
      }

    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
    });

    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {

        if (elmnt != x[i] && elmnt != inp) {

          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function(e) {
      closeAllLists(e.target);
    });
  }



  /*An array containing all the country names in the world:*/
  // var suggestions = [`1 E-Commerce Website + Domain +  1 yr Hosting + 1 yr Maintenance + 3 Business Emails ( Complimentary)  SEO ( 1 Month)`,
  //   "1 G-Suite Email address",
  //   "1 Logo Design and 10 Concepts",
  //   "1 Logo Design and 12 Concepts",
  //   "1 Logo Design and 5 Concepts Down Payment",
  //   "1 Platinum Website + appointment booking integration + Website optimization+ Hosting +website security plugin + 1 Year Free Website Maintenance + Logo Association with Source files",
  //   "15 Customized Mugs (48 Oz)",
  //   "Custom product naming and hovering effect"
  // ];

  /*initiate the autocomplete function on the "myInput" element, and pass along the suggestions array as possible autocomplete values:*/
  //autocomplete(itemNameTextarea[0], suggestions);
</script>









<script>
  $(`.laravel_validation`).html('');
  var settings = {
    "url": "{{route('invoices.items')}}",
    "method": "GET",
    "timeout": 0,
    "headers": {
      "Content-Type": "application/json",
      "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    },
  };
  $.ajax(settings).done(function(response) {

    if (response.status == false) {

    } else {
      for (var i = 0; i < response.data.length; i++) {
        let title = response.data[i].title;
        if (title) {
          if (title.length > 45)
            title = title.substring(0, 45) + "...";
          suggestions.push(response.data[i]);
        }
      }



     // console.log("suggestions", suggestions);
      autocomplete(itemNameTextarea[0], suggestions);
    }

  });
</script>


<script>
  $('#add-invoice-items').click(() => {
    $('#invoice-items').append(`
                <li class="invoice-lineRow u-position--relative js-invoice-line sortable-item" data-sortable-item="true">
                  <div  class="ember-view">
                    <div class="invoice-lineItem js-invoice-line-item js-line-guid-ember614" data-ebd-id="-trigger">
                      <i class="fa fa-bars hoverable" aria-hidden="true"></i>
                      <div class="invoice-lineItemCell invoice-lineItemCell--nonNumeric">
                        <div id="ember615" class="js-item-select js-invoice-line-item-name ember-view"><span  class="js-type-ahead-control ember-view">
                            <textarea  aria-haspopup="listbox" aria-controls="ember616-typeahead" aria-expanded="false" aria-autocomplete="list" role="combobox" placeholder="Enter an Item Name"  class="ember-text-area typeahead-filter form-unstyledInput js-selected-item ember-view form-control item-name-textarea " aria-label="Item Name" style="overflow: hidden;height: 54px;"></textarea>
                            <!---->
                          </span>
                        </div>
                        <div class="invoice-lineItemSecondaryData">
                          <textarea  placeholder="Enter an Item Description" value="" class="ember-text-area form-unstyledInput item-description-textarea  form-control" ></textarea>
                          </div>
                      </div>
                      <div class="invoice-lineItemCell">
                        <input aria-label="Item Rate (USD)" placeholder="$0.00" maxlength="9"  class=" line-rate ember-text-field form-unstyledInput js-item-rate ember-view" type="number">
                        <div class="invoice-lineItemSecondaryData invoice-addTaxButton link">
                          <div id="ember621" class="ember-view">
                            <!---->
                            <div class="hoverable">
                              <a  onclick="addTaxes().call(this)" href="javascript:void(0)"> Add Taxes</a>
                            </div>
                            <div id="ember-basic-dropdown-content-ember623" class="ember-basic-dropdown-content-placeholder" style="display: none;"></div>
                          </div>
                        </div>
                      </div>
                      <div class="invoice-lineItemCell">
                        <div>
                          <div  class="ember-view"><input aria-label="Item Quantity" value="1" maxlength="19"  class=" line-qty ember-text-field form-unstyledInput js-item-quantity js-ember613-item-quantity ember-view" type="text" >
                          </div>
                        </div>
                        <!---->
                      </div>
                      <div class="invoice-lineItemCell js-invoice-line-item-total">
                        <div>
                          <input  readonly aria-label="Line Total (USD)" placeholder="$0.00" maxlength="9"  class=" line-total ember-text-field form-unstyledInput ember-view" type="number" >
                        </div>
                      </div>
                      <i class="fa fa-trash hoverable" onclick="removeItem.call(this)" aria-hidden="true"></i>
                    </div>
                  </div>
                </li>`);

    autocomplete(itemNameTextarea[itemNameTextarea.length - 1], suggestions);


  });

  function removeItem() {
    this.parentElement.remove();
    calculate();
  }

  $(function() {
    $("#invoice-items").sortable();
    $("#invoice-items").disableSelection();
  });




  $(document).on('keyup', ".line-rate", function() {
    this.parentElement.parentElement.querySelectorAll(".line-total")[0].value = parseInt((this.value) ? this.value : 0) * parseInt(this.parentElement.parentElement.querySelectorAll(".line-qty")[0].value);
    calculate();
  });

  $(document).on('keydown', ".line-rate", function() {
    this.parentElement.parentElement.querySelectorAll(".line-total")[0].value = parseInt((this.value) ? this.value : 0) * parseInt(this.parentElement.parentElement.querySelectorAll(".line-qty")[0].value);
    calculate();
  });


  $(document).on('change', ".line-rate", function() {
    this.parentElement.parentElement.querySelectorAll(".line-total")[0].value = parseInt((this.value) ? this.value : 0) * parseInt(this.parentElement.parentElement.querySelectorAll(".line-qty")[0].value);
    calculate();
  });



  $(document).on('keyup', ".line-qty", function() {
    this.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-total")[0].value = parseInt(this.value) * parseInt((this.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-rate")[0].value) ? this.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-rate")[0].value : 0);
    calculate();
  });

  $(document).on('keydown', ".line-qty", function() {
    this.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-total")[0].value = parseInt(this.value) * parseInt((this.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-rate")[0].value) ? this.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-rate")[0].value : 0);
    calculate();
  });

  $(document).on('change', ".line-qty", function() {
    this.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-total")[0].value = parseInt(this.value) * parseInt((this.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-rate")[0].value) ? this.parentElement.parentElement.parentElement.parentElement.querySelectorAll(".line-rate")[0].value : 0);
    calculate();
  });








  function calculate() {
    subtotal.innerHTML = parseInt(0);
    for (var i = 0; i < lineTotal.length; i++) {
      subtotal.innerHTML = parseInt(subtotal.innerHTML) + parseInt(lineTotal[i].value)
    }

    applyTax();
  }


  function addTaxes() {
    $('#taxModal').modal('show');
  }


  function addDiscount() {
    $('#discountModal').modal('show');
  }


  $('#add-tax-items').click(() => {

    $('#tax-table-body').append(`
    <tr class="js-taxes-popover-row taxesPopover-row js-pickable-tax-0 ember-view">
                  <td class="js-taxes-popover-checkbox taxesPopover-checkbox">
                    <label class="m-0">
                      <span class="form-input form-input--checkbox js-tax-checkbox is-unchecked ember-view">
                        <input class="form-control tax-row-id" aria-label="Select va3" type="checkbox">

                        <span class="icon icon--check icon--standalone form-input--checkboxIcon u-invisible"></span>

                        <!---->
                      </span>
                    </label>
                  </td>
                  <td class="u-paddingBottom--half u-paddingRight--half u-verticalAlign--middle js-taxes-popover-amount">
                    <div class="form-inputIconSplit">
                      <div class="d-flex align-items-center">
                        <input aria-label="Tax Rate (Percentage)" placeholder="0" maxlength="6" class="form-control tax-row-percentage" type="text" >
                      

                           <div class="container-toggle">
                            <div class="off">%</div>
                            <label class="switch m-0">
                              <input id="check" class="toggle-check" onclick="onOff(this)" type="checkbox">
                              <span class="toggle "></span>
                            </label>
                            <div class="on">$</div>
                          </div>

                      </div>
                    </div>
                  </td>
                  <td class="u-paddingBottom--half u-paddingRight--half taxes-popover-name js-taxes-popover-name">
                    <input aria-label="Tax name" placeholder="Tax name" maxlength="15" class=" tax-row-name form-control " type="text">
                  </td>
                  <td class="u-paddingBottom--half js-taxes-popover-number" colspan="2">
                    <input aria-label="Tax number" placeholder="Tax number" maxlength="25" class=" tax-row-number form-control " type="text">
                  </td>
                  <!---->
                </tr>
                `);

  });


  function applyTax() {



    taxes = [];

    subtotal.innerHTML = 0;
    for (var i = 0; i < lineTotal.length; i++) {
      subtotal.innerHTML = parseInt(subtotal.innerHTML) + parseInt(lineTotal[i].value)
    }



    if($('#discount-type').is(':checked')){
    //fixed
    discountPercentage = discount.value/parseInt(subtotal.innerHTML)*100 
    discountAmount = parseInt(discount.value);
    discountType = "fixed";

    }else{
    discountAmount = parseInt(discount.value)*parseInt(subtotal.innerHTML)/100  
    discountPercentage = parseInt(discount.value);
    discountType = "percentage"; 
    }
    
    total.innerHTML = parseInt(subtotal.innerHTML) - parseInt(discountAmount);

    $('#discountDiv').html(`
              <div class="row">
                <div class="col-sm-6">
                  <span class="custom-label">Discount</span>
                </div>
                <div class="col-sm-6">
                  <span class="invoice-taxLine js-invoice-tax-total custom-label">
                    ${discountAmount} (${parseInt(discountPercentage)}%)           
                  </span>
                </div>
              </div>
            `);

    totalTax = 0;
    var tax = 0;
    var taxPercentage = 0;
    var taxType = "fixed";
    var taxRowName = "";
    var taxRowNumber = "";
    $('#taxesDiv').html('');

    taxes = [];
    for (var i = 0; i < taxRowIds.length; i++) {

      if (taxRowIds[i].checked == true) {

        taxRowName = taxRowIds[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll(".tax-row-name")[0].value;
        
      if (taxRowName.length > 0) {
        
        taxRowNumber = taxRowIds[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll(".tax-row-number")[0].value;
        //tax = parseInt(subtotal.innerHTML) * parseInt(taxRowIds[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll(".tax-row-percentage")[0].value) / 100;
             
       // tax = parseInt(subtotal.innerHTML) * parseInt(taxRowIds[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll(".tax-row-percentage")[0].value) / 100;
       
       //taxPercentage = 



        if(taxRowIds[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll(".toggle-check")[0].checked){

            taxType = "fixed";
            taxPercentage =  parseInt(taxRowIds[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll(".tax-row-percentage")[0].value)/ parseInt(subtotal.innerHTML) *100  
            tax = parseInt(taxRowIds[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll(".tax-row-percentage")[0].value);

        }else{
            taxType = "percentage";
            tax = parseInt(subtotal.innerHTML) * parseInt(taxRowIds[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll(".tax-row-percentage")[0].value) / 100;
            taxPercentage = parseInt(taxRowIds[i].parentElement.parentElement.parentElement.parentElement.querySelectorAll(".tax-row-percentage")[0].value);  
        }



        console.log("tax",tax)
        console.log("taxPercentage",taxPercentage)
        console.log("taxType",taxType)
        console.log("subtotal.innerHTML",subtotal.innerHTML)



        totalTax = parseInt(totalTax) + parseInt(tax);

        $('#taxesDiv').append(`
                  <div class="row">
                    <div class="col-sm-6">
                      <span class="custom-label">${taxRowName}</span>
                    </div>
                    <div class="col-sm-6">
                      <span class="invoice-taxLine js-invoice-tax-total custom-label">
                        ${tax} (${parseFloat(taxPercentage).toFixed(2)}%)            
                      </span>
                    </div>
                    <div class="col-sm-6">
                      <span class="tax-number">(#${taxRowNumber})</span>
                    </div>
                    <div class="col-sm-6">
                    </div>

                  </div>
                `);

        taxes.push(i);
        taxes[i] = {
          'title': taxRowName,
          'number': taxRowNumber,
          'value': tax,
          'type':taxType
        };

      }
      }
    }

    total.innerHTML = parseInt(total.innerHTML) + parseInt(totalTax);

    amountDue.innerHTML = parseInt(total.innerHTML) - parseInt(amountPaid.innerHTML);

    $('#total_amount').html('$' + amountDue.innerHTML);
  }





  function applyDiscount() {

    applyTax();

  }



  $('#apply-tax').click(() => {
    applyTax();
  });


  $('#apply-discount').click(() => {
    applyDiscount();
  });



  function save_and_copy_link() {
      copy_link = true;
      send_email = false;
      save();
  }


    function save_and_send_email(){
        copy_link = false;
        send_email = true;
        save();
    }

  function save() {
    
    $('#loading').css('display', 'block');
    $('.detailsDiv').css('display', 'none');

    let data = {};

    data.brand_name = $('#brand_name').html();
    data.brand_phone = $('#brand_phone').html();
    data.brand_address = $('#brand_address').html();
    data.brand_logo = brand_logo;

    data.client_id = $('select[name=client_id]').val();
    data.issue_date = $('input[name=issue_date]').val();
    data.due_date = $('input[name=due_date]').val();
    data.invoice_number = $('input[name=invoice_number]').val();
    data.reference = $('input[name=reference]').val();
    data.sub_total = parseInt($('#subtotal').html());
    data.terms = CKEDITOR.instances.terms.getData(),
    data.notes = $('input[name=notes]').val();
    data.discount_amount = discountAmount;
    data.discount_type = discountType;
    data.amount_paid = amountPaid.innerHTML;
    data.total_amount = amountDue.innerHTML;
    data.taxes = taxes;
    data.total_tax = totalTax;
    data.partial_payments = $('#partialPayments').is(':checked');
    data.payment_method = $('input[name="payment_method"]:checked').val();
    data.send_email = send_email; 
    data.currency = $('select[name=currency]').val();
    data.partial_payment_amount = $('input[name=partialPaymentAmount]').val();


    if(data.partial_payment_amount > parseFloat(amountDue.innerHTML)){

        $('#partialPayments_err').html('Partial amount cannot be greater than '+ parseFloat(amountDue.innerHTML));


            $('#loading').css('display', 'none');
            $('.detailsDiv').css('display', 'flex');


        return false;
    }



    



    items = [];
    for (var i = 0; i < lineTotal.length; i++) {
      items.push(i);
      items[i] = {
        'total': lineTotal[i].value,
        'rate': lineTotal[i].parentElement.parentElement.parentElement.querySelectorAll(".line-rate")[0].value,
        'quantity': lineTotal[i].parentElement.parentElement.parentElement.querySelectorAll(".line-qty")[0].value,
        'title': lineTotal[i].parentElement.parentElement.parentElement.querySelectorAll(".item-name-textarea")[0].value,
        'description': lineTotal[i].parentElement.parentElement.parentElement.querySelectorAll(".item-description-textarea")[0].value
      };
    }
    data.items = items;


    $(`.laravel_validation`).html('');
    var settings = {
      "url": "{{route('invoices.create')}}",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json",
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": JSON.stringify(data),
    };
    $.ajax(settings).done(function(response) {


      $('#loading').css('display', 'none');
      $('.detailsDiv').css('display', 'flex');


     // console.log("response", response)
      if (response.status == false) {
        for (let key of Object.entries(response.data)) {
          $(`#${key[0]}_err`).html(key[1]);
        }
      } else {
        swal("Invoice Created!", response.message, "success");

        $('#loading').css('display', 'none');
        $('.detailsDiv').css('display', 'none');


            let url_ =  "{{URL('/')}}/invoice/{{Session::get('brand_slug')}}/"+response.data.slug;
            
            if(copy_link){
                $('#out').val(url_);

                copy_clipboard();
            }

        setTimeout(function() {
          window.location =  "{{URL('/')}}/invoices";
        }, 2000);

      }
    })
    .fail(function(err) {



      $('#loading').css('display', 'none');
      $('.detailsDiv').css('display', 'flex');


                    swal("Error!", err.responseJSON.message, "error");
           

    });


  }






  $('#logo_img').click(() => {
    $('#brand_logo').click();
  });

  window.addEventListener('load', function() {
    document.querySelector('#brand_logo').addEventListener('change', function() {
      if (this.files && this.files[0]) {
        var img = document.querySelector('#logo_img');
        img.onload = () => {
          URL.revokeObjectURL(img.src); // no longer needed, free memory
        }
        img.src = URL.createObjectURL(this.files[0]); // set src to blob url
        myFormData.append('brand_logo', this.files[0]);
        upload_brand_logo();
      }
    });
  });

function copy_clipboard(){

  navigator.clipboard.writeText(document.querySelector('#out').value)
    .then(() => {
console.log("copied");
    })
    .catch(() => {

console.log("unable to copy");
    });

}

  function upload_brand_logo() {
    var settings = {
      "url": "{{route('invoices.upload')}}",
      "method": "POST",
      "timeout": 0,
      'processData': false,
      'contentType': false,
      'cache': false,
      "headers": {
        "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
      },
      "data": myFormData,
    };
    $.ajax(settings).done(function(response) {
      if (response.success) {
        brand_logo = response.image_name;
      }
    });
  }




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

          $("select[name='client_id']").prepend($('<option>', {
            value: response.data.id,
            text: response.data.first_name+" "+response.data.last_name
        }));



      }

    });

  }


</script>


<script>

function onOff(th){
  var checkInput = document.getElementById('check');
  var on = th.parentElement.parentElement.querySelectorAll('.on')[0]; //document.getElementsByClassName('on');
  var off = th.parentElement.parentElement.querySelectorAll('.off')[0]; //document.getElementsByClassName('off');

  
  if (th.checked == true) {
    on.style.color="green";
    off.style.color="#253b52";
  } else {
   on.style.color="#253b52";
    off.style.color="green";
  }
}



function applyAllTaxes(){
  
  if($('#applyAllTaxes').is(':checked')){
    $('.tax-row-id').prop('checked',true);
  }else{
    $('.tax-row-id').prop('checked',false);
  }

}



</script>




    <!-- CKEditor --> 
  <script src="{{ url('/') }}/admin/ckeditor/ckeditor.js"></script>
    

    <script type="text/javascript">

    // Initialize CKEditor
    CKEDITOR.replace( 'terms',{
      width: "100%",
      height: "100%"
    });

    function insertIntoCkeditor(element,str){
      CKEDITOR.instances[element].insertText(str);
    }



  $(document).ready(function() {
    $('.client_id').select2();

    $('textarea').each(function(){
        $(this).on('change',function(){
            $(this).height( $(this)[0].scrollHeight );
        });
    });


  });



$('#partialPayments').change(function() {
  if($('#partialPayments').is(':checked')){
    $('#partialPaymentAmount').prop('disabled', false);
  }else{
        $('#partialPaymentAmount').val('')
        $('#partialPaymentAmount').prop('disabled', true);
  }
});





    </script>



@endsection