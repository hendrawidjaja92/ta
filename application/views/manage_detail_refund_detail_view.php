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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false"><?php echo $username; ?><span class="caret"></span></a>
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
                        <li><a href="<?= base_url() ?>index.php/admin/history_penjualan">History Penjualan</a></li>
                        <li><a href="<?= base_url() ?>index.php/admin/history_pembelian">History Pembelian</a></li>
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
            <h3>Manage Refund</h3>
        </li>
    </ul>
    <h3 style="padding-left: 5%">REFUND <span
            class="glyphicon glyphicon-transfer" aria-hidden="true"></span></h3>
    <br>


    <?php $i = 1; ?>


    <?php foreach ($barang->result() as $b): ?>

        <?php echo form_open_multipart('admin/refund/'.$b->id_pembelian.'/'.$b->id_barang); ?>

        <?php $id_sup = $b->id_supplier; ?>
        <?php foreach ($supplier->result() as $s): ?>
            <?php    if($id_sup == $s->id_user){
                $nama_perusahaan = $s->nama_perusahaan;
            } ?>
        <?php endforeach; ?>

        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Supplier :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('supplier', $nama_perusahaan))?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Gambar Barang :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <img height="100px" width="150px" src="<?= base_url().$b->gambar_barang ?>"</img>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Nama Barang :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('nama_barang', $b->nama_barang))?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Harga :'); ?>
        </div>
        <div hidden="hidden">
            <?php echo form_input(array(
                'id'    => 'harga_refund_detail',
                'name'  => 'harga_refund_detail',
                'class' => 'form-control',
                'style' => 'text-align: right',
                'value' => set_value('harga_refund_detail', $b->harga_beli_detail)
            )); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('harga_refund_detail', "Rp " . number_format($b->harga_beli_detail, 2, ",", "."))) ?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Merk :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('merk_barang', $b->merk_barang))?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Satuan Berat :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('satuan_berat', $b->satuan_berat))?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Nilai Berat :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('nilai_berat', number_format($b->nilai_berat,0,",",".")))?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Kategori Barang :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">

            <?php foreach ($kategoriBarang as $key => $value): ?>
                <?php if($b->id_kategori_barang == $key){
                    $kategori = $value;
                } ?>
            <?php endforeach; ?>

            <?php echo form_label(set_value('kategori_barang', $kategori))?>

        </div>

        <div class="col-md-12 col-md-offset-1">
            <?php echo form_label('Tanggal :'); ?>
        </div>
        <?php $date = date('Y-m-d'); ?>
        <input type="hidden" name=tgl_refund id="tgl_refund" class="form-control"
               value="<?= set_value('tgl_refund', $date) ?>"/>
        <fieldset class="col-md-4 col-md-offset-1" disabled>
            <div>
                <input type="date" name=tgl_refund id="tgl_refund" class="form-control"
                       value="<?= set_value('tgl_refund', $date) ?>"/>
            </div>
        </fieldset>
        <div class="col-md-10 col-md-offset-1">
            <?php echo form_label('Keterangan :'); ?>
        </div>
        <div class="col-md-4 col-md-offset-1">
            <?php echo form_textarea(array(
                'id'    => 'keterangan_refund',
                'name'  => 'keterangan_refund',
                'class' => 'form-control',
                'value' => set_value('keterangan_refund', '')
            )); ?>
        </div>
        <?php echo form_error('keterangan_refund'); ?>



        <div class="col-md-12 col-md-offset-1">
            <?php echo form_label('Jumlah Refund :'); ?>
        </div>
        <div class="input-group col-md-1 col-md-offset-1">
            <?php echo form_input(array(
                'id'    => 'jumlah_refund_detail',
                'name'  => 'jumlah_refund_detail',
                'class' => 'form-control',
                'style' => 'text-align: right',
                'value' => set_value('jumlah_refund_detail', "")
            )); ?>
        </div>

        <?php echo form_error('jumlah_refund_detail'); ?>

    <?php endforeach; ?>

    <br>
    <br>
    <div class="col-md-9 col-md-offset-1"><br></div>

    <div class="modal-footer col-md-10 col-md-offset-1">
        <?php echo form_submit(array('id' => 'refund', 'name' => 'refund', 'value' => 'Refund', 'class' => 'btn btn-ok')); ?>
    </div>

    <?php echo form_close(); ?>

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