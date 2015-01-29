<h1>Edit Goal</h1>
<div class="span12 well">
    <div class="box-content">
<?php
    
    echo $this->Form->create('Goal');
    echo $this->Form->hidden('project_id', array( 'value' => $projectId ));
    echo $this->Form->input('title', array('rows' => '1'));
    echo $this->Form->input('description', array('rows' => '3'));
    $options = array(
    'label' => 'Save',
    'class' => 'btn btn-small btn-success',
    );
    echo $this->Form->end($options);
?>
    </div>
</div>
<div class="span12 well">
    <div class="box-content">
<?
    
    echo $this->Html->link('Add Threshold', array('controller' => 'thresholds', 'action' => 'add', $goal['id']), array('class'=>'btn btn-small btn-primary'));
    echo '<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">';
    echo $this->Html->tableHeaders(array('Title', 'Description', 'Number', 'Actions'));
    foreach($thresholds as $threshold){
        echo $this->Html->tableCells(array($threshold['Threshold']['title'],
                                           $threshold['Threshold']['description'],
                                           $threshold['Threshold']['number'],
                                           $this->Html->link($this->Html->useTag('i', 'class=icon-edit icon-white') . 'Edit',
                                                             array('controller'=>'thresholds', 'action'=>'edit', $threshold['Threshold']['id'], $goal['id']),
                                                             array('class'=>'btn btn-info'),
                                            array('class' => 'odd'),
                                            array('class' => 'even'))));
    }
    echo "</table>";
?>
    </div>
</div>
