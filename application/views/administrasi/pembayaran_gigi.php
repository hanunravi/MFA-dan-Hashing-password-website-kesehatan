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
                            <a href="<?php echo base_url();?>C_Administrasi" class="logo">
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
                                <a href="<?php echo base_url();?>C_Administrasi">
                                    <i class="fe-airplay"></i>Dashboard</a>
                            </li>
                        <li class="has-submenu">
                                <a href="<?php echo base_url();?>C_Administrasi/pasien">
                                    <i class="fe-users"></i>Pasien</a>
                            </li>
                            <li class="has-submenu">
                                <a href="<?php echo base_url();?>C_Administrasi/daftar_berobat">
                                    <i class="fe-user-plus"></i>Daftar Berobat</a>
                            </li>
                            <li class="has-submenu">
                                <a href="<?php echo base_url();?>C_Administrasi/pembayaran">
                                    <i class="fe-dollar-sign"></i>Pembayaran</a>
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
                                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>C_Administrasi">Administrasi</a></li>
                                    <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>C_Administrasi/pembayaran">Pembayaran</a></li>
                                    <li class="breadcrumb-item active">Gigi</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Poli gigi</h4>
                            <?php if($this->session->flashdata('item')){
                                $message = $this->session->flashdata('item');
                            ?>
                            <div class="<?php echo $message['class']; ?>" role="alert">
                               
                                <?php echo $message['message']; ?>
                            </div>              
                            <?php }?>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>     
                <!-- end page title --> 

                <div class="row" >
                     <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Pembayaran Pasien Poli Gigi</h4>
                            <form class="form-horizontal" method="post" action="<?php echo base_url('C_Administrasi/tambahPembayaranGigi') ?>">
                                <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Pasien </label>
                                        <div class="col-sm-10">
                                           <select class=" js-example-basic-single form-control" name="idPasien" required>
                                                <option  disabled selected>---- Pilih Pasien ------</option>
                                                <?php foreach ($dftr as $row) { ?>
                                                    <option  value="<?php echo $row->idPasien ?>"><?php echo $row->namaPasien ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanggal Transaksi</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="date" name="tanggal" max="<?php echo date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>                                
<!--                                     <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tindakan</label>

                                        <div class="col-sm-10">
                                            <?php foreach($tindakan as $row){ ?>
                                          <input onchange="change_checkbox(this);" id="xxx" type="checkbox" name="tindakan[]" value="<?php echo $row->tarif ?>"><label><?php echo $row->namaTindakan ?></label><br/>
                                          <?php } ?>
                                        </div>
                                        </div>
                                    </div> -->
                                  <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Biaya Konsultasi (Rp.)</label>
                                        <div class="col-sm-10">
                                         <input type="text" name="total" class="form-control" id="dengan-rupiah" required/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Biaya Obat (Rp.)</label>
                                        <div class="col-sm-10">
                                         <input type="text" name="total2" class="form-control" id="dengan-rupiah" required />
                                        </div>
                                    <div id="wrapper">
                                          <button type="submit" class="btn btn-block btn-primary">Tambah Transaksi</button>
                                        </div>
                                                    
                                </form>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- end row -->




                
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- Footer Start -->
        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        Brimedika &copy; 2018 
                    </div>

                </div>
            </div>
        <!-- end Footer -->


        <!-- App js -->
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/app.min.js"></script>

        <!-- Plugins js -->
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/Chart.bundle.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor/jquery.knob.min.js"></script>

        <script src="<?php echo base_url();?>assets/Horizontal/dist/js/pages/dashboard.init.js"></script>
<script type="text/javascript">

function change_checkbox(el){
  if(el.checked){
    var tes = $("#dengan-rupiah").val();
    //console.log(tes);
    if(tes === undefined){
    tes = 0;
    }
   var  biayal = parseInt(tes);
   if(isNaN(biayal)){
    biayal = 0;
   }
    var biayab = parseFloat(el.value);
    //console.log(biayal);
    //console.log(biayalb;
    var biaya = biayab + biayal;
    $("#dengan-rupiah").val(biaya);
    //console.log(biaya)

  }else{
    var tes = $("#dengan-rupiah").val();
    //console.log(tes);
    if(tes === undefined){
    tes = 0;
    }
   var  biayal = parseInt(tes);
   if(isNaN(biayal)){
    biayal = 0;
   }
    var biayab = parseFloat(el.value);
    console.log(biayal);
    //console.log(biayalb;
    var biaya = biayal - biayab;
    $("#dengan-rupiah").val(biaya);
    console.log(biaya)
  }
}

 /* Tanpa Rupiah */


</script>
    </body>
</html>

