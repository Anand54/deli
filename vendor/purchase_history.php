<?php include "header.php"; ?>

<div class="topbar  pt-3 mb-2"><a class="btn"><i class="bi bi-list p-3" id="colpsCustom"></i></a><span class="p-3 fw-bold mt-3">Purchase
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
      <td>aaaa</td>
      <td>bbbbbbbbbbbbb</td>
      <td>ccccc</td>
      <td>ddddd
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
                  <td>a</td>
                  <td>bbbb</td>
                  <td>ccc</td>
                  <td>ddddd</td>
                  <td>eeeeee</td>
                  <td>ffff</td>
                  <td>ggggg</td>
                  <td>hhhh</td>
                  <td>iiiii</td>
                  <td>jjjjjj</td>
                </tr>
                  
                     <tr class="fw-bold">
                    <td  colspan="8">Total</td>
                    <td Id="totalAfterDiscount">Rs.20</td>
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
    
    $(".printPurchaseHIstry").click(function(){
        // $(".hideSidebarwhileprint").css("display", "none");
        window.print();
        return false;
    });
    
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