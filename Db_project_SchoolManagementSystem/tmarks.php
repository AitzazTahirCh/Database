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
$query_2 = $conn->prepare("SELECT subject_id FROM SUBJECT WHERE teacher_id = ? ");
$query_2->execute([$teacher_id]);
$result_2 = $query_2->fetchall(PDO::FETCH_ASSOC);
foreach ($result_2 as $key => $value) {
$subject_id = $value['subject_id'];
}
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
  <strong>Here you can mark student's marks in exams.</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
if (isset($_POST['mark'])){
?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Marks has been marked successfully.</h4>
</div>
<?php
$roll_no = $_POST['roll_no'];
$obtained = $_POST['obtained_marks'];
$remark = $_POST['remark'];
$query_2 = $conn->prepare("SELECT subject_id FROM SUBJECT WHERE teacher_id = ? ");
$query_2->execute([$teacher_id]);
$result_2 = $query_2->fetchall(PDO::FETCH_ASSOC);
foreach ($result_2 as $key => $value) {
$subject_id = $value['subject_id'];
}
$query_3 = $conn->prepare("SELECT * FROM TRANSCRIPT WHERE roll_no = ? ");
$query_3->execute([$roll_no]);
$result_3 = $query_3->fetchall(PDO::FETCH_ASSOC);
if($result_3 == NULL)
{
$query_4 = $conn->prepare("INSERT INTO TRANSCRIPT (obtained_marks, roll_no, subject_id, remark) VALUES (?,?,?,?)");
$query_4->execute([$obtained, $roll_no, $subject_id, $remark]);
}
elseif ($result_3 != NULL) {
  $query_4 = $conn->prepare("UPDATE TRANSCRIPT SET obtained_marks = ?, remark = ? WHERE roll_no = ?");
  $query_4->execute([$obtained, $remark, $roll_no]);
}
}
?>
<h2>Mark student Marks:</h2>
<form action="tmarks.php" method="POST">
<div class="mb-3">
<div class="form-floating">
<input type="text" class="form-control" name="roll_no" id="floatingInput" placeholder="Roll No:">
<label for="floatingInput">Roll No:</label>
</div>
<div class="form-floating">
<input type="text" class="form-control" name="obtained_marks" id="floatingInput" placeholder="Obtained Marks:">
<label for="floatingInput">Obtained Marks:</label>
</div>
<div class="form-floating">
<input type="text" class="form-control" name="remark" id="floatingInput" placeholder="Remarks:">
<label for="floatingInput">Remarks:</label>
</div>
<input type="hidden" name="mark" value="1" />
<input class="btn btn-primary" type="submit" value="Update">
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
<div>
<?php
$query_9 = $conn->prepare("SELECT * FROM TRANSCRIPT");
$query_9->execute();
$result_9 = $query_9->fetchall(PDO::FETCH_ASSOC);
?>
<table class="table table-striped table-hover">
    <thead>
    <center><h2>Marksheet</h2></center>
  <tr>
  <th>Subject Id</th>
  <th>Obtained Marks</th>
  <th>Total marks</th>
  <th>Remarks</th>
  </tr>
  </thead>
  <tbody>
    <?php
        foreach ($result_9 as $key => $value) {
      echo'<tr>
        <td>'.$value['subject_id'].'</td>
        <td>'.$value['obtained_marks'].'</td>
        <td>'.$value['total_marks'].'</td>
        <td>'.$value['remark'].'</td>
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