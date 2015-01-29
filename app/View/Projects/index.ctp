<h1>Projects</h1>
<?php echo $this->Html->link(
    'Create New Project',
    array('controller' => 'projects', 'action' => 'add'),
    array('class' => 'btn btn-large btn-primary')
); ?>

<div class="row-fluid sortable ui-sortable">
    
				
    <?php
    $counter = 0;
    
    foreach ($projects as $project){
        
        ?>
    <div class="box span3">
        <div data-original-title="" class="box-header well">
            <h2><i class="icon-th"></i> <?php echo $this->Html->link($project['Project']['title'],
array('controller' => 'projects', 'action' => 'view', $project['Project']['id'])); ?></h2>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <p>
                    <?php echo $project['Project']['description']; ?> 
                </p>
                <p>
                    <?php echo $allEvents[$project['Project']['id']]['EventCount'];?> total events recorded.
                </p>
                <?php echo $this->Html->link('View Project',
                    array('controller' => 'projects', 'action' => 'view', $project['Project']['id']), array('class'=>'btn btn-small btn-success')); ?>
                <?php echo $this->Form->postLink(
                    'Delete Project',
                    array('action' => 'delete', $project['Project']['id']),
                    array('confirm' => 'Are you sure?','class'=>'btn btn-small btn-danger'));
                ?>
            </div>                   
        </div>
        
    </div><!--/span-->
        
    <?
        $counter++;
        if($counter >= 3){
        ?>
            </div>
            <div class="row-fluid sortable ui-sortable">
        <?
            $counter = 0;
        }
    }   
    unset($project); ?>
</div>

<?php /*echo $project['Project']['id']; ?></td>
        
            <?php echo $this->Html->link($project['Project']['title'],
array('controller' => 'projects', 'action' => 'view', $project['Project']['id'])); ?>
        </td>
        <td><?php echo $project['Project']['description']; ?></td>
        <td><?php echo $project['Project']['startDate']; ?></td>
        <td><?php echo $project['Project']['endDate']; ?></td>
    </tr>
    */?>