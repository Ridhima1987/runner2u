<?php 
   include_once 'db-config.php';
   $json_location=array();
   
   $AllLocationQuery=$db->query("select * from tbl_customer_jobs");
   if($AllLocationQuery->num_rows>0){
	   while($LocationArray=$AllLocationQuery->fetch_array()){
		   $senderId=$LocationArray['sender_id'];
		   $CustomerNameQuery=$db->query("select customer_name from tbl_customer_registration where customer_id=$senderId")->fetch_array();
		   $Job_id=$LocationArray['job_id'];
		   $CustomerName=$CustomerNameQuery['customer_name'];
		   $GoodType=$LocationArray['good_type'];
		   $PickUpLoc=$LocationArray['pick_up_location'];
		   $DelLocation=$LocationArray['delivery_location'];
		   $PicUpDate=$LocationArray['pick_up_date'];
		   $PicUpTime=$LocationArray['pick_up_time'];
		   $DelDate=$LocationArray['delivery_date'];
		   $Price=$LocationArray['good_price'];
		   $json_location[]=array(
		   "job_id"=>$Job_id,
		      "customer_name"=>$CustomerName,
			  "good_type"=>$GoodType,
			  "pick_location"=>$PickUpLoc,
			  "del_location"=>$DelLocation,
			  "pick_date"=>$PicUpDate,
			  "pick_time"=>$PicUpTime,
			  "delivery_date"=>$DelDate,
			  "price"=>$Price
		   );
	   }
   }else{
	   $json_location[]=array("status"=>"ok","response"=>"No Rows Found.");
   }
   
   echo json_encode($json_location);
   
?>