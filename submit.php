<?php


$host = "localhost";
$user = "root";
$pass = "";
$db = "form_app";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$linkedin = $_POST['linkedin'];
$appointment = $_POST['appointment'];

// Handle file upload
$photo = $_FILES['photo'];
$photoName = $photo['name'];
$photoTmp = $photo['tmp_name'];
$photoSize = $photo['size'];

$allowed = ['jpg', 'jpeg', 'png', 'webp'];
$ext = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed) || $photoSize > 1024 * 1024) {
    die("Invalid file. Only JPG/PNG/WEBP under 1MB allowed.");
}

$newPhotoName = uniqid("IMG_") . "." . $ext;
$uploadPath = "uploads/" . $newPhotoName;

if (!move_uploaded_file($photoTmp, $uploadPath)) {
    die("Failed to upload file.");
}

// Insert into DB
$stmt = $conn->prepare("INSERT INTO appointments (fullname, email, phone, linkedin, photo, appointment_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $fullname, $email, $phone, $linkedin, $newPhotoName, $appointment);

if ($stmt->execute()) {
    echo "Appointment submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
