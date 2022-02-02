<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<title>course</title>
<style>
table {
  border: 1px solid black;
  border-collapse: collapse;
}
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

?>
<br>
<form action="assignment2.1.php" method="POST">
<h2>Search Student</h2>
<div class="form-floating">
<input type="text" class="form-control" name="roll_no" id="floatingPassword" placeholder="Search Roll No:">
<label for="floatingPassword">Search Roll No:</label>
<input type="hidden" name="submitted" value="1" />
<input class="btn btn-primary" type="submit" value="Search">
</div>
</form>
<?php
$roll_no = $_POST['roll_no'];
$query_1 = $conn->query('use university');
$query_2 = $conn->prepare("SELECT * FROM STUDENT WHERE roll_no = ? ");
$query_2->execute([$roll_no]);
$result_2 = $query_2->fetchall(PDO::FETCH_ASSOC);
?>
<table class="table table-striped table-hover">
    <thead>
	<tr>
	<th>Roll Name</th>
	<th>Name</th>
	<th>Farher's name</th>
	<th>Gender</th>
	<th>Contact No</th>
	<th>Address</th>
	</tr>
	</thead>
	<tbody>
    <?php
        foreach ($result_2 as $key => $value) {
			echo'<tr>
				<td>'.$value['roll_no'].'</td>
				<td>'.$value['st_name'].'</td>
				<td>'.$value['f_name'].'</td>
				<td>'.$value['gender'].'</td>
				<td>'.$value['contact'].'</td>
				<td>'.$value['address'].'</td>
				</tr>';
		}
		?>
	</tbody>
</table>
<?php
$query_3 = $conn->prepare("SELECT course_code FROM ENROLLED WHERE roll_no = ? ");
$query_3->execute([$roll_no]);
$result_3 = $query_3->fetchall(PDO::FETCH_ASSOC);
?>
	<h2>Registered Courses</h2>
		<table class="table table-striped table-hover">
            <thead>
				<tr>
				<th>Course Code</th>
				<th>Course Name</th>
				<th>Credits</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($result_3 as $key => $temp) {
				$val = $temp['course_code'];
				$query_4 = $conn->prepare("SELECT * FROM COURSES WHERE course_code = ? ");
				$query_4->execute([$val]);
				$result_4 = $query_4->fetchall(PDO::FETCH_ASSOC);
				foreach ($result_4 as $key => $value) {
				if($val ==  $value['course_code'])
				{
				echo'<tr>
					<td>'.$value['course_code'].'</td>
					<td>'.$value['course_name'].'</td>
					<td>'.$value['credit_hours'].'</td>
				</tr>';
			    }
				}
			}
			?>
<?php
$query_6 = $conn->prepare("SELECT course_code FROM ENROLLED NATURAL JOIN COURSES WHERE roll_no != ? ");
$query_6->execute([$roll_no]);
$result_6 = $query_6->fetchall(PDO::FETCH_ASSOC);
?>
	</tbody>
	</table>
	<h2>Available Courses</h2>
		<table class="table table-striped table-hover">
            <thead>
				<tr>
				<th>Course Code</th>
				<th>Course Name</th>
				<th>Credits</th>
				<th></th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($result_6 as $key => $temp) {
				$val = $temp['course_code'];
				$query_5 = $conn->prepare("SELECT * FROM COURSES WHERE course_code = ? ");
				$query_5->execute([$val]);
				$result_5 = $query_5->fetchall(PDO::FETCH_ASSOC);
				foreach ($result_5 as $key => $value) {
				if($val ==  $value['course_code'])
				{
				echo'<tr>
					<td>'.$value['course_code'].'</td>
					<td>'.$value['course_name'].'</td>
					<td>'.$value['credit_hours'].'</td>
					<td><button type="button">Register</button></td>
				</tr>';
			    }
				}
			}
			?>
			</tbody>
			</table>			
			<?php
}
?>
</body>
</html>