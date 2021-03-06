<?
	// SET FMS DB
	$fms_db = new DBConfig;
	$fms_db->setFleetDB();

	// SET WORK ORDER
	$workordermst = new Table;
	$workordermst->setSQLType($fms_db->getSQLType());
	$workordermst->setInstance($fms_db->getInstance());
	$workordermst->setView("v_workordermaster");
	$workordermst->setParam("WHERE status NOT IN('6','7','8') ORDER BY status ASC, woReferenceNo DESC, woTransactionDate DESC");
	$workordermst->doQuery("query");
	$row_workordermst = $workordermst->getLists();

	// SET SERVICE TYPE
	$servicetypemst = new Table;
	$servicetypemst->setSQLType($fms_db->getSQLType());
	$servicetypemst->setInstance($fms_db->getInstance());
	$servicetypemst->setView("v_servicetypemaster");
	$servicetypemst->setParam("WHERE status = '1'");
	$servicetypemst->doQuery("query");
	$row_servicetypemst = $servicetypemst->getLists();

	// SET EQUIPMENT
	$equipmentmst = new Table;
	$equipmentmst->setSQLType($fms_db->getSQLType());
	$equipmentmst->setInstance($fms_db->getInstance());
	$equipmentmst->setView("v_equipmentmaster");
	$equipmentmst->setParam("WHERE status = '1'");
	$equipmentmst->doQuery("query");
	$row_equipmentmst = $equipmentmst->getLists();
	$num_equipmentmst = $equipmentmst->getNumRows();

	if($num_equipmentmst == 1){
		$assignee = $row_equipmentmst[0]['assigneeName'];
	}

	// SET EQUIPMENT
	$assigneemst = new Table;
	$assigneemst->setSQLType($fms_db->getSQLType());
	$assigneemst->setInstance($fms_db->getInstance());
	$assigneemst->setView("v_assigneemaster");
	$assigneemst->setParam("WHERE status = '1'");
	$assigneemst->doQuery("query");
	$row_assigneemst = $assigneemst->getLists();

	// SET PARTS
	$partsmst = new Table;
	$partsmst->setSQLType($fms_db->getSQLType());
	$partsmst->setInstance($fms_db->getInstance());
	$partsmst->setView("v_partsmaster");
	$partsmst->setParam("ORDER BY partsID");
	$partsmst->doQuery("query");
	$row_partsmst = $partsmst->getLists();
	
	// CLOSING FMS DB 
	$fms_db->DBClose();
?>