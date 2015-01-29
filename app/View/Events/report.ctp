<? foreach($reportData as $project){
?>    
<h2><? echo $project['ProjectTitle']; ?></h2>
<table class='table table-striped table-bordered bootstrap-datatable datatable'>
    <tbody>
        <tr>
            <th style="width:300px; text-align: center;">Goal Name</th>
            <th style="width:100px; text-align: center;">Total Events</th>
            <th style="width:100px; text-align: center;">Total Apps</th>
            <th style="width:100px; text-align: center;">Avg Events Per App</th>
            <th style="width:100px; text-align: center;">-15 Day Event Count</th>
            <th style="width:100px; text-align: center;">-15 Day App Count</th>
            <th style="width:100px; text-align: center;">-30 Day Event Count</th>
            <th style="width:100px; text-align: center;">-30 Day App Count</th>
        </tr>
        <?
            foreach($project['goals'] as $goal){
                ?>
                <tr>
                    <td style="width:300px;"><?echo $goal['GoalTitle']; ?></td>
                    <td style="width:100px; text-align: center;"><?echo $goal['Event Count']; ?></td>
                    <td style="width:100px; text-align: center;"><?echo $goal['AppCount']; ?></td>
                    <td style="width:100px; text-align: center;"><?if($goal['AppCount'] != 0 && $goal['Event Count'] != 0) echo round($goal['Event Count'] / $goal['AppCount'],2);
                                                                    else echo "0";?></td>
                    <td style="width:100px; text-align: center;"><?echo $goal['15Days']; ?></td>
                    <td style="width:100px; text-align: center;"><?echo $goal['15DaysApps']; ?></td>
                    <td style="width:100px; text-align: center;"><?echo $goal['30Days']; ?></td>
                    <td style="width:100px; text-align: center;"><?echo $goal['30DaysApps']; ?></td>
                </tr>
                <?
            }
        ?>
    </tbody>
</table>
<?
}
?>
