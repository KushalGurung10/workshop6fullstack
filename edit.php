<?php
include "db.php";

$id = $_GET['id'];

// Fetch student
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Update student
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $update = $conn->prepare(
        "UPDATE students SET name=?, email=?, course=? WHERE id=?"
    );
    $update->execute([$name, $email, $course, $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student</h2>

<form method="POST">
    <input type="text" name="name" value="<?= $student['name'] ?>" required><br><br>
    <input type="email" name="email" value="<?= $student['email'] ?>" required><br><br>
    <input type="text" name="course" value="<?= $student['course'] ?>" required><br><br>
    <button type="submit">Update</button>
</form>

<a href="index.php">Back</a>

</body>
</html>
