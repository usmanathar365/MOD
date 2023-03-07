<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$invoice->brand_name}} | Invoice</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/') }}/admin/dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/select2/css/select2.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('/') }}/admin/dist/css/style.css">
</head>

<style>
    .stamp {
        transform: rotate(12deg);
        color: #555;
        font-size: 3rem;
        font-weight: 700;
        border: 0.25rem solid #555;
        display: inline-block;
        padding: 0.25rem 1rem;
        text-transform: uppercase;
        border-radius: 1rem;
        font-family: 'Courier';
        -webkit-mask-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/8399/grunge.png');
        -webkit-mask-size: 944px 604px;
        mix-blend-mode: multiply;
    }

    .is-nope {
        color: #D23;
        border: 0.5rem double #D23;
        transform: rotate(3deg);
        -webkit-mask-position: 2rem 3rem;
        font-size: 2rem;
    }

    .is-approved {
        color: #0A9928;
        border: 0.5rem solid #0A9928;
        -webkit-mask-position: 13rem 6rem;
        transform: rotate(-14deg);
        border-radius: 0;
    }

    .is-draft {
        color: #C4C4C4;
        border: 1rem double #C4C4C4;
        transform: rotate(-5deg);
        font-size: 6rem;
        font-family: "Open sans", Helvetica, Arial, sans-serif;
        border-radius: 0;
        padding: 0.5rem;
    }
    .buying-detail-flex {
        padding: 0px 0px 0px 0px;
        margin: 0px 0px 20px 0px;
        font-size: 14px;
        background: #28a745;
        color: #FFF;
        width: 100%;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0px;
        font-family: "Rubik-Regular";
    }
    .buying-detail-flex h6 {
        margin: 0px;
    }
</style>















    <style type="text/css">
        #loading img {
            max-width: 600px;
            width: 100%;
            height: auto;
        }

        #loading {
            display: none;
        }

        #loadingPaypal {
            display: none;
        }

        @font-face {
            font-weight: 400;
            font-style: normal;
            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Book-cd7d2bcec649b1243839a15d5eb8f0a3.woff2') format('woff2');
        }

        @font-face {
            font-weight: 500;
            font-style: normal;
            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Medium-d74eac43c78bd5852478998ce63dceb3.woff2') format('woff2');
        }

        @font-face {
            font-weight: 700;
            font-style: normal;
            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Bold-83b8ceaf77f49c7cffa44107561909e4.woff2') format('woff2');
        }

        @font-face {
            font-weight: 900;
            font-style: normal;
            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Black-bf067ecb8aa777ceb6df7d72226febca.woff2') format('woff2');
        }
    </style>



    <style type="text/css">
        body #payment-form {
            font-family: "Helvetica Neue", Helvetica, sans-serif;
        }

        #payment-form form {
            padding: 30px;
            height: 120px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
        }

        #payment-form label {
            font-weight: 500;
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
        }

        #payment-form #card-errors {
            height: 20px;
            padding: 4px 0;
            color: #fa755a;
        }

        #payment-form .token {
            color: #32325d;
            font-family: 'Source Code Pro', monospace;
            font-weight: 500;
        }

        .wrapper {
            width: 90%;
            margin: 0 auto;
            height: 100%;
        }

        #stripe-token-handler {
            position: absolute;
            top: 0;
            left: 25%;
            right: 25%;
            padding: 20px 30px;
            border-radius: 0 0 4px 4px;
            box-sizing: border-box;
            box-shadow: 0 50px 100px rgba(50, 50, 93, 0.1),
                0 15px 35px rgba(50, 50, 93, 0.15),
                0 5px 15px rgba(0, 0, 0, 0.1);
            -webkit-transition: all 500ms ease-in-out;
            transition: all 500ms ease-in-out;
            transform: translateY(0);
            opacity: 1;
            background-color: white;
        }

        #stripe-token-handler.is-hidden {
            opacity: 0;
            transform: translateY(-80px);
        }

        .form-row {
            width: 70%;
            height: 100px;
            float: left;
        }

        #card-element {
            background-color: white;
            width: 400px;
            height: 50px;
            padding: 15px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .btn-Stripe {
            border: none;
            border-radius: 4px;
            outline: none;
            text-decoration: none;
            color: #fff;
            background: #32325d;
            white-space: nowrap;
            display: inline-block;
            height: 52px;
            line-height: 40px;
            padding: 0 14px;
            box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
            border-radius: 4px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.025em;
            text-decoration: none;
            -webkit-transition: all 150ms ease;
            transition: all 150ms ease;
            float: left;
            margin-left: 12px;
            margin-top: 28px;
        }

        .btn-Stripe:hover {
            transform: translateY(-1px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, .10), 0 3px 6px rgba(0, 0, 0, .08);
            background-color: #43458b;
        }

        #card-element--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        #card-element--invalid {
            border-color: #fa755a;
        }

        #card-element--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>


<body>




<div id="loadingPaypal" class="mt-5">

<div class="row">
    <div class="col-3">

    </div>

    <div class="col-6">

        <img src="{{url('admin/images/stripe_payment.gif')}}">
    </div>
    <div class="col-3">
    </div>

</div>
</div>



    @if(isset($invoice->id))


<div id="exceptPaypal">
    <div class="container text-right mb-2 mt-2">
        <a class="mt-" href="{{URL('/generate-pdf/').'/'.$invoice->slug}}">

                <img src="https://w7.pngwing.com/pngs/415/881/png-transparent-computer-icons-pdf-others-text-rectangle-logo.png" style="
                    height: auto;
                    width: 5%;
                ">
        </a>



    </div>


    @php 

        $currency_symbol = '$';

        if($invoice->currency == 'USD'){
            $currency_symbol = '$';
        }
        else if($invoice->currency == 'AUD'){
            $currency_symbol = 'AUD $';
        }
        else if($invoice->currency == 'CAD'){
            $currency_symbol = 'CAD $';
        }
        else if($invoice->currency == 'GBP'){
            $currency_symbol = '£';
        }
        else if($invoice->currency == 'EUR'){
            $currency_symbol ='€';
        }
        else if($invoice->currency == 'AED'){
            $currency_symbol = 'AED';
        }
        else if($invoice->currency == 'PKR'){
            $currency_symbol = 'RS';
        }
    
    @endphp

    <!-- Main content -->
    <section class="content invoices1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-9 c-bg">
                    
                    @if((float) $invoice->total_amount- (float)$invoice->total_amount_paid > 0)
                    <div style="background-color:#dc3545" class="buying-detail-flex">
                        <h6>Unpaid<h6>
                    </div>
                    @else
                    <div class="buying-detail-flex">
                        <h6>Paid<h6>
                    </div>
                    @endif
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <div class="invoice-logo">
                                @if($invoice->brand_logo)
                                <img src="{{ url('/') }}/public/uploads/invoices/{{$invoice->brand_logo}}" class="img-fluid">
                                @else
                                <img src="{{ url('/') }}/public/uploads/brands/{{$invoice->brand->logo}}" class="img-fluid">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="d-flex justify-content-between invoice-detail-3">
                                <div class="d-1 d-c">
                                    <h6>{{$invoice->brand_name}}</h6>
                                    <h5>{{$invoice->brand_phone}}</h5>
                                </div>
                                <div class="d-1 d-c">
                                    <h6> {{$invoice->brand_address}} </h6>
                                    <h5><span>{{$invoice->brand_country}}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="d-6">
                                <h6>Billed To</h6>

                                @if($invoice->client)
                                <h5> <b>{{$invoice->client->first_name.' '.$invoice->client->last_name}} </b> </h5>
                                @else
                                <h5> <b> <del> Deleted #{{$invoice->client_id }} </del> </b> </h5>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex justify-content-between invoice-detail-1">
                                <div class="d-3">
                                    <div class="d-gap mb-5">
                                        <h6>Date of Issue</h6>
                                        <h5 class="dateformat"><b>{{ date("jS F, Y", strtotime($invoice->issue_date)); }} </b></h5>
                                    </div>
                                    <div class="d-gap">
                                        <h6>Due Date</h6>
                                        <h5 class="dateformat"> <b>{{ date("jS F, Y", strtotime($invoice->due_date)); }} </b> </h5>
                                    </div>
                                </div>
                                <div class="d-4">
                                    <div class="d-gap mb-5">
                                        <h6>Invoice Number</h6>
                                        <h5> <b> #{{$invoice->invoice_number}} </b> </h5>
                                    </div>
                                </div>
                                <div class="d-5">
                                    <div class="d-gap mb-3">
                                        <h6>Amount Payable ({{($invoice->currency)?$invoice->currency:'USD'}})</h6>
                                        <h5 id="amount_due" > {{$currency_symbol}}  {{$invoice->partial_payments == 1?   (float) $invoice->partial_payment_amount: (float) $invoice->total_amount- (float)$invoice->total_amount_paid }}</h5>
                                    </div>


                                    <script>
                                        document.getElementById('amount_due').addEventListener('change', function() {
                                            document.getElementsByName('amount')[0].value = document.getElementById('amount_due').innerHTML.replace("$", "");
                                        });
                                    </script>

                                    @if($invoice->payment_methods)
                                    @if((float) $invoice->total_amount- (float)$invoice->total_amount_paid > 0 )


                                    @if($invoice->payment_methods->type == "Paypal")
                                   
                                   
                                   
                                    <div class="d-gap">


                                    
    <div class="links">
                    <div id="paypal-button-container"></div>
                    </div>


                                        <!-- <h5>

                                            <form method="POST" action="{{route('payment.paypal.handle')}}">

                                                @csrf <input type="text" hidden name="amount" value="{{(float) $invoice->total_amount- (float)$invoice->total_amount_paid }}">
                                                <input type="text" hidden name="id" value="{{$invoice->id}}">

                                                <a href="javascript:void(0);">
                                                    <button type="submit" class="btn btn-success"> Pay Now</button>
                                                </a>
                                            </form>
                                        </h5> -->
                                    </div>
                                    @else
                                    <div class="d-gap">
                                        <h5>

                                                                                        <button class="btn btn-success"  data-toggle="modal" data-target="#createModal"> Pay Now</button>


 <!--
 
                                             <a href="{{route('payment.paynow',array('id'=>$invoice->id))}}">
                                                 <button class="btn btn-success"  data-toggle="modal" data-target="#createModal"> Paynow</button>
                                             </a>
                                             -->
                                        </h5>
                                    </div>
                                    @endif


                                    @else

                                     <!--
                                    // <div class="d-gap">
                                    //     <span class="stamp is-nope">paid</span>
                                    // </div>
 -->
                                    @endif


                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="d-7 d-gap-1 invoice-detail-2">
                                <div class="card-body">
                                    <table class="table table-responsive table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Rate</th>
                                                <th>Qty</th>
                                                <th>Line Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @if(count($invoice->items) > 0)
                                            @foreach($invoice->items as $item)




                                            <tr data-widget="expandable-table" aria-expanded="true">
                                                <td> {{$item->title}}</td>
                                                <td>{{$currency_symbol}} {{$item->rate}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$currency_symbol}} {{$item->total}}</td>
                                            </tr>

                                            @if($item->description)

                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <p>
                                                      @php echo str_replace("\n","<br>",$item->description) @endphp
                                                    </p>
                                                </td>
                                            </tr>


                                            @endif

                                            @endforeach
                                            @endif



                                            <tr class="no-border" data-widget="expandable-table" aria-expanded="false">
                                                <td></td>
                                                <td></td>
                                                <td>Subtotal</td>
                                                <td>{{$currency_symbol}} {{$invoice->subtotal_amount}} </td>
                                            </tr>

                                            @if((float)$invoice->total_discount > 0)
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td></td>
                                                <td></td>
                                                <td>Discount</td>




    <?php
                                $discount_ = (float) $invoice->total_discount *100 / (float) $invoice->subtotal_amount;
    ?>



                                                <td>-{{$invoice->total_discount}} ({{$discount_}}%)</td>
                                            </tr>
                                            @endif


                                            @if((float)$invoice->total_tax > 0)
                                            @foreach($invoice->taxes as $tax)
                                            <tr class="no-boder" data-widget="expandable-table" aria-expanded="false">
                                                <td></td>
                                                <td></td>
                                                <td>{{$tax->title}}
                                                    <p>#{{$tax->number}}</p>
                                                </td>



<?php
                                $tax_ =  $tax->value *100 /(int)$invoice->subtotal_amount;                 
?>

                                                <td>+{{$tax->value}} ({{$tax_}}%)</td>
                                            </tr>
                                            @endforeach
                                            @endif






                                            <tr class="no-border" data-widget="expandable-table" aria-expanded="false">
                                                <td></td>
                                                <td></td>
                                                <td>Total</td>
                                                <td>{{$currency_symbol}} {{ (float) $invoice->total_amount}}</td>
                                            </tr>
                                            <tr class="no-border" data-widget="expandable-table" aria-expanded="false">
                                                <td></td>
                                                <td></td>
                                                <td class="amount-paid">Amount Paid</td>
                                                <td class="amount-paid">{{$currency_symbol}} {{ (float)(float)$invoice->total_amount_paid}}</td>
                                            </tr>
                                            <tr class="no-border" data-widget="expandable-table" aria-expanded="false">
                                                <td></td>
                                                <td></td>
                                                <td class="amount-due">Amount Due ({{$currency_symbol}})</td>
                                                <td class="amount-due">{{$currency_symbol}} {{ (float) $invoice->total_amount- (float)$invoice->total_amount_paid}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="d-7 d-gap-1">
                                            <h6><b>Notes </b> </h6>
                                            <p> {{$invoice->notes}} </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="d-7">
                                            <h6> <b> Terms </b> </h6>
                                            {!! $invoice->terms !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


<!-- Paynow -->




    <!-- Create Modal -->
    <div class="modal custom-modal modal-custom-1 fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog w-50" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="row align-items-center">
              <div class="col-sm-6">
                <h5 class="modal-title" id="exampleModalLabel">
                 Payment 
                </h5>
              </div>
              <div class="col-sm-6">
                <ul class="breadcrumb">
                  <li>
                    <a data-dismiss="modal" href="javascript:void(0)">Cancel</a>
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



    <form id="payment-form" class="sr-payment-form payment-form">
        <section class="sec-1">
            <div class="container">



                <div id="loading" class="mt-5">

                    <div class="row">
                        <div class="col-3">

                        </div>

                        <div class="col-6">

                            <img src="{{url('admin/images/stripe_payment.gif')}}">
                        </div>
                        <div class="col-3">
                        </div>

                    </div>
                </div>

                
            </div>
            <div class="row detailsDiv">
                <div class="col-12 ">
                    <div class="form-group">
                        <p class="g-title">Credit Card Information</p>
                        <div class="container">

       <input type="hidden" name="invoice_id" id="invoice_id"  value="{{$invoice->id}}" >

                            <div class="col-12 mt-2">
                                <label for="card-element">

                                </label>
                                <div id="card-element">
                                    <!-- a Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display Element errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </div>
                        <button type="button" class="btn-Stripe">Pay Now</button>
                    </div>
                </div>
            </div>


            <span id="stripe_token_err" class="text-danger laravel_validation"> </span>

            </div>
        </section>



    </form>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    </div>

<!-- Paynow  -->


    @endif

    <!-- jQuery -->
    <script src="{{ url('/') }}/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('/') }}/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- InputMask -->
    <script src="{{ url('/') }}/admin/plugins/moment/moment.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ url('/') }}/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('/') }}/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('/') }}/admin/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('/') }}/admin/dist/js/demo.js"></script>
    <script src="{{ url('/') }}/admin/dist/js/custom.js"></script>
    <!-- Page specific script -->

    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>






    <script src="https://js.stripe.com/v3/"></script>


    <script>
        var stripeToken = "";
        $('.btn-Stripe').click(async () => {

        $('.btn-Stripe').prop('disabled',true);

            await getStripeToken();
            var orderData = {
                invoice_id: document.getElementById("invoice_id").value,
                stripe_token: stripeToken
            };

            $('#loading').css('display', 'block');
            $('.detailsDiv').css('display', 'none');

            $(`.laravel_validation`).html('');
            var settings = {
                "url": "{{route('payment.create')}}",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                    "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                "data": JSON.stringify(orderData),
            };
            $.ajax(settings).done(function(response) {

                console.log("response",response);
                


                $('.btn-Stripe').prop('disabled',false);
                // $('#loading').css('display', 'none');
                // $('.detailsDiv').css('display', 'flex');



                    $('#loading').css('display', 'none');
                    $('.detailsDiv').css('display', 'block');


                if (response.status == false) {


                    for (let key of Object.entries(response.data)) {
                        $(`#${key[0]}_err`).html(key[1]);
                    }
                } else {



                    swal("Transaction Completed!", response.message, "success");
                    setTimeout(function() {
                            location.reload();
                    }, 2000);
                }
            }).fail(function(err) {




                $('.btn-Stripe').prop('disabled',false);

                $('#loading').css('display', 'none');
                $('.detailsDiv').css('display', 'block');


                    swal("Error!", err.responseJSON.message, "error");
           

            });

        });

        // Create a Stripe client
        var stripe = Stripe("{{$public_key}}");

        // Create an instance of Elements
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element
        var card = elements.create('card', {
            style: style
        });

        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');

        function getStripeToken() {
            return new Promise(resolve => {
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {

                        resolve(result.token.id);
                        /* token contains id, last4, and card type */
                        stripeToken = result.token.id;
                    }
                });
                return stripeToken;
            });
        }
    </script>




</body>

</html>

<script src="{{ url('/') }}/admin/dist/js/adminlte.min.js"></script>



<!-- paypal -->



@if($invoice->payment_methods->type == "Paypal")


<!-- Sample PayPal credentials (client-id) are included -->
<script src="https://www.paypal.com/sdk/js?client-id={{$invoice->payment_methods->public_key}}&currency={{$invoice->currency}}&intent=capture&enable-funding=venmo" data-sdk-integration-source="integrationbuilder"></script>
        






<script>


const paypalButtonsComponent = paypal.Buttons({
              // optional styling for buttons
              // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
              style: {
                color: "gold",
                shape: "rect",
                layout: "vertical"
              },

              // set up the transaction
              createOrder: (data, actions) => {
                  // pass in any options from the v2 orders create call:
                  // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                  const createOrderPayload = {
                      purchase_units: [
                          {
                              amount: {
                                  value: "{{$invoice->partial_payments == 1?   (float) $invoice->partial_payment_amount: (float) $invoice->total_amount- (float)$invoice->total_amount_paid }}"
                              }
                          }
                      ]
                  };

                  return actions.order.create(createOrderPayload);
              },

              // finalize the transaction
              onApprove: (data, actions) => {
                  const captureOrderHandler = (details) => {
                      
                    console.log("details.purchase_units[0].id",details.purchase_units[0].payments.captures[0].id);




                    $('#loadingPaypal').css('display', 'block');
                    $('#exceptPaypal').css('display', 'none');

                fetch("{{route('payment.paypal.execute')}}", {
                    method: 'POST',
                    body: JSON.stringify({
                    invoiceId:"{{$invoice->id}}",
                    amount:details.purchase_units[0].payments.captures[0].amount.value,
                    transaction_id:details.purchase_units[0].payments.captures[0].id,
                    transaction_object : details
                    }),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),                        
                        'Content-type': 'application/json; charset=UTF-8',
                    }
                    })
                    .then(function(response){ 
                    return response.json()})
                    .then(function(res)
                    {

                        
                    $('#loadingPaypal').css('display', 'none');
                    $('#exceptPaypal').css('display', 'block');


                                if(res.success){

                                    swal("Transaction Completed!", res.message, "success");
                                        setTimeout(function() {
                                             location.reload();
                                        }, 2000);
                                }else{


                                    swal("Error!", res.message, "error");
                                        setTimeout(function() {
                                              location.reload();
                                        }, 2000);

                                }

                    }).catch(error => console.error('Error:', error)); 
                  };

                  return actions.order.capture().then(captureOrderHandler);
              },

              // handle unrecoverable errors
              onError: (err) => {

                  
                $('#loadingPaypal').css('display', 'none');
                    $('#exceptPaypal').css('display', 'block');

                  alert('An error prevented the buyer from checking out with PayPal');
              }
          });

          paypalButtonsComponent
              .render("#paypal-button-container")
              .catch((err) => {
                  console.error('PayPal Buttons failed to render');
              });


</script>

@endif