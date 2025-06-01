<?php
$data = [
    'link' => $_GET['link'] ?? 'unknown',
    'page' => $_GET['page'] ?? 'unknown',
    'ip' => $_SERVER['REMOTE_ADDR'],
    'timestamp' => date('Y-m-d H:i:s')
];

file_put_contents('whatsapp_clicks.log', json_encode($data).PHP_EOL, FILE_APPEND);
header("Location: ".$_GET['redirect']);
?>
