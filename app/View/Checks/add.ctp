<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Checkup</h1>
<?php
    echo $this->Form->create('Check');
    echo $this->Form->input('title', array('rows' => '1'));
    echo $this->Form->input('description', array('rows' => '3'));
    echo $this->Form->input('goals');
    echo $this->Form->input('action');
    echo $this->Form->input('actiontarget');
    $options = array(
        'label' => 'Save Checkup',
        'class' => 'btn btn-small btn-success',
        );  
    echo $this->Form->end($options);
?>