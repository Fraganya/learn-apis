<?php
// a simple PHP api example

$intent = $_GET['intent'];

$connection = new mysqli("localhost","fraganya","root","smis");



if($intent === "store"){
    // save the data to the database
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $reg = $_POST['reg'];


    $query = sprintf("INSERT INTO students(first_name,last_name,reg) VALUES('%s','%s','%s')",$fname,$sname,$reg);

    $connection->query($query);

    $data = [
        'message'=>"Student successfully registered!"
    ];

    return json_encode($data);


}
elseif($intent === "get"){
    // retrieve data from the database
    $query = "SELECT * FROM students";

    $result_set = $connection->query($query);

    $data = [];

    while($student =$result_set->fetch_object()){
        $data[]=$student;
    }

    print json_encode($data);
}
else{
    print("Intent unknown");
}

