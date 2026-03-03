<?php
include 'config/database.php';

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Fetch student
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    header("Location: index.php");
    exit();
}

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name   = trim($_POST['name']);
    $email  = trim($_POST['email']);
    $phone  = trim($_POST['phone']);
    $course = trim($_POST['course']);

    // Simple validation
    if (empty($name) || empty($email)) {
        $error = "Name and Email are required!";
    } else {
        $update = $pdo->prepare("UPDATE students SET name=?, email=?, phone=?, course=? WHERE id=?");
        $update->execute([$name, $email, $phone, $course, $id]);

        header("Location: index.php");
        exit();
    }
}

include 'includes/header.php';
?>

<div class="card shadow p-4">
    <h4 class="mb-3">Edit Student</h4>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control"
                value="<?= htmlspecialchars($student['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                value="<?= htmlspecialchars($student['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control"
                value="<?= htmlspecialchars($student['phone']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Course</label>
            <input type="text" name="course" class="form-control"
                value="<?= htmlspecialchars($student['course']) ?>">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>