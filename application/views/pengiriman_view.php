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
                <li><a href="<?= base_url() ?>index.php/customer/">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false"><?php echo $username; ?><span class="caret"></span></a>
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

<div class="judul-2 col-md-offset-0 col-sm-offset-2 col-xs-offset-2 col-md-10 row"
     data-example-id="carousel-with-captions">
    <ul class="list-group judul-1">
        <li class="list-group-item judul-1">
            <h3>Pengiriman</h3>
        </li>
    </ul>
    <?php if ($this->session->flashdata('category_success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
    <?php } ?>
    <table class="table table-hover">

        <tr style="background-color: black; color: white">
            <th>#</th>
            <th>Gambar Barang</th>
            <th>Nama Barang</th>
            <th>Merk</th>
            <th>Jumlah</th>
            <th>Berat Kg</th>
            <th>Berat Volume</th>
            <th>Harga</th>
            <th>Sub Total</th>


        </tr>
        <?php $i = 1; ?>
        <?php $j = 0; ?>
        <?php $tot = 0; ?>
        <?php $berat = 0; ?>
        <?php $volume = 0; ?>

        <?php if ($cart->result()) { ?>

            <?php foreach ($cart->result() as $c): ?>

                <?php echo form_open('customer/pengiriman'); ?>

                <?php $data[$i] = $c->id_user ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><img height="100px" width="150px" src="<?= base_url() . $c->gambar_barang ?>"</img></td>
                    <td><?= $c->nama_barang ?></td>
                    <td><?= $c->merk_barang ?></td>
                    <td align="right"><p id="jum"><?= number_format($c->jumlah_belanja, 0, ",", ".") ?></p></td>
                    <td align="right"><p id="jum"><?= number_format($c->nilai_berat/1000, 3, ",", ".")."/Kg" ?></p></td>
                    <td align="right"><p id="jum"><?= number_format($c->nilai_volume, 0, ",", ".") ?></p></td>

                    <td align="right"><p id="harga"><?= "Rp " . number_format($c->harga_jual, 2, ",", ".") ?></p></td>

                    <?php $sub =  $c->jumlah_belanja*$c->harga_jual; ?>

                    <td align="right"><p id="harga"><?= "Rp " . number_format($sub, 2, ",", ".") ?></p></td>

                    <?php $i += 1; ?>
                </tr>
                <?php $j += $c->jumlah_belanja; ?>
                <?php $tot += $sub; ?>
                <?php $berat += $c->nilai_berat * $c->jumlah_belanja; ?>
                <?php $volume += $c->nilai_volume * $c->jumlah_belanja; ?>

            <?php endforeach; ?>
            <tr style="background-color: black; color: white">
                <td colspan="4" align="center"><strong><?= $i - 1 . " Items " ?></strong></td>

                <td align="right" style="border: solid 1px"><strong><?= number_format($j, 0, ",", ".") ?></strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="right" style="border: solid 1px"><strong id="total"><?= "Rp " . number_format($tot, 2, ",", ".") ?></strong>
                </td>

            </tr>
            <tr style="background-color: black; color: white">
                <td colspan="8" align="center"><strong>Total</strong></td>


                <td align="right" style="border: solid 1px"><strong id="gtotal"><?= "Rp " . number_format($tot, 2, ",", ".") ?></strong>
                </td>

            </tr>
        <?php } else { ?>
            <tr>
                <td colspan="10" align="center"><b> --------------- Data is empty ---------------</b></td>
            </tr>
        <?php } ?>
    </table>

    <div class="col-md-2 col-md-offset-1">
        <?php echo form_label('Berat Kg :'); ?>
    </div>
    <div class="col-md-9 col-md-offset-0">
        <?php echo form_label(number_format($berat/1000, 3, ",", ".") ."/Kg"); ?>
    </div>

        <?php echo form_input(array(
            'type'  => 'hidden',
            'id'    => 'kg',
            'name'  => 'kg',
            'class' => 'form-control',
            'value' => set_value('kg', $berat)
        )); ?>

    <div class="col-md-2 col-md-offset-1">
        <?php echo form_label('Berat Volume :'); ?>
    </div>
    <div class="col-md-9 col-md-offset-0">
        <?php echo form_label(number_format($volume/6000, 3, ",", ".")."/Kg"); ?>
    </div>
        <?php echo form_input(array(
            'type'  => 'hidden',
            'id'    => 'volume',
            'name'  => 'volume',
            'class' => 'form-control',
            'value' => set_value('volume', $volume)
        )); ?>
    <div class="col-md-2 col-md-offset-1" hidden="hidden">
        <label>
            <input type="radio" id="beratkg" name="berat" value="1" aria-label="..." <?php if($berat/1000 > $volume/6000){echo "checked";}else{echo "";} ?>> Biaya Kirim Kg
        </label>
    </div>
    <div class="col-md-3 col-md-offset-0" hidden="hidden">
        <label>
            <input type="radio" id="beratvolume" name="berat" value="2" aria-label="..." <?php if($berat/1000 < $volume/6000){echo "checked";}else{echo "";} ?>> Biaya Kirim Volume < 1 Kg
        </label>
    </div>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Kota Kirim :'); ?>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <select id="kota_kirim" name="kota_kirim" class="form-control">
            <option value="0">--Select Kota--</option>
            <?php foreach ($kota_kirim->result() as $key): ?>
                <option value="<?= $key->id_kota_kirim ?>" <?= set_select('kota_kirim', '', '') ?>>
                    <?= $key->nama_kota_kirim ?>
                </option>

            <?php endforeach; ?>
        </select>
    </div>
    <?php echo form_error('kota_kirim'); ?>
    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Alamat Lengkap Kirim :'); ?>
    </div>
    <div class="col-md-4 col-md-offset-1">
        <?php echo form_textarea(array(
            'style' => 'height: 75px',
            'placeholder' => 'contoh : Lantai 16, Menara Bidakara, Jalan Jendral Gatot Subroto, No. 71-73',
            'id'    => 'alamat_lengkap_kirim',
            'name'  => 'alamat_lengkap_kirim',
            'class' => 'form-control',
            'value' => set_value('alamat_lengkap_kirim', '')
        )); ?>
    </div>
    <?php echo form_error('alamat_lengkap_kirim'); ?>

    <div class="col-md-9 col-md-offset-1">
        <?php echo form_label('Biaya Pengiriman :'); ?>
    </div>

    <fieldset class="col-md-4 col-md-offset-1"  disabled>

    <div >
        <?php echo form_input(array(
            'id'    => 'harga_kirim',
            'name'  => 'harga_kirim',
            'class' => 'form-control',
            'style' => 'text-align: right',
            'value' => set_value('harga_kirim', '')
        )); ?>
    </div>
        </fieldset>
    <?php echo form_error('harga_kirim'); ?>
    <div class="col-md-9 col-md-offset-1">
        <br>
        <br>
</div>

    <div class="modal-footer col-md-10 col-md-offset-1">
        <?php echo form_submit(array('id' => 'buy', 'name' => 'buy', 'value' => 'Buy', 'class' => 'btn btn-ok')); ?>
    </div>
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
        $("#kota_kirim").change(function () {
            var z = 0;
            var kg = 0;
            var volume = 0;
            var tot = <?= $tot ?>;
//            var x = 0;

            <?php foreach($kota_kirim->result() as $a): ?>

                var id = <?= $a->id_kota_kirim ?>;
                var harga = <?= $a->harga_kirim?>;
                if(id == $('#kota_kirim').val()){
                    z = harga;
                    kg = (harga*($('#kg').val()-($('#kg').val()%1000))/1000);
                    volume = harga*($('#volume').val()/6000);

                }

            <?php endforeach; ?>



            if (document.getElementById('beratkg').checked) {
                alert("A");
                if($('#kg').val() < 1000){
                    tot+=parseInt(z);
                    tot= tot.toFixed(2);
                    tot= tot.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                    z= z.toFixed(2);
//                    x = parseInt(z).toFixed(2);
                    z= z.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                    document.getElementById("harga_kirim").value = "Rp "+ z;
                    document.getElementById("gtotal").innerHTML = "Rp "+ tot;
//                    document.getElementById("harga_kirim_ori").value = x;
                }else{

                    tot+=kg;
                    tot= tot.toFixed(2);
                    tot= tot.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
//                    x = kg.toFixed(2);
                    kg= kg.toFixed(2);
                    kg= kg.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                    document.getElementById("harga_kirim").value = "Rp "+ kg;
                    document.getElementById("gtotal").innerHTML = "Rp "+ tot;
//                    document.getElementById("harga_kirim_ori").value = x;

                }



            }else if(document.getElementById('beratvolume').checked){
                alert("B");
                tot+=volume;
                tot= tot.toFixed(2);
                tot= tot.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
//                x = volume.toFixed(2);
                volume= volume.toFixed(2);
                volume= volume.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                document.getElementById("harga_kirim").value = "Rp " + volume;
                document.getElementById("gtotal").innerHTML = "Rp "+ tot;
//                document.getElementById("harga_kirim_ori").value = x;
            }


        });
    });


    $(document).ready(function () {
        $("#beratkg").change(function () {
            alert("X");alert($('#kg').val()%1000);
            document.getElementById("kota_kirim").value = 0;
            document.getElementById("harga_kirim").value = "";

        });
    });
    $(document).ready(function () {
        $("#beratvolume").change(function () {
            alert("Y");
            document.getElementById("kota_kirim").value = 0;
            document.getElementById("harga_kirim").value = "";

        });
    });

    function confDelete(id) {
        var confimation = window.confirm("Are you sure want to delete this cart");
        if (confimation) {
            window.location = "<?= base_url() ?>index.php/customer/un_cart/" + id;
        }
    }


    $('.carousel').carousel({
        interval: 5000
    })
</script>
</body>
</html>