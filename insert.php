
<?php
$visitorName = $_POST['visitorName'];
$visitorSurname = $_POST['visitorSurname'];
$visitorGender = $_POST['visitorGender'];
$visitorEmail = $_POST['visitorEmail'];
$visitorPhone = $_POST['visitorPhone'];
$visitorVisiting = $_POST['visitorVisiting'];
$visitorType = $_POST['visitorType'];
$visitorCompany = $_POST['visitorCompany'];
$visitorImage = $_POST['visitorImage'];


if (!empty($visitorName) || !empty($visitorSurname) || !empty($visitorGender) || !empty($visitorEmail) || !empty($visitorPhone) || !empty($visitorVisiting || !empty($visitorType))) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "visitorEntry";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
        die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    } else {


        $SELECT = "SELECT email From visitor_Entry Where email = ? Limit 1";
        $SELECT = "SELECT email From visitor_Entry Where phone = ? Limit 1";
        $INSERT = "INSERT Into visitor_Entry (name, surname, phone,email,company_name,gender, visiting_patient, visitor_type,image) values(?, ?,?, ?, ?, ?, ?,?)";
        //Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        if ($rnum == 0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssss", $username, $password, $gender, $email, $phoneCode, $phone);
            $stmt->execute();
            echo "New record inserted sucessfully";
        } else {
            echo "Someone already register using this email";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "All field are required";
    die();
}
?>