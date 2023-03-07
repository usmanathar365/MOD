
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ url('/') }}/admin/images/favicon-1.png" type="image/x-icon">
  <title>Cloud Solutions</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">



  <!-- Date Range PIcker -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  <!-- Tempusdominus Bootstrap 4 -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/dist/css/style.css">

  <!-- Sweet alert -->
  <script src="{{ url('/') }}/admin/js/sweetalert.min.js"></script>

  <!-- Moment Js alert -->
  <script src="{{ url('/') }}/admin/js/moment.min.js"></script>


  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/') }}/admin/plugins/select2/css/select2.min.css">

  @yield('pageCss')
  <style>
    ul.brand-dropdown {
      background: #0c0c0c78;
      max-height: 212px;
      height: auto;
    }
  </style>



</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader bg-light flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ url('/') }}/public/uploads/cs-logo.png" alt="AdminLTELogo" height="auto" width="200">
    </div>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>




      <ul class="navbar-nav ml-auto">


        <li class="nav-item">
          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a class="nav-link" href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
              {{ __('Log Out') }}
            </a>
          </form>
          </a>
        </li>




        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <a href="#!" class="brand-link">
        <img style="max-height: 130px;" src="{{ url('/') }}/public/uploads/cs-logo.png" alt="CS Logo" class="brand-image">
      </a>


      <div class="sidebar">
        <nav class="custom-navbar">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">







          <li class="nav-item">
                  <a href="{{ route('banners.list') }}" class="nav-link">
                    <i class="fa fa-image nav-icon"></i>
                    <p>Manage Banners</p>
                  </a>
                </li>


                <li class="nav-item">
                  <a href="{{ route('news.list') }}" class="nav-link">
                    <i class="fa fa-newspaper nav-icon"></i>
                    <p>Manage News</p>
                  </a>
                </li>

          <!-- <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon fa fa-chart-pie"></i>
                <p>
                  CMS
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="{{ route('banners.list') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Banners</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('news.list') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>News</p>
                  </a>
                </li>


              </ul>
            </li>
 -->




            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon fa fa-chart-pie"></i>
                <p>
                  Manage Users
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="{{ route('roles.list') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Roles</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('users.list') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Users</p>
                  </a>
                </li>


              </ul>
            </li>




          </ul>
        </nav>
      </div>
    </aside>



    @yield('mainContent')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

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
  <!-- Page specific script -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

  <!-- Date Range PIcker -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>



  <script>
  </script>
  <script>
    $('.advanced-search-toggle').on('click', function() {
      $('.search-details').toggleClass('active');
    });


    $(document).ready(function() {
      //Initialize Select2 Elements
      // $('.select2').select2()

      //Initialize Select2 Elements
      // $('.select2bs4').select2({
      //   theme: 'bootstrap4'
      // })

      //Datemask dd/mm/yyyy
      // $('#datemask').inputmask('dd/mm/yyyy', {
      //   'placeholder': 'dd/mm/yyyy'
      // })

      //Datemask2 mm/dd/yyyy
      // $('#datemask2').inputmask('mm/dd/yyyy', {
      //   'placeholder': 'mm/dd/yyyy'
      // })


      //Money Euro
      // $('[data-mask]').inputmask()

      //Date picker
      // $('#reservationdate').datetimepicker({
      //   format: 'L'
      // });

      //Date and time picker
      // $('#reservationdatetime').datetimepicker({
      //   icons: {
      //     time: 'far fa-clock'
      //   }
      // });

      //Date range picker
      // $('#reservation').daterangepicker()
      //Date range picker with time picker
      // $('#reservationtime').daterangepicker({
      //   timePicker: true,
      //   timePickerIncrement: 30,
      //   locale: {
      //     format: 'MM/DD/YYYY hh:mm A'
      //   }
      // })
      //Date range as a button
      // $('#daterange-btn').daterangepicker({
      //     ranges: {
      //       'Today': [moment(), moment()],
      //       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      //       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      //       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      //       'This Month': [moment().startOf('month'), moment().endOf('month')],
      //       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      //     },
      //     startDate: moment().subtract(29, 'days'),
      //     endDate: moment()
      //   },
      //   function(start, end) {
      //     $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      //   }
      // )

      //Timepicker
      // $('#timepicker').datetimepicker({
      //   format: 'LT'
      // })

      //Bootstrap Duallistbox
      // $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      // $('.my-colorpicker1').colorpicker()
      //color picker with addon
      // $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      })

      $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })

    })





    // A $( document ).ready() block.
    $(document).ready(function() {


      // BS-Stepper Init
      document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
      })



    });
  </script>

  <script>
    $(".brand-link").click(function() {
      $(".brand-dropdown").toggleClass("brand-active");
    });
  </script>

  @yield('pageJs')

</body>

</html>