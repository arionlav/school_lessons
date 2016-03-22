<div id="tableBox">
    <table id="resultTable">
        <thead>
        <tr>
            <th>Program name</th>
            <?
            if (! empty($data->Columns)) {
                foreach ($data->Columns as $month) {
                    echo "<th>$month</th>";
                }
            }
            echo "<th>At the year</th>";
            ?>
        </tr>
        </thead>
        <tbody>
        <?
        if (! empty($data->Rows)) {
            foreach ($data->Rows as $lessonName => $orders) {
                echo "<tr><td class='specialRow'>$lessonName</td>";
                $count = 0;
                foreach ($orders as $countOrders) {
                    echo "<td>$countOrders</td>";
                    $count += $countOrders;
                }
                echo "<td class='specialRow'>$count</td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>
