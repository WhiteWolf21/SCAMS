<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SCAMS SYSTEM</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="css/fontawesome/css/all.css" rel="stylesheet">

        <!-- Styles -->
        <link href="css/app.css" rel="stylesheet">
        <link href="css/global.css" rel="stylesheet">
        <link href="css/include/floatingLabel.css" rel="stylesheet">

        <!-- Plugins -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 3 | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">

    </head>
    <header>
        @include ('include/navbar')
    </header>
    <body class="hold-transition sidebar-mini layout-fixed">
    @include ('include/sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Room And Devices Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Room And Devices Reports</li>
                        </ol>
                    </div>
                    @if (session('msg'))
                        <div class="sub-title alert alert-{{session('msg_type')}}">
                            {{session('msg')}}
                        </div>
                    @endif
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="overflow: scroll">
                        <div class="card-header">
                            <h3 class="card-title">Devices</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead >
                                <tr>
                                    <th>Device Type</th>
                                    <th>Belong To Room</th>
                                    <th>Belong To Department</th>
                                    <th>Status</th>
                                    <th>Usage</th>
                                    @if (session('type') == 'admin' or session('type') == 'staff')
                                        <th>Switch</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody >
                                @foreach ($device as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->rname}}</td>
                                        <td>{{$item->dname}}</td>
                                        <td>@if ($item->status == 1) On @else Off @endif</td>
                                        <td>{{$item->usage}}</td>
                                        @if (session('type') == 'admin' or session('type') == 'staff')
                                            <td>
                                                <form action="switch" target="" class="sub-content form" method="post">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="device" value={{$item->device_id}}>
                                                    <input type="hidden" name="room" value={{$item->rname}}>
                                                    @php ($newitem = str_replace(' ','_',$item->dname))
                                                    <input type="hidden" name="department" value={{$newitem}}>
                                                    <input type="hidden" name="item" value={{$item->name}}>
                                                    @if ($item->status == 1)
                                                        <button type="submit" style="background-color: #f44336; padding: 5px 10px;" name="switch" value="off" class="button">Off</button>
                                                        <button type="submit" style="opacity: 0.5;background-color: #4CAF50; padding: 5px 10px;" name="switch" value="on" class="guest-button">On</button>
                                                    @else
                                                        <button type="submit" style="opacity: 0.5;background-color: #f44336; padding: 5px 10px;" name="switch" value="off" class="button">Off</button>
                                                        <button type="submit" style="background-color: #4CAF50; padding: 5px 10px;" name="switch" value="on" class="guest-button">On</button>
                                                    @endif
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Device Type</th>
                                    <th>Belong To Room</th>
                                    <th>Belong To Department</th>
                                    <th>Status</th>
                                    <th>Usage</th>
                                    @if (session('type') == 'admin' or session('type') == 'staff')
                                        <th>Switch</th>
                                    @endif
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
    </body>
</html>
