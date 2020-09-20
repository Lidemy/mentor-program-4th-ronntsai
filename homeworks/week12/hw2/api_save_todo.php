<?php
    require_once('conn.php');

    header('Content-type:application/json;charset=utf-8');
    header('Access-Control-Allow-Origin: *');

    if (empty($_POST['content'])) {
        $json = array(
            "code" => -1,
            "resp"=> "Please don't missing information"
        );
  
        $response = json_encode($json);
        echo $response;
        die();
    }

    $content = $_POST['content'];

    $sql = "INSERT INTO Ronn_lists (content, create_time) VALUES (?, UNIX_TIMESTAMP())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $content);
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
        "resp" => "Success!",
        "list_id" => $conn -> insert_id
    );
    
    $response = json_encode($json);
    echo $response;

?>