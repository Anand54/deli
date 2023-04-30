<?php include 'header.php'; ?>
<style>
    table.dataTable tbody td {
  padding: 0px 10px;
}
  .dt-button{
height: 33px !important;
font-size: 10px !important;
padding: 7px !important;
    }
</style>
<!-- Page Wrapper -->
<div id="wrapper">
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
        <div class="p-1 mb-2 col-2 bg-dark text-white text-center text-uppercase mb-3 text-gray-800">All Product</div>
        <table id="table_id" class="display" style="font-size:1rem;">
          <thead>
            <tr>
              <th>S.N.</th>
              <th class="col-1">Category Name</th>
              <th class="col-2">Product Name</th>
              <th>Price</th>
              <th>Color</th>
              <th>Quantity</th>
              <th class="col-1">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT product.`id` as productID,`categoryID`, `image_path`, `image`,`pGroup`,`pCode`, `product`, `unit`, `availableQty`, `rate`, `pStatus` FROM `product`
                      INNER JOIN category on category.id = product.categoryID
                      LEFT JOIN product_image PI ON PI.product_id = product.id;";
            $conn = dbConnecting();
            $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
              $i = 1;
              while ($data = mysqli_fetch_assoc($req)) { ?>
            <tr class="fs-6">
              <td>
                <?php echo $i; ?>
              </td>
              <td>
                <?php echo $data['pGroup']; ?>
              </td>
              <td>
                <?php echo $data['pCode'] ?>
              </td>
              <td>
                <?php echo $data['product']; ?>
              </td>
              <td>
                <?php echo $data['rate']; ?>
              </td>
              <td>
                <?php echo $data['availableQty']; ?>
              </td>
              <td>
               <a href="#" class="imageup" data-bs-toggle="modal" data-productID="<?php echo $data['productID'];?>" data-path="<?php echo $data['image_path'].$data['image'];?>" data-bs-target="#uploadImage"><i class="bi bi-pencil-square"></i></a>
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
    </div>
  </div>
</div>
<script>
  $(".imageup").click(function () {// button class where button clicked
    var pid = $(this).attr("data-productID"); //attribute from button data-category
    $("#productId").attr("value", pid.trim());// where to show id

    var image = $(this).attr("data-path"); //attribute from button data-category
    $("#pImage").attr("src", image.trim());// where to show id

    // var pid = $(this).attr("data-image"); //attribute from button data-category
    // $("#productId").attr("value", pid.trim());// where to show id
  });
</script>
<!-- upload image Modal -->
<div class="modal fade" id="uploadImage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Upload Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
           <input type="hidden" class="form-control" id="productId">
          <span class="input-group-text col-12" id="basic-addon1">
          <input type="file" class="form-control" id="imageUpload" name="imageUpload" onchange="upload_image()"></span>
        </div>
        <div>
            <img id="pImage" class="w-50">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="uploadBtn">Submit</button>
      </div>
    </div>
  </div>
</div>
<script>
  async function upload_image() {
    let formData = new FormData();
    formData.append("file", imageUpload.files[0]);
    await fetch('library/upload_image.php', {
      method: "POST",
      body: formData
    });
  }
$(document).ready(function(){
  $("#uploadBtn").click(function(){
    var productId = $("#productId").val();
    var imageUpload = $("#imageUpload").val().replace(/C:\\fakepath\\/i, '');
    if(productId==""||imageUpload==""){
      alert("Please fill the form properly.");
    }
    else{
      $.ajax({
        url: "library/image_control.php",
        method: "POST",
        data: { insert_product_name: imageUpload, productId:productId},
        success: function (data) {
          var da = JSON.parse(data);
          if(da.status_code==200){
            alert("Image stored successfully.");
            location.reload(true);
          }
          else if(da.status_code==201){
            alert("Unable to store image");
          }
        }
      });
    }
  });
});
</script>
<?php include "footer.php"; ?>