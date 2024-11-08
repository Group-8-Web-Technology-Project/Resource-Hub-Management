<?php


function isEmailExists($conn,$email){
   
    $query = "SELECT * FROM user WHERE USER_EMAIL='$email'";
    
    $result = $conn->query($query);
    
    if($result && $result->num_rows > 0){
        echo "true";
        return 1;
    }else{
        echo "false";
        return 0;
    }
}

function isStudentIDExists($conn,$studentID){
    

    $query = "SELECT * FROM user WHERE STUDENT_ID='$studentID'";
    
    $result = $conn->query($query);
    
    if($result && $result->num_rows > 0){
        echo "true";
        return 1;
    }else{
        echo "false";
        return 0;
    }
}


?>