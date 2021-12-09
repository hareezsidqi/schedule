<?php
#Naim: fileToArray();
#Wani: printCourse();
#Mohamed: printList();
#Hareez: CSS
#Syahmi: Local storage and index.php
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

  #CODER: Naim
  #this function reads the local data file on courses and write the data onto an array
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
      array_push($coursesArray, $coursesAssoc);

      #creates a copy of a course as to make 2 meetings 
      $coursesCopy = $coursesAssoc;
      $coursesCopy['day'] += 2;

      #pushes the copy into the multidimensional courses array
      array_push($coursesArray, $coursesCopy);
    }
    fclose($coursesFile);
    return $coursesArray;
  }

  #CODER: Wani
  #prints the table with the course data 
  function printCourse($coursesArray) {
    echo "<tr>";
    #prints each timeslot
    foreach (time as $timeslot) {
      echo "<th>$timeslot</th>";
    }
    echo "</tr>";

    #loops printing out each day
    foreach (days as $day) {
      echo "<tr>
        <td>$day<td>";

      #loops each slot for the courses per day 
      for($slot = 1; $slot < 5; $slot++) {
        #makes a special column for lunch timeslot for the week
        if (strcmp($day,'MON') === 0 && $slot === 3) {
          echo "<td class=\"lunch\" rowspan=\"7\">LUNCH</td>";
        }
        #prints out the slots
        else {
          echo "<td></td>";
        }
      }
      echo "</tr>";

    }
  }

  #CODER: Mohammed
  #prints total courses (with duplicates on other days)
  function printList($coursesArray) {
    #prints each course data and loops
    foreach ($coursesArray as $course) {
      echo "<tr>
      <td>$course[courseid]</td>
      <td>$course[timeslot]</td>
      <td>$course[day]</td>
      </tr>";
    }
  }
$coursesArray = fileToArray();
?>

