<div class="row-fluid sortable ui-sortable">
    <div class="box span3">
        <div data-original-title="" class="box-header well">
                <h2>Total Apps Reporting</h2>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <p style="font-size:100px; font-weight:bold; text-align: center; line-height: 1.5;"><? echo $appsReporting[0][0]['appCount']; ?></p> 
            </div>                   
        </div>
    </div>
    <div class="box span3">
        <div data-original-title="" class="box-header well">
                <h2>-15 Day Apps Reporting</h2>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <p style="font-size:100px; font-weight:bold; text-align: center; line-height: 1.5;"><? echo $fifteenDayApps[0][0]['appCount']; ?></p> 
            </div>                   
        </div>
    </div>
    <div class="box span3">
        <div data-original-title="" class="box-header well">
                <h2>-30 Day Apps Reporting</h2>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <p style="font-size:100px; font-weight:bold; text-align: center; line-height: 1.5;"><? echo $thirtyDayApps[0][0]['appCount']; ?></p> 
            </div>                   
        </div>
    </div>
</div>
<div class="row-fluid sortable ui-sortable">
    <div class="box span6">
        <div data-original-title="" class="box-header well">
                <h2><i class="icon-th"></i> Global Event Count By App</h2>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
                    <thead>
                        <tr>
                            <th>App Name</th>
                            <th>Event Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                            foreach($eventCountByApp as $app){
                                echo "<tr><td>" . $app['Event']['appName'] . "</td><td>" . $app[0]['eventCount'] . "</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>                   
        </div>
    </div>
</div>


<pre>
<?
    var_dump($appsReporting);
    var_dump($fifteenDayApps);
    var_dump($thirtyDayApps);
    var_dump($eventCountByApp);


?>
</pre>
