<?php
include 'connect_db.php';
 include 'includes/nav.php';
 include 'includes/footer.php';
// Get current day selection, month, and year, or set as current time
$daySelect = isset($_GET["daySelect"]) ? intval($_GET["daySelect"]) : date('j');
$month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$date = $year .'-'. $month .'-'. $daySelect;

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <title>PHP Calendar - <?= $monthName . ' ' . $year ?></title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 justify-content-center d-flex">
                <div class="calendar" >
                    <div class="calendar-header">
                     <button class="nav-button" onclick="changeMonth(-1)">&#8592;</button>
                  <h2><?= $monthName . ' ' . $year ?></h2>
                   <button class="nav-button" onclick="changeMonth(1)">&#8594;</button>
               </div>
              <table allign="left">
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
                          $isToday = ($day == $daySelect);
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
           </div>
           <?php   //get cards for the selected day, cards have a recpie image and description, with a link to the recipe page
        //create a button to add or edit recipie cards
        //cards should have meal, recipe title, recipe image, and recipe description the whole card should be a link to the recipe page
        	$q = "SELECT * FROM recipies" ;
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 ){

    while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
{    if( $row["date"] == $date ){
        echo '
         <div class="col-4 justify-content-center d-flex">
           <div class="card" style="width: 18rem;">
        	 <img class="card-img-top src='. $row['recipe_img'].'" alt="recipeImage">
        	  <div class="card-body">
        	   <h5 class="card-title text-center">' . $row['recipe_name'] .'</h5>
        	   <p class="card-text">' . $row['item_name'] .'</p>
           </div>
            <div class="card-footer text-muted">
          Meal
         </div>
        	</div>
         </div>';
}
}
    }
         //card for adding 
             echo '
         <div class="col-4 justify-content-center d-flex">
          <div class="card" style="width: 18rem;">
        	 <img class="card-img-top" alt="recipeImage">
	          <div class="card-body">
	           <h5 class="card-title text-center">test</h5>
	           <p class="card-text">test</p>
             </div>
	        </div>
    </div>
  </div>
  </div>';
?>
<script src="scripts.js"> </script>
</body>
</html>