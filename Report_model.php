<?php // Training module for map in Conta System

class Report_model {

    private $conn; 

    function __construct(){
        $servername = "localhost";
        $database = "conta";
        $username = "";
        $password = "";
        $this->conn = mysqli_connect($servername, $username, $password, $database);
        
    }

    function testConect(){
        if (!$this->conn) {
            die("<p>Connection failed: </p>" . mysqli_connect_error());
        }else{
            echo "<p>Connected successfully</p>";
        }
    }

    function closeConnect(){
        mysqli_close($this->conn);
        //echo "<p>Connection close</p>";
    }

    function saveReport($lat=null, $lng=null,  $description, $user=null){

        if($lat == null || $lng == null || $user == null ){
            echo "<p>Problem in data!</p>";
        }else{
            $sql = "INSERT INTO tb_report (lat, lng, fk_users, description) VALUES (".$lat.", ".$lng.", ".$user.", '".$description."')";
            if (mysqli_query($this->conn, $sql)) {
                  echo "New record created successfully";
            } else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            }
        }
        
    }

    function getReports(){
        $sql = "SELECT id, lat, lng, description FROM tb_report";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            while($row = $result->fetch_assoc()) {
                //$dados[] =  "id: " . $row["id"]. " lat: " . $row["lat"]. " lng: " . $row["lng"] ."";
                $dados[] = array("id" => $row['id'], "lat" => $row['lat'], "lng" => $row['lng'], "description" => $row['description']);
                
            }
            echo json_encode($dados);
        } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }


    
}


?>
