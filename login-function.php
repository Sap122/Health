<?php
include ('config.php');

//******************************* */patient list
if(isset($_GET["list"])) 
{
    $data =  GetList($_GET["list"]);
	if(!$data){
		$data = [];
	  } 
	$results = ["sEcho" => 1, 
				"iTotalRecords" => count($data),
				"iTotalDisplayRecords" => count($data),
				"aaData" => $data ];
	echo json_encode($results);

} 
//get the data
function GetList($sql_query){ 
	global $db;
	$sql=$sql_query;
	$result = mysqli_query($db,$sql) or die(mysqli_error($db));
	$data = [];
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$data[] = $row;
	}
	return $data;
}


//******************************************88 */doctor list
//******************************* */patient list
// if(isset($_GET["doctor_list"])) 
// {
//     $data =  Getdoctor($_GET["doctor_list"]);
// 	if(!$data){
// 		$data = [];
// 	  } 
// 	$results = ["sEcho" => 1, 
// 				"iTotalRecords" => count($data),
// 				"iTotalDisplayRecords" => count($data),
// 				"aaData" => $data ];
// 	echo json_encode($results);

// } 
// //get the data
// function Getdoctor($id){ 
// 	global $db;
// 	$sql="SELECT * FROM doctor INNER JOIN patient ON doctor.D_ID = patient.D_ID";
// 	$result = mysqli_query($db,$sql) or die(mysqli_error($db));
// 	$data = [];
// 	while($row = $result->fetch_array(MYSQLI_ASSOC)){
// 	$data[] = $row;
// 	}
// 	return $data;
// }


//********************************************** */
if($_POST && isset($_POST['action']))
{
    //sanitize action
    switch($_POST['action'])
    {
        case 'login':
		   Login($_POST['name'],$_POST['password']);
            break;

        case 'chart':
            chart_data();
             break;
 
        }
         
    }


//*************************************************** */


function SetSessions($ans)
{
    setcookie("diseas_id", $ans['diseas_id'], time() + (86400 * 30), "/");     
}



function Login($name,$password)
{
 
    global $db; 
    $str = "select * from user where name='$name' and password ='$password'";
    $res = mysqli_query($db, $str) or die(mysqli_error($db));
    // print_r($res);
    if ($res->num_rows == 0)
    {
        $myObj = array();
        $myObj["Error"] = true;
        $myObj["message"] = "Not exist";
        
        $myJSON = json_encode($myObj);
            
        echo $myJSON;
    }
    else
    {
        $ans = mysqli_fetch_array($res);
        SetSessions($ans);
        $role =$ans["Role"];
        $myObj = array();
        $myObj["Error"] = false;
        $myObj["message"] = $role;
        
        $myJSON = json_encode($myObj);
            
        echo $myJSON;
}
}


function chart_data(){
    global $db; 
    $str = "SELECT diseases.diseases_name,count(name)as patient FROM user INNER JOIN diseases ON user.diseas_id =diseases.ID WHERE Role=2 GROUP BY diseases_name";
    $res = mysqli_query($db, $str) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($res)) {

        $data[] =["patient_count"=>$row['patient'] ,"dieases"=>$row['diseases_name']];
    
    }
    $json =json_encode($data);
    echo $json;
}

?>
