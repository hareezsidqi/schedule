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
  ]);

  #reads the local data file on courses and write the data onto an array
  function fileToArray() {
    #fopen() opens and reads file
    $coursesFile = fopen('courses.txt', 'r') or die("Unable to open file!");
    #initialize course key array for categorizing the course data
    $coursesKeys = array('courseid','timeslot','day');
    #initialize course data array
    $coursesArray = [];

    #reads the file line-by-line until the end of the file:
    while(!feof($coursesFile)) {
      #takes a line of data from the file and seperates each data and pushes the data into an array
      $coursesLine = explode(",", fgets($coursesFile));
      
      #combines the course key array and data array into an associative course array
      $coursesAssoc = array_combine($coursesKeys, $coursesLine);

      #pushes the data array into a multidimensional courses array
      array_push($courseArray, $coursesAssoc);

      #creates a copy of a course as to make 2 meetings 
      $coursesCopy = $coursesAssoc;
      $coursesCopy['day'] += 2;

      #pushes the copy into the multidimensional courses array
      array_push($courseArray, $coursesCopy);
    }
    // print_r($coursesArray);
    fclose($coursesFile);
    return $coursesArray;
  }

  #prints the table with the course data 
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
  
$coursesArray = fileToArray();
?>

