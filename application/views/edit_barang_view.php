<?php
$id_user = $this->session->userdata('id_user');
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
                        <li><a href="<?= base_url() ?>index.php/admin/ubah_akun/<?php echo $id_user; ?>">Ubah Akun</a>
                        </li>
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
                        <li><a href="<?= base_url() ?>index.php/admin/logout">Logout</a></li>
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
            <h3>Manage Barang</h3>
        </li>
    </ul>
    <h3 style="padding-left: 5%">EDIT Barang <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></h3>

    <?php foreach ($barang->result() as $b): ?>

    <?php echo form_open_multipart('admin/edit_barang/'. $b->id_barang); ?>


    <br>
    <div class="col-md-12 col-md-offset-1">
        <?php echo form_label('Gambar Barang :'); ?>
    </div>
    <div class="col-md-4 col-md-offset-1 input">
        <img height="100" width="150" src="<?= base_url().$b->gambar_barang ?>"/>
        <br>
        <br>
        <?php echo form_upload(array(
            'id'    => 'gambar_barang',
            'name'  => 'gambar_barang',
            'class' => 'form-control',
            'value' => set_value('gambar_barang', $b->gambar_barang)
        )); ?>
    </div>
    <?php echo form_error('gambar_barang'); ?>
    <div class="col-md-12 col-md-offset-1">
        <?php echo form_label('Nama Barang :'); ?>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <?php echo form_input(array(
            'id'    => 'nama_barang',
            'name'  => 'nama_barang',
            'class' => 'form-control',
            'value' => set_value('nama_barang', $b->nama_barang)
        )); ?>
    </div>
    <?php echo form_error('nama_barang'); ?>
    <div class="col-md-5 col-md-offset-1"></div>


    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Harga Beli :'); ?>
    </div>
    <div class="col-md-3 col-md-offset-1 input-group">
        <div class="input-group-addon">Rp</div>
        <?php echo form_input(array(
            'id'    => 'harga_beli',
            'name'  => 'harga_beli',
            'class' => 'form-control',
            'style' => 'text-align: right',
            'value' => set_value('harga_beli', $b->harga_beli)
        )); ?>
        <div class="input-group-addon">.00</div>
    </div>
    <?php echo form_error('harga_beli'); ?>


    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Harga_Jual :'); ?>
    </div>
    <div class="input-group col-md-3 col-md-offset-1">
        <div class="input-group-addon">Rp</div>
        <?php echo form_input(array(
            'id'    => 'harga_jual',
            'name'  => 'harga_jual',
            'class' => 'form-control',
            'style' => 'text-align: right',
            'value' => set_value('harga_jual', $b->harga_jual)
        )); ?>
        <div class="input-group-addon">.00</div>
    </div>
    <?php echo form_error('harga_jual'); ?>


    <div class="col-md-12 col-md-offset-1">
        <?php echo form_label('Stok :'); ?>
    </div>
    <div class="input-group col-md-1 col-md-offset-1">
        <?php echo form_input(array(
            'id'    => 'jumlah',
            'name'  => 'jumlah',
            'class' => 'form-control',
            'style' => 'text-align: right',
            'value' => set_value('jumlah', $b->jumlah)
        )); ?>
    </div>

    <?php echo form_error('jumlah'); ?>
    <div class="col-md-10 col-md-offset-1">
        <?php echo form_label('Merk :'); ?>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <?php echo form_input(array(
            'id'    => 'merk_barang',
            'name'  => 'merk_barang',
            'class' => 'form-control',
            'value' => set_value('merk_barang', $b->merk_barang)
        )); ?>
    </div>
    <?php echo form_error('merk_barang'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Satuan Berat :'); ?>
    </div>
    <div class="col-md-2 col-md-offset-1">
        <?php echo form_input(array(
            'id'    => 'satuan_berat',
            'name'  => 'satuan_berat',
            'class' => 'form-control',
            'value' => set_value('satuan_berat', $b->satuan_berat)
        )); ?>
    </div>
    <?php echo form_error('satuan_berat'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Nilai Berat :'); ?>
    </div>
    <div class="col-md-2 col-md-offset-1">
        <?php echo form_input(array(

            'id'    => 'nilai_berat',
            'name'  => 'nilai_berat',
            'class' => 'form-control',
            'style' => 'text-align: right',
            'value' => set_value('nilai_berat', $b->nilai_berat)
        )); ?>
    </div>
    <?php echo form_error('nilai_berat'); ?>

    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Kategori Barang :'); ?>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <select id="kategori_barang" name="kategori_barang" class="form-control">
            <?php foreach ($kategoriBarang as $key => $value): ?>
                <option value="<?= $key ?>" <?= set_select('kategori_barang', $key, $b->id_kategori_barang == $key) ?>>
                    <?= $value ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php echo form_error('kategori_barang'); ?>
        <div class="col-md-9 col-md-offset-1">
            <?php echo form_label('Status Barang :'); ?>
        </div>
        <div class="col-md-5 col-md-offset-1">
            <select id="status_barang" name="status_barang" class="form-control">
                <option value="0" <?= set_select('status_barang', '0', $b->status_barang == 0) ?>>Not Active</option>
                <option value="1" <?= set_select('status_barang', '1', $b->status_barang == 1) ?>>Active</option>
                <option value="2" <?= set_select('status_barang', '2', $b->status_barang == 2) ?>>Banned</option>
            </select>

            <br>
            <br>
        </div>
    <div class="modal-footer col-md-10 col-md-offset-1">
        <?php echo form_submit(array('id' => 'save', 'name' => 'save', 'value' => 'Save', 'class' => 'btn btn-ok')); ?>
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