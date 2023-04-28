<?php include "header.php"; ?>
<div class="col-6 d-flex">
  <div class="p-1 mb-2 col-5 bg-dark text-white text-center">Vendor Checkout Completed List</div>
</div>

<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th>S.N</th>
      <th>Order Date</th>
      <th>User Type</th>
      <th>Company Name</th>
      <th>No.of Product Order</th>
      <th>View Detail</th>
    </tr>
  </thead>
    <tbody>
    <?php 
        $checkoutID = '';
        $query_checkoutQry = "SELECT vendor_checkout.`id` as checkoutID, vendor_checkout.`vendor_email`,`user_type`,`vendor_contact`, `vendor_company_name`,`product_count`,`order_confirmed`,`process_completed`,`order_place_date`,`order_dispatched_date`, `order_delivered_date` FROM `vendor_checkout` inner JOIN  vendor_users ON vendor_users.vendor_email = vendor_checkout.vendor_email WHERE `order_confirmed`='1' AND `process_completed` ='1';";
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
      <td><?php echo $data_show['product_count'] ?></td>
      <td>
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
    $(".childTable").css("display", "none");
    $(".toggleBtn").click(function(){
      $(this).parent().parent().parent().next('.childTable').toggle(); 
    });
</script>
<?php include "footer.php"; ?>