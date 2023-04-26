<?php include "header.php" ?>
<style>
    table.dataTable tbody td {
  padding: 1px 34px !important;
    }
  .dt-button{
height: 33px !important;
font-size: 10px !important;
padding: 7px !important;
    }

</style>
<div class="col-12">
  <div class="col-12 d-flex">
    <div class="p-1 mb-2 bg-dark text-white text-center text-uppercase">
      <div>Vendor List</div>
    </div>
  </div>
  <!-- datatable start -->
  <!-- datatable start -->
  <table id="table_id" class="display">
    <thead>
      <tr style="font-size:13px;">
        <th>S.N.</th>
        <th>Type</th>
        <th>Username</th>
        <th class="col-1">Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT  `active_state`,`user_type`,`discountPercent`,`vendor_company_name`, `vendor_email`, `vendor_pass`, `vendor_contact`, `vendor_pan`, `vendor_vat`, `vendor_address`, `create_date`, `deactivate_date`, `remarks` FROM `vendor_users` ORDER BY `id` DESC;";
            $conn = dbConnecting();
            $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
              $i = 1;
              while ($data = mysqli_fetch_assoc($req)) { 
              ?>
              <tr>
                    <td style="font-size:1rem;"><?php echo $i; ?></td>
                    <td style="font-size:1rem;"><?php echo $data["user_type"]; ?></td>
                    <td style="font-size:1rem;"><?php echo $data["vendor_company_name"]; ?></td>
                    <td style="font-size:1rem;"><?php echo $data["vendor_email"]; ?></td >
                    <td style="font-size:1rem;"><?php echo $data["vendor_contact"]; ?></td >
                    <td style="font-size:1rem;"><?php echo $data["vendor_address"]; ?></td >
                    <td class="row" style="font-size:1rem;">
                        <a class="disCount" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-disCount="<?php echo $data["discountPercent"]; ?>" data-vendorEmail="<?php echo $data["vendor_email"]; ?>"><i class="bi bi-pen"></i></a>
                        <div class="form-check form-switch"><input <?php if($data['active_state']){echo "checked";} ?> class="form-check-input toggle_active" style="border-color: transparent;" data-email="<?php echo $data["vendor_email"]; ?>" id="toggleCheck" type="checkbox" role="switch">
                                    <label class="form-check-label lbl_active">
                                      <?php if($data['active_state']){echo "Active";}else{echo "InActive";} ?>
                                    </label>
                        </div>
                       
                    </td>

                  </tr>
                  <?php
                $i++;
              }
            }
            ?>
    </tbody>
  </table>
  <!-- datatable end -->
  <!-- datatable end -->
</div>
</div>

<script>
  $(".disCount").click(function () {// button class where button clicked
    var vendorEmail = $(this).attr("data-vendorEmail"); //attribute from button data-category
    $("#vEml").attr("value", vendorEmail.trim());
    var disCount = $(this).attr("data-disCount");
     $("#vendorDiscount").attr("value", disCount.trim());
  });
</script>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Client Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" class="form-control" id="vEml">
           <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">Client Type</span>
                <select class="form-select" aria-label="Default select example" id="clientType">
                  <option class="selectOption">Select</option>
                  <option value="Wholesaler">Wholesaler</option>
                  <option value="Retailer">Retailer</option>
                  <option value="Dealer">Dealer</option>
                </select>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">Discount</span>
              <input type="text" class="form-control" id="vendorDiscount">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitDisc">Save</button>
      </div>
    </div>
  </div>
</div>




<script>
$(document).ready(function(){
    
    $("#submitDisc").click(function(){
        var clientType = $("#clientType").val();
        var vendorEml = $("#vEml").val();
        var vendorDiscount = $("#vendorDiscount").val();
        // alert(vendorEml);  alert(vendorDiscount);
        if(vendorEml==""||vendorDiscount==""){
            alert("Fill the form properly");
        }
        else{
                $.ajax({
                type: 'POST',
                url: 'library/vendorControl.php',
                data: {insert_vendor_discount_percent:vendorEml,vendorDiscount:vendorDiscount,clientType:clientType},
                success: function (data) {
                    console.log(data);
                   var da = JSON.parse(data);
                    if(da.status_code==200){
                        // alert("New vendor added successfully");
                        location.reload();
                    }else{
                        alert("Unable to add discount(%)");
                    }
                }
            }); 
        }
    });
    
    $("#clientType").click(function(){
     $(".selectOption").hide();  
    });
    
        
            $(document).on('click', '.toggle_active', function() { 
            //  alert("toggle_active");
             $(this).addClass('clicked');
            var user_email=$(this).attr("data-email");
            if($(this).prop("checked")==true){
                // alert('checked');
                // alert(user_email);
                if(confirm("Are you sure you want to active vendor ?")){
                $.ajax({
                url: 'library/vendorControl.php',
                type: 'POST',
                data: { toggle_active_vendor: 1, user_email: user_email },
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                }
            });
            }
            $('.clicked').next(".lbl_active").text("Active");
            $('.clicked').removeClass('clicked');
            }else{
                // alert('uncheck');
                if(confirm("Are you sure you want to inactive vendor ?")){
                $.ajax({
                url: 'library/vendorControl.php',
                type: 'POST',
                data: { toggle_active_vendor: 0,user_email: user_email },
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                },
            });
           }
            $('.clicked').next(".lbl_active").text("InActive");
            $('.clicked').removeClass('clicked');
            }
        });
});

</script>



<?php include "footer.php"; ?>