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
              <!-- <th class="col-1">Product Image</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT `categoryID`, `pGroup`,`pCode`, `product`, `unit`, `availableQty`, `rate`, `pStatus` FROM `product`
            INNER JOIN category on category.id = product.categoryID;";
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

<?php include "footer.php"; ?>