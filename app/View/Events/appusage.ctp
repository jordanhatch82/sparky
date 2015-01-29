<script>
    $(function() {
        $( "#EventsFromDate" ).datepicker("option", "dateFormat", "yy-mm-dd");
        $( "#EventsToDate" ).datepicker("option", "dateFormat", "yy-mm-dd");
      });
</script>

<?
    echo $this->Form->create('Events', array('action' => 'appusage', 'type' => 'get'));
    if(isset($_GET['fromDate'])) $fromDate = $_GET['fromDate'];
    else $fromDate = date('Y-m-d', strtotime('-1 month'));
    if(isset($_GET['toDate'])) $toDate = $_GET['toDate'];
    else $toDate = date('Y-m-d', strtotime('today'));
    if(isset($_GET['type'])) $type = $_GET['type'];
    else $type = 'kickstart';
    echo $this->Form->input('fromDate', array('type' => 'text', 'value' => $fromDate));
    echo $this->Form->input('toDate', array('type' => 'text', 'value' => $toDate));
    echo $this->Form->input('type', array('options' => array('kickstart'=>'kickstart', 'marketplace'=>'marketplace', 'vertical'=>'vertical', 'other'=>'other'),'selected' => $type));
    
    echo $this->Form->end('Update Search');
?>

<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable">
    <tr role="row">
        <th>App Name</th>
        <th>Campaign Count</th>
        <th>Event Count</th>
        <th>Level</th>
    </tr>

<?
    $counts= array('low'=>0, 'med'=>0, 'high'=>0);
    foreach($data as $app){
        if($app[0]['eventCount'] < 20){
            $level = "low";
            $counts['low']++;
        }
        if($app[0]['eventCount'] >= 20 && $app[0]['eventCount'] < 100){
            $level = "medium";
            $counts['med']++;
        }
        if($app[0]['eventCount'] >=100){
            $level = "high";
            $counts['high']++;
        }
        echo "<tr><td>" . $app['events']['appName'] . "</td><td>" . $app[0]['projectsCount'] . "</td><td>" . $app[0]['eventCount'] . "</td><td>". $level . "</td></tr>";
    }
?>

</table>
<table>
    <tr>
        <th>Level</th>
        <th>Count</th>
        <th>Percentage</th>
    </tr>
    <tr>
        <td>Low</td>
        <td><?echo $counts['low'];?></td>
        <td><?echo $counts['low'] / count($data);?></td>
    </tr>
    <tr>
        <td>Mediumw</td>
        <td><?echo $counts['med'];?></td>
        <td><?echo $counts['med'] / count($data);?></td>
    </tr>
    <tr>
        <td>High</td>
        <td><?echo $counts['high'];?></td>
        <td><?echo $counts['high'] / count($data);?></td>
    </tr>
    <tr>
        <td>Total</td>
        <td><?echo count($data);?></td>
        <td></td>
    </tr>
</table>