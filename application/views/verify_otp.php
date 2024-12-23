<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Verifikasi OTP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url();?>assets/Horizontal/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/Horizontal/dist/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/Horizontal/dist/css/app.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="authentication-bg">
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <h4>Masukkan Kode OTP</h4>
                                <p class="text-muted mb-4 mt-3">Kode OTP telah dikirimkan ke email Anda.</p>
                            </div>
                            <form action="<?php echo base_url('C_Login/verify_otp_action');?>" method="post">
                                <div class="form-group mb-3">
                                    <label for="otp">Kode OTP</label>
                                    <input class="form-control" type="text" id="otp" name="otp" required placeholder="Masukkan Kode OTP">
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> Verifikasi </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    // Mencegah tombol back
    window.history.forward();function noBack() {window.history.forward();}
    </script>

    <script src="<?php echo base_url();?>assets/Horizontal/dist/js/vendor.min.js"></script>
    <script src="<?php echo base_url();?>assets/Horizontal/dist/js/app.min.js"></script>
</body>
</html>
