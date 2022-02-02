<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<title>Portal</title>
<style>
body {
    background-image: url(pics.jpg);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
}
.form-select {
    background-color: #fff0;
  }
#footer {
          position: fixed;
          padding: 10px 10px 0px 10px;
          bottom: 0;
          width: 100%;
          height: 40px;
          background:#212529;
          color: white;
        }
        input[type="text"]
{
    background: transparent;
}
</style>
</head>
<body>
<?php
//this code is executed when the data is submitted
$username = 'root';
$password = '';
try {
$conn = new PDO("mysql:host=localhost;dbname=school", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}
$query_1 = $conn->query('use school');
session_start();
$teacher_id = $_SESSION['teacher_id'];
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand">School Portal</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="thome.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tmarks.php">Marks</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tattendance.php">Attendance</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="portal.php">Log out<span class="sr-only"></span></a>
      </li>
    </ul>
  </div>
</nav>
<?php
if(!isset($_POST['mark'])){
  ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Here you can mark student's attendance.</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
if (isset($_POST['mark'])){
?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Attendance has been marked successfully.</h4>
</div>
<?php
$roll_no = $_POST['roll_no'];
$status = $_POST['typ'];
$date = date('Y-m-d');

$query_11 = $conn->prepare("SELECT * FROM ATTENDANCE WHERE roll_no = ? and date = ? ");
$query_11->execute([$roll_no, $date]);
$result_11 = $query_11->fetchall(PDO::FETCH_ASSOC);
if ($result_11 == NULL) {
$query_7 = $conn->prepare("INSERT INTO ATTENDANCE (roll_no,status,date) values (?,?,?)");
$query_7->execute([$roll_no,$status,$date]);
}
elseif ($result_11 != NULL){
  $query_7 = $conn->prepare("UPDATE ATTENDANCE SET status = ? WHERE roll_no = ? and date = ?");
$query_7->execute([$roll_no,$status,$date]);
}
}
?>
<h2>Mark student Attendance:</h2>
<form action="tattendance.php" method="POST">
<div class="mb-3">
<div class="form-floating">
<input type="text" class="form-control" name="roll_no" id="floatingInput" placeholder="Roll No:">
<label for="floatingInput">Roll No:</label>
</div>
<div class="form-floating">
<select class="form-select" aria-label="status" name="typ" id="floatingselect" placeholder="status">
  <option value="P">Present</option>
  <option value="A">Absent</option>
  <option value="L">Leave</option>
</select>
<label for="floatingselect">Status</label>
</div>
<input type="hidden" name="mark" value="1" />
<input class="btn btn-primary" type="submit" value="Mark">
</div>
</form>
<?php
$query_5 = $conn->prepare("SELECT * FROM STUDENTS");
$query_5->execute();
$result_5 = $query_5->fetchall(PDO::FETCH_ASSOC);
?>
<table class="table table-striped table-hover">
    <thead>
    <h2>All Students in subject :</h2>
  <tr>
  <tr>
  <th>Roll No</th>
  <th>First Name</th>
  <th>Last name</th>
  </tr>
  </thead>
  <tbody>
    <?php
        foreach ($result_5 as $key => $value) {
      echo'<tr>
        <td>'.$value['roll_no'].'</td>
        <td>'.$value['f_name'].'</td>
        <td>'.$value['l_name'].'</td
        </tr>';
    }
    ?>
  </tbody>
</table>
</div>
<!--
<?php
$query_6 = $conn->prepare("SELECT * FROM STUDENTS");
$query_6->execute();
$result_6 = $query_6->fetchall(PDO::FETCH_ASSOC);
?>
    <table class="table table-striped table-hover">
            <thead>
            <h2></h2>
        <tr>
        <th>Roll No</th>
        <th>First Name</th>
        <th>Last name</th>
        <th>Mark</th>
        </tr>
      </thead>
      <tbody>
      <?php
      foreach ($result_6 as $key => $value) {
        echo'<tr>
        <td>'.$value['roll_no'].'</td>
        <td>'.$value['f_name'].'</td>
        <td>'.$value['l_name'].'</td>
        <td><button type="button">Register</button></td>
        </tr>';
      }
      ?>
      </tbody>
      </table>      
-->
<?php
$query_3 = $conn->prepare("SELECT * FROM ATTENDANCE ORDER BY date DESC");
$query_3->execute();
$result_3 = $query_3->fetchall(PDO::FETCH_ASSOC);
?>
<table class="table table-striped table-hover">
    <thead>
    <center><h2>Attendance Sheet</h2></center>
  <tr>
  <th>Roll No</th>
  <th>Date</th>
  <th>Status</th>
  </tr>
  </thead>
  <tbody>
    <?php
        foreach ($result_3 as $key => $value) {
      echo'<tr>
        <td>'.$value['roll_no'].'</td>
        <td>'.$value['date'].'</td>
        <td>'.$value['status'].'</td>
        </tr>';
    }
    ?>
  </tbody>
</table>
</div>
<center><div id="footer">© zaz 2021</div></center>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>