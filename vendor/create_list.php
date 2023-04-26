
<div class="topbar pt-3 mb-2" ><a class="btn"><i class="bi bi-list p-3" id="colpsCustom"></i></a><span class="fw-bold mt-3">Products</span>
</div>
<div style="overflow:auto;" class="font_size_in_mobile">
<div class="row ms-3">
    <div class="col  input-group mb-3">
      <span class="input-group-text col-9" id="basic-addon1">List Name : &nbsp;
      <input type="text" class="form-control w-100" id="favlist" placeholder="Favorite List Name"></span>
    <!--</div>-->
    <!--    <div class="col  input-group mt-2 ms-3 mb-3">-->
        <button type="button" id="saveBtn" class="btn btn-success col-2 ms-2">Save</button>
    </div>
</div>
<input type="hidden" id="vendorEmail" >
   <table id="table_id" class="display">
        <thead>
            <tr>
                <th class="col-1">Select</th>
                <th >Category</th>  
                <th >Product Code</th>
                <th >Product</th>
                <th >Market Price</th>
                <th >Price</th>
                <th class="col-1">Image</th>
            </tr>
        </thead>
        <tbody class="vendor_table">
            
            <tr>
                <td>
                  <div class="form-check">
                      <input class="form-check-input checkItem"  type="checkbox" id="flexCheckDefault">
                    </div>
                </td>
                <td>
                 aaaa
                </td>
                <td>
                    bbbbbb
                </td>
                <td>
                   cccccc
                </td>
                <td>
                    dddddd
                </td>
                 <td>
                  eeeeee
                </td>
                 <td>
                   ffffff
                </td>
            </tr>
            <?php
            
            
            ?>
        </tbody>
    </table>
</div>

<script>
// $(document).ready(function(){
//     $("#saveBtn").click(function(){
//         if(<?php echo $list_counted;?>>=5){
//            alert("You can create only 5 Favorite List.")
//         }else{
//             var products_id=[];
//     var count=0;
//     $('.checkItem').each(function(){
//     if($(this).prop("checked")){
//         products_id.push($(this).attr('data-productID'));
//         count++;
//         }
//     });
//     console.log(products_id);
//     var favlist = $('#favlist').val();
//     var vendorEmail = $('#vendorEmail').val();
//       if(favlist==""){
//           alert("Please fill the form Properly");
//       }
//       else if(count<=3){
//         alert("Please select more then 3 item");  
//       }
//       else{
//         $.ajax({
//         url: "../../assets/library/vendorControl.php",
//         method: "POST",
//         data: {create_list:favlist,products_id:products_id,vendorEmail:vendorEmail},
//         success: function (data) {
//         var da = JSON.parse(data);
//         if(da.status_code ==200){
//         alert("List Created Successfully");
//         location.reload();
//         }
//         else if(da.status_code ==55){
//           alert("List name already exists.");   
//         }
//         else{
//             alert("Error processing request. Please try again.");
//         }
//         }
//       });
//       }
//         }
//     });
// });
</script>
<?php
include "footer.php"; 
?>
<script>
        $('#table_id').DataTable({
            scrollY:400,
            dom: 'Bfrtip',
            paging:false,
            buttons: [
            ]
        });
         $("#table_id").children("caption").css("display","none");
         $("#table_id_info").css("display", "none");

</script>