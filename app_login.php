<?php

include_once 'db-config.php';

$customer_email_id = $_POST['customer_email_phone'];
$customer_password = md5($_POST['customer_password']);
$customer_type=isset($_POST['customer_type'])?$_POST['customer_type']:"Customer";

$json_array=array();

$SelectFrom_tbl_customer_registration=$db->query("select * from tbl_customer_registration where (customer_email_id='$customer_email_id' or customer_phone_number='$customer_email_id') and customer_password='$customer_password' and customer_type='$customer_type'");


if($SelectFrom_tbl_customer_registration->num_rows>0){

		$Result=$SelectFrom_tbl_customer_registration->fetch_array();

        $Status=$Result['customer_status'];

	if($Status=="Pending"){
		$json_array[]=array("status"=>"failed","response"=>"Your Request is Not Confirmed , Login Credentials will activate within 24hrs.");
	}else if($Status=="Blocked"){
		$json_array[]=array("status"=>"failed","response"=>"Your Request is Blocked due to fake details .");
	}else if($Status=="Confirmed"){
		$json_array[]=array(
							  "customer_id" => $Result['customer_id'] ,
							    "customer_name" => $Result['customer_name'] ,
"customer_profile" => $Result['customer_profile_pic'] ,
								/*"customer_id_card_number" => $Result['customer_id_card_number'] ,
								"customer_phone_number" => $Result['customer_phone_number'] ,
								"customer_email_id" => $Result['customer_email_id'] ,*/
								"response"=>"Login Successful" 
							   // "customer_address" => $Result['customer_address']
											  );
	}

}else{
       $json_array[]=array("status"=>"failed","response"=>"Invalid Login.");
}

echo json_encode($json_array);

?>