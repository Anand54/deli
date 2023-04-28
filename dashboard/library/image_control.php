<?php
 include "connect_server.php"; 
 if(isset($_POST['insert_product_name'])){
    $response ="";
    $image = $_POST['insert_product_name'];
    $productId = $_POST['productId'];
    $id= get_primary_id("");
    $check_query="SELECT IF (EXISTS (SELECT * FROM `product_image` WHERE `product_id`= '$productId'),1,0) as result;";
    $result=check_if_exist($check_query);
    if($result="1"){
        $response = array(
        'message' => 'Duplicate',
        'status_code' => '404'
        );
    }
    else{

    } 
 }
 ?>