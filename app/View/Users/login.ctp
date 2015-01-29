<div class="row-fluid">
    <div class="well span5 center login-box">
        <div class="alert alert-info">
            Please login with your Username and Password.
        </div>
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('User'); ?>
            <fieldset>
                <div data-rel="tooltip" class="input-prepend" data-original-title="Username">
                    <span class="add-on">
                        <i class="icon-user"></i>
                    </span>
                    <?php echo $this->Form->input('username', array('class'=>'input-large span10'));?>
                </div>
                <div class="clearfix"></div>

                <div data-rel="tooltip" class="input-prepend" data-original-title="Password">
                    <span class="add-on">
                        <i class="icon-lock"></i>
                    </span>
                    <? echo $this->Form->input('password', array('class'=>'input-large span10')); ?>
                </div>
                <div class="clearfix"></div>

                <p class="center span5">
                    <?php $options = array(
                        'label' => 'Login',
                        'class' => 'btn btn-large btn-success'
                    );
                    echo $this->Form->end($options); ?>
                </p>
            </fieldset>
        
    </div><!--/span-->
</div>