<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Project</h1>
<?php
    echo $this->Form->create('Project');
    echo $this->Form->input('title', array('rows' => '1', 'limit' => 30));
    echo $this->Form->input('description', array('rows' => '3'));
    echo $this->Form->input('category', array(
        'label' => 'Project Category',
        'options' => array('vertical' => 'Vertical Campaign', 'marketplace' => 'Marketplace Campaign', 'kickstart' => 'Kickstart Campaign', 'other' => 'Other')
    ));
    echo $this->Form->input('startDate', array(
        'label' => 'Start Date',
        'dateFormat' => 'MDY',
        'minYear' => date('Y') - 1,
        'maxYear' => date('Y') + 5,
    ));
    echo $this->Form->input('endDate', array(
        'label' => 'End Date',
        'dateFormat' => 'MDY',
        'minYear' => date('Y') - 1,
        'maxYear' => date('Y') + 5,
    ));
    $options = array(
            'label' => 'Save Project',
            'class' => 'btn btn-small btn-success',
            );  
    echo $this->Form->end($options);

//'Vertical Campaign', 'Marketplace Campaign', 'Kickstart Campaign', 'Other'
?>

