<?php
    require_once("conn.php"); 

    if (empty($_GET['list_id'])) {
        $json = array(
            "code" => -1,
            "resp"=> "Please give a list id!"
        );
        
        $response = json_encode($json);
        echo $response;
        die();
    }

    $list_id = $_GET['list_id'];

    $sql = "SELECT list_id, content, create_time FROM Ronn_lists WHERE list_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $list_id);
    $result = $stmt->execute();
    if(!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    $json = array(
        "code" => 0,
        "content" => $row['content']
    );

    $response = json_encode($json);
    header("Content-type: application/json;charset=utf-8");
    header('Access-Control-Allow-Origin: *');

    echo $response;

?>