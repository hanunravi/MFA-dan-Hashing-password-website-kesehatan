<!-- File: application/views/dokter/verify_pin.php -->
<div class="container">
    <h2>Verifikasi PIN</h2>
    <form method="post" action="<?php echo site_url('C_Dokter/verify_pin'); ?>">
        <div class="form-group">
            <label for="pin">Masukkan PIN Anda</label>
            <input type="password" class="form-control" id="pin" name="pin" required>
        </div>
        <button type="submit" class="btn btn-primary">Verifikasi</button>
    </form>
</div>
