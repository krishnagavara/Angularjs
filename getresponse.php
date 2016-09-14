<?php
	include('config.php');
	$sql = "select * from customer";
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);

    //close the db connection
    mysqli_close($conn);
?>