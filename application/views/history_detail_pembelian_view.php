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
            <h3>History Pembelian</h3>
        </li>
    </ul>

    <br>


    <?php $i = 1; ?>

    <?php if ($pembelian->result()) { ?>

<?php echo form_open('admin/history_pembelian'); ?>

    <?php foreach ($pembelian->result() as $p): ?>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('No Faktur :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('no_faktur_pembelian', $p->no_faktur_pembelian)) ?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Tanggal :'); ?>
        </div>
        <?php
        $originalDate = $p->tgl_beli;
        $newDate      = date("d - M - Y", strtotime($originalDate));
        ?>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('tgl_beli', $newDate)) ?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Total :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('total_beli', "Rp " . number_format($p->total_beli, 2, ",", "."))) ?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Pajak :'); ?>
        </div>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('pajak', ($p->pajak == 0) ? "Non Pajak" : "Pajak")) ?>
        </div>
        <div class="col-md-2 col-md-offset-1">
            <?php echo form_label('Supplier :'); ?>
        </div>
        <?php
        foreach ($supplier->result() as $s) {
            if ($s->id_user == $p->id_supplier) {
                $nama_perus = $s->nama_perusahaan;
            }
        }
        ?>
        <div class="col-md-0 col-md-offset-1">
            <?php echo form_label(set_value('supplier', $nama_perus)) ?>
        </div>
    <?php endforeach; ?>

    <br>
    <br>

    <table class="table table-hover">

        <tr style="background-color: black; color: white;">
            <th style="background-color: black; color: white; text-align: center">#</th>
            <th style="background-color: black; color: white; text-align: center">Gambar Barang</th>
            <th style="background-color: black; color: white; text-align: center">Nama Barang</th>
            <th style="background-color: black; color: white; text-align: center">Jumlah</th>
            <th style="background-color: black; color: white; text-align: center">Harga Beli</th>
            <th style="background-color: black; color: white; text-align: center">Merk</th>
            <th style="background-color: black; color: white; text-align: center">Kategori Barang</th>

        </tr>
        <?php foreach ($detail->result() as $d): ?>


            <?php $data[$i] = $d->id_pembelian ?>
            <tr
                class="<?= ($d->status_pembelian == 1) ? "alert-success" : "" ?> <?= ($d->status_pembelian == 2) ? "alert-danger" : "" ?>">
                <td><?= $i ?></td>

                <td align="center"><img height="100px" width="150px" src="<?= base_url().$d->gambar_barang ?>" /></td>
                <td><?= $d->nama_barang ?></td>
                <td align="right"><?= number_format($d->jumlah_beli_detail, 0, ",", ".") ?></td>

                <td align="right"><?= "Rp " . number_format($d->harga_beli_detail, 2, ",", ".") ?></td>
                <td align="center"><?= $d->merk_barang ?></td>

                <?php foreach ($kategoriBarang as $key => $value): ?>
                    <?php if($d->id_kategori_barang == $key){
                        $kategori = $value;
                    } ?>
                <?php endforeach; ?>

                <td align="center"><?= $kategori ?></td>


                <?php $i += 1; ?>
            </tr>

        <?php endforeach; ?>

        <?php } else { ?>
            <tr>
                <td colspan="10" align="center"><b> --------------- Data is empty ---------------</b></td>
            </tr>
        <?php } ?>


    </table>
    <div class="modal-footer col-md-10 col-md-offset-1">
        <?php echo form_submit(array('id' => 'back', 'name' => 'back', 'value' => 'Back', 'class' => 'btn btn-ok')); ?>
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