<?php 

  mysql_connect("localhost","speakgga","0T8b3u^T^0#E");
  mysql_select_db("speakgga_foodbroadcast") or die("No Db Selected");//to show error in db

 
  
   
	
    $NumberList="['895029647','8554588545']";

  
    $json_array_key=array();

    


$InsertQuery=mysql_query("insert into table values('','$NumberList')");

if($InsertQuery){
	$json_array_key[]=array("status"=>"ok","response"=>"Inserted Successfully");
}else{
	$json_array_key[]=array("status"=>"failed","response"=>"Failed to Insert.");
}

  
 
  
  echo json_encode($json_array_key);
  
  
?>