<?php
include('../../../settings/router.php');
session_start();
$db = new PDO($dsn, $user, $password);
if (empty($_SESSION['username'])) {
    header("location: https://www.youtube.com/watch?v=ukzE8LRAL_c");
} else {
    $q = @$_GET['list'];
    $type = $_GET['type'];
    switch ($type) {
        case '3D':
            $stmt = $db->prepare("TRUNCATE TABLE ilan");
            $son = $stmt->execute();
            if ($son) {
                echo "<script>history.go(-1);</script>";
            }
            break;
        case 'havale':
            $stmt = $db->prepare("TRUNCATE TABLE 3d");
            $son = $stmt->execute();
        
            if ($son) {
                echo "<script>history.go(-1);</script>";
            }
            break;
    }
}



?>