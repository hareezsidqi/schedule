<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Course Timetable</title>
  <link rel="stylesheet" href="style.css">
  <?php include 'schedule.php';?>
</head>

<body>
  <h1>TIMETABLE</h1>
  <table class="center">
  <?php
    printCourse($coursesArray);
  ?>
  </table>
</body>
</html>