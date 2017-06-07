<?php 
error_reporting(0);
set_time_limit(128);

   
	$vars = array_keys(get_defined_vars());
	for ($i = 0; $i < sizeOf($vars); $i++) {
	    unset($$vars[$i]);
	}
	unset($vars,$i);
  

	// if(!empty($_GET)) {
	// 	$studentNumber = $_GET['studentNumber'];
 //        $studentNumber = mysqli_real_escape_string($conn, $studentNumber);
 //        $studentNumber = trim($studentNumber);
 //        $studentNumber = strip_tags($studentNumber);

 //        $month = $_GET['month'];
 //        $month = mysqli_real_escape_string($conn, $month);
 //        $month = trim($month);
 //        $month = strip_tags($month);

 //        $day = $_GET['day'];
 //        $day = mysqli_real_escape_string($conn, $day);
 //        $day = trim($day);
 //        $day = strip_tags($day);

 //        $year = $_GET['year'];
 //        $year = mysqli_real_escape_string($conn, $year);
 //        $year = trim($year);
 //        $year = strip_tags($year);

 //        $password = $_GET['password'];
 //        $password = mysqli_real_escape_string($conn, $password);
 //        $password = trim($password);
 //        $password = strip_tags($password);
	// }

	// $studentId = "2014-00084-TG-0";
	// $month = "11";
	// $day = "16";
	// $year = "1997";
	// $password = "2014-00084-TG-0!";

	$studentId = "2014-00080-TG-0";
	$month = "11";
	$day = "30";
	$year = "1997";
	$password = "104@leb@nc";
 ?>

<style>
	body {
		display: none;
	}
</style>
<?php
 
	//Upload a blank cookie.txt to the same directory as this file with a CHMOD/Permission to 777
	function login($url,$data){
	    $fp = fopen("cookie.txt", "w");
	    fclose($fp);
	    $login = curl_init();
	    curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
	    curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
	    curl_setopt($login, CURLOPT_TIMEOUT, 40000);
	    curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($login, CURLOPT_URL, $url);
	    curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	    curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
	    curl_setopt($login, CURLOPT_POST, TRUE);
	    curl_setopt($login, CURLOPT_POSTFIELDS, $data);
	 //    curl_setopt($login, CURLOPT_HTTPHEADER, array(
		//     'Access-Token: <snip>',
		//     'x-api-user: email:<snip>',
		//     'Content-Type: application/json')
		// );
	    $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13';
	    curl_setopt($login, CURLOPT_USERAGENT, $userAgent);
	    // $code = curl_getinfo($login, CURLINFO_HTTP_CODE);
	    ob_start();
	    return curl_exec ($login);
	    ob_end_clean();
	    curl_close ($login);
	    unset($login);    
	}                  
	 
	function grab_page($site){
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
	    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
	    curl_setopt($ch, CURLOPT_URL, $site);
	    ob_start();
	    return curl_exec ($ch);
	    ob_end_clean();
	    curl_close ($ch);
	}
	 
	function post_data($site,$data){
	    $datapost = curl_init();
	        $headers = array("Expect:");
	    curl_setopt($datapost, CURLOPT_URL, $site);
	        curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
	    curl_setopt($datapost, CURLOPT_HEADER, TRUE);
	        curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($datapost, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	    curl_setopt($datapost, CURLOPT_POST, TRUE);
	    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
	        curl_setopt($datapost, CURLOPT_COOKIEFILE, "cookie.txt");
	    ob_start();
	    return curl_exec ($datapost);
	    ob_end_clean();
	    curl_close ($datapost);
	    unset($datapost);    
	}
 
?>

<?php 
	$min=1;
  	$max=6;
  	$i =  rand($min,$max);
	echo grab_page("http://sis2.pup.edu.ph/aims/students/grades.php?mainID=106&menuDesc=Grades");
	login("http://sis2.pup.edu.ph/aims/process/validate.php?userType=1", "txtUser=".$studentId."&cboMonth=".$month."&cboDay=".$day."&cboYear=".$year."&txtPwd=".$password."");
 ?>

 <script src="jquery.min.js"></script>
 <script>
     $('td.caption').remove();
     $('img').remove();
     $('div i').remove(); 
     $('a').contents().unwrap();
     $('u').contents().unwrap();
     $('body > table > tbody > tr > td > table > tbody > tr:nth-child(2) > td:nth-child(2) > table > tbody > tr:nth-child(3) > td > table > tbody > tr:nth-child(2) > td').remove(); 
     $('body > table > tbody > tr > td > table > tbody > tr:nth-child(2) > td:nth-child(2) > table > tbody > tr:nth-child(3) > td > table > tbody > tr:nth-child(3) > td > table > tbody > tr > td > form > table > tbody > tr:nth-child(1) > td:nth-child(2)').remove();
	
	//only load this part
	$('body > table > tbody > tr > td > table > tbody > tr:nth-child(2) > td:nth-child(2) > table > tbody > tr:nth-child(3) > td > table > tbody > tr:nth-child(3) > td > table > tbody > tr > td > form > table > tbody > tr:nth-child(2) > td > table').html();


	$(function () {
     $('body').removeClass('hidden');
 	});
 </script>
 <style>
	* {
		font-size: 100%;
		font-family: Arial;
		color: black;
	}
	body {
		display: unset

	}

	body > table {
		margin-bottom: 100px;
	}



	/*description header*/
	td > table > tbody > tr.tableheader > td:nth-child(3) {
		width: 31%;
	}
	/*faculty name header*/
	td > table > tbody > tr.tableheader > td:nth-child(4) {
		width: 31%;
	}

	td > table > tbody > tr.tableheader > td:nth-child(5) {
		width: 5%;
	}

	/*units*/
	td > table > tbody > tr > td:nth-child(5) {
		text-align: center;
	}
	/*sect code*/
	td > table > tbody > tr > td:nth-child(6) {
		text-align: center;
	}
	/*grade*/
	td > table > tbody > tr > td:nth-child(7) {
		text-align: center;
		font-weight: bold;
	}
	/*passs or failed*/
	td > table > tbody > tr > td:nth-child(8) {
		text-align: center;
		font-weight: bold;
	}



</style>


