<?php
 include "connect_server.php"; 

 if(isset($_POST['order_confirmation'])){
    $response='';
    $checkout_ID=$_POST['order_confirmation'];
    $checkoutEmail=$_POST['checkoutEmail'];
    $action_user = $_POST['confirmByEmail'];
    $check_query="SELECT IF (EXISTS (SELECT * FROM `vendor_checkout` WHERE `id`='$checkout_ID' AND `vendor_email` ='$checkoutEmail'),1,0) as result;";
    if(check_if_exist($check_query)){
        //update confirmation
        $remarks="Order Confirmed BY ".$action_user;
        $update_query="UPDATE `vendor_checkout` SET `order_confirmed`='1',`remarks`='$remarks' WHERE `id`=$checkout_ID AND `vendor_email` ='$checkoutEmail';";
        if(run_update_query($update_query)){
            $response=array("status_code"=>"200","message"=>"success");
        }else{
            $response=array("status_code"=>"201","message"=>"failure");
        }
    }else{
        $response=array("status_code"=>"404","message"=>"Not Found");
    }
    echo json_encode($response);
}


 if(isset($_POST['order_close'])){
    $response='';
    $checkout_ID=$_POST['order_close'];
    $action_user = $_POST['confirmByEmail'];
    $check_query="SELECT IF (EXISTS (SELECT * FROM `vendor_checkout` WHERE `id`='$checkout_ID'),1,0) as result;";
    if(check_if_exist($check_query)){
        //update confirmation
        $remarks="Order Closed BY ".$action_user;
        $update_query="UPDATE `vendor_checkout` SET `process_completed`='1',`remarks`='$remarks' WHERE `id`=$checkout_ID;";
        if(run_update_query($update_query)){
            $response=array("status_code"=>"200","message"=>"success");
        }else{
            $response=array("status_code"=>"201","message"=>"failure");
        }
    }else{
        $response=array("status_code"=>"404","message"=>"Not Found");
    }
    echo json_encode($response);
}

 ?>