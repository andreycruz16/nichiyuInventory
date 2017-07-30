<?php    
	session_start();
	require '../../../database.php';

	define("BACKUP_PATH", "C:/NichiyuAsialiftDatabaseBackups/");

	$date_string = date('m-d-Y_hisA', time());

	if (!is_dir(BACKUP_PATH)) {
    		mkdir(BACKUP_PATH, 0777, true);
	}

	$cmd = "C:/xampp/mysql/bin/mysqldump --routines -h {$server_name} -u {$username} {$database_name} > " . BACKUP_PATH . "{$date_string}_{$database_name}.sql";

	exec($cmd);
	
	echo "<script>alert('DATABASE BACKUP FINISHED'); window.location.href = '../maintenance.php'</script>";

	mysqli_query($conn, $sql);
?>