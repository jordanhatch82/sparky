<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', '# of Events'],
          <?php
            foreach($eventsByDate as $date){
                echo '["'. date('m-d-Y', strtotime($date['Event']['dateCreated'])) .'",'. $date[0]["COUNT(`Event`.`id`)"] .'],';
            }
          ?>
        ]);

        var options = {
            legend: "none"
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

<h2>Data for Event</h2>
<div class="row-fluid sortable ui-sortable">
    <div class="box-header well" data-original-title="">
        <h2><i class="icon-th"></i> Total Number of Events By Day</h2>
    </div>
    <div id="chart_div" class="box span10" style="height:350px;"></div>  
</div>
<div class="row-fluid sortable ui-sortable">
    <div id="content" class="span10">
        <div class="box span4">
            <div class="box-header well" data-original-title="">
                <h2><i class="icon-th"></i> Total Number of Events</h2>
            </div>
            <div class="box-content">
                <p style="font-size:100px; font-weight:bold; text-align: center; line-height: 1.5;"><? echo count($allEventData); ?></p>    
            </div>                   
        </div>
        <div class="box span4">
            <div class="box-header well" data-original-title="">
                <h2><i class="icon-th"></i> Average # Of Events By App</h2>
            </div>
            <div class="box-content">
                <?
                    $totalEvents = 0;
                    $totalApps = 0;
                    foreach($eventsByApp as $app){
                        $totalEvents += $app[0]["eventCount"];
                        $totalApps++;
                    }
                ?>
                <p style="font-size:100px; font-weight:bold; text-align: center; line-height: 1.5;"><? echo round($totalEvents/$totalApps, 1); ?></p> 
            </div>                   
        </div>
        <div class="box span4">
            <div class="box-header well" data-original-title="">
                <h2><i class="icon-th"></i> Top 5 Apps By # of Events</h2>
            </div>
            <div class="box-content">
                <?
                    $appsArray = array();
                    foreach($eventsByApp as $app2){
                        $totalEvents += $app2[0]["eventCount"];
                        $appsArray[$app2['Event']['appName']] = $app2[0]["eventCount"];
                    }
                    arsort($appsArray);
                    $counter = 1;
                    while ($topApp = current($appsArray)) {
                        echo "<h2>" . $counter . ".) " . key($appsArray) ." - " . $topApp . " events</h2>";
                        next($appsArray);
                        $counter++;
                        if($counter >= 6) break;
                    }
                ?>
                
            </div>                   
        </div>
        <div class="box span4">
            <div class="box-header well" data-original-title="">
                <h2><i class="icon-th"></i> Total # of Apps Reporting</h2>
            </div>
            <div class="box-content">
                  <p style="font-size:100px; font-weight:bold; text-align: center; line-height: 1.5;">
                        <? echo $totalApps; ?>
                  </p>
            </div>                   
        </div>
    </div>
</div>
<h2>All Event Data</h2>
<div class="row-fluid sortable ui-sortable">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
        <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 19%;" aria-sort="ascending" aria-label="Name of goal being completed">Id</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 19%;" aria-label="Description of goal being completed">Event Date</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 19%;" aria-label="URL to send the HTTP Post to in Infusionsoft">App Name</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 19%;" aria-label="Edit, View Data, Delete">Contact Id</th>
                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 19%;" aria-label="Edit, View Data, Delete">POST IP Address</th>
                </tr>
                    <?php foreach ($allEventData as $event){ ?>
                        <tr>
                            <td>
                                <p><?php echo $event['Event']['id']; ?></p>
                            </td>
                            <td>
                                <p><?php echo $event['Event']['dateCreated']; ?></p>
                            </td>
                            <td>
                                <p><?php echo $event['Event']['appName']; ?></p>
                            </td>
                            <td>
                                <p><?php echo $event['Event']['contactId']; ?></p>
                            </td>
                            <td>
                                <p><?php echo $event['Event']['referringUrl']; ?></p>
                            </td>
                        </tr>
                    <? } ?>
            </thead> 
        </table>
    </div>
</div>