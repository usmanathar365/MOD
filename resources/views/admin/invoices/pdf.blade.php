<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url('/') }}/admin/dist/img/favicon.ico" type="image/x-icon">
    <title>Oneterminal - Invoice #{{$invoice->invoice_number}}</title>
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
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
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
</style>



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

<body>

    @if(isset($invoice->id))


    <!-- Main content -->
    <section class="">
        <div class="">
            <div>

                <div>
                    <div class="" style="float: left; width: 41%;">
                        <div class="invoice-logo d-1 d-c">

                            @if($invoice->brand_logo)
                            <img src="{{ url('/') }}/public/uploads/invoices/{{$invoice->brand_logo}}" class="img-fluid">
                            @else
                            <img src="{{ url('/') }}/public/uploads/brands/{{$invoice->brand->logo}}" class="img-fluid">
                            @endif
                        </div>


                        <div style="margin-top: 3.2rem; ">
                            <h6>Billed To</h6>

                            @if($invoice->client)
                            <h5> <b>{{$invoice->client->first_name.' '.$invoice->client->last_name}} </b> </h5>
                            @else
                            <h5> <b> <del> Deleted #{{$invoice->client_id }} </del> </b> </h5>
                            @endif
                        </div>


                    </div>
                    <div class="" style="float: left; width: 59%; ">
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

                        <div class="ml-4" style="float: left; ">
                            <div class="">
                                <h6>Date of Issue</h6>
                                <h5><b>{{ date("d-m-Y", strtotime($invoice->issue_date)); }} </b></h5>
                            </div>
                            <div class="">
                                <h6>Due Date</h6>
                                <h5> <b>{{ date("d-m-Y", strtotime($invoice->due_date)); }} </b> </h5>
                            </div>
                        </div>

                        <div style="float: right; ">
                            <div class="">
                                <h6>Invoice Number</h6>
                                <h5> <b> #{{$invoice->invoice_number}} </b> </h5>
                            </div>
                            <div>
                                <h6>Amount Payable ({{($invoice->currency)?$invoice->currency:'USD'}})</h6>
                                <h5 id="amount_due" > {{$currency_symbol}}  {{$invoice->partial_payments == 1?   (float) $invoice->partial_payment_amount: (float) $invoice->total_amount- (float)$invoice->total_amount_paid }}</h5>
                            </div>

                            @if((float) $invoice->total_amount- (float)$invoice->total_amount_paid > 0 )

                            @else
                            <div class="d-gap">
                                <span class="stamp is-nope">paid</span>
                            </div>

                            @endif
                        </div>
                    </div>


                    <div class="row" style="margin-top:250px">


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
                                                <td>{{$currency_symbol}}  {{$item->rate}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$currency_symbol}}  {{$item->total}}</td>
                                            </tr>

                                            @if($item->description)

                                            <tr class="expandable-body">
                                                <td colspan="5">
                                                    <p>
                                                        {{$item->description }}
                                                    </p>
                                                </td>
                                            </tr>


                                            @endif

                                            @endforeach
                                            @endif



                                            <tr data-widget="expandable-table" aria-expanded="false">
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
                                            <tr data-widget="expandable-table" aria-expanded="false">
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






                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td></td>
                                                <td></td>
                                                <td>Total</td>
                                                <td>{{$currency_symbol}}  {{ (float) $invoice->total_amount}}</td>
                                            </tr>
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td></td>
                                                <td></td>
                                                <td>Amount Paid</td>
                                                <td>{{$currency_symbol}}  {{ (float)(float)$invoice->total_amount_paid}}</td>
                                            </tr>
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td></td>
                                                <td></td>
                                                <td>Amount Due (USD)</td>
                                                <td>{{$currency_symbol}}  {{ (float) $invoice->total_amount- (float)$invoice->total_amount_paid}}</td>
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
</body>

</html>

<script src="{{ url('/') }}/admin/dist/js/adminlte.min.js"></script>