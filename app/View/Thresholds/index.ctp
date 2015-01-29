<h1>All Thresholds</h1>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Number</th>
        <th>Goal Id</th>
    </tr>

    <?php foreach ($thresholds as $threshold): ?>
    <tr>
        <td><?php echo $threshold['Threshold']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($threshold['Threshold']['title'],
                    array('controller' => 'thresholds', 'action' => 'edit', $threshold['Threshold']['id'], $threshold['Threshold']['goal_id'])); ?>
        </td>
        <td><?php echo $threshold['Threshold']['description']; ?></td>
        <td><?php echo $threshold['Threshold']['number']; ?></td>
        <td><?php echo $threshold['Threshold']['goal_id']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($thresholds); ?>
</table>