<?php
// include "library/connect_server.php";
include "header.php";

$url = 'http://myomsapi.globaltechsolution.com.np:802/api/MasterList/StockReportApp?DbName=demospec01&BranchCode';

$data1 = apiCal($url);
inject_api_Data($data1);

function inject_api_Data($data1)
{
    $insert_query = '';
    $tblName = 'category';
    $tblName = 'product';
    if (!delete_existing($tblName)) {
        echo "Cannot Delete Data";
    } else {
        // $id=give_primary_id($tblName);
        foreach ($data1['data'] as $da) {
            // echo $da['Code']."<br>";
            $code = $da['Code'];
            $product = $da['Product'];
            $group = $da['Group'];
            $subGroup = $da['SubGroup'];
            $unit = $da['Unit'];
            $balanceQty = $da['BalanceQty'];
            $altBalanceQty = $da['AltBalanceQty'];
            $stockValue = $da['StockValue'];
            $rate = $da['Rate'];
            $cat_id = get_primary_id("category");
            $prepared_category_insert_query = "INSERT INTO `category`(`id`, `pGroup`, `remarks`) VALUES ('$cat_id',' $group','');";
            if (!run_insert_query($prepared_category_insert_query)) {
                echo "Data insert Stopped Due to some conflict";
                die();
            } else {
                // echo "Data inserted <hr>";
                $product_id = get_primary_id("product");
                $prepared_product_insert_query = "INSERT INTO `product`(`id`,`categoryID`,`pCode`, `product`, `unit`, `availableQty`, `rate`, `pStatus`) VALUES ('$product_id','$cat_id','$code','$product','$unit','$balanceQty','$rate','1');";
                if (!run_insert_query($prepared_product_insert_query)) {
                    echo "Data insert Stopped Due to some conflict";
                    die();
                } else {
                    echo "Data inserted <hr>";
                }
            }
        }
    }
}

function apiCal($url)
{
    // Initialize curl session
    $ch = curl_init();

    // Set curl options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute curl request
    $response = curl_exec($ch);

    // Close curl session
    curl_close($ch);

    // Print response
    // print_r($response);
    $data = json_decode($response, true);
    return $data;
}

include "footer.php"; 
