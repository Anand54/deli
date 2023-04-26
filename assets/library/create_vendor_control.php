<?php 
 include "function_here.php"; 
 if (isset($_POST['give_district_from_server'])) {
  $give_district_from_server = $_POST['give_district_from_server'];
  $check_exist = "SELECT IF (EXISTS(SELECT * FROM `address` WHERE province='$give_district_from_server'),1,0) as result;";
  $result = check_if_exist($check_exist);
  if ($result == 1) {
    $sql = "SELECT distinct `district` FROM `address` WHERE `province` = '$give_district_from_server';";
    $data = get_Table_Data($sql);
    $response = array(
      "message" => "success",
      "status_code" => '200',
      "address" => $data
    );
    echo json_encode($response);
  } else {
    $response = get_response(501);
    echo json_encode($response);
  }
}

if (isset($_POST['give_municipality_from_server'])) {
  $give_municipality_from_server = $_POST['give_municipality_from_server'];
  $check_exist = "SELECT IF (EXISTS(SELECT * FROM `address` WHERE district='$give_municipality_from_server'),1,0) as result;";
  $result = check_if_exist($check_exist);
  if ($result == 1) {
    $sql = "SELECT DISTINCT `municipality` FROM `address` WHERE `district` = '$give_municipality_from_server';";
    $data = get_Table_Data($sql);
    $response = array(
      "message" => "success",
      "status_code" => '200',
      "address" => $data
    );
    echo json_encode($response);
  } else {
    $response = get_response(501);
    echo json_encode($response);
  }
}

if(isset($_POST['register_vendor_user'])){
    //response
    $response="";
    //operation
    $company_name = $_POST['register_vendor_user'];
    $email = $_POST['venEmail'];
    $user_type = "Null";
    $pass = $_POST['Password'];
    $vat = $_POST['Vatno']; if($vat==''){$vat=0;}
    $pan = $_POST['panno']; if($pan==''){$pan=0;}
    $contact = $_POST['contact'];
    $address = $_POST['province'].", ".$_POST['district'].", ".$_POST['municipality'];
    $id = get_primary_id('vendor_users');
    $check_exist = "SELECT IF (EXISTS (SELECT * FROM `vendor_users` WHERE `vendor_company_name`='$company_name' AND `vendor_email`='$email'),1,0) as result;";
    if($vat=='0' && $pan=='0'){
        $response = give_response(201);
    }
    else if(check_if_exist($check_exist)){
        $response = give_response(55);
    }else{
        $enc_pass=md5($pass);
        $ins_qry="INSERT INTO `vendor_users` (`id`,`active_state`,`user_type`, `vendor_company_name` , `vendor_email`, `vendor_pass`, `vendor_contact`, `vendor_pan`, `vendor_vat`, `vendor_address`, `remarks`) VALUES ($id,'0','$user_type','$company_name','$email','$enc_pass','$contact','$pan','$vat','$address','');";
        // echo $ins_qry;
        $conn = dbConnecting();
        $req_insert = mysqli_query($conn,$ins_qry);
        if($req_insert){
            $to = $email;
            $subject ="Vendor User Created";
            $message ="Dear ".$email." Delinepal received your details for registration. Please wait for the conformation. Thank you.";
            $from = "account@delinepal.com";
            $header = "From: $from";
            mail($to,$subject, $message,$header);
            $response = array("status_code"=>200,
            "message"=>'success');
        }else{
            $response = array("status_code"=>201,
            "message"=>'Failure');
        }
    }
    echo json_encode($response);
}
 ?>