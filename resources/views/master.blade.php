<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="<?= URL::to('/'); ?>/layout/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= URL::to('/'); ?>/layout/assets/css/fontgoogleapis.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript-->
  <script src="<?= URL::to('/'); ?>/layout/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= URL::to('/'); ?>/layout/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Core plugin JavaScript-->
  <!-- <script src="<?= URL::to('/'); ?>/layout/assets/vendor/jquery-easing/jquery.easing.min.js"></script> -->

  <!-- Select Select-->
  <link href="<?= URL::to('/'); ?>/layout/assets/css/select2.min.css" rel="stylesheet" />
  <script src="<?= URL::to('/'); ?>/layout/assets/js/select2.min.js"></script>

  
  <!-- Custom styles for this template-->
  <link href="<?= URL::to('/'); ?>/layout/assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= URL::to('/'); ?>/layout/assets/css/additional.css" rel="stylesheet">
  
  <!-- Sweat Alert -->
  <script src="<?= URL::to('/'); ?>/layout/assets/js/sweetalert.min.js"></script>

  <!-- DataTable -->
  <link rel="stylesheet" type="text/css" href="<?= URL::to('/'); ?>/layout/assets/css/dataTables.css">
  <script type="text/javascript" charset="utf8" src="<?= URL::to('/'); ?>/layout/assets/js/dataTables.js" defer>
  </script>

  <link href="<?= URL::to('/'); ?>/layout/assets/css/bootstrap-toggle.min.css" rel="stylesheet">

  <script src="<?= URL::to('/'); ?>/layout/assets/js/bootstrap-toggle.min.js"></script>

  @stack('scripts')

</head>

@yield('modal')

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('include.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" style="padding-bottom: 20px">

        <!-- Topbar -->
          @include('include.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
         
          <!-- Content Row -->
          
          <div class="row">
            
          <!-- Konten Disini -->
          
          <div class="col-md-12" style="padding-left: 0px">

          @yield('alert')

          </div>

          @yield('content')

          <!-- End Content -->

          </div>                 

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
        @include('include.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin ingin meninggalkan sistem ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ url('/auth/logout') }}">Logout</a>
        </div>
      </div>
    </div>
  </div>
 
  
</body>

</html>

<script type="text/javascript">
    var base_url = {!! json_encode(url('/')) !!}
</script>

<!-- Custom scripts for all pages-->
<script src="<?= URL::to('/'); ?>/layout/assets/js/sb-admin-2.js"></script>
<!-- <script src="<?= URL::to('/'); ?>/layout/assets/js/sb-admin-2.min.js"></script> -->

<!-- Page level plugins -->
<!-- <script src="<?= URL::to('/'); ?>/layout/assets/vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="<?= URL::to('/'); ?>/layout/assets/js/demo/chart-area-demo.js"></script>
<script src="<?= URL::to('/'); ?>/layout/assets/js/demo/chart-pie-demo.js"></script> -->
