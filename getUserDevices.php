<?php
    class Device{
        public function __construct(array $arguments = array()) {
            if (!empty($arguments)) {
                foreach ($arguments as $property => $argument) {
                    $this->{$property} = $argument;
                }
            }
        }
    }
    
    function getDevices($email){
        include "dbConnect.php";
        $firstLastQuery = "SELECT FirstName, LastName FROM User Where Email = '$email';";
        if(!$result = mysqli_query($conn, $firstLastQuery)){
            mysqli_error($conn);
            exit();
        }
        else{
            $row = $result->fetch_assoc();
            $first = $row['FirstName'];
            $last = $row['LastName'];
        }
        $deviceArr = array();
        $query = "SELECT * FROM Device WHERE AssignedTo = '$email';";
        if(!$result = mysqli_query($conn, $query)){
            mysqli_error($conn);
            exit();
        }
        while($row = $result->fetch_assoc()){
            $device = new Device();
            $device->id = $row['Id'];
            $device->type = $row['Type'];
            $device->description = $row['Description'];
            $device->assignedFirst = $first;
            $device->assignedLast = $last;
            $device->assignedEmail = $email;
            array_push($deviceArr, $device);
        }
        return $deviceArr;
    }
?>