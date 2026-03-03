<?php
include 'config/database.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    $stmt = $pdo->prepare("INSERT INTO students (name, email, phone, course) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $phone, $course]);

    header("Location: index.php");
}
include 'includes/header.php';
?>

<form method="POST" class="card p-4 shadow">
    <input name="name" class="form-control mb-3" placeholder="Name" required>
    <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
    <input name="phone" class="form-control mb-3" placeholder="Phone">
    <input name="course" class="form-control mb-3" placeholder="Course">

    <button class="btn btn-success">Save</button>
    <a href="index.php" class="btn btn-secondary">Back</a>
</form>

<?php include 'includes/footer.php'; ?>