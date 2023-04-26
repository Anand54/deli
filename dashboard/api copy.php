<?php 
include "header.php"; 
?>
<div class="p-3">
    <div class="text-center">
        <h3>Input API</h3>
    </div>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">API</span>
            <input type="text" class="form-control" id="inputApi" name="inputApi">
        </div>
        <button type="submit" class="btn btn-success" name="submitBtn" id="submitBtn">Submit</button>
    </form>
</div>

<?php
include "library/connect_server.php";

if (isset($_POST['submitBtn'])) {
    $url = trim($_POST['inputApi']);
    echo "<br>Submit clicked with api : " . $url;
    $data1 = apiCal($url);
    inject_api_Data($data1);
}

function inject_api_Data($data1)
{
    $insert_query = '';
    $tblName = 'productMaster';
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
            $id = get_primary_id($tblName);
            $prepared_insert_query = "INSERT INTO `productMaster` (`id`, `pCode`, `Product`, `pGroup`, `subGroup`, `unit`, `balanceQty`, `altBalanceQty`, `stockValue`, `rate`,`pStatus`) VALUES($id,'$code','$product','$group','$subGroup','$unit','$balanceQty','$altBalanceQty','$stockValue','$rate',1);";
            // $id++;
            // $insert_query = $insert_query . $prepared_insert_query;
            if (!run_insert_query($prepared_insert_query)) {
                echo "Data insert Stopped Due to some conflict";
                die();
            } else {

                // echo $prepared_insert_query . "<br>";
                echo "Data inserted <hr>";
            }
        }
    }
}
function apiCal($url)
{
    // Set API URL
    // $url = 'http://myomsapi.globaltechsolution.com.np:802/api/MasterList/StockReportApp?DbName=demospec01&BranchCode';

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
?>

<?php 
include "footer.php"; 
?>