
<?php
// Get current month and year, or use those passed in URL
$daySelect = isset($_GET["daySelect"]) ? intval($_GET["daySelect"]) : date('j');
$month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

// Adjust for overflow (e.g., month = 13 -> next year)
if ($month > 12) {
    $month = 1;
    $year++;
} elseif ($month < 1) {
    $month = 12;
    $year--;
}

// First day of the month
$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
// Total days in the month
$daysInMonth = date('t', $firstDayOfMonth);
// Determine the weekday index (0 = Sunday)
$startDay = date('w', $firstDayOfMonth);

// Month name
$monthName = date('F', $firstDayOfMonth);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="includes/styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calendar - <?= $monthName . ' ' . $year ?></title>
</head>
<body>
    <div class="calendar" >
        <div class="calendar-header">
            <button class="nav-button" onclick="changeMonth(-1)">&#8592;</button>
            <h2><?= $monthName . ' ' . $year ?></h2>
            <button class="nav-button" onclick="changeMonth(1)">&#8594;</button>
        </div>
        <table>
            <tr>
                <th>Sun</th><th>Mon</th><th>Tue</th>
                <th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
            </tr>
            <tr>
                <?php
                // Fill blank cells before the first day
                for ($i = 0; $i < $startDay; $i++) {
                    echo "<th></th>";
                }

                // Fill the days of the month
                $day = 1;
                $today = date('j');
                $currentMonth = date('n');
                $currentYear = date('Y');

                while ($day <= $daysInMonth) {
                    if (($i % 7) == 0 && $i != 0) echo "</tr><tr>"; // Start a new week

                    if ($daySelect == $today) {
                    $isToday = ($day == $today && $month == $currentMonth && $year == $currentYear);
                    $class = $isToday ? 'today' : 'notToday';

                    echo "<td class='$class'><button class='day-button' onclick='changeDay($day)'>$day</button></td>";

                    $day++;
                    $i++;
                } else {
                    $isToday = ($day == $daySelect && $month == $currentMonth && $year == $currentYear);
                    $class = $isToday ? 'today' : 'notToday';

                    echo "<td class='$class'><button class='day-button' onclick='changeDay($day)'>$day</button></td>";

                    $day++;
                    $i++;
                    }
                }

                // Fill remaining cells
                while ($i % 7 != 0) {
                    echo "<td></td>";
                    $i++;
                } 
                ?>
            </tr>
        </table>
    </div>

    <div>



    </div>


    <script src="scripts.js"> </script>
</body>
</html>