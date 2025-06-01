<?php
// Password protection
$password = 'your_secure_password';
if ($_POST['password'] !== $password) {
    echo '<form method="post"><input type="password" name="password"><button>View Logs</button></form>';
    exit;
}

$logs = file(__DIR__.'/whatsapp_clicks.log');
echo "<h1>WhatsApp Click Report</h1>";
echo "<table border='1'><tr><th>Time</th><th>Link</th><th>Page</th><th>IP</th></tr>";

foreach ($logs as $log) {
    $data = json_decode($log, true);
    echo "<tr>
        <td>{$data['timestamp']}</td>
        <td>{$data['link']}</td>
        <td>{$data['page']}</td>
        <td>{$data['ip']}</td>
    </tr>";
}

echo "</table>";
echo "<p>Total clicks: ".count($logs)."</p>";
?>
