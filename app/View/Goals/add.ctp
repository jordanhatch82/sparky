<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Goal</h1>
<?php
    echo $this->Form->create('Goal');
    echo $this->Form->hidden('project_id', array( 'value' => $projectId ));
    echo $this->Form->input('title', array('rows' => '1'));
    echo $this->Form->input('description', array('rows' => '3'));
    $options = array(
        'label' => 'Save Goal',
        'class' => 'btn btn-small btn-success',
        );  
    echo $this->Form->end($options);
?>