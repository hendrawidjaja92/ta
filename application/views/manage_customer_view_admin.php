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

<div class="judul-2 col-md-offset-0 col-sm-offset-2 col-xs-offset-2 col-md-10 row"
     data-example-id="carousel-with-captions">
    <ul class="list-group judul-1">
        <li class="list-group-item judul-1">
            <h3>Manage Customer</h3>
        </li>
    </ul>
    <h3 style="padding-left: 5%"><a href="<?= base_url() ?>index.php/admin/add_customer">ADD <span
                class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h3>
    <?php if ($this->session->flashdata('category_success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
    <?php } ?>
    <table class="table table-hover">

        <tr style="background-color: black; color: white">
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Jenis Kelamin</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
        <?php $i = 1; ?>

        <?php if ($customer->result()) { ?>

            <?php foreach ($customer->result() as $c): ?>


                <?php $data[$i] = $c->id_user ?>
                <tr
                    class="<?= ($c->status_user == 1) ? "alert-success" : "" ?> <?= ($c->status_user == 2) ? "alert-danger" : "" ?>">
                    <td><?= $i ?></td>
                    <td><?= $c->nama_user ?></td>
                    <td><?= $c->email ?></td>
                    <td><?= $c->alamat ?></td>
                    <td><?= $c->no_telepon ?></td>
                    <td><?= ($c->jenis_kelamin == 1) ? "Laki-laki" : "Perempuan" ?></td>
                    <td><a href="<?= base_url() ?>index.php/admin/view_customer/<?= $c->id_user ?>"
                           class="glyphicon glyphicon-user" aria-hidden="true"> VIEW</a></td>
                    <td><a href="<?= base_url() ?>index.php/admin/edit_customer/<?= $c->id_user ?>"
                           class="glyphicon glyphicon-cog" aria-hidden="true"> EDIT</a></td>
                    <td><a href="#" onclick="confDelete(<?= $c->id_user ?>)"
                           class="glyphicon glyphicon-remove" aria-hidden="true">
                            DELETE</a></td>
                    <?php $i += 1; ?>
                </tr>

            <?php endforeach; ?>

        <?php } else { ?>
            <tr>
                <td colspan="9" align="center"><b> --------------- Data is empty ---------------</b></td>
            </tr>
        <?php } ?>



    </table>
    <h3 style="padding-left: 5%"><a href="<?= base_url() ?>index.php/admin/add_customer">ADD <span
                class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h3>
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

    function confDelete(id) {
        var confimation = window.confirm("Are you sure want to delete this customer");
        if (confimation) {
            window.location = "<?= base_url() ?>index.php/admin/delete_customer/" + id;
        }
    }


    $('.carousel').carousel({
        interval: 5000
    })
</script>
</body>
</html>