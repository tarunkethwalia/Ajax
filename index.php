<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>AJAX Practice</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="indexes.css">
</head>
  <body>

    <!-- MODAL -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit Information</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="update_form">
              <form id="updateform" action="insert.php" method="post">
              <div class="update_fullname form-group">
              <label>Full Name:</label>
              <input class="form-control" id="update_fullname" type="text" name="update_fullname" />
              </div>
              <div class="update_email form-group">
              <label>Email:</label>
              <input class="form-control" id="update_email" type="email" name="update_email" />
              </div>
              <div class="update_mobile form-group">
              <label>Mobile:</label>
              <input class="form-control" id="update_mobile" type="text" name="update_mobile" />
              </div>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" onclick="updatedata()" class="btn btn-success">Update</button>
            <input type="hidden" name="" id="hidden_input" />
          </div>
          </form>
        </div>
      </div>
    </div>

<h1 class="text-center">AJAX</h1></br>

<div class="wrapper">

  <div class="form">
    <form id="submitform" action="insert.php" method="post">
    <div class="fullname form-group">
    <label for="id">Full Name:</label>
    <input class="form-control" id="fullname" type="text" name="fullname" />
    </div>
    <div class="email form-group">
    <label for="id">Email:</label>
    <input class="form-control" id="email" type="email" name="email" />
    </div>
    <div class="mobile form-group">
    <label for="id">Mobile:</label>
    <input class="form-control" id="mobile" type="text" name="mobile" />
    </div>
    <input id="submitdata" onclick="addrecord()" type="submit" name="Submit" value="Submit" class="btn btn-success"/>
    </form>
  </div>

  <div class="tablediv" id="datashow">

  </div>

</div>

<script type="text/javascript">

$(document).ready(function() {
  showdata();
});

function updatedata() {
  var updfullname = $('#update_fullname').val();
  var updemail = $('#update_email').val();
  var updmobile = $('#update_mobile').val();

  var updhidden = $('#hidden_input').val();
  $.post( "insert.php",
    {
      updfullname:updfullname,
      updemail:updemail,
      updmobile:updmobile,
      updhidden:updhidden
     },
    function(data,status) {
        $('#myModal').modal("hide");
        showdata();
    }
  );
}

function getdata(getid) {
  $('#hidden_input').val(getid);
  $.post( "insert.php",
    { getid:getid },
    function(data,status) {
      var user = JSON.parse(data);
      $('#update_fullname').val(user.fullname);
      $('#update_email').val(user.email);
      $('#update_mobile').val(user.mobile);
    }
  );

  $('#myModal').modal("show");
}

function deletedata(deleteid) {
  var conf = confirm("Are you sure?");
  if (conf == true) {
    $.ajax({
      url: 'insert.php',
      type: 'POST',
      data: {
        deleteid: deleteid
      },
      success: function(data,status) {
        showdata();
      }
    });
  }
}

function showdata() {
  var readrecords = "readrecords";
  $.ajax({
    url: 'insert.php',
    type: 'POST',
    data: {
      readrecords: readrecords
    },
    success: function(data,status) {
      $('#datashow').html(data);
    }
  });
}

  function addrecord() {
    var fullname = $('#fullname').val();
    var email = $('#email').val();
    var mobile = $('#mobile').val();
    $.ajax({
      url: 'insert.php',
      type: 'POST',
      data:
      {
        fullname: fullname,
        email: email,
        mobile: mobile
      },
      success: function(data,status) {
        showdata();
      }
    });
  }

</script>

  </body>
</html>
