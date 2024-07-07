<form method="POST">

    <input type="text" name="emp_name" placeholder="Emp Name" required autofocus />
    <input type="submit" value="Add Employee" name="submit">
</form>

<?php

if(isset($_POST['submit'])){

    require_once("config.php");
    $emp_name=$_POST['emp_name'];

    $query="INSERT INTO att(emp_name) VALUE('$emp_name')";
    $execQuery=mysqli_query($db,$query)or die(mysqli_error($db));

    echo "Employee Added Succesfully";
}


?>

<script>
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
</script>