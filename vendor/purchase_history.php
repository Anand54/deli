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
    <?php
        $orderConfirm='';
        $checkoutID = '';
        $vendorEmail = $_SESSION['vendor_email'];
        $query_checkoutQry = "SELECT  `id` as checkoutID,`order_confirmed`,process_completed,`product_count`, `order_place_date` FROM `vendor_checkout` WHERE `vendor_email` ='$vendorEmail' AND `process_completed`='1';";
        $conn = dbConnecting();
        $req_checkout = mysqli_query($conn, $query_checkoutQry) or die(mysqli_error($conn));
        if (mysqli_num_rows($req_checkout) > 0) {
            $i = 1;
            while ($data_show = mysqli_fetch_assoc($req_checkout)) {
                 $checkoutID = $data_show['checkoutID'];
                 $orderConfirm = $data_show['order_confirmed'];
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data_show['order_place_date'] ?></td>
      <td><?php echo $data_show['product_count'] ?></td>
      <td><a href="#" style="text-decoration:none; color:black;" data-checkoutID="<?php echo $data_show['checkoutID']; ?>"><i class="bi bi-eye toggleBtn"></i></a>
      <a href="vendor_invoice.php?ref=<?php echo $vendorEmail; ?>& id=<?php echo $checkoutID; ?>" class="printClass" target="blank"><i class="bi bi-printer-fill"></i></a>
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
                  <th >Discount(<?php echo $discountPercent; ?>%)</th>
                  <th >Total</th>
                  <th >Image</th>
                </tr>
              </thead>
                <tbody>
                    <?php 
                         $query = "SELECT vendor_checkout_items.`id`, `pGroup`,`pCode`, `product`, `vendor_checkout_id`, `product_id`, `order_quantity`, `discountPercent`, `sales_rate`, `total_amt`, `discountAmount`, `total_after_discount` FROM `vendor_checkout_items` 
                                    INNER JOIN product ON product.id = vendor_checkout_items.product_id
                                    INNER JOIN category ON category.id = product.categoryID
                                    WHERE `vendor_checkout_id` ='$checkoutID';";
                         $conn = dbConnecting();
                        $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
                        $sumTotal=0.0;
                        if (mysqli_num_rows($req) > 0) {
                            $j = 1;
                            while ($data = mysqli_fetch_assoc($req)) {
                    ?>
                <tr>
                  <td><?php echo $j; ?></td>
                  <td><?php echo $data['pGroup']; ?></td>
                  <td><?php echo $data['pCode']; ?></td>
                  <td><?php echo $data['product']; ?></td>
                  <td><?php echo intval($data['sales_rate']); ?></td>
                  <td><?php echo $data['order_quantity']; ?></td>
                  <td><?php echo intval($data['total_amt']); ?></td>
                  <td><?php echo intval($data['discountAmount']); ?></td>
                  <td class="totalAfterDis"><?php echo intval($data['total_after_discount']); ?></td>
                </tr>
                    <?php
                    $sumTotal=$sumTotal+intval($data['total_after_discount']);
                    $j++;
                        }
                        }
                    ?>
                     <tr class="fw-bold">
                    <td  colspan="8">Total</td>
                    <td Id="totalAfterDiscount">Rs. <?php echo $sumTotal ?></td>
                </tr>
              </tbody>
            </table> 
            </td>
      </tr>
    <?php 
    $i++;
            }
            }
?>
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
      var vendorEmail = "<?php echo $_SESSION['vendor_email'] ?>";
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