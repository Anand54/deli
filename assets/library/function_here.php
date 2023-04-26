<?php 
 include "connect_server.php"; 
 
function popMsg($msg)
{
?>
<script>
  alert("<?php echo $msg; ?>");
</script>
<?php
}

 function get_Table_Data($sql)
{
  $conn = dbConnecting();
  $req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if (!$req) {
    return 0;
  } else if (mysqli_num_rows($req) != 0) {
    $list = [];
    $i = 1;
    while ($data = mysqli_fetch_assoc($req)) {
      $list[$i] = $data;
      $i = $i + 1;
    }
    return $list;
  } else {
    return 0;
  }
}

function check_if_exist($sql)
{
  $conn = dbConnecting();
  $req = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($req);
  $val = $result['result'];
  if ($val == 1) {
    return 1;
  } else if ($val == 0) {
    return 0;
  } else {
    return mysqli_error($conn);
  }
  mysqli_close($conn);
}

function get_primary_id($tblName)
{
    $conn = dbConnecting();
    $query = "SELECT  case when isnull(max(id))then 1 else  (max(id))+1 end as new_id FROM `$tblName`;";
    $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
    // echo $query;
    if ($req == true) {
        $id = mysqli_fetch_assoc($req);
        // echo $id['id'];
        return $id['new_id'];
    } else {
        return 1;
    }
}

function give_response($code)
{

    $success = array(
        'message' => 'success',
        'status_code' => '200'
    );
    $failure = array(
        'message' => 'failure',
        'status_code' => '201'
    );
    $errore = array(
        'message' => 'errore',
        'status_code' => '502'
    );
    $response = array(
        'message' => 'unknown',
        'status_code' => '501'
    );
    $nodata = array(
        'message' => 'unknown',
        'status_code' => '404'
    );
    $parentrow = array(
        'message' => 'Parent row',
        'status_code' => '1451'
    );
    $duplicate = array(
        'message' => 'Duplicate Entry',
        'status_code' => '55'
    );

    switch ($code) {
        case '200':
            return $success;
            break;
        case '201':
            return $failure;
            break;
        case '502':
            return $errore;
            break;
        case '501':
            return $response;
            break;
        case '404':
            return $nodata;
            break;
        case '1451':
            return $parentrow;
            break;
        case '55':
            return $duplicate;
            break;
        default:
            # code...
            break;
    }
}
 ?>