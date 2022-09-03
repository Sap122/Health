<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Doctor List </h2>
          
  <table class="table table-hover" id="tbl_doctor">
    <thead>
      <tr>
        <th>Name</th>

      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
</div>
<!-- datatables -->      
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css"/>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<!-- datatables -->

</body>
</html>

<script>
 $(document).ready(function () {
  var id =  <?php if(isset($_COOKIE['diseas_id'])){
         echo $_COOKIE['diseas_id'];
            } ?>;
var sql ="SELECT name FROM user WHERE Role = 1 and diseas_id ="+id;

  getDoctor(sql);
      });
         function getDoctor(sql){
            
            $('#tbl_doctor').dataTable({
               "bProcessing": true,
            "destroy": true,
               "sAjaxSource": "login-function.php?list="+sql,
               "aoColumns": [
              
                 {
                  mData: 'name',

                },
                
              ]
                  
            });
         }

  </script>
