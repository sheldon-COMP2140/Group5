<?php
// Allow all origins (you can restrict this to specific domains for security)
header("Access-Control-Allow-Origin: *"); // Allow all domains (you can specify a domain if necessary)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow GET, POST, and OPTIONS methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow certain headers
header('Content-Type: application/json'); // Ensures the response is treated as JSON
error_reporting(E_ERROR | E_PARSE); // Suppress warnings and notices
ob_clean(); // Clear any unwanted output before JSON


class theWindow {
    private $length;
    private $width;
    // private $color;
    private $cost;
    private $type;

    public function __construct($length, $width, $type){
        $this->length = $length;
        $this->width = $width;
        $this->type = $type;

    // Size in inches
    }
    public function getLength(){
        return $this->length;
    }
    public function getWidth(){
        return $this->width;
    }
    public function getType(){
        return $this->type;
    }
    public function getCost(){
        return $this->cost;
    }
    // public function __toString(){
    //     return ''. $this->length .''. $this->width .
    //     ''. $this->color .
    //     ''. $this->cost .;
    // }

    public function __setCost( $cost ){
        $this->cost = $cost;
    }

    public function __createCost( $length, $width, $type ){
        $area= ($length*$width)/144;
        if ($type == 'Frosted'){
            $cost= $area*550;
        }
        else if ($type == 'Titanium'){
            $cost= $area*550;
        }
        else if ($type == 'Midnight'){
            $cost= $area*450;
        }
        else{
            $cost= $area*450;
        }
        return $cost;
        }
    }


    header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $l = (int)$_POST['length'] ?? '';
    $w = (int)$_POST['width'] ?? '';
    $t = $_POST['Type'] ?? '';

    if (!empty($l) && !empty($w) && !empty($t)) {
        // Process data (e.g., save to DB, perform calculations)
        $newWindow= new theWindow( $l, $w,  $t);
    
        $price= $newWindow->__createCost($newWindow->getLength(), $newWindow->getWidth(), $newWindow->getType());
        // $price= $newWindow->__createCost($l, $w, $t);        
        $newWindow->__setCost($price);
        // echo $price;
        // $response = [
        //     "status" => "success",
        //     "Price" => round($price, 2), 
        // ];
        
        // $host = 'localhost';
        // $username = 'users';
        // $password = 'password123';
        // $dbname = ' EAGLE';
        // $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $stmt = $conn->query("INSERT INTO EagleGeneratedCost VALUES ($price);");

        $host = 'localhost';
        // $username = 'users';
        // $password = 'password123';
        $username = 'root';
        $password = '';
        $dbname = 'EAGLE';
        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }


        $sql = "INSERT INTO EagleGeneratedCost (Price) VALUES ($price)";

        if ($conn->query($sql) === TRUE) {
        $response = [
            "status" => "200",
            "status1" => "success",
            "Price" => round($price, 2),
            "message" => "New record created successfully"
        ];
        echo json_encode($response);
        } else {
            $response = [
                "status" => "error",
                "message" => "Error: " . $sql . "<br>" . $conn->error
            ];
            echo json_encode($response);
        }
        $conn->close();
    

    } else {
        $response = [
            "status" => "error",
            "message" => "Invalid data received"
        ];
    
    // $response = [
    //     "length" => $l,
    //     "width" => $w,
    //     "Type" => $t,
    // ];
    echo json_encode($response);
    exit;
    }
    
} else {
    http_response_code(405); // Method Not Allowed
    // echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    $response = [
        "length" => $l,
        "width" => $w,
        "Type" => $t,
    ];
    echo json_encode($response);
}

// $servername = "localhost";
// $username = "root";
// $password = "";

// $pdo = new
// PDO('mysql:host=localhost; dbname=EAGLE', 'root', '');
// $statement = $pdo->query("INSERT INTO `Eagle`.Generate VALUES (450);");
// $row = $statement->fetch(PDO::FETCH_ASSOC);
// // echo htmlentities($row['some_field']);

// $pdo = new
// PDO('mysql:host=example.com;dbname=database',
// 'user', 'password');
// $statement = $pdo->query("SELECT some_field FROM
// some_table");
// $row = $statement->fetch(PDO::FETCH_ASSOC);
// echo htmlentities($row['some_field']);

?>