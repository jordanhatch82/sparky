<h1>Edit Project</h1>
<div class="span12 well">
    <div class="box-content">
<?php
    
    echo $this->Form->create('Project');
    echo $this->Form->input('title', array('rows' => '1'));
    echo $this->Form->input('description', array('rows' => '3'));
    echo $this->Form->input('category', array('options' => array('vertical', 'marketplace', 'kickstart', 'other')));
    $options = array(
    'label' => 'Save',
    'class' => 'btn btn-small btn-success',
    );
    echo $this->Form->end($options);
?>
    </div>
</div>
