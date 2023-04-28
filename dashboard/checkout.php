<?php include "header.php"; ?>
<div class="col-6 d-flex">
  <div class="p-1 mb-2 col-5 bg-dark text-white text-center">Vendor Checkout List</div>
</div>

<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th>S.N</th>
      <th>Order Date</th>
      <th>User Type</th>
      <th>Company Name</th>
      <th>Contact</th>
      <th>No.of Product Order</th>
      <!-- <th>Status</th> -->
      <th>Action</th>
    </tr>
  </thead>
    <tbody>
    <?php 
        $checkoutID = '';
        // $query_checkoutQry = "SELECT `id` as checkoutID, `vendor_email`, `order_confirmed`,`product_count`, `order_place_date` FROM `vendor_checkout` ";
         $query_checkoutQry = "SELECT vendor_checkout.`id` as checkoutID, vendor_checkout.`vendor_email`,`user_type`,`vendor_contact`, `vendor_company_name`, `product_count`,`order_confirmed`, `order_place_date`,`order_dispatched_date`, `order_delivered_date` FROM `vendor_checkout` inner JOIN  vendor_users ON vendor_users.vendor_email = vendor_checkout.vendor_email WHERE vendor_checkout.archived=0 AND `process_completed` ='0';";
        $conn = dbConnecting();
        $req_checkout = mysqli_query($conn, $query_checkoutQry) or die(mysqli_error($conn));
        if (mysqli_num_rows($req_checkout) > 0) {
            $i = 1;
            while ($data_show = mysqli_fetch_assoc($req_checkout)) {
                 $checkoutID = $data_show['checkoutID'];
                 $order_Status=$data_show['order_confirmed'];
                 $orderDispatch = $data_show['order_dispatched_date'];
                 $orderDeliver = $data_show['order_delivered_date'];
                 $vendor_email=$data_show['vendor_email'];
    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data_show['order_place_date'] ?></td>
                <td><?php echo $data_show['user_type'] ?></td>
                <td><?php echo $data_show['vendor_company_name'] ?></td>
                <td><?php echo $data_show['vendor_contact'] ?></td>
                <td><?php echo $data_show['product_count'] ?></td>
                <td>
                    <?php 
                        $checkConfirm = $data_show['order_confirmed']; 
                        if($checkConfirm==0){
                            echo'<a href="#" class="orderConfirm" data-pID="'.$checkoutID.'" data-email="'. $vendor_email.'"><i class="bi bi-cart-dash-fill text-primary"></i></a>';
                        }
                        else if($checkConfirm==1){
                             echo'<a href="#" class="closeOrder" data-checkoutID="'.$checkoutID.'"><i class="bi bi-cart-check-fill text-success"></i></a>';
                        }
                    ?> 
                    <a href="vendor_invoice.php?ref=<?php echo $vendor_email; ?>& id=<?php echo $checkoutID; ?>" target="blabk"><i class="bi bi-printer text-primary"></i></a> 
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
        $('.orderConfirm').click(function(){
            var checkoutID = $(this).attr('data-pID');
            var checkoutEmail = $(this).attr('data-email');
            var confirmByEmail = "<?php echo $_SESSION['adminemail']; ?>";
            if(checkoutID==""||checkoutEmail==""){
                alert("Some data not found");
            }
            else{
                if(confirm("Are you sure you want to confirm the order ?")){
                $.ajax({
                    url: "library/checkout_control.php",
                    method: "POST",
                    data: {order_confirmation:checkoutID,checkoutEmail:checkoutEmail,confirmByEmail:confirmByEmail},
                    success: function (data) {
                        console.log(data);
                        var da = JSON.parse(data);
                        if(da.status_code==200){
                            location.reload();
                        }
                        else if(da.status_code!=200){
                           alert("error"); 
                        }
                        else{
                        
                        }
                    }
            });
            }
            }
        });


        $('.closeOrder').click(function(){
            var checkoutID = $(this).attr('data-checkoutID');
            var confirmByEmail = "<?php echo $_SESSION['adminemail']; ?>";
            if(checkoutID==""||confirmByEmail==""){
                alert("Some data not found");
            }
            else{
                if(confirm("Is the bill clear of this order ?")){
                $.ajax({
                    url: "library/checkout_control.php",
                    method: "POST",
                    data: {order_close:checkoutID,confirmByEmail:confirmByEmail},
                    success: function (data) {
                        console.log(data);
                        var da = JSON.parse(data);
                        if(da.status_code==200){
                            location.reload();
                        }
                        else if(da.status_code!=200){
                           alert("error"); 
                        }
                        else{
                        
                        }
                    }
            });
            }
            }
        });
    });
</script>

<?php
include "footer.php" 
?>

    