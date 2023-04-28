<?php
include "connect_server.php";
if(isset($_POST['delete_order_list'])){
    $list_id=$_POST['delete_order_list'];
    $_email=$_POST['vendor_email'];
    $response=remove_list($list_id,$_email);
    echo json_encode($response);
}

function remove_list($list_id,$_email){
    $response='';
    $check_exist="SELECT IF ( EXISTS (SELECT * FROM `vendor_checkout` WHERE `vendor_email`='$_email' AND `id`=$list_id),1,0) as result;";
    if(check_if_exist($check_exist)){
        // echo "List exist";
        $check_exist="SELECT IF ( EXISTS (SELECT * FROM `vendor_checkout_items` WHERE `vendor_checkout_id`=$list_id),1,0) as result;";
        if(check_if_exist($check_exist)){
            // echo "Sub List exist";
            $del_qry="DELETE FROM `vendor_checkout_items` WHERE `vendor_checkout_id`=$list_id";
            if(run_delete_query($del_qry)!=0){
                //delete sub list succes
                //now delete main list
            $del_qry="DELETE FROM `vendor_checkout` WHERE `vendor_email`='$_email' AND `id`=$list_id";
             if(run_delete_query($del_qry)!=0){
                 $response=array(
                     'status_code'=>'200',
                     'message'=>'success',
                     'message_2'=>'delete success'
                     );
             }else{
                 $response=array(
                     'status_code'=>'200',
                     'message'=>'success',
                     'message_2'=>'sublist deleted but cannot delete main list'
                     );
             }
            }else{
                $response=array(
                     'status_code'=>'201',
                     'message'=>'error',
                     'message_2'=>'cannot delete sub list'
                     );
            }
        }else{
            // echo "Sub list not exist so delete list only";
             $del_qry="DELETE FROM `vendor_checkout` WHERE `vendor_email`='$_email' AND `id`=$list_id";
             if(run_delete_query($del_qry)!=0){
                 $response=array(
                     'status_code'=>'200',
                     'message'=>'success',
                     'message_2'=>'delete success'
                     );
             }else{
                 $response=array(
                     'status_code'=>'201',
                     'message'=>'error',
                     'message_2'=>'cannot delete list'
                     );
             }
        }
    }else{
        // echo "list not exist";
        $response=array(
                     'status_code'=>'201',
                     'message'=>'error',
                     'message_2'=>'list doesnot exist'
                     );
    }
    return $response;
}

?>