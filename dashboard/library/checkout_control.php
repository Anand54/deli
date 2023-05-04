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
        $update_query="UPDATE `vendor_checkout` SET `order_confirmed`='1',`remarks`='$remarks' WHERE `id`=$checkout_ID AND `vendor_email` ='$checkoutEmail'";
        if(run_update_query($update_query)){
            $response=array("status_code"=>"200","message"=>"success");

            // quantity update
            // get product id from server
            $product_id=[];
            $quantity=0;
            $availableQty=0;
            $select_discount_percent="SELECT `product_id`,`availableQty`,`order_quantity` FROM `vendor_checkout_items`
            INNER JOIN product on product.id = `vendor_checkout_items`.product_id WHERE `vendor_checkout_id` ='$checkout_ID';";
            $datas = get_Table_Data($select_discount_percent);
            foreach($datas as $data){
            $product_id =$data['product_id'];
            $quantity = $data['order_quantity'];
            $availableQty = $data['availableQty']; 
            $diff_quantity=0;
            $get_quantity_diffrence_quary = "select (sum($availableQty)- sum($quantity)) as diffQty from vendor_checkout_items ci inner join product p on ci.product_id=p.id where p.id='$product_id' and ci.vendor_checkout_id='$checkout_ID';";
            $req_data = get_Table_Data($get_quantity_diffrence_quary);
            foreach($req_data as $da){
            $diff_quantity= $da['diffQty'] ; 


            // api part start.............................................................
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://myomsapi.globaltechsolution.com.np:802/api/Order/BToBSaveOrder',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "DbName": "demospec01",
                "UserCode": "oms",
                "Remarks": "Confirm",
                "GLCode": "1050",
                "Lat": "",
                "Lng": "",
                "BToBorderDetails": [
                    {
                        "Pcode": "100",
                        "Qty": "12",
                        "Rate": "10",
                        "TotalAmt": "120"
                    }
                ]
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

            //api part end................................................................


            $update_available_quantity= "
                update product  set availableqty= $diff_quantity
                where product.id='$product_id';";
                    if(run_update_query($update_available_quantity)){
                        $response=array("status_code"=>"200","message"=>"Quantity update success");
                    }else{
                        $response=array("status_code"=>"201","message"=>"failure to update quantity");
                    }
            }
            }
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