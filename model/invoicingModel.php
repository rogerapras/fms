<?
	// SET FMS DB
	$fms_db = new DBConfig;
	$fms_db->setFleetDB();

	// SET MAKE
	$invoicing = new Table;
	$invoicing->setSQLType($fms_db->getSQLType());
	$invoicing->setInstance($fms_db->getInstance());
	$invoicing->setView("v_equipmentrepairedmaster");
	$invoicing->setParam("WHERE noOfTransactions > 0 ORDER BY companyName ");
	$invoicing->doQuery("query");
	$row_invoicing = $invoicing->getLists();

	// CLOSING FMS DB 
	$fms_db->DBClose();
?>