<?php 
    ob_start();
    session_start();
    include('baglan.php');
    $ip = $_POST['ip'];

    if(empty($_SESSION['username'])) {
        header('Location: https://www.youtube.com/watch?v=ukzE8LRAL_c');
        exit;
    }
    
    if($_POST['ip']<>""){
        $query = $conn->prepare("INSERT INTO ban SET ip = ?");
        $insert = $query->execute(array($ip));
        if ($insert){
            $title = array(
                "type" => "success",
             );
             $return = json_encode($title);
             echo $return;    
        } else {
            $title = array(
                "type" => "error",
             );
             $return = json_encode($title);
             echo $return;
        }
    }
?>