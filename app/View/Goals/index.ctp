<h1>All Goals</h1>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Project</th>
    </tr>

    <?php foreach ($goals as $goal): ?>
    <tr>
        <td><?php echo $goal['Goal']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($goal['Goal']['title'],
array('controller' => 'goals', 'action' => 'view', $goal['Goal']['id'])); ?>
        </td>
        <td><?php echo $goal['Goal']['description']; ?></td>
        <td><?php echo $goal['Goal']['project_id']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($goal); ?>
</table>