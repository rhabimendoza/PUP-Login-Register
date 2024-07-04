<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['log-email']);
    $password = trim($_POST['log-pword']);

    $file = 'users.json';

    if (file_exists($file) && filesize($file) > 0) {
        $current_data = file_get_contents($file);
        $array_data = json_decode($current_data, true);

        foreach ($array_data['members'] as $member) {
            if ($member['email'] === $email && $member['pword'] === $password) {
                header("Location: index.html?status=login_success");
                exit();
            }
        }
    }

    header("Location: index.html?status=login_error");
    exit();
}
?>