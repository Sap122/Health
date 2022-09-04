<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid bg-light mt-5" >
  <div class="row" >
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>
</div>

<div>


<div class="row m-5 p-3">
<div class="col-md-6">
  
  <h2>Patient List</h2>
          
  <table class="table table-hover" id="tbl_doctor">
    <thead>
      <tr>
        <th>Name</th>
        <th>DISEASE</th>

      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
</div>
<div class="col-md-6">
  <h2> Doctor List</h2>
          
          <table class="table table-hover" id="tbl_patient">
            <thead>
              <tr>
                <th>Name</th>
                <th>DISEASE</th>
        
              </tr>
            </thead>
            <tbody>
        
            </tbody>
          </table>
</div>
</div>


<!-- datatables -->      
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css"/>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<!-- datatables -->
<script>


//doctor
$(document).ready(function () {
var sql_doctor ="SELECT name,diseases_name FROM user INNER JOIN diseases ON user.diseas_id =diseases.ID WHERE Role=2";
var sql_patient="SELECT name,diseases_name FROM user INNER JOIN diseases ON user.diseas_id =diseases.ID WHERE Role=1";


  getDoctor(sql_doctor);
  getPatient(sql_patient);
  chart_data_get();
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
                {
                  mData: 'diseases_name',

                },
                
              ]
                  
            });
         }




//patient*********************************************************

         function getPatient(sql){
          
            
            $('#tbl_patient').dataTable({
               "bProcessing": true,
            "destroy": true,
               "sAjaxSource": "login-function.php?list="+sql,
               "aoColumns": [
                
                 {
                  mData: 'name',

                },
                {
                  mData: 'diseases_name',

                },
                
              ]
                  
            });
         }



//************************************************************************************************************ */
//    
//get json data
function chart_data_get(){
$.ajax({
            url : 'login-function.php',
            type : 'POST',
            data : { action: "chart"},
            dataType : 'html',
            success: function(response, textStatus, jqXHR) { 
                const res = JSON.parse(response);
                 chart(res);
             
            }
         });
        }



         function chart(list){
var xValues = [];
var yValues = [];

for (let index = 0; index < list.length; index++) {
     xValues.push(list[index].dieases);
     yValues.push(list[index].patient_count);
     
}



var barColors = ["red", "green","blue","orange"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
   legend: {display: false},
   title: {
      display: true,
      text: "Number of patient affected by dieases"
    },
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
         }
</script>

</body>
</html>
