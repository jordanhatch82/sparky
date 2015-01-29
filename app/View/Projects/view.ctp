
<?php
    echo $this->Html->link(
        'Create New Goal',
        array('controller' => 'goals', 'action' => 'add', $project['Project']['id']),
        array('class' => 'btn btn-large btn-primary')
    );
?>

<div class="row-fluid sortable ui-sortable">
    <div class="box span12">
        <div data-original-title="" class="box-header well">
            <h2><i class="icon-user"></i> Project - <? echo $project['Project']['title']; ?></h2>
            <div class="box-icon">
                <? echo $this->Html->link('View Data', array('controller' => 'projects', 'action' => 'edit', $project['Project']['id']), array('class'=>'btn btn-setting btn-round')); ?>
                                            
            </div>
        </div>   
        <div class="box-content">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                    <thead>
			<tr role="row">
                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 225px;" aria-sort="ascending" aria-label="Name of goal being completed">Goal Name</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 300px;" aria-label="Description of goal being completed">Description</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 500px;" aria-label="URL to send the HTTP Post to in Infusionsoft">HTTP Post URL</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 75px;" aria-label="Edit, View Data, Delete">Event Count</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 2200px;" aria-label="Edit, View Data, Delete">Actions</th>
                        </tr>
                            <?php foreach ($project['Goal'] as $goal){ ?>
                                <tr>
                                    <td>
                                        <h4><?php echo $this->Html->link($goal['title'], array('controller' => 'goals', 'action' => 'edit', $goal['id'], $goal['project_id'])); ?></h4>
                                    </td>
                                    <td>
                                        <p style="word-wrap: break-word;"><?php echo $goal['description']; ?></p>
                                    </td>
                                    <td>
                                        <p style="word-wrap: break-word;"><?php echo 'https://sparky.gopagoda.com/events/record/'. $goal['id']; ?></p>
                                        <p><? echo $this->Form->postLink('Test Post', array('controller' => 'events', 'action' => 'record', $goal['id']), array('class'=>'btn btn-mini btn-primary')); ?></p>
                                    </td>
                                    <td>
                                        <h3><?
                                            //echo $this->Event->find('count', array('conditions'=>array('goal_id' => $goal['id'])));
                                            echo $goal['event_count'];
                                        ?></h3>
                                    </td>
                                    <td>
                                        <?php
                                            echo $this->Html->link('View Data', array('controller' => 'events', 'action' => 'data', $goal['id']), array('class'=>'btn btn-small btn-primary'));
                                            echo $this->Html->link('Edit Goal', array('controller' => 'goals', 'action' => 'edit', $goal['id']), array('class'=>'btn btn-small btn-success'));
                                            echo $this->Form->postLink('Delete Goal', array('controller' => 'goals', 'action' => 'delete', $goal['id']), array('confirm' => 'Are you sure?','class'=>'btn btn-small btn-danger'));
                                        ?>
                                    </td>
                                </tr>
                            <? } ?>
                    </thead> 
                </table>
            </div>
        </div>
    </div>
    
    <? unset($project); ?>
</div>
