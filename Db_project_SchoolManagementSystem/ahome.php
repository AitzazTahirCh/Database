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
.row {
    --bs-gutter-x: 0rem;
    --bs-gutter-y: 68;
    display: flex;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-evenly;
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
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Welcome!!!</strong>You have successfully logged in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<div class="row">
<div class="col-md-4" id="sid_bar">
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
<h2>Search student:</h2>
<form action="students.php" method="POST">
<div class="mb-3">
<div class="form-floating">
<input type="text" class="form-control" name="roll_no" id="floatingInput" placeholder="Roll No:">
<label for="floatingInput">Roll No:</label>
</div>
<input type="hidden" name="ssearch" value="1" />
<input class="btn btn-primary" type="submit" value="Search">
</div>
</form>
</div>

<div class="col-md-4" id="main_content">
<h2>Remove Teacher:</h2>
<form action="teachers.php" method="POST">
<div class="mb-3">
<div class="form-floating">
<input type="text" class="form-control" name="teacher_id" id="floatingInput" placeholder="Teacher Id:">
<label for="floatingInput">Teacher Id:</label>
</div>
<input type="hidden" name="tdel" value="1" />
<input class="btn btn-primary" type="submit" value="Remove">
</div>
</form>
<h2>Remove Student:</h2>
<form action="students.php" method="POST">
<div class="mb-3">
<div class="form-floating">
<input type="text" class="form-control" name="roll_no" id="floatingInput" placeholder="Roll No:">
<label for="floatingInput">Roll No:</label>
</div>
<input type="hidden" name="sdel" value="1" />
<input class="btn btn-primary" type="submit" value="Remove">
</div>
</form>
</div>
</div>

<center><div id="footer">© zaz 2021</div></center>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>