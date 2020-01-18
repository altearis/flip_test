<?php
require_once("configs/Constant.php");
include_once("models/Model.php");

class MainController {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new Model();
    } 
	
	public function index()
	{          
        $this->view_list();		
    }
    public function requestCounter(){
        return $this->model->selectData()->rowCount();        
    }

	function sendRequest()
	{ 
        $bank_code = array("bca","bni","bri","mandiri");
        $account_num = rand(100000,getrandmax());
        $amount = rand(100000,1000000);
        $remark = "This is sample remark";
		$param = [
			"account_number" => $account_num,
			"bank_code" => $bank_code[rand(0,3)],
			"amount" =>$amount,
			"remark" =>$remark,
		];

		$this->model->saveData($param);		
	}

	function view_list()
	{
        $result = $this->model->selectData();
        $counter = $result->rowCount();
		require_once('views/transaction_list.php');		
    }
    
    function update_status($autoId)
	{
		$result = $this->model->updateStatus($autoId);	
	}

}

?>