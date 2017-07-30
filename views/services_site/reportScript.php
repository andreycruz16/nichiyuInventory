<?php

	// print_r($_POST); die();
	$date = $_POST['date'];
	$dateTo = $_POST['dateTo'];
	$dateFrom = $_POST['dateFrom'];

	if($_POST['itemType_id']){
		if ($_POST['itemType_id'] == 1) {

			header('location:genuineCountReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['itemType_id'] == 2) {

			header('location:localCountReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['itemType_id'] == 3) {

			header('location:forkliftUnitCountReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['itemType_id'] == 4) {

			header('location:batteryCountReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['itemType_id'] == 5) {

			header('location:chargerCountReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['itemType_id'] == 6) {

			header('location:handpalletCountReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['itemType_id'] == 7) {

			header('location:attachmentsCountReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else {
			header('location:reports.php');
		}
	}

	if($_POST['reference_id']) {
		if ($_POST['reference_id'] == 1) {

			header('location:purchaseOrderReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['reference_id'] == 2) {

			header('location:transferTicketReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['reference_id'] == 3) {

			header('location:pickUpOrderReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['reference_id'] == 4) {

			header('location:invoiceReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['reference_id'] == 5) {

			header('location:deliveryReceiptReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else if ($_POST['reference_id'] == 6) {

			header('location:physicalCountReport.php?date='.$date.'&dateFrom='.$dateFrom.'&dateTo='.$dateTo);
		} else {

			header('location:reports.php');
		}
	}
?>