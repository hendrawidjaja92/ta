<div class="modal-body row">

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <div class="col-md-5 col-md-offset-3">
        <?php echo form_label('Email :'); ?>
    </div>
    <div class="col-md-5 col-md-offset-3">
        <?php echo form_input(array('id'    => 'email',
                                    'name'  => 'email',
                                    'class' => 'form-control',
                                    'value' => set_value('email', "")
            )); ?>
    </div>
    <?php echo form_error('email'); ?>


    <div class="col-md-5 col-md-offset-3">
        <?php echo form_label('Password :'); ?>
    </div>
    <div class="col-md-5 col-md-offset-3">
        <?php echo form_password(array('id' => 'password', 'name' => 'password', 'class' => 'form-control')); ?>
    </div>
    <?php echo form_error('password'); ?>
</div>
<div class="modal-footer">
    <div>
        <?php echo form_submit(array('id'    => 'login',
                                     'name'  => 'login',
                                     'value' => 'Login',
                                     'class' => 'btn btn-ok'
            )); ?>
    </div>

</div>