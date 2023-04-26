<?php
 include "connect_server.php"; 

if(isset($_POST['insert_vendor_discount_percent'])){
    $response='';
    $vendor_email = $_POST['insert_vendor_discount_percent'];
    $vendorDiscount = $_POST['vendorDiscount'];
    $clientType = $_POST['clientType'];
    $check_query="SELECT IF (EXISTS (SELECT * FROM `vendor_users` WHERE `vendor_email`='$vendor_email'),1,0) as result;"; //echo $check_query;
    $result=check_if_exist($check_query); //echo  $result;
    if($result==0){
        $response = array(
        'message' => 'Email not found',
        'status_code' => '404'
    );
    }
    else if($result==1){
         $discount_query = "UPDATE `vendor_users` SET `discountPercent`='$vendorDiscount',`user_type`='$clientType' WHERE `vendor_email` ='$vendor_email';"; //echo $discount_query;
        $conn = dbConnecting();
        $Res = mysqli_query($conn, $discount_query);
        if($Res){
                $response=array(
                    'status_code'=>'200',
                    'message'=>'success'
                );
        }
        else{
            $response = array(
               'status_code'=>'201',
               'messaage' => 'Failed'
               ); 
        }
    }
    echo json_encode($response);
}

if(isset($_POST['toggle_active_vendor'])){
    $state_is=$_POST['toggle_active_vendor'];
    $email = $_POST['user_email'];
    $update_ok = run_toggal_state_vendor($state_is,$email);
    $response='';
    if($update_ok){
        $response = array(
        'message' => 'success',
        'status_code' => '200'
    );
    }else{
        $response =array(
        'message' => 'failure',
        'status_code' => '201'
    );
    }
    echo json_encode($response);
}

function run_toggal_state_vendor($state_is,$email){
    if($state_is){
        $check_qry = "SELECT IF (EXISTS(SELECT * FROM vendor_users WHERE `vendor_email`='$email' and `active_state`='$state_is'),1,0)as result;";
        $result = check_if_exist($check_qry);
        if($result){
            return 1;
        }else{
        $update_toggle_query="UPDATE `vendor_users` SET `active_state`='$state_is',`remarks`= now() WHERE `vendor_email` ='$email';";
            $to = $email;
            $subject ="Vendor User Activated";
            $message ="Dear ".$email." your account has veen activated. Now you can login as a vendor user. http://delinepal.com/vendor_login/";
            $from = "account@delinepal.com";
            $header = "From: $from";
            mail($to,$subject, $message,$header);
        return run_update_query($update_toggle_query);
        }
    }else{
        $check_qry = "SELECT IF (EXISTS(SELECT * FROM vendor_users WHERE `vendor_email`='$email' and `active_state`='$state_is'),1,0)as result;";
        $result = check_if_exist($check_qry);
        if($result){
            return 1;
        }else{
        $update_toggle_query="UPDATE `vendor_users` SET `active_state`='$state_is',`remarks`= now() WHERE `vendor_email` ='$email';";
        return run_update_query($update_toggle_query);
        }
    }
}
?>