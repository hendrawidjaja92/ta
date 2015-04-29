<?php
$username = $this->session->userdata('username');
$email = $this->session->userdata('email');
$password = $this->session->userdata('password');
$nama_lengkap = $this->session->userdata('nama_lengkap');
$nama_perusahaan = $this->session->userdata('nama_perusahaan');
$alamat = $this->session->userdata('alamat');
$no_telepon = $this->session->userdata('no_telepon');
$jenis_kelamin = $this->session->userdata('jenis_kelamin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Toko Kenal Jaya Online</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('public_html/css/bootstrap.css') ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="cover">

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= base_url() ?>index.php/home">Toko Kenal Jaya Online</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Cari</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= base_url() ?>index.php/admin">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= base_url() ?>index.php/admin/ubah_akun">Ubah Akun</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/manage_pembayaran">Manage Pembayaran</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/manage_barang">Manage Barang</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/manage_refund">Manage Refund</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/manage_supplier">Manage Supplier</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/manage_seller">Manage Seller</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/manage_customer">Manage Customer</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/manage_pegawai">Manage Pegawai</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/pembelian">Pembelian</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/history_pembelian">History Penjualan</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/history_penjualan">History Pembelian</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </li>
                <li><a href="#">Tentang Kami</a></li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<ul class="list-group col-md-2 col-sm-2 col-xs-2">
    <li class="list-group-item kategori">
        Kategori
    </li>
    <li class="list-group-item">
        <span class="badge">100</span>
        Cras justo odio
    </li>
    <li class="list-group-item">
        <span class="badge">14</span>
        Cras justo odio
    </li>
    <li class="list-group-item">
        <span class="badge">4</span>
        Cras justo odio
    </li>
    <li class="list-group-item">
        <span class="badge">54</span>
        Cras justo odio
    </li>
    <li class="list-group-item">
        <span class="badge">144</span>
        Cras justo odio
    </li>
    <li class="list-group-item">
        <span class="badge">14</span>
        Cras justo odio
    </li>
    <li class="list-group-item">
        <span class="badge">141</span>
        Cras justo odio
    </li>
    <li class="list-group-item">
        <span class="badge">1</span>
        Cras justo odio
    </li>
    <li class="list-group-item">
        <span class="badge">0</span>
        Cras justo odi
    </li>
    <li class="list-group-item">
        <span class="badge">1400</span>
        Cras justo odio
    </li>
</ul>

<div class="judul-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2 row" data-example-id="carousel-with-captions">
    <ul class="list-group judul-1">
        <li class="list-group-item judul-1">
            <h3>Ubah Akun</h3>
        </li>
    </ul>
    <br>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Email :'); ?> <?php echo form_error('email'); ?>
        </div>
        <div class="col-md-5 col-md-offset-2">
            <?php echo form_input(array('id' => 'email', 'name' => 'email', 'class' => 'form-control', 'value' => $email)); ?>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Old Password :'); ?> <?php echo form_error('password'); ?>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <?php echo form_password(array('id' => 'old_password', 'name' => 'password', 'class' => 'form-control')); ?>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('New Password :'); ?> <?php echo form_error('password'); ?>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <?php echo form_password(array('id' => 'new_password', 'name' => 'password', 'class' => 'form-control')); ?>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Re-Password :'); ?> <?php echo form_error('re_password'); ?>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <?php echo form_password(array('id' => 're_password', 'name' => 're_password', 'class' => 'form-control')); ?>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Nama Lengkap :'); ?> <?php echo form_error('nama_user'); ?>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <?php echo form_input(array('id' => 'nama_user', 'name' => 'nama_user', 'class' => 'form-control')); ?>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Nama Perusahaan :'); ?> <?php echo form_error('nama_perusahaan'); ?>
        </div>
        <div class="col-md-5 col-md-offset-2">
            <?php echo form_input(array('id' => 'nama_perusahaan', 'name' => 'nama_perusahaan', 'class' => 'form-control')); ?>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Alamat :'); ?> <?php echo form_error('alamat'); ?>
        </div>
        <div class="col-md-5 col-md-offset-2">
            <?php echo form_input(array('id' => 'alamat', 'name' => 'alamat', 'class' => 'form-control')); ?>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('No Telepon :'); ?> <?php echo form_error('no_telepon'); ?>
        </div>
        <div class="col-md-3 col-md-offset-2">
            <?php echo form_input(array('id' => 'no_telepon', 'name' => 'no_telepon', 'class' => 'form-control')); ?>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Jenis Kelamin :', 'jenis_kelamin'); ?>
        </div>
        <div class="col-md-3 col-md-offset-2">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-gender-man active">
                    <input type="radio" name="jenis_kelamin" id="a" autocomplete="off"
                           checked>Laki-laki
                </label>
                <label class="btn btn-gender-girl">
                    <input type="radio" name="jenis_kelamin" id="b" autocomplete="off">Perempuan
                </label>
            </div>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Tanggal Lahir :', 'tgl_lahir'); ?>
        </div>
        <div class="col-md-3 col-md-offset-2">
            <input type="date" name=tgl_lahir id="tgl_lahir" class="form-control"/>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Provinsi :', 'provinsi'); ?>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <?php echo form_dropdown(array('id' => 'provinsi', 'name' => 'provinsi', 'class' => 'form-control'), $provinsiDrop); ?>
        </div>
        <div class="col-md-9 col-md-offset-2">
            <?php echo form_label('Kota :', 'kota'); ?>
        </div>
        <div class="col-md-5 col-md-offset-2">
            <?php echo form_dropdown(array('id' => 'kota', 'name' => 'kota', 'class' => 'form-control')); ?>
            <br>
            <br>
        </div>

    <div class="modal-footer col-md-10 col-md-offset-1">
        <?php echo form_button(array('id' => 'save', 'name' => 'save', 'content' => 'Save', 'class' => 'btn btn-ok')); ?>
    </div>
</div>

<nav class="modal-footer">
    © 2015 Fakultas Teknologi Informasi<br>
    Universitas Kristen Maranatha Bandung<br>
    Created by 1172013
</nav>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?= base_url('public_html/js/jquery.min.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?= base_url('public_html/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#provinsi").change(function () {
            /*dropdown post *///
            $.ajax({
                url: "<?php echo base_url();?>index.php/home/buildDropKota",
                data: {id: $(this).val()},
                type: "POST", success: function (data) {
                    $("#kota").html(data)
                    ;
                }
            });
        });
    });

    $('.carousel').carousel({
        interval: 5000
    })
</script>
</body>
</html>