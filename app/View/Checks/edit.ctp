<h1>Edit Checkup</h1>
<div class="span8 well">
    <div class="box-content">
<?php
    
    echo $this->Form->create('Check');
    echo $this->Form->input('title', array('rows' => '1'));
    echo $this->Form->input('description', array('rows' => '3'));
    echo $this->Form->input('goals');
    echo $this->Form->input('action', array('options' => array('email', 'goal')));
    echo $this->Form->input('actiontarget');
    $options = array(
    'label' => 'Save',
    'class' => 'btn btn-small btn-success',
    );
    echo $this->Form->end($options);
?>
    </div>
</div>
