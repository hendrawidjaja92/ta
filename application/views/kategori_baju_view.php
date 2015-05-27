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
                <li><a href="<?= base_url() ?>index.php/customer/">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= base_url() ?>index.php/customer/ubah_akun/<?php echo $id_user; ?>">Ubah Akun</a></li>
                        <li><a href="<?= base_url() ?>index.php/customer/pesanan_saya/">Pesanan Saya</a></li>
                        <li><a href="<?= base_url() ?>index.php/customer/wishlist/">Wishlist</a></li>
                        <li><a href="<?= base_url() ?>index.php/customer/pembayaran/">Pembayaran</a></li>
                        <li><a href="<?= base_url() ?>index.php/customer/refund/">Refund</a></li>
                        <li><a href="<?= base_url() ?>index.php/customer/history_belanja/">History Belanja</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= base_url() ?>index.php/customer/logout/">Logout</a></li>
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
    <?php foreach($kategori_barang->result() as $k): ?>
        <?php $value = 0; ?>

        <?php foreach($this->barang_model->show_value_kategori($k->id_kategori_barang)->result() as $x): ?>

            <?php $value++; ?>
        <?php endforeach; ?>
        <a id="pilih_kategori" href="<?= base_url() . "index.php/customer/a" . $k->id_kategori_barang . "/" . $k->id_kategori_barang ?>">
            <li id="kategori_barang_value" class="list-group-item" value="<?= $k->id_kategori_barang ?>">
                <span class="badge"><?= $value ?></span>
                <?= $k->nama_kategori_barang ?>
            </li>
        </a>

    <?php endforeach; ?>
</ul>

<nav class="col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
<ul class="list-group judul-2">
    <li class="list-group-item judul-1">
        <h3>Baju</h3>
    </li>
</ul>
<div class="bs-example" data-example-id="thumbnails-with-custom-content">
    <?php foreach($barang->result() as $b): ?>

    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <img data-src="holder.js/100%x200" alt="100%x200" src="<?= base_url() . $b->gambar_barang ?>"
                 data-holder-rendered="true" style="height: 200px; width: 100%; display: block;" />

            <div class="caption">
                <h3 id="thumbnail-label"><?= $b->nama_barang ?><a class="anchorjs-link" href="#thumbnail-label"><span
                            class="anchorjs-icon"></span></a></h3>

                <p><strong><?= "Rp " . number_format($b->harga_jual, 2, ",", ".") ?></strong></p>
                <p><strong><?= $b->merk_barang ?></strong></p>
                <p><a href="<?= base_url(). "index.php/customer/add_lihat/".$b->id_barang ?>">View Detail</a></p>

                <?php
                if($this->customer_model->cart($id_user,$b->id_barang)->result()){ ?>
            <p><a href="#" class="btn btn-success" role="button">Cart</a>
                <?php }else{ ?>
                <p><a href="<?= base_url(). "index.php/customer/add_cart/". $b->id_barang ?>" class="btn btn-warning" role="button")">Cart</a>
                <?php } ?>

                    <?php
                    if($this->customer_model->wishlist($id_user,$b->id_barang)->result()){ ?>
                    <a href="<?= base_url(). "index.php/customer/un_wishlist/". $b->id_barang?>" class="btn btn-danger" role="button">Wishlist</a></p>
                    <?php }else{ ?>
                        <a href="<?= base_url(). "index.php/customer/add_wishlist/". $b->id_barang?>" class="btn btn-default" role="button">Wishlist</a></p>
                    <?php } ?>



            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

</nav>

<div class="col-sm-12 col-md-12 row">
<nav class="modal-footer">
    © 2015 Fakultas Teknologi Informasi<br>
    Universitas Kristen Maranatha Bandung<br>
    Created by 1172013
</nav>
</div>
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


    function lihat(id){
        window.location = "<?= base_url() ?>index.php/customer/add_lihat/". id;
    }

    $('.carousel').carousel({
        interval: 5000
    })
</script>
</body>
</html>