<table border="1" cellspacing="0">
    <form method="POST">
        <tr>
            <th>Employee Name</th>
            <th>P</th>
            <th>A</th>
            <th>L</th>
            <th>H</th>
        </tr>
        <?php
        require_once("config.php");
        $fetchingEmp=mysqli_query($db, "SELECT * FROM att") OR die(myssqli_error($db));
        while($data=mysqli_fetch_assoc($fetchingEmp)){
            $emp_name=$data['emp_name'];
            $empid=$data['id'];
            ?>
            <tr>
                <td><?php echo $emp_name; ?></td>
                <td><input type="checkbox" name="PreEmp[]" value=<?php echo $empid; ?>></td>
                <td><input type="checkbox" name="AbsEmp[]" value=<?php echo $empid; ?>></td>
                <td><input type="checkbox" name="LeavEmp[]" value=<?php echo $empid; ?>></td>
                <td><input type="checkbox" name="HolEmp[]" value=<?php echo $empid; ?>></td>
            </tr>
            <?php
        }

?>

<tr>
    <td>Select Date(Optional)</td>
    <td colspan="4"> <input type="date" name="selected_date" /></td>
</tr>
<tr>
    <th colspan="5"><input type="submit" name="attBTN" value="Submit"/></th>
</tr>
    </form>
    </table>


    <?php
    if(isset($_POST['attBTN'])){
        date_default_timezone_set("Asia/Kolkata");
        //Date Logic1
        if($_POST['selected_date']==NULL){
            $selected_date=date("Y-m-d");
        }else{
            $selected_date = $_POST['selected_date'];
            }
            //DL2
            $att_mth=date("M",strtotime($selected_date));
            $att_yr=date("Y",strtotime($selected_date));

            if(isset($_POST['PreEmp'])){
                $PreEmp=$_POST['PreEmp'];
                $attendance="P";
                foreach($PreEmp as $atd){
                    mysqli_query($db,"INSERT INTO addatt(empid,curr_date,att_mth,att_yr,attendance) VALUES('". $atd ."','".$selected_date."','". $att_mth ."','". $att_yr ."','". $attendance ."')") OR die(mysqli_error($db));
                }
            }if(isset($_POST['AbsEmp'])){
                $AbsEmp=$_POST['AbsEmp'];
                $attendance="A";
                foreach($AbsEmp as $atd){
                    mysqli_query($db,"INSERT INTO addatt(empid,curr_date,att_mth,att_yr,attendance) VALUES('". $atd ."','".$selected_date."','". $att_mth ."','". $att_yr ."','". $attendance ."')") OR die(mysqli_error($db));
                }
            }if(isset($_POST['LeavEmp'])){
                $LeavEmp=$_POST['LeavEmp'];
                $attendance="L";
                foreach($LeavEmp as $atd){
                    mysqli_query($db,"INSERT INTO addatt(empid,curr_date,att_mth,att_yr,attendance) VALUES('". $atd ."','".$selected_date."','". $att_mth ."','". $att_yr ."','". $attendance ."')") OR die(mysqli_error($db));
                }
            }if(isset($_POST['HolEmp'])){
                $HolEmp=$_POST['HolEmp'];
                $attendance="H";
                foreach($HolEmp as $atd){
                    mysqli_query($db,"INSERT INTO addatt(empid,curr_date,att_mth,att_yr,attendance) VALUES('". $atd ."','".$selected_date."','". $att_mth ."','". $att_yr ."','". $attendance ."')") OR die(mysqli_error($db));
                }
            }
            echo "Attendance added successfully";

            
    }


?>
<script>
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
</script>