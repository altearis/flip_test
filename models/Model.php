<?php

include_once("configs/Database.php");
include_once("configs/Constant.php");

class Model {
	private $apiURL;
	private $secret_key;
	private $header;
	private $db_conn;
	
    
	function __construct()
	{
		$this->apiURL 		= API_HOST."disburse";
		$this->db_conn 		= new Database;
		$this->db_conn		= $this->db_conn->getConnection();

		$this->secret_key 	= "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
		$this->header 		= array("Content-Type: application/x-www-form-urlencoded");
		date_default_timezone_set('Asia/Jakarta');
	}


	function saveData($param)
	{	

		$result = $this->api_parse($this->apiURL,$param);
		$result = json_decode($result); 

		$request_id 	= ''; 
		$request_status = '';
		$request_receipt= '';
		$time_served 	= ''; 

		if (isset($result->status) === true) {
			$request_id 	= $result->id;
			$request_status = $result->status;
			$request_receipt= $result->receipt;
			$time_served 	= $result->time_served;
		}

		$api_request = json_encode($param);
		$api_response = json_encode($result);	
		
		$dateNow = date('Y-m-d H:i:s'); 
        if ($result!=null) {
            try {
				echo "inside if";
                $ps = $this->db_conn->prepare("INSERT INTO disburse_log(req_id,req_status,req_receipt,time_served,api_request,api_response,insert_date,update_date) VALUES (:reqId,:reqStatus,:reqReceipt,:timeServed,:requestApi,:respApi,:insDate,:updDate)");
                $ps->bindParam(":reqId", $request_id);
                $ps->bindParam(":reqStatus", $request_status);
                $ps->bindParam(":reqReceipt", $request_receipt);
                $ps->bindParam(":timeServed", $time_served);
                $ps->bindParam(":requestApi", $api_request);
                $ps->bindParam(":respApi", $api_response);
                $ps->bindParam(":insDate", $dateNow);
				$ps->bindParam(":updDate", $dateNow);
				
				$ps->execute();
            }catch(PDOException $e){
				echo $e->getMessage();
			}
        }
	}

	function updateStatus($autoId)
	{
		$apiURL = $this->apiURL."/".$autoId;
		$result = $this->api_parse($apiURL,null);
		$result = json_decode($result); 
			
			$request_status = '';
			$request_receipt= '';
			$time_served 	= ''; 
	
			if (isset($result->status) === true) {
				$request_status = $result->status;
				$request_receipt= $result->receipt;
				$time_served 	= $result->time_served;
			}
			$api_response = json_encode($result);

			$dateNow = date('Y-m-d H:i:s'); 
			$psUp = $this->db_conn->prepare("UPDATE disburse_log  SET req_status =:reqStatus, req_receipt = :reqReceipt, time_served = :timeServed, api_response = :respApi, update_date = :updDate WHERE autoId=:autoId");
		
			$psUp->bindParam(":reqStatus",$request_status);
			$psUp->bindParam(":reqReceipt",$request_receipt);
			$psUp->bindParam(":timeServed",$time_served);
			$psUp->bindParam(":respApi",$api_response);
			$psUp->bindParam(":updDate",$dateNow);
			$psUp->bindParam(":autoId",$autoId);
			$psUp->bindParam($request_status,$request_receipt,$time_served,$api_response,$dateNow,$autoId);
			$psUp->execute();

	}

	function selectData()
	{

		$result = $this->db_conn->query("SELECT * FROM disburse_log");
		return $result;
	}	

	public function api_parse($url,$param)
	{

		$handle = curl_init();

		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handle, CURLOPT_HEADER, FALSE);
		curl_setopt($handle, CURLOPT_HTTPHEADER, $this->header);
		curl_setopt($handle, CURLOPT_USERPWD, $this->secret_key.":");

		if(isset($param)){
			curl_setopt($handle, CURLOPT_POST, TRUE);
			curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($param));
		}
		curl_setopt($handle, CURLOPT_VERBOSE, true);
		$verbose = fopen('php://temp', 'w+');
		curl_setopt($handle, CURLOPT_STDERR, $verbose);

		$result = curl_exec($handle);
		curl_close($handle);

		return $result;

	}
	
}

?>