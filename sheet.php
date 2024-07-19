<?php
require_once("config.php");

$firstDayOfMonth=date("1-m-Y");
$totalDaysInMonth=date("t",strtotime($firstDayOfMonth));

//Fetching employees
$fetchingEmp=mysqli_query($db,"SELECT * FROM att") OR die(mysqli_error($db));
$totalNumberOfEmp=mysqli_num_rows($fetchingEmp);

$empArr=array();
$idArr=array();
$counter=0;

while($emp=mysqli_fetch_assoc($fetchingEmp)){
    $empArr[]= $emp['emp_name'];
    $idArr[]= $emp['count'];
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<body>
    
<table border="1" cellspacing="0">
    <?php
    for($i=1;$i<=$totalNumberOfEmp+2;$i++){
        if($i==1){
        echo "<tr>";
        echo "<td rowspan='2'>Names</td>";
        for($j=1;$j<=$totalDaysInMonth;$j++){
            echo "<td>$j</td>";
        }
        echo"</tr>";
    }else if($i==2){
        echo "<tr>";
        for($j=0;$j<$totalDaysInMonth;$j++){
            echo "<td>".date("D",strtotime("+$j days",strtotime($firstDayOfMonth)))."</td>";
        }
        echo"</tr>";
    }else if ($counter < $totalNumberOfEmp){
        echo "<tr>";
        echo "<td>" . $empArr[$counter] . "</td>";
        for($j=1;$j<=$totalDaysInMonth;$j++){

            $attdate=date("Y-m-$j");
            
            $fetchingAtt=mysqli_query($db,"SELECT attendance FROM addatt WHERE empid='". $idArr[$counter] ."'AND curr_date='". $attdate ."'") OR die(mysqli_error($db));
            
            $isAdded=mysqli_num_rows($fetchingAtt);
            if($isAdded>0){
                $empAtt=mysqli_fetch_assoc($fetchingAtt);
                if($empAtt['attendance']=="P"){
                    $color="#16A085";
                }else if($empAtt['attendance']=="A"){
                    $color="#990033";
                }else if($empAtt['attendance']=="L"){
                    $color="Khaki";
                }else if($empAtt['attendance']=="H"){
                    $color="#494F55";
                }
                echo "<td style='background-color:$color; color:white'>".$empAtt['attendance']."</td>";
            }else{
                echo "<td></td>";
            }
        }
        echo"</tr>";
        $counter++;
    }
    }
    
    ?>
</table>

</body>
</html>


