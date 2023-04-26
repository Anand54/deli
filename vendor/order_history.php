<?php include "header.php"; 
?>
<div class="topbar  pt-3 mb-2"><a class="btn"><i class="bi bi-list p-3" id="colpsCustom"></i></a><span class="p-3 fw-bold mt-3">Order
        History</span>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th>S.N</th>
      <th>Order Date</th>
      <th>No.of Product Order</th>
      <th>Action</th>
    </tr>
  </thead>
    <tbody>
    
    <tr>
      <td>1</td>
      <td>32</td>
      <td>3</td>
      <td class="col-2">
          <a href="#" style="text-decoration:none; color:black;"><i class="bi bi-eye toggleBtn"></i></a>
       <a class="ms-2 deleteBtn" herf="#" ><i class="bi bi-trash2-fill text-danger"></i></a>
      <a href="vendor_invoice.php"  class="printClass" target="blank"><i class="bi bi-printer-fill"></i></a>
      </td>
    </tr>
    <tr class="childTable">
        <td></td>
        <td colspan="3">
         <table class="table">
              <thead>
                <tr>
                  <th >S.N</th>
                  <th >Category</th>
                  <th >Product Code</th>
                  <th >Product</th>
                  <th>Price</th>
                  <th >Quantity</th>
                  <th >Amount</th>
                  <th >Discount(20%)</th>
                  <th >Total</th>
                  <th >Image</th>
                </tr>
              </thead>
                <tbody>
                 
                <tr>
                  <td>1</td>
                  <td>anand</td>
                  <td>1223</td>
                  <td>kjgjh</td>
                  <td>sssss</td>
                  <td>qqq</td>
                  <td>wwwww</td>
                  <td>jkjkkkk</td>
                  <td class="totalAfterDis">hhjh</td>
                  <td class="col-1"><img src="sssss" class="w-100"></td>
                </tr>
                   
                <tr class="fw-bold">
                    <td  colspan="8">Total</td>
                    <td Id="totalAfterDiscount">Rs. 20</td>
                </tr>
              </tbody>
            </table> 
            </td>
      </tr>
   
  </tbody>
</table>
</div>
<script>
$(document).ready(function(){
    // $(".printClass").click(function(){
    //     // $(".hideSidebarwhileprint").css("display", "none");
    //     window.print();
    //     return false;
    // });
    
    $(".deleteBtn").click(function(){
      var checkoutID = $(this).attr('data-checkouTID');
      var vendorEmail = "anand@gmail.com";
     if(confirm("Are you sure you want to delete order list ?")){
     if(checkoutID==""||vendorEmail==""){
         alert("facing problem");
     }
     else{
        $.ajax({
        url: "../../assets/library/vendorControl.php",
        method: "POST",
        data: {delete_order_list:checkoutID,vendor_email:vendorEmail},
        success: function (data) {
            console.log(data);
            var da = JSON.parse(data);
            if(da.status_code==200){
                location.reload();
            }
            else if(da.status_code!=220){
                
            }
            else{
               
            }
        }
      });
     }
    }
    });
    
    $(".childTable").css("visibility", "collapse");
    $(".toggleBtn").click(function(){
        // alert('clicked');
     var vis = $(this).parent().parent().parent().next('.childTable').css("visibility");
     if(vis=="collapse"){
      $(this).parent().parent().parent().next('.childTable').css("visibility","visible"); }
      else{
      $(this).parent().parent().parent().next('.childTable').css("visibility","collapse"); }
    });
});


</script>
<?php
include "footer.php" 
?>

    