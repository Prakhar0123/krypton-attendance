<form method="POST">

    <input type="text" name="emp_name" placeholder="Emp Name" required autofocus />
    <input type="submit" value="Add Employee" name="submit_add">
</form>

<form method="POST">

    <input type="text" name="emp_name_remove" placeholder="Emp Name to Remove" required />
    <input type="submit" value="Remove Employee" name="submit_remove">
</form>

<?php

if(isset($_POST['submit_add'])){

    require_once("config.php");
    $emp_name = $_POST['emp_name'];

    $query = "INSERT INTO att(emp_name) VALUE('$emp_name')";
    $execQuery = mysqli_query($db, $query) or die(mysqli_error($db));

    echo "Employee Added Successfully";
}

if(isset($_POST['submit_remove'])){

    require_once("config.php");
    $emp_name_remove = $_POST['emp_name_remove'];

    $query = "DELETE FROM att WHERE emp_name = '$emp_name_remove'";
    $execQuery = mysqli_query($db, $query) or die(mysqli_error($db));

    echo "Employee Removed Successfully";
}

?>

<script>
    if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
    }
</script>
