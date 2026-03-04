<?php
session_start();

// Function to safely include files
function safeInclude($file) {
    $basePath = __DIR__ . '/';
    $fullPath = $basePath . $file;
    if (file_exists($fullPath)) {
        include($fullPath);
        return true;
    } else {
        error_log("Failed to load file: $fullPath");
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Discuss Project</title>
    <?php safeInclude('client/commonFiles.php'); // Fix filename ?>
</head>
<body>
    <?php safeInclude('client/header.php'); ?>

    <?php
    $username = isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : '';

    if (isset($_GET['signup']) && empty($username)) {
        safeInclude('client/signup.php');
    } elseif (isset($_GET['login']) && empty($username)) {
        safeInclude('client/login.php');
    } elseif (isset($_GET['ask']) && !empty($username)) {
        safeInclude('client/ask.php');
    } elseif (isset($_GET['q-id'])) {
        $qid = (int)$_GET['q-id'];
        safeInclude('client/question-details.php');
    } elseif (isset($_GET['c-id'])) {
        $cid = (int)$_GET['c-id'];
        safeInclude('client/questions.php');
    } elseif (isset($_GET['u-id'])) {
        $uid = (int)$_GET['u-id'];
        safeInclude('client/questions.php');
    } elseif (isset($_GET['latest'])) {
        safeInclude('client/questions.php');
    } elseif (isset($_GET['search'])) {
        $search = $_GET['search'];
        safeInclude('client/questions.php');
    } else {
        safeInclude('client/questions.php');
    }
    ?>
</body>
</html>