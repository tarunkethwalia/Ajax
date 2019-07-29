<?php

$con = mysqli_connect('localhost','root','1234');
mysqli_select_db($con,'ajaxform_last');

extract($_POST);

if (isset($_POST['updhidden'])) {
  $hidden_input = $_POST['updhidden'];
  $updfullname = $_POST['updfullname'];
  $updemail = $_POST['updemail'];
  $updmobile = $_POST['updmobile'];

  $q="update crudajax set fullname='$updfullname', email = '$updemail', mobile = '$updmobile' where id = '$hidden_input' ";
  mysqli_query($con,$q);
}

if (isset($_POST['getid']) && isset($_POST['getid']) != "" ) {
  $user_id = $_POST['getid'];
  $q2 = "select * from crudajax where id ='$user_id'";
  if (!$result = mysqli_query($con,$q2)) {
    exit(mysli_error());
  }
  $response = array();

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $response = $row;
    }
  }
  echo json_encode($response);
}

if (isset($_POST['deleteid'])) {
  $userid = $_POST['deleteid'];
  $q2 = "delete from `crudajax` where id ='$userid'";
  $result = mysqli_query($con,$q2);
}

if (isset($_POST['readrecords'])) {
  echo "<table class='table table-striped table-bordered'>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Edit</th>
          <th>Delete</th>
          </tr>";

  $q2 = "select * from `crudajax` ";
  $result = mysqli_query($con,$q2);
  if (mysqli_num_rows($result) > 0) {
    $number = 1;
    while ($row = mysqli_fetch_array($result)) {
  echo "<tr>
        <td>".$number."</td>
        <td>".$row['fullname']."</td>
        <td>".$row['email']."</td>
        <td>".$row['mobile']."</td>
        <td> <button class='btn btn-secondary' onclick='getdata(".$row['id'].")'>Edit</button> </td>
        <td> <button class='btn btn-danger' onclick='deletedata(".$row['id'].")'>Delete</button> </td>
      </tr>";
      $number++;
    }
  }

echo "</table>";
}

if (isset($_POST['Submit'])) {
  $q = "insert into crudajax(fullname,email,mobile) values('$fullname','$email','$mobile') ";
  $result = mysqli_query($con,$q);
  header('location:index.php');
}

?>
