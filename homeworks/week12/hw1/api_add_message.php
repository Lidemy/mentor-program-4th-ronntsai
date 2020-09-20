<?php
    require_once('conn.php');

    header('Content-type:application/json;charset=utf-8');
    header('Access-Control-Allow-Origin: *');

    if (empty($_POST['message']) ||
        empty($_POST['user_name']) ||
        empty($_POST['site_key'])) {
        $json = array(
            "code" => -1,
            "resp"=> "Please don't missing information"
        );
  
        $response = json_encode($json);
        echo $response;
        die();
    }

    $message = $_POST['message'];
    $user_name = $_POST['user_name'];
    $site_key = $_POST['site_key'];

    $sql = "INSERT INTO Ronn_messages (message, user_name, site_key, create_time) VALUES (?, ?, ?, UNIX_TIMESTAMP())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $message, $user_name, $site_key);
    $result = $stmt->execute();

    if (!$result) {
        $json = array(
            "code" => -1,
            "resp"=> $conn -> error
        );
  
        $response = json_encode($json);
        echo $response;
        die();
    }

    $json = array(
        "code" => 0,
        "resp"=> "Success!"
    );
    
    $response = json_encode($json);
    echo $response;

?>