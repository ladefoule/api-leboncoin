<?php 

// header('Content-Type: application/html', TRUE, 200);

header('Content-Type: application/json');
header('HTTP/1.0 200 Not Found');

echo json_encode($_SERVER);
echo json_encode($_SERVER['REQUEST_METHOD']);