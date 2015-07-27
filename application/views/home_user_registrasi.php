<div class="modal-body row">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <?php
    $kategori_user    = array();
    $kategori_user[0] = '--Select Kategori--';
    $this->db->select('*');
    $this->db->where_in('id_kategori_user', [3,5]);
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
            'onchange' => 'kt()',
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
            'value' => set_value('reg_nama_user', ""),
            ));


         ?>
    </div>
    <?php echo form_error('reg_nama_user'); ?>
    <div class="col-md-9 col-md-offset-3" id="lblnp" <?= ($this->input->post('kategori') == 3) ? "" : "hidden"; ?>>
        <?php echo form_label('Nama Perusahaan :'); ?>
    </div>

    <div class="col-md-5 col-md-offset-3">
        <?php echo form_input(array(
            'id'    => 'reg_nama_perusahaan',
            'name'  => 'reg_nama_perusahaan',
            'class' => 'form-control',
            'style'=> ($this->input->post('kategori') == 3) ? "display: block" : "display: none",
            'value' => set_value('reg_nama_perusahaan', "")
        )); ?>
    </div>
    <div id="lblanp">
    <?php echo form_error('reg_nama_perusahaan'); ?>
    </div>
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

<script type="text/javascript">
//    $(document).ready(function () {
//        $("#kategori").change(function () {
//            if($(this).val() == 3){
//                alert("A");
//                document.getElementById("lblnp").style.display='block';
//                document.getElementById("lblanp").style.display='block';
//                document.getElementById("reg_nama_perusahaan").style.display='block';
//            }else if($(this).val() == 5){
//                alert("B");
//                document.getElementById("lblnp").style.display = 'none';
//                document.getElementById("lblanp").style.display = 'none';
//                document.getElementById("reg_nama_perusahaan").style.display = 'none';
//            }
//        });
//    });
    function kt(){
        if($("#kategori").val() == 3){
//            alert("A");
            document.getElementById("lblnp").style.display='block';
            document.getElementById("lblanp").style.display='block';
            document.getElementById("reg_nama_perusahaan").style.display='block';
        }else if($("#kategori").val() == 5){
//            alert("B");
            document.getElementById("lblnp").style.display = 'none';
            document.getElementById("lblanp").style.display = 'none';
            document.getElementById("reg_nama_perusahaan").style.display = 'none';

        }
    }
</script>