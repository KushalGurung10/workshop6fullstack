<?php
include "db.php";


$stmt = $conn->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
</head>
<body>

<h2>Add Student</h2>

<form action="add.php" method="POST">
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="text" name="course" placeholder="Course" required><br><br>
    <button type="submit">Add Student</button>
</form>

<hr>

<h2>Student List</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= $student['name'] ?></td>
            <td><?= $student['email'] ?></td>
            <td><?= $student['course'] ?></td>
            <td>
                <a href="edit.php?id=<?= $student['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $student['id'] ?>" onclick="return confirm('Delete this student?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
