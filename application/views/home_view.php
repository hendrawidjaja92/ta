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
<li><a href="#">Home</a></li>
<li><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg-login">Login</a></li>
<li><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">Registrasi</a></li>

<!--                FORM LOGIN ======================================-->
<div class="modal fade bs-example-modal-lg-login" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header-edit">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4>Login</h4></div>
            <?php echo form_open('home/user_login',
                ['onsubmit' => 'return false;', 'id' => 'form_login']); ?>
            <div class="modal-body row">
                <div class="col-md-5 col-md-offset-3">
                    <?php echo form_label('Email :'); ?>
                </div>
                <div class="col-md-5 col-md-offset-3">
                    <?php echo form_input(array(
                        'id'    => 'email',
                        'name'  => 'email',
                        'class' => 'form-control'
                    )); ?>
                </div>
                <?php echo form_error('email'); ?>


                <div class="col-md-5 col-md-offset-3">
                    <?php echo form_label('Password :'); ?>
                </div>
                <div class="col-md-5 col-md-offset-3">
                    <?php echo form_password(array(
                        'id'    => 'password',
                        'name'  => 'password',
                        'class' => 'form-control'
                    )); ?>
                </div>
                <?php echo form_error('password'); ?>
            </div>
            <div class="modal-footer">
                <div>
                    <?php echo form_submit(array(
                        'id'    => 'login',
                        'name'  => 'login',
                        'value' => 'Login',
                        'class' => 'btn btn-ok'
                    )); ?>
                </div>

            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!--                FORM LOGIN ======================================-->
<!--                FORM REGISTRASI =================================-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header-edit">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
                <h4>Registrasi</h4>
            </div>
            <?= form_open('home/registrasi',
                ['onsubmit' => 'return false;', 'id' => 'form_registrasi']) ?>
            <div class="modal-body row">
                <?php
                $kategori_user    = array();
                $kategori_user[0] = '--Select Kategori--';
                $this->db->select('*');
                $query = $this->db->get('kategori_user');
                if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                        $kategori_user[$row->id_kategori_user] = $row->nama_kategori_user;
                    }
                }

                ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Kategori User :', 'kategori_user'); ?>
                </div>
                <div class="col-md-4 col-md-offset-3">
                    <?php echo form_dropdown(array(
                        'id'    => 'kategori',
                        'name'  => 'kategori',
                        'class' => 'form-control',
                        'value' => set_value('kategori', "")
                    ), $kategori_user);
                    ?>
                </div>
                <?php echo form_error('kategori'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Username :'); ?>
                </div>
                <div class="col-md-4 col-md-offset-3">
                    <?php echo form_input(array(
                        'id'    => 'reg_username',
                        'name'  => 'reg_username',
                        'class' => 'form-control',
                        'value' => set_value('reg_username', "")
                    )); ?>
                </div>
                <?php echo form_error('reg_username'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Email :'); ?>
                </div>
                <div class="col-md-5 col-md-offset-3">
                    <?php echo form_input(array(
                        'id'    => 'reg_email',
                        'name'  => 'reg_email',
                        'class' => 'form-control',
                        'value' => set_value('reg_email', "")
                    )); ?>
                </div>
                <?php echo form_error('reg_email'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Password :'); ?>
                </div>
                <div class="col-md-4 col-md-offset-3">
                    <?php echo form_password(array(
                        'id'    => 'reg_password',
                        'name'  => 'reg_password',
                        'class' => 'form-control'
                    )); ?>
                </div>
                <?php echo form_error('reg_password'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Re-Password :'); ?>
                </div>
                <div class="col-md-4 col-md-offset-3">
                    <?php echo form_password(array(
                        'id'    => 'reg_re_password',
                        'name'  => 'reg_re_password',
                        'class' => 'form-control'
                    )); ?>
                </div>
                <?php echo form_error('reg_re_password'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Nama Lengkap :'); ?>
                </div>
                <div class="col-md-4 col-md-offset-3">
                    <?php echo form_input(array(
                        'id'    => 'reg_nama_user',
                        'name'  => 'reg_nama_user',
                        'class' => 'form-control',
                        'value' => set_value('reg_nama_user', "")

                    )); ?>
                </div>
                <?php echo form_error('reg_nama_user'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Nama Perusahaan :'); ?>
                </div>
                <div class="col-md-5 col-md-offset-3">
                    <?php echo form_input(array(
                        'id'    => 'reg_nama_perusahaan',
                        'name'  => 'reg_nama_perusahaan',
                        'class' => 'form-control',
                        'value' => set_value('reg_nama_perusahaan', "")
                    )); ?>
                </div>
                <?php echo form_error('reg_nama_perusahaan'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Alamat :'); ?>
                </div>
                <div class="col-md-5 col-md-offset-3">
                    <?php echo form_input(array(
                        'id'    => 'reg_alamat',
                        'name'  => 'reg_alamat',
                        'class' => 'form-control',
                        'value' => set_value('reg_alamat', "")

                    )); ?>
                </div>
                <?php echo form_error('reg_alamat'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('No Telepon :'); ?>
                </div>
                <div class="col-md-3 col-md-offset-3">
                    <?php echo form_input(array(
                        'id'    => 'reg_no_telepon',
                        'name'  => 'reg_no_telepon',
                        'class' => 'form-control',
                        'value' => set_value('reg_no_telepon', "")

                    )); ?>
                </div>
                <?php echo form_error('reg_no_telepon'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Jenis Kelamin :', 'reg_jenis_kelamin'); ?>
                </div>
                <div class="col-md-3 col-md-offset-3">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-gender-man active">
                            <input type="radio" name="reg_jenis_kelamin" id="a" autocomplete="off" value="1">Laki-laki
                        </label>
                        <label class="btn btn-gender-girl">
                            <input type="radio" name="reg_jenis_kelamin" id="b" autocomplete="off" value="2">Perempuan
                        </label>
                    </div>
                </div>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Tanggal Lahir :', 'reg_tgl_lahir'); ?>
                </div>
                <div class="col-md-3 col-md-offset-3">

                    <input type="date" name=reg_tgl_lahir id="reg_tgl_lahir" class="form-control"
                           value="<?= set_value('reg_tgl_lahir', '') ?>"/>

                </div>
                <?php echo form_error('reg_tgl_lahir'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Provinsi :', 'reg_provinsi'); ?>
                </div>
                <div class="col-md-4 col-md-offset-3">
                    <select id="reg_provinsi" name="reg_provinsi" class="form-control">
                        <?php foreach ($provinsiDrop as $key => $value): ?>
                            <option value="<?= $key ?>" <?= set_select('reg_provinsi', $key) ?>>
                                <?= $value ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php echo form_error('reg_provinsi'); ?>
                <div class="col-md-9 col-md-offset-3">
                    <?php echo form_label('Kota :', 'reg_kota'); ?>
                </div>
                <div class="col-md-5 col-md-offset-3">
                    <select id="reg_kota" name="reg_kota" class="form-control">
                        <?php foreach ($kotaDrop as $key => $value): ?>
                            <option value="<?= $key ?>" <?= set_select('reg_kota', $key, '') ?>>
                                <?= $value ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <?php echo form_error('reg_kota'); ?>
            </div>

            <div class="modal-footer">
                <?php echo form_submit(array(
                    'id'    => 'registrasi',
                    'name'  => 'registrasi',
                    'value' => 'Registrasi',
                    'class' => 'btn btn-ok'
                )); ?>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!--                FORM REGISTRASI ==================================-->
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


<div class="bs-example col-md-offset-2 col-sm-offset-2 col-xs-offset-2" data-example-id="carousel-with-captions">
    <ul class="list-group judul-1">
        <li class="list-group-item judul-1">
            <h3>Penjualan Produk Terbaik</h3>
        </li>
    </ul>
    <div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-captions" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-captions" data-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active col-md-offset-1">
                <img data-src="holder.js/900x500/auto/#777:#777" alt="900x500"
                     src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzc3NyIvPjxnPjx0ZXh0IHg9IjM0MC45OTIxODc1IiB5PSIyNTAiIHN0eWxlPSJmaWxsOiM3Nzc7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6NDJwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj45MDB4NTAwPC90ZXh0PjwvZz48L3N2Zz4="
                     data-holder-rendered="true">

                <div class="carousel-caption">
                    <h3 id="first-slide-label">First slide label<a class="anchorjs-link" href="#first-slide-label"><span
                                class="anchorjs-icon"></span></a></h3>

                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="item col-md-offset-1">
                <img data-src="holder.js/900x500/auto/#666:#666" alt="900x500"
                     src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzY2NiIvPjxnPjx0ZXh0IHg9IjM0MC45OTIxODc1IiB5PSIyNTAiIHN0eWxlPSJmaWxsOiM2NjY7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6NDJwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj45MDB4NTAwPC90ZXh0PjwvZz48L3N2Zz4="
                     data-holder-rendered="true">

                <div class="carousel-caption">
                    <h3 id="second-slide-label">Second slide label<a class="anchorjs-link"
                                                                     href="#second-slide-label"><span
                                class="anchorjs-icon"></span></a></h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="item col-md-offset-1">
                <img data-src="holder.js/900x500/auto/#555:#5555" alt="900x500"
                     src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDkwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzU1NSIvPjxnPjx0ZXh0IHg9IjM0MC45OTIxODc1IiB5PSIyNTAiIHN0eWxlPSJmaWxsOiM1NTU1O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjQycHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+OTAweDUwMDwvdGV4dD48L2c+PC9zdmc+"
                     data-holder-rendered="true">

                <div class="carousel-caption">
                    <h3 id="third-slide-label">Third slide label<a class="anchorjs-link" href="#third-slide-label"><span
                                class="anchorjs-icon"></span></a></h3>

                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-captions" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-captions" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<nav class="col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
<ul class="list-group judul-2">
    <li class="list-group-item judul-2">
        <h3>Produk Baru</h3>
    </li>
</ul>
<div class="bs-example" data-example-id="thumbnails-with-custom-content">
<div class="row">
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>


<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img data-src="holder.js/100%x200" alt="100%x200"
             src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjkzIiB5PSIxMDAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MTFwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj4yNDJ4MjAwPC90ZXh0PjwvZz48L3N2Zz4="
             data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">

        <div class="caption">
            <h3 id="thumbnail-label">Thumbnail label<a class="anchorjs-link" href="#thumbnail-label"><span
                        class="anchorjs-icon"></span></a></h3>

            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta
                gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                                                               class="btn btn-default"
                                                                               role="button">Button</a></p>
        </div>
    </div>
</div>
</div>
</div>
</nav>
<nav class="col-md-offset-6 col-sm-offset-6 col-xs-offset-4">
    <ul class="pagination ">
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

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
        $("#reg_provinsi").change(function () {
            /*dropdown post *///
            $.ajax({
                url: "<?php echo base_url();?>index.php/home/buildDropKota",
                data: {id: $(this).val()},
                type: "POST", success: function (data) {
                    $("#reg_kota").html(data)
                    ;
                }
            });
        });
    });

    $(document).ready(function () {
        $("#form_login").submit(function () {
            /*dropdown post *///
            $.ajax({
                url: "<?php echo base_url();?>index.php/home/user_login",
                // serialize untuk mengambil seluruh data name
                data: $("#form_login").serialize(),
                type: "POST",
                success: function (data) {

                    if (data.result == "success") {
                        window.location.href = "<?= base_url('index.php') ?>" + data.url;
                    } else {
                        $("#form_login").html(data.view);
                    }

                }
            });
        });
    });
    $(document).ready(function () {
        $("#form_registrasi").submit(function () {
            /*dropdown post *///
            $.ajax({
                url: "<?php echo base_url();?>index.php/home/registrasi",
                // serialize untuk mengambil seluruh data name
                data: $("#form_registrasi").serialize(),
                type: "POST",
                success: function (data) {

                    if (data.result == "success") {
                        window.location.href = "<?= base_url('index.php') ?>" + data.url;
                    } else {
                        $("#form_registrasi").html(data.view);
                    }

//                    alert(data.view);
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