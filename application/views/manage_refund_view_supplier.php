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
                <li><a href="<?= base_url() ?>index.php/supplier">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= base_url() ?>index.php/supplier/ubah_akun/<?php echo $id_user; ?>">Ubah Akun</a></li>
                        <li><a href="<?= base_url() ?>index.php/supplier/manage_refund/">Manage Refund</a></li>
                        <li><a href="<?= base_url() ?>index.php/supplier/history_penjualan/">History Penjualan</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= base_url() ?>index.php/supplier/logout/">Logout</a></li>
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
    <br>
    <?php if ($this->session->flashdata('category_success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
    <?php } ?>


    <table class="table table-hover">

        <tr style="background-color: black; color: white;">
            <th style="background-color: black; color: white; text-align: center" >#</th>
            <th style="background-color: black; color: white; text-align: center">No Faktur</th>
            <th style="background-color: black; color: white; text-align: center">Tanggal Refund</th>
            <th style="background-color: black; color: white; text-align: center">Tanggal Beli</th>
            <th style="background-color: black; color: white; text-align: center">Total</th>
            <th style="background-color: black; color: white; text-align: center">Pajak</th>
            <th style="background-color: black; color: white; text-align: center">Supplier</th>
            <th style="background-color: black; color: white; text-align: center">View</th>

        </tr>
        <?php $i = 1; ?>

        <?php if ($refund->result()) { ?>

            <?php foreach ($refund->result() as $r): ?>


                <?php $data[$i] = $r->id_pembelian ?>
                <tr
                    class="<?= ($r->status_refund == 1) ? "alert-success" : "" ?> <?= ($r->status_refund == 2) ? "alert-danger" : "" ?>">
                    <td><?= $i ?></td>

                    <td align="center"><?= $r->no_faktur_pembelian ?></td>
                    <?php
                    $originalDate = $r->tgl_refund;
                    $ref_date = date("d - M - Y", strtotime($originalDate));
                    ?>
                    <td align="center"><?= $ref_date ?></td>
                    <?php
                    $originalDate = $r->tgl_beli;
                    $buy_date = date("d - M - Y", strtotime($originalDate));
                    ?>
                    <td align="center"><?= $buy_date ?></td>
                    <td align="right"><?= "Rp " . number_format($r->total_refund ,2,",",".") ?></td>
                    <td align="center"><?= ($r->pajak == 0) ? "Non Pajak" : "Pajak"?></td>
                    <?php
                    foreach ($supplier->result() as $s) {
                        if ($s->id_user == $r->id_supplier) {
                            $nama_perus = $s->nama_perusahaan;
                        }
                    }
                    ?>
                    <td><?= $nama_perus ?></td>

                    <td><a href="<?= base_url() ?>index.php/supplier/view_data_refund/<?= $r->id_pembelian ?>/<?= $r->id_refund ?>"
                           class="glyphicon glyphicon-cog" aria-hidden="true"> VIEW</a></td>

                    <?php $i += 1; ?>
                </tr>

            <?php endforeach; ?>

        <?php } else { ?>
            <tr>
                <td colspan="10" align="center"><b> --------------- Data is empty ---------------</b></td>
            </tr>
        <?php } ?>



    </table>




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