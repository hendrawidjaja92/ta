<?php
$id_user  = $this->session->userdata('id_user');
$username = $this->session->userdata('username');
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
<?php foreach ($pilot->result() as $pil): ?>
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
                <?php if ($pil->id_kategori_user == 1): ?>
                    <li><a href="<?= base_url() ?>index.php/admin">Home</a></li>
                <?php endif; ?>

                <?php if ($pil->id_kategori_user == 2): ?>
                    <li><a href="<?= base_url() ?>index.php/pegawai">Home</a></li>
                <?php endif; ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false"><?php echo $username; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php if ($pil->id_kategori_user == 1): ?>

                            <li><a href="<?= base_url() ?>index.php/admin/ubah_akun/<?php echo $id_user; ?>">Ubah
                                    Akun</a>
                            </li>
                            <li><a href="<?= base_url() ?>index.php/admin/manage_pembayaran">Manage Pembayaran</a></li>
                            <li><a href="<?= base_url() ?>index.php/admin/manage_barang">Manage Barang</a></li>
                            <li><a href="<?= base_url() ?>index.php/admin/manage_refund">Manage Refund</a></li>
                            <li><a href="<?= base_url() ?>index.php/admin/manage_supplier">Manage Supplier</a></li>
                            <li><a href="<?= base_url() ?>index.php/admin/manage_seller">Manage Seller</a></li>
                            <li><a href="<?= base_url() ?>index.php/admin/manage_customer">Manage Customer</a></li>
                            <li><a href="<?= base_url() ?>index.php/admin/manage_pegawai">Manage Pegawai</a></li>
                            <li><a href="<?= base_url() ?>index.php/admin/pembelian">Pembelian</a></li>
                            <li><a href="<?= base_url() ?>index.php/admin/history_penjualan">History Penjualan</a></li>
                            <li><a href="<?= base_url() ?>index.php/admin/history_pembelian">History Pembelian</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= base_url() ?>index.php/admin/logout">Logout</a></li>

                        <?php endif; ?>

                        <?php if ($pil->id_kategori_user == 2): ?>
                            <li><a href="<?= base_url() ?>index.php/pegawai/ubah_akun/<?php echo $id_user; ?>">Ubah
                                    Akun</a></li>
                            <li><a href="<?= base_url() ?>index.php/pegawai/manage_pembayaran/">Manage Pembayaran</a>
                            </li>
                            <li><a href="<?= base_url() ?>index.php/pegawai/manage_refund/">Manage Refund</a></li>
                            <li><a href="<?= base_url() ?>index.php/pegawai/manage_supplier/">Manage Supplier</a></li>
                            <li><a href="<?= base_url() ?>index.php/pegawai/manage_seller/">Manage Seller</a></li>
                            <li><a href="<?= base_url() ?>index.php/pegawai/manage_customer/">Manage Customer</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= base_url() ?>index.php/pegawai/logout">Logout</a></li>
                        <?php endif; ?>
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
        <h3>Manage Supplier</h3>
    </li>
</ul>
<h3 style="padding-left: 5%">EDIT Supplier <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></h3>

<?php foreach ($user->result() as $u): ?>

    <?php if ($pil->id_kategori_user == 1): ?>
        <?php echo form_open('admin/edit_supplier/' . $u->id_user); ?>

    <?php endif; ?>
    <?php if ($pil->id_kategori_user == 2): ?>
        <?php echo form_open('pegawai/edit_supplier/' . $u->id_user); ?>

    <?php endif; ?>
<?php endforeach; ?>

    <br>

    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Username :'); ?>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <?php echo form_input(array(
            'type'  => 'hidden',
            'id'    => 'id_user',
            'name'  => 'id_user',
            'class' => 'form-control',
            'value' => $u->id_user
        )); ?>
        <?php echo form_input(array(
            'id'    => 'username',
            'name'  => 'username',
            'class' => 'form-control',
            'value' => set_value('username', $u->username)
        )); ?>
    </div>
    <?php echo form_error('username'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Email :'); ?>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <!--            --><?php //echo form_input(array(
        //                'type'  => 'hidden',
        //                'id'    => 'id_user',
        //                'name'  => 'id_user',
        //                'class' => 'form-control',
        //            ));
        ?>
        <?php echo form_input(array(
            'id'    => 'email',
            'name'  => 'email',
            'class' => 'form-control',
            'value' => set_value('email', $u->email)
        )); ?>
    </div>
    <?php echo form_error('email'); ?>
    <!--        <div class="col-md-9 col-md-offset-2">-->
    <!--            --><?php //echo form_label('Old Password :'); ?>
    <!--        </div>-->
    <!--        <div class="col-md-4 col-md-offset-2">-->
    <!--            --><?php //echo form_input(array('type' => 'hidden', 'id' => 'old', 'name' => 'old', 'class' => 'form-control', 'value' => $u->password)); ?>
    <!--            --><?php //echo form_password(array('id' => 'old_password', 'name' => 'old_password', 'class' => 'form-control')); ?>
    <!--        </div>-->
    <!--        --><?php //echo form_error('old_password'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Password :'); ?>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <?php echo form_password(array('id' => 'password', 'name' => 'password', 'class' => 'form-control')); ?>
    </div>
    <?php echo form_error('password'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Re-Password :'); ?>
    </div>

    <div class="col-md-4 col-md-offset-1">
        <?php echo form_password(array(
            'id'    => 're_password',
            'name'  => 're_password',
            'class' => 'form-control'
        )); ?>
    </div>
    <?php echo form_error('re_password'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Nama Lengkap :'); ?>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <?php echo form_input(array(
            'id'    => 'nama_user',
            'name'  => 'nama_user',
            'class' => 'form-control',
            'value' => set_value('nama_user', $u->nama_user)
        )); ?>
    </div>
    <?php echo form_error('nama_user'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Nama Perusahaan :'); ?>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <?php echo form_input(array(
            'id'    => 'nama_perusahaan',
            'name'  => 'nama_perusahaan',
            'class' => 'form-control',
            'value' => set_value('nama_perusahaan', $u->nama_perusahaan)
        )); ?>
    </div>
    <?php echo form_error('nama_perusahaan'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Alamat :'); ?>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <?php echo form_input(array(
            'id'    => 'alamat',
            'name'  => 'alamat',
            'class' => 'form-control',
            'value' => set_value('alamat', $u->alamat)
        )); ?>
    </div>
    <?php echo form_error('alamat'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('No Telepon :'); ?>
    </div>
    <div class="col-md-3 col-md-offset-1">
        <?php echo form_input(array(
            'id'    => 'no_telepon',
            'name'  => 'no_telepon',
            'class' => 'form-control',
            'value' => set_value('no_telepon', $u->no_telepon)
        )); ?>
    </div>
    <?php echo form_error('no_telepon'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Jenis Kelamin :', 'jenis_kelamin'); ?>
    </div>
    <div class="col-md-3 col-md-offset-1">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-gender-man <?= ($u->jenis_kelamin == 1) ? "active" : "" ?>">
                <input type="radio" name="jenis_kelamin" id="jenis_kelamin" autocomplete="off"
                       value="1"  <?= set_radio('jenis_kelamin', '1', $u->jenis_kelamin == 1) ?>>Laki-laki
            </label>
            <label class="btn btn-gender-girl <?= ($u->jenis_kelamin == 2) ? "active" : "" ?>">
                <input type="radio" name="jenis_kelamin" id="jenis_kelamin" autocomplete="off"
                       value="2" <?= set_radio('jenis_kelamin', '2', $u->jenis_kelamin == 2) ?> >Perempuan
            </label>
        </div>
    </div>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Tanggal Lahir :', 'tgl_lahir'); ?>
    </div>
    <div class="col-md-3 col-md-offset-1">
        <input type="date" name=tgl_lahir id="tgl_lahir" class="form-control"
               value="<?= set_value('tgl_lahir', $u->tgl_lahir) ?>"/>
    </div>
    <?php echo form_error('tgl_lahir'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Provinsi :', 'provinsi'); ?>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <select id="provinsi" name="provinsi" class="form-control">
            <?php foreach ($provinsiDrop as $key => $value): ?>
                <option value="<?= $key ?>" <?= set_select('provinsi', $key, $u->id_provinsi == $key) ?>>
                    <?= $value ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php echo form_error('provinsi'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Kota :', 'kota'); ?>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <select id="kota" name="kota" class="form-control">
            <?php foreach ($kotaDrop as $key => $value): ?>
                <option value="<?= $key ?>" <?= set_select('kota', $key, $u->id_kota == $key) ?>>
                    <?= $value ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php echo form_error('kota'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Status :', 'status'); ?>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <select id="status" name="status" class="form-control">
            <option value="0" <?= set_select('status', '0', $u->status_user == 0) ?>>Not Active</option>
            <option value="1" <?= set_select('status', '1', $u->status_user == 1) ?>>Active</option>
            <option value="2" <?= set_select('status', '2', $u->status_user == 2) ?>>Banned</option>
        </select>

        <br>
        <br>
    </div>
    <div class="modal-footer col-md-10 col-md-offset-1">
        <?php echo form_submit(array(
            'id'    => 'save',
            'name'  => 'save',
            'value' => 'Save',
            'class' => 'btn btn-ok'
        )); ?>
    </div>
<?php endforeach; ?>
<?php echo form_close(); ?>



<br>

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