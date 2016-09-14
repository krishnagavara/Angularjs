<?php
	include('config.php');
	$login = "select * from users";
	$result = mysqli_query($conn, $login) or 
	die("Error in Selecting " . mysqli_error($conn));
	while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    echo json_encode($emparray);

    //close the db connection
    mysqli_close($conn);
?>