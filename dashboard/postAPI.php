<?php
$Pcode ='100';
$Qty ='2';
$Rate ='1100';
$TotalAmt ='2200';


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
    "BToBorderDetails": "'getOrderDataList()'";
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

function  getOrderDataList() async {
    $items = "";
    $items += "[";
    if (!n) {
      for (int i = 0; i < n.length; i++) {
        if (i < (n.length - 1)) {
           items += ' { "Pcode": "${n[i]["PCode"]}", "Qty": "${n[i]["Qty"]}", "Rate": "${n[i]["Rate"]}", "TotalAmt": "${n[i]["TotalAmt"]}" },';
        } else {
           items += ' { "Pcode": "${n[i]["PCode"]}", "Qty": "${n[i]["Qty"]}", "Rate": "${n[i]["Rate"]}", "TotalAmt": "${n[i]["TotalAmt"]}" }';
        }
      }
    }
     $items += "]";

    CustomLog.successLog(value: "items =>  $items");
    return jsonDecode(items);
  }

?>





// [
//         {
//             "Pcode": "100",
//             "Qty": "12",
//             "Rate": "10",
//             "TotalAmt": "120"
//         }

//     ]



