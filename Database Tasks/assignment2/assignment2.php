<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<title>course</title>
<style>
body { 
  display: block;
  margin:150px;
}
</style>
</head>
<body>
<?php 
$username = 'root';
$password = '';
try {
$conn = new PDO("mysql:host=localhost;dbname=university", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}
if (isset($_POST['submitted'])){
//this code is executed when the data is submitted

$course_code = $_POST['course_code'];
$course_name = $_POST['course_name'];
$credit_hours = $_POST['credit_hours'];
$query_1 = $conn->query('use university');
$query_2 = $conn->prepare("INSERT INTO COURSES VALUES (?,?,?)");
$query_2->execute([$course_code, $course_name, $credit_hours]);
?>
<br>
<h2>Search Student</h2>
<form action="assignment2.1.php" method="POST">
<div class="form-floating">
<input type="text" class="form-control" name="roll_no" id="floatingPassword" placeholder="Search Roll No:">
<label for="floatingPassword">Search Roll No:</label>
<input type="hidden" name="submitted" value="1" />
<input class="btn btn-primary" type="submit" value="Search">
</div>
</form>

<?php 
}

else { ?>
</div>
<main class="form-signin">
<h2>Course Registrartion Form</h2>
<form action="assignment2.php" method="POST">
<div class="mb-3">
<div class="form-floating">
<input type="text" class="form-control" name="course_code" id="floatingInput" placeholder="Course Code">
<label for="floatingInput">Course Code</label>
</div>
<br>
<div class="form-floating">
<input type="text" class="form-control" name="course_name" id="floatingPassword" placeholder="Course Name">
<label for="floatingPassword">Course Name</label>
</div>
<br>
<div class="form-floating">
<input type="text" class="form-control" name="credit_hours" id="floatingPassword" placeholder="Credits">
<label for="floatingPassword">Credits</label>
</div>

<input type="hidden" name="submitted" value="1" />
<br>
<input class="btn btn-primary" type="submit" value="Submit">
</div>
</form>
</main>
<?php } ?>
</body>
</html>