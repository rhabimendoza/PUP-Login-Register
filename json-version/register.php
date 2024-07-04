<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['reg-name']);
    $bdate = trim($_POST['reg-bdate']);
    $gender = trim($_POST['reg-gen']);
    $region = trim($_POST['reg-regi']);
    $province = trim($_POST['reg-prov']);
    $email = trim($_POST['reg-email']);
    $pword = trim($_POST['reg-pword']);

    $userData = array(
        "name" => $name, 
        "bdate" => $bdate, 
        "gender" => $gender, 
        "region" => $region, 
        "province" => $province, 
        "email" => $email, 
        "pword" => $pword
    );

    $file = 'users.json';

    if (file_exists($file) && filesize($file) > 0) {
        $current_data = file_get_contents($file);
        $array_data = json_decode($current_data, true);
    } else {
        $array_data = array("members" => array());
    }

    $emailExists = false;
    foreach ($array_data['members'] as $member) {
        if ($member['email'] === $email) {
            $emailExists = true;
            break;
        }
    }

    if (!$emailExists) {
        $array_data['members'][] = $userData;
        $json_data = json_encode($array_data, JSON_PRETTY_PRINT);
        if (file_put_contents($file, $json_data)) {
            header("Location: index.html?status=data_saved");
            exit();
        } else {
            header("Location: index.html?status=data_error");
            exit();
        }
    } else {
        header("Location: index.html?status=email_exist");
        exit();
    }
}
?>