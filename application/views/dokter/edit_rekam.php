<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Brimedika</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/Horizontal/dist/assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?php echo base_url();?>assets/Horizontal/dist/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/Horizontal/dist/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/Horizontal/dist/css/vendor/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/Horizontal/dist/css/vendor/select.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/Horizontal/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/Horizontal/dist/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/Horizontal/dist/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <nav class="navbar-custom">

                <div class="container-fluid">
                    <ul class="list-unstyled topbar-right-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo base_url();?>assets/Horizontal/dist/assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                                <small class="pro-user-name ml-1">
                                 <?php echo $this->session->userdata('nama'); ?>
                                </small>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Hai !</h6>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                 <a href="<?php echo base_url();?>C_Login/logout" style="color:#00acc1" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span >Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>
                    <?php //var_dump($_SESSION); ?>
                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <a href="index.html" class="logo">
                                <span class="logo-lg">
                                    <img src="<?php echo base_url();?>assets/Horizontal/dist/assets/images/favicon.ico" alt="" height="18"> <b style="color:white">BRIMEDIKA</b>
                                </span>
                                <span class="logo-sm">
                                    <img src="<?php echo base_url();?>assets/Horizontal/dist/assets/images/favicon.ico" alt="" height="28">
                                </span>
                            </a>
                        </li>
            
                    </ul>
                </div>

            </nav>
            <!-- end topbar-main -->

            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                         <li class="has-submenu">
                                <a href="<?php echo base_url();?>C_Dokter">
                                    <i class="fe-airplay"></i>Dashboard</a>
                            </li>
                        <li class="has-submenu">
                                <a href="<?php echo base_url();?>C_Dokter/pasien">
                                    <i class="fe-users"></i>Pasien</a>
                            </li>
                            <li class="has-submenu">
                                <a href="<?php echo base_url();?>C_Dokter/obat">
                                    <i class="fe-link"></i>Obat</a>
                            </li>


                  
                            
                                </ul>
                            </li>

                        </ul>
                        <!-- End navigation menu -->

                        <div class="clearfix"></div>
                    </div>
                    <!-- end #navigation -->
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->

        <div class="wrapper">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>C_Dokter">Administrasi</a></li>
                                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>C_Dokter/pasien">Pasien</a></li>
                                    <li class="breadcrumb-item active">Edit Pasien</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Edit Pasien</h4>



                        </div>
                    </div>
                </div>     
                <!-- end page title --> 


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Form Edit Pasien</h4>

                                   <form class="form-horizontal" method="post" action="<?php echo base_url('C_Dokter/prosesEditR') ?>">
                                   <?php foreach($rekam as $row){ ?>
                                    <input type="hidden" name="idp" class="form-control" value="<?php echo $row->idPasien?>">
                                    <input type="hidden" name="idr" class="form-control" value="<?php echo $row->noRM?>">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanggal Pemeriksaan</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="date" name="tanggal" max="<?php echo date('Y-m-d');  ?>" value="<?php echo $row->tglPemeriksaan ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Anamnesa </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="ana" class="form-control" value="<?php echo $row->anamnesa ?>" size="3">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Diagnosa </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="diagnosa" class="form-control" value="<?php echo $row->diagnosa ?>" size="3">
                                        </div>
                                    </div>
                                   <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Terapi </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="terapi" class="form-control" value="<?php echo $row->terapi ?>" size="3">
                                        </div>
                                    </div>
                                   <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Ket Terapi </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="detail" class="form-control" value="<?php echo $row->ketTerapi ?>" size="3">
                                        </div>
                                    </div>
                                   
                                    <style type="text/css">
                                        #wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
}


                                    </style>
                                    <div id="wrapper">
                                          <button type="submit" class="btn btn-primary">Edit Data</button>
                                        </div>
                                    <?php } ?>              
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        Brimedika &copy; 2024 
                    </div>

                </div>
            </div>
        </footer>
        <!-- end Footer -->


        <!-- App js -->
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/app.min.js"></script>

        <!-- Plugins js -->
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/Chart.bundle.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/jquery.knob.min.js"></script>

        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/jquery.dataTables.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/dataTables.bootstrap4.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/buttons.flash.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/buttons.print.min.js"></script>
         <script src="<?php echo base_url();?>assets/Horizontal/dist/js/pages/datatables.init.js"></script>

        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/pages/dashboard.init.js"></script>

    </body>
</html>
