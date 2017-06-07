<?php
	session_start();
	require '../../../database.php';

	if(isset($_POST)) {

	$user_id = $_POST['user_id'];
	$user_id = mysqli_real_escape_string($conn, $user_id);
	$user_id = trim($user_id);

	$username = $_POST['username'];
	$username = mysqli_real_escape_string($conn, $username);
	$username = trim($username);

	$firstName = $_POST['firstName'];
	$firstName = mysqli_real_escape_string($conn, $firstName);
	$firstName = trim($firstName);

	$lastName = $_POST['lastName'];
	$lastName = mysqli_real_escape_string($conn, $lastName);
	$lastName = trim($lastName);

	$contactNumber = $_POST['contactNumber'];
	$contactNumber = mysqli_real_escape_string($conn, $contactNumber);
	$contactNumber = trim($contactNumber);		

	$sql = "UPDATE
			  tbl_users
			SET
			  tbl_users.username = '".$username."',
			  tbl_users.firstName = '".$firstName."',
			  tbl_users.lastName = '".$lastName."',
			  tbl_users.contactNumber = '".$contactNumber."'
			WHERE
			  user_id = ".$user_id.";";

	$retval = mysqli_query($conn, $sql); 
	if ($retval) {

	  /*ACTIVITY LOG*/
	  $sql = "INSERT INTO tbl_activity_logs VALUES(NULL,
	                                           '".$_SESSION['user_id']."',
	                                           now(),
	                                           7,
	                                           'Updated Another User Profile'
	                                           );";  /*3 is update for activity type*/
	  mysqli_query($conn, $sql);
	  echo "<script>alert('PROFILE DETAILS UPDATED SUCCESSFULLY.'); window.location.href = '../userDetails.php?user_id=".$user_id."'</script>";
	                                                        
	} else {
	  echo "<script>alert('AN ERROR OCCURED. UPDATE NOT SAVED. CHECK YOUR INPUTS. TRY AGAIN.'); window.location.href = '../userManagement.php'</script>";
	}
	mysqli_close($conn);	

	}

?> 