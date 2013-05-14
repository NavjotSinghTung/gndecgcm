<?php


$json = array();


 // Registering a user device & Storing reg id in users table
if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["regId"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $gcm_regid = $_POST["regId"]; // GCM Registration ID
    // Storing user details in db
    include_once './db_functions.php';
    include_once './GCM.php';

    $db = new DB_Functions();
    $gcm = new GCM();

    $res = $db->storeUser($name, $email, $gcm_regid);

    $registatoin_ids = array($gcm_regid);
    $message = array("Greeting" => "Hello");

    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;
} else {
   echo "User Details are missing";
}
?>