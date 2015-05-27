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
        <h3>Pembelian</h3>
    </li>
</ul>
<h3 style="padding-left: 5%">PEMBELIAN <span
        class="glyphicon glyphicon-plus" aria-hidden="true"></span></h3>
<?php if ($this->session->flashdata('category_success')) { ?>
    <div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
<?php } ?>

<?php echo form_open_multipart('admin/pembelian'); ?>


<?php $i = 0; ?>
<?php foreach ($temp->result() as $t): ?>
    <?php $id_sup = $t->id_supplier; ?>
    <?php $no_fak = $t->no_faktur_pembelian_temp; ?>
    <?php $i++; ?>
<?php endforeach; ?>


<br>

<div class="col-md-12 col-md-offset-1">
    <?php echo form_label('Supplier :'); ?>
</div>

<fieldset class="col-md-4 col-md-offset-1" <?= ($i > 0) ? "disabled" : "" ?>>
    <div>
        <select id="<?= ($i > 0) ? "supplier2" : "supplier" ?>" name="<?= ($i > 0) ? "supplier2" : "supplier" ?>" class="form-control">
            <option value="0">-- Select Supplier --</option>
            <?php foreach ($supplier->result() as $s): ?>
                <option value="<?= $s->id_user ?>" <?= set_select('supplier', $s->id_user, ($i == 0) ? '' : $id_sup == $s->id_user) ?>>
                    <?= $s->nama_perusahaan ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

</fieldset>
<?php //echo form_error('supplier'); ?>
<div hidden="hidden" >
    <select id="<?= ($i > 0) ? "supplier" : "supplier2" ?>" name="<?= ($i > 0) ? "supplier" : "supplier2" ?>" class="form-control">
        <?php foreach ($supplier->result() as $s): ?>
            <option value="<?= $s->id_user ?>" <?= set_select('supplier', $s->id_user,
                ($i == 0) ? "" : $id_sup == $s->id_user) ?>>
                <?= $s->nama_perusahaan ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<br>
<br>

<div class="col-md-12 col-md-offset-1">
    <?php echo form_button([
        'id'          => 'pilih_barang',
        'name'        => 'pilih_barang',
        'class'       => 'btn btn-primary',
        'content'     => '-------------------- Choose Barang --------------------',
        'data-toggle' => 'modal',
        'data-target' => '.pil_barang',
    ]); ?>
</div>

<!--// =============================================================================================================-->
<div class="modal fade pil_barang" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header-edit">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4>Choose Barang</h4></div>
            <!--            --><?php //echo form_open('admin/pembelian'); ?>
            <div class="modal-body row">

                <table class="table table-hover" id="barang">

                </table>
            </div>
        </div>
    </div>
</div>
<!--// =============================================================================================================-->


<div class="col-md-12 col-md-offset-1">
    <?php echo form_label('No Faktur :'); ?>
    <?php echo form_input(array(
        'id'    => 'no_faktur_pembelian',
        'name'  => 'no_faktur_pembelian',
        'class' => 'form-control',
        'value' => set_value('no_faktur_pembelian', ($i > 0) ? "$no_fak" : ""),
        'type'  => 'hidden'
    )); ?>
</div>
<fieldset class="col-md-4 col-md-offset-1" <?= ($i > 0) ? "disabled" : "" ?>>
    <div>
        <?php echo form_input(array(
            'id'    => 'no_faktur_pembelian',
            'name'  => 'no_faktur_pembelian',
            'class' => 'form-control',
            'value' => set_value('no_faktur_pembelian', ($i > 0) ? "$no_fak" : "")
        )); ?>
    </div>
</fieldset>
<?php echo form_error('no_faktur_pembelian'); ?>
<div class="col-md-12 col-md-offset-1">
    <?php echo form_label('Tanggal :'); ?>
</div>
<?php $date = date('Y-m-d'); ?>
<input type="hidden" name=tgl_beli id="tgl_beli" class="form-control"
       value="<?= set_value('tgl_beli', $date) ?>"/>
<fieldset class="col-md-4 col-md-offset-1" disabled>
    <div>
        <input type="date" name=tgl_beli id="tgl_beli" class="form-control"
               value="<?= set_value('tgl_beli', $date) ?>"/>
    </div>
</fieldset>

<div class="col-md-12 col-md-offset-1">
    <?php echo form_label('Gambar Barang :'); ?>
</div>
<div class="col-md-4 col-md-offset-1 input">
    <?php echo form_upload(array(
        'id'    => 'gambar_barang',
        'name'  => 'gambar_barang',
        'class' => 'form-control',
        'value' => set_value('gambar_barang', '')
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
        'value' => set_value('nama_barang', "")
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
        'value' => set_value('harga_beli', "")
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
        'value' => set_value('harga_jual', "")
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
        'value' => set_value('jumlah', "")
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
        'value' => set_value('merk_barang', '')
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
        'value' => set_value('satuan_berat', '')
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
        'value' => set_value('nilai_berat', '')
    )); ?>
</div>
<?php echo form_error('nilai_berat'); ?>
<div class="col-md-9 col-md-offset-1">
    <?php echo form_label('Nilai Volume :'); ?>
</div>
<div class="col-md-2 col-md-offset-1">
    <?php echo form_input(array(

        'id'    => 'nilai_volume',
        'name'  => 'nilai_volume',
        'class' => 'form-control',
        'style' => 'text-align: right',
        'value' => set_value('nilai_volume', '')
    )); ?>
</div>
<?php echo form_error('nilai_volume'); ?>
<div class="col-md-9 col-md-offset-1">
    <?php echo form_label('Kategori Barang :'); ?>
</div>
<div class="col-md-4 col-md-offset-1">
    <select id="kategori_barang" name="kategori_barang" class="form-control">
        <?php foreach ($kategoriBarang as $key => $value): ?>
            <option value="<?= $key ?>" <?= set_select('kategori_barang', $key, '') ?>>
                <?= $value ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<?php echo form_error('kategori_barang'); ?>

<br>
<br>
<br>

<div class="col-md-9 col-md-offset-1"><br></div>

<div class="modal-footer col-md-10 col-md-offset-1">
    <?php echo form_submit(array('id' => 'add', 'name' => 'add', 'value' => 'Add', 'class' => 'btn btn-ok')); ?>
</div>
<?php echo form_close(); ?>

<table class="table table-hover" id="temp_beli">

    <tr style="background-color: black; color: white">
        <th>#</th>
        <th>Gambar Barang</th>
        <th>Nama Barang</th>
        <th>Merk</th>
        <th>Kategori Barang</th>
        <th>Jumlah</th>
        <th>Harga Beli</th>
        <th>Sub Total</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>

    </tr>
    <?php $i = 1; ?>
    <?php $j = 0; ?>
    <?php $tot = 0; ?>


    <?php if ($temp->result()) { ?>

        <?php foreach ($temp->result() as $t): ?>

            <!--            --><?php //echo var_dump($t->gambar_barang_temp); ?>
            <?php $data[$i] = $t->id_temp ?>
            <tr
                class="<?= ($t->status_barang_temp == 1) ? "alert-success" : "" ?> <?= ($t->status_barang_temp == 2) ? "alert-danger" : "" ?>">
                <td><?= $i ?></td>
                <td><img height="100px" width="150px" src="<?= base_url() . $t->gambar_barang_temp ?>"</img></td>
                <td><?= $t->nama_barang_temp ?></td>
                <td><?= $t->merk_barang_temp ?></td>
                <?php foreach ($kategoriBarang as $key => $value): ?>
                    <?php if ($key == $t->id_kategori_barang_temp): ?>
                        <td> <?= $value; ?></td>
                    <?php endif; ?>
                <?php endforeach; ?>

                <td align="right"><p id="jum"><?= number_format($t->jumlah_temp, 0, ",", ".") ?></p></td>

                <!--                --><?php //foreach($beli as $key => $value): ?>
                <!--                <td value="--><? //= $key ?><!--" --><? //= set_select('harga', $key, '') ?><!-->
                <!--                    --><? //= $value ?>
                <!--                </td>-->
                <!--                --><?php //endforeach; ?>

                <td align="right"><p id="harga"><?= "Rp " . number_format($t->harga_beli_temp, 2, ",", ".") ?></p></td>
                <?php $sub = $t->jumlah_temp * $t->harga_beli_temp; ?>
                <td align="right"><p id="subtot"><?= "Rp " . number_format($sub, 2, ",", ".") ?></p></td>
                <td><a href="<?= base_url() ?>index.php/admin/view_barang_temp/<?= $t->id_temp ?>"
                       class="glyphicon glyphicon-user" aria-hidden="true"> VIEW</a></td>
                <td><a href="<?= base_url() ?>index.php/admin/edit_barang_temp/<?= $t->id_temp ?>"
                       class="glyphicon glyphicon-cog" aria-hidden="true"> EDIT</a></td>
                <td><a href="#" onclick="confDelete(<?= $t->id_temp ?>)"
                       class="glyphicon glyphicon-remove" aria-hidden="true">
                        DELETE</a></td>
                <?php $i += 1; ?>
                <?php $j += $t->jumlah_temp; ?>
                <?php $tot += $sub; ?>
                <!--                --><?php //if(#pajak.checked) ?>

            </tr>


        <?php endforeach; ?>
        <tr style="background-color: black; color: white">
            <td colspan="5" align="center"><strong><?= $i - 1 . " Items " ?></strong></td>

            <td align="right" style="border: solid 1px"><strong><?= number_format($j, 0, ",", ".") ?></strong></td>
            <td></td>
            <td align="right" style="border: solid 1px"><strong><?= "Rp " . number_format($tot, 2, ",", ".") ?></strong>
            </td>

            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php } else { ?>
        <tr>
            <td colspan="10" align="center"><b> --------------- Data is empty ---------------</b></td>
        </tr>
    <?php } ?>


</table>
<div class="checkbox">
    <label>
        <input type="checkbox" id="pajak" name="pajak" value="10" aria-label="..."> Pajak 10%
    </label>
</div>

<?php if ($temp->result()): ?>

    <h3 align="right" style="padding-right: 5%"><a id="cekpajak" href="#">BUY <span
                class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></h3>
<?php endif; ?>

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

//    $(document).ready(function () {
//        $("#supplier").change(function () {
//            /*dropdown post *///
//            $.ajax({
//                url: "<?php //echo base_url();?>//index.php/admin/buildBarang",
//                data: {id: $(this).val()},
//                type: "POST", success: function (data) {
//                    alert((data));
//                    $("#barang").html(data)
//                    ;
//                }
//            });
//        });
//    });

    $(document).ready(function () {
        $("#pilih_barang").click(function () {
            /*dropdown post *///
            $.ajax({
                url: "<?php echo base_url();?>index.php/admin/buildBarang",
                data: {id: $('#supplier').val()},
                type: "POST", success: function (data) {
//                    alert((data));
                    $("#barang").html(data)
                    ;
                }
            });
        });
    });

    $(document).ready(function () {
        $("#pajak").change(function () {
            /*dropdown post *///
            $.ajax({
                url: "<?php echo base_url();?>index.php/admin/pajak",
                data: {id: $(this).val()},
                type: "POST", success: function (data) {
                    if (($('input[name=pajak]').is(':checked')) == true) {
                        alert("A");
                        $("#temp_beli").html(data);

                    } else {
                        alert("B");
                        window.location.href = "<?php echo base_url();?>index.php/admin/pembelian";
                    }


                    alert(data);
//                    $("#reg_kota").html(data);
                }
            });
        });
    });

    function confDelete(id) {
        var confimation = window.confirm("Are you sure want to delete this barang");
        if (confimation) {
            window.location = "<?= base_url() ?>index.php/admin/delete_barang_temp/" + id;
        }
    }

    $(document).ready(function () {
        $("#cekpajak").click(function () {
            if (($('input[name=pajak]').is(':checked')) == true) {
                alert("Pajak");
                window.location = "<?= base_url() ?>index.php/admin/buy_pajak/";
            } else {
                alert("Non Pajak");
                window.location = "<?= base_url() ?>index.php/admin/buy_barang/";
            }

        });
    });

    $(document).ready(function () {
        $("#pilih_barang").click(function () {
            var x = $('#supplier').val();
            if (x == 0) {
                alert("DOR!")
            } else {
                alert("YES!"+ x)
//                document.getElementById("myDiv").innerHTML = x;
            }
        });
    });

    //    function CekPajak(){
    //        if($('input[name=pajak]').is(':checked')) == true){
    //            alert("A");
    //        }else{
    //            alert("B");
    //        }
    //    }
    //    function myFunction() {
    //
    //        x = document.getElementById("pajak").value;
    //        y = document.getElementById("harga").innerHTML;
    //        p = document.getElementById("subtot").innerHTML;
    //        q = parseInt(document.getElementById("jum").innerHTML);
    //
    //        alert(q);
    //        y = y.replace(/\./g, '');
    //        y = y.replace(/\Rp/g, '');
    //        y = parseInt(y);
    //
    //
    //        x = y/10;
    //        var z = x + y;
    //
    //        z = z.toFixed(2);
    //        z = z.replace(".", ",");
    //        z = z.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    //        document.getElementById("harga").innerHTML = "Rp " + z;
    //    }


    $('.carousel').carousel({
        interval: 5000
    })
</script>
</body>
</html>