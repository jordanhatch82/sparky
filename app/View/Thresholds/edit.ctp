<h1>Edit Threshold</h1>
<?php
    echo $this->Form->create('Threshold');
    echo $this->Form->hidden('goal_id', array( 'value' => $goalId ));
    echo $this->Form->input('title', array('rows' => '1'));
    echo $this->Form->input('description', array('rows' => '3'));
    echo $this->Form->input('number', array('label'=>'Level to check for:'));
    echo $this->Form->input('emailid', array('label'=>'Infusionsoft Email Template Id to send'));
    $options = array(
    'label' => 'Save Threshold',
    'class' => 'btn btn-small btn-success',
    );
    echo $this->Form->end($options);
?>