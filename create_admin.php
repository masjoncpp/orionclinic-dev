<?php
$hash = password_hash('password123', PASSWORD_DEFAULT);
$mysqli = new mysqli("localhost", "jojo", "masjottie12", "orionclinic");
$stmt = $mysqli->prepare("INSERT INTO users (name, email, password, role) VALUES ('Admin Orion', 'admin@orion.com', ?, 'admin')");
$stmt->bind_param("s", $hash);
$stmt->execute();
echo "Admin created\n";
