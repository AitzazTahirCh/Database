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
input[type="text"]
{
    background: transparent;
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
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand">School Portal</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="ahome.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="teachers.php">Teachers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="students.php">Students</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="portal.php">Log out<span class="sr-only"></span></a>
      </li>
    </ul>
  </div>
</nav>
<?php if (!isset($_POST['tdel'])){ ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Here you can view all Teachers and can search for their bio data.</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
if (isset($_POST['tdel'])){
$teacher_id = $_POST['teacher_id'];
$query_3 = $conn->prepare("DELETE FROM TEACHERS WHERE teacher_id = ? ");
$query_3->execute([$teacher_id]);
$query_8 = $conn->prepare("DELETE FROM LOGINS WHERE user_id = ? ");
$query_8->execute([$teacher_id]);
?><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>--Teacher Deleted--</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}?>
<?php if (isset($_POST['tsearch'])){
$teacher_id = $_POST['teacher_id'];
$query_3 = $conn->prepare("SELECT * FROM TEACHERS WHERE teacher_id = ? ");
$query_3->execute([$teacher_id]);
$result_3 = $query_3->fetchall(PDO::FETCH_ASSOC);
?>
<table class="table table-striped table-hover">
    <thead>
    <h2>Bio data of your searched Teacher:</h2>
  <tr>
  <th>Teacher Id</th>
  <th>First Name</th>
  <th>Last name</th>
  <th>Gender</th>
  <th>CNIC</th>
  <th>DOB</th>
  <th>Age</th>
  <th>Phone No</th>
  </tr>
  </thead>
  <tbody>
    <?php
        foreach ($result_3 as $key => $value) {
      echo'<tr>
        <td>'.$value['teacher_id'].'</td>
        <td>'.$value['f_name'].'</td>
        <td>'.$value['l_name'].'</td>
        <td>'.$value['gender'].'</td>
        <td>'.$value['CNIC'].'</td>
        <td>'.$value['DOB'].'</td>
        <td>'.$value['age'].'</td>
        <td>'.$value['phone_no'].'</td>
        </tr>';
    }
    ?>
  </tbody>
</table>
</div>  
<?php
}
?>
<h2>Search Teacher:</h2>
<form action="teachers.php" method="POST">
<div class="mb-3">
<div class="form-floating">
<input type="text" class="form-control" name="teacher_id" id="floatingInput" placeholder="Teacher Id:">
<label for="floatingInput">Teacher Id:</label>
</div>
<input type="hidden" name="tsearch" value="1" />
<input class="btn btn-primary" type="submit" value="Search">
</div>
</form>
<div>
<?php
$query_4 = $conn->prepare("SELECT * FROM TEACHERS");
$query_4->execute();
$result_4 = $query_4->fetchall(PDO::FETCH_ASSOC);
?>
<table class="table table-striped table-hover">
    <thead>
    <h2>Bio data of All Teachers:</h2>
  <tr>
  <th>Teacher Id</th>
  <th>First Name</th>
  <th>Last name</th>
  <th>Gender</th>
  <th>CNIC</th>
  <th>DOB</th>
  <th>Age</th>
  <th>Phone No</th>
  </tr>
  </thead>
  <tbody>
    <?php
        foreach ($result_4 as $key => $value) {
      echo'<tr>
        <td>'.$value['teacher_id'].'</td>
        <td>'.$value['f_name'].'</td>
        <td>'.$value['l_name'].'</td>
        <td>'.$value['gender'].'</td>
        <td>'.$value['CNIC'].'</td>
        <td>'.$value['DOB'].'</td>
        <td>'.$value['age'].'</td>
        <td>'.$value['phone_no'].'</td>
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