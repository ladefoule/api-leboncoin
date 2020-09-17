<?php 

$json = file_get_contents("php://input");

echo json_decode($json);