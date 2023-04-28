<?php
function dbConnecting()
{
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'deliecom';
    $conn = mysqli_connect($hostname, $username, $password, $database);

    if (!$conn) {
        echo "unable to connect database";
        die();
    }
    else {
        // echo "connected successfully";
        return $conn;
    }
}

function run_query($query)
{
    $conn = dbConnecting();
    $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);
    if ($req) {
        return 1;
    } else {
        return 0;
    }
}

function delete_existing($tblName)
{
    $count = get_primary_id($tblName);
    for ($i = 1; $i < $count; $i++) {
        $sql = "DELETE FROM `$tblName` WHERE `id` =$i";
        if (!run_query($sql)) {
            return 0;
        } else {
            // echo "Data delated at $i";
        }
    }
    echo "<hr>";
    return 1;
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

function run_insert_query($query)
{
    $conn = dbConnecting();
    $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);
    if ($req) {
        return 1;
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

function run_update_query($sql){
    $conn = dbConnecting();
    $req = mysqli_query($conn,$sql);
    if($req){
        // history_table($sql, true);
        //success
        // echo "query executed";
        $row = mysqli_affected_rows($conn);
        // echo "affected Row : ".$row;
        if($row==1){
            return 1;
        }else{
            mysqli_error($conn);
            return 0;
        }
    }else{
        //failed
    }
}

?>