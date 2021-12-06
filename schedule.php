<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
    define("time", [
      "Days",
      "8:30-9:50",
      "10:00-11:20",
      "11:30-12:50",
      "1:00-1:50",
      "2:00-3:20",
      "3:30-4:50",
    ]);
    define("days", [
      "MON",
      "TUE",
      "WED",
      "THU",
      "FRI",
      "SAT",
      "SUN"
    ]);
  
    function fileToArray() {
      #fopen() opens and reads file
      $coursesFile = fopen('courses.txt', 'r') or die("Unable to open file!");
      $coursesKeys = array('courseid','timeslot','day');
      $courseArray = [];

      #reads the file line-by-line until the end of the file:
      while(!feof($coursesFile)) {
        $coursesLine = explode(",", fgets($coursesFile));
        array_push($courseArray, array_combine($coursesKeys, $coursesLine));
      }
      fclose($coursesFile);
      return $courseArray;
    }
    function mirrorCourse() {
    }

    function printCourse($coursesArray) {
      $entry = 0;
      $j = 0;
      echo "<tr>";
      foreach (time as $timeslot) {
        echo "<th>$timeslot</th>";
      }
      echo "</tr>";

      foreach (days as $day) {
        echo "<tr>
          <td>$day<td>";
        for($slot = 1; $slot < 5; $slot++) {
          if (strcmp($day,'MON') === 0 && $slot === 3) {
            echo "<td class=\"lunch\" rowspan=\"7\">LUNCH</td>";
          }
          else {
            echo "<td></td>";
          }
        }
        echo "</tr>";

      }
    }
#------------------------------
  $coursesArray = fileToArray();
  
  #print_r($coursesArray);
  ?>
  <h1>TIMETABLE</h1>
  <table class="center">
  <?php
    printCourse($coursesArray);
  ?>
  </table>
</body>
</html>