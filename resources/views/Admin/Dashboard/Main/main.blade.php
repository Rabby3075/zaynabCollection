<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
    @isset($companyData->logo)
    <link rel="shortcut icon" type="image/png" href="/Company/{{ $companyData->logo }}">
    @else
        <link rel="shortcut icon" type="image/png" href="image/default/logo.jpg">
    @endisset

  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <link rel="stylesheet" href="../../vendors/select2/select2.min.css">
    <link rel="stylesheet" href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d4fd55d14f.js" crossorigin="anonymous"></script>
    <!--Table cdn-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
<!--Toast-->
    <style>
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        .toast .progress-bar {
            animation: progress 5s linear;
        }

        @keyframes progress {
            from {
                width: 0%;
            }
            to {
                width: 100%;
            }
        }
    </style>
    <!--Toast-->
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
   @include('Admin.Dashboard.Main.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
     @include('Admin.Dashboard.Main.rightSidebar')
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
        @include('Admin.Dashboard.Main.sidebar')
      <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
        @yield('content')
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
                </div>
            </footer>
        </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>
  <!-- End custom js for this page-->
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
  <!--Table cdn-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable( {
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]] // 5 is the minimum value
        } );
        $('#myTable').DataTable();
    });
    <!--Table cdn-->
    <!--Excel Conversion-->
    function html_table_to_excel(type)
    {
        var data = document.getElementById('myTable');
        var file = XLSX.utils.table_to_book(data, {sheet: "Report"});
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
        XLSX.writeFile(file, 'data.' + type);
    }
    const export_button = document.getElementById('export-btn');
    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });
    <!--Excel Conversion-->
    <!--Toast JS-->
    function showToast(msg) {
        $('.toast').toast('show');
        $('#msg').text(msg);
        var toastElement = $('.toast:last');
        var toastInterval = setInterval(function() {
            var progressBar = toastElement.find('.toast-progress-bar');
            var currentTime = parseFloat(progressBar.attr('aria-valuenow'));
            var maxTime = parseFloat(progressBar.attr('aria-valuemax'));
            var percentage = Math.round((currentTime / maxTime) * 100);

            if (currentTime >= maxTime) {
                clearInterval(toastInterval);
                $('.toast').remove();
            } else {
                currentTime += 0.1; // Change the timer speed here
                progressBar.css('width', percentage + '%');
                progressBar.attr('aria-valuenow', currentTime.toFixed(1));
            }
        }, 100);
    }
    <!--Toast JS-->
</script>

</body>

</html>

