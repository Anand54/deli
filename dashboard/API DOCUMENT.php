post method:
 http://myomsapi.globaltechsolution.com.np:802/api/Order/BToBSaveOrder
{
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
}

get method:
http://myomsapi.globaltechsolution.com.np:802/api/MasterList/StockReportApp?DbName=demospec01&BranchCode'