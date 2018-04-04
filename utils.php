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
    
    class Request{
        public function __construct(array $arguments = array()) {
            if (!empty($arguments)) {
                foreach ($arguments as $property => $argument) {
                    $this->{$property} = $argument;
                }
            }
        }
    }
    
    class Ticket{
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
    
    function getRequests($email){
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
        $reqArr = array();
        $query = "SELECT * FROM Request WHERE UserId = '$email';";
        if(!$result = mysqli_query($conn, $query)){
            mysqli_error($conn);
            exit();
        }
        while($row = $result->fetch_assoc()){
            
            $req = new Request();
            $req->id = $row['Id'];
            $req->type = $row['DeviceType'];
            $req->description = $row['Description'];
            $req->neededBy = $row['NeededBy'];
            $req->approved = $row['Approved'];
            $req->submitFirst = $first;
            $req->submitLast = $last;
            $req->submitEmail = $email;
            array_push($reqArr, $req);
        }
        return $reqArr;
    }
    
    function getTickets($email){
        
        include "dbConnect.php";
        $firstLastQuery = "SELECT FirstName, LastName FROM User Where Email = '$email';";
        if(!$result = mysqli_query($conn, $firstLastQuery)){
            echo mysqli_error($conn);
            exit();
        }
        else{
            $row = $result->fetch_assoc();
            $first = $row['FirstName'];
            $last = $row['LastName'];
        }
        $ticArr = array();
        $query = "SELECT * FROM Ticket WHERE Submitter = '$email';";
        if(!$result = mysqli_query($conn, $query)){
            echo mysqli_error($conn);
            exit();
        }
        while($row = $result->fetch_assoc()){
            $device = $row['Device'];
            if ($device == 'NULL'){
                $device = "Other";
                $devType = "Other";
                $devDescription = "Other";
            }
            else{
                $devQuery = "SELECT Type, Description FROM Device WHERE Id = '$device'";
                if(!$devResult = mysqli_query($conn, $devQuery)){
                    mysqli_error($conn);
                    exit();
                }
                $devRow = $devResult->fetch_assoc();
                $devType = $devRow['Type'];
                $devDescription = $devRow['Description'];
            }
            $tic = new Ticket();
            $tic->id = $row['Id'];
            $tic->device = $device;
            $tic->devType = $devType;
            $tic->devDescription = $devDescription;
            $tic->comments = $row['Comments'];
            $tic->submitDate = $row['DateSubmitted'];
            $tic->status = $row['Status'];
            $tic->submitFirst = $first;
            $tic->submitLast = $last;
            $tic->submitEmail = $email;
            array_push($ticArr, $tic);
        }
        return $ticArr;
    }
    
    function getEmail($name){
        if ($name == "None" or $name = "" or $name = "Inventory"){
            return 'NULL';
        }
        else{
            include "dbConnect.php";
            $arr = preg_split('/\\s/', $name, -1);
            $first = $arr[0]; $last = $arr[1];
            $reportQuery = "SELECT Email FROM User WHERE FirstName = '$first' AND LastName = '$last'";
            $result = mysqli_query($conn, $reportQuery);
            if ($result->num_rows == 1){
                $row = $result->fetch_assoc();
                mysqli_close($conn);
                return $row['Email'];
            }
            else{
                echo mysqli_error($conn);
                mysqli_close($conn);
                exit();
            }
        }
    }
?>