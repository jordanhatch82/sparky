<h1>All Checkups</h1>

<? echo $this->Html->link('Add Checkup', array('controller' => 'checks', 'action' => 'add'), array('class'=>'btn btn-small btn-primary')); ?>


<table class='table table-striped table-bordered bootstrap-datatable datatable dataTable'>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Goals</th>
        <th>Action</th>
        <th>Action Target</th>
        
    </tr>

    <?php foreach ($checks as $check): ?>
        <tr>
            <td><?php echo $check['Check']['id']; ?></td>
            <td><?php echo $this->Html->link($check['Check']['title'], array('controller' => 'checks', 'action' => 'edit', $check['Check']['id'])); ?></td>
            <td><?php echo $check['Check']['description']; ?></td>
            <td><?php echo $check['Check']['goals']; ?></td>
            <td><?php echo $check['Check']['action']; ?></td>
            <td><?php echo $check['Check']['actiontarget']; ?></td>
        </tr>
    <?php endforeach; ?>
    <?php unset($checks); ?>
</table>