<?php
    require_once("conn.php"); 

    if (empty($_GET['site_key'])) {
        $json = array(
            "code" => -1,
            "resp"=> "Please give a site key!"
        );
        
        $response = json_encode($json);
        echo $response;
        die();
    }

    $page = 1;

    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
    }

    $limit = 5;
    $offset = ($page - 1) * $limit;

    $site_key = $_GET['site_key'];

    $sql = "SELECT SQL_CALC_FOUND_ROWS message_id, site_key, message, user_name, create_time FROM Ronn_messages WHERE site_key = ? ORDER BY create_time desc LIMIT ? OFFSET ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $site_key, $limit, $offset);
    $result = $stmt->execute();
    if(!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();

    $messages = array();

    while($row = $result->fetch_assoc()) {
        array_push($messages, array(
            "message_id" => $row["message_id"],
            "site_key" => $row["site_key"],
            "message" => $row["message"],
            "user_name" => $row["user_name"],
            "create_time" => $row["create_time"]
        ));
    }

    $sql = "SELECT FOUND_ROWS() AS total_count";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    if(!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $json = array(
        "code" => 0,
        "messages" => $messages,
        "total_count" => $row['total_count']
    );

    $response = json_encode($json);
    header("Content-type: application/json;charset=utf-8");
    header('Access-Control-Allow-Origin: *');

    echo $response;

?>