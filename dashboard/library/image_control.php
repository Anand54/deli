<?php
 include "connect_server.php"; 
 if(isset($_POST['insert_product_name'])){
    $response ="";
    $image = $_POST['insert_product_name'];
    $image_path = "img/products/";
    $productId = $_POST['productId'];
    $id= get_primary_id("product_image");
    $conn = dbConnecting();
    $check_query="SELECT IF (EXISTS (SELECT * FROM `product_image` WHERE `product_id`= '$productId'),1,0) as result;"; //echo $check_query;
    $result=check_if_exist($check_query);
    if($result=="1"){
        $update_image="UPDATE `product_image` SET `image_path`='$image_path',`image`='$image' WHERE `product_id` = '$productId';";
        // echo $update_image;
        $Req_update = mysqli_query($conn, $update_image);
        if($Req_update){
                $response=array(
                    'status_code'=>'200',
                    'message'=>'Update image success'
                );
        }
        else{
            $response = array(
               'status_code'=>'201',
               'messaage' => 'Update Failed'
               );
        }
    }
    else if($result=="0"){
        $insert_image="INSERT INTO `product_image`(`id`,`product_id`, `image_path`, `image`) VALUES ('$id','$productId','$image_path','$image');";
       // echo $insert_image;
        $Req = mysqli_query($conn, $insert_image);   
        if($Req='1'){
            $response=array(
                'status_code'=>'200',
                'message'=>'Insert image success'
            );  
        } 
        else{
            $response = array(
               'status_code'=>'201',
               'messaage' => 'insert image Failed'
            );
        }
    } 
    echo json_encode($response);
 }
 ?>