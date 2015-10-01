<?
	if(isset($_GET['id']) && !empty($_GET['id'])){
		$id = $_GET['id'];
		$comp_exist = 0;
		
		for($i=0;$i<count($row_invoicing);$i++){
			if($id == $row_invoicing[$i]['companyID']){
				$comp_exist++;
			}
		}
		
		if($comp_exist == 0){
			$alert = new MessageAlert();
			$alert->setURL(BASE_URL . 'invoicing.php');
			$alert->setMessage("Invalid URL!11");
			$alert->Alert();
		}

		// SET FMS DB
		$fms_db = new DBConfig;
		$fms_db->setFleetDB();

		// SET MAKE
		$invoicingdtl = new Table;
		$invoicingdtl->setSQLType($fms_db->getSQLType());
		$invoicingdtl->setInstance($fms_db->getInstance());
		$invoicingdtl->setView("v_equipmentrepaireddetail");
		$invoicingdtl->setParam("WHERE companyID = '$id' ORDER BY woTransactionDate DESC");
		$invoicingdtl->doQuery("query");
		$row_invoicingdtl = $invoicingdtl->getLists();

		// CLOSING FMS DB 
		$fms_db->DBClose();

	}else{
		$alert = new MessageAlert();
		$alert->setURL(BASE_URL . 'invoicing.php');
		$alert->setMessage("Invalid URL!");
		$alert->Alert();
	}
?>