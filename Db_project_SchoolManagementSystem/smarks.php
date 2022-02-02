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
$roll_no = $_SESSION['roll_no'];
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand">School Portal</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="shome.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="smarks.php">Marks</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sattendance.php">Attendance</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="portal.php">Log out<span class="sr-only"></span></a>
      </li>
    </ul>
  </div>
</nav>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Here you can see your performance in exams...</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div>
<?php
$query_3 = $conn->prepare("SELECT * FROM TRANSCRIPT WHERE roll_no = ? ");
$query_3->execute([$roll_no]);
$result_3 = $query_3->fetchall(PDO::FETCH_ASSOC);
?>
<table class="table table-striped table-hover">
    <thead>
    <center><h2>Your Marksheet</h2></center>
	<tr>
	<th>Subject Id</th>
	<th>Obtained Marks</th>
	<th>Total marks</th>
	<th>Remarks</th>
	</tr>
	</thead>
	<tbody>
    <?php
        foreach ($result_3 as $key => $value) {
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