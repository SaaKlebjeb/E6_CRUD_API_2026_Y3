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

<div class="page-header">
    <h1>
        Edit Student
        <small>Update details for <strong><?= htmlspecialchars($student['name']) ?></strong></small>
    </h1>
    <a href="index.php" class="btn-sms-secondary">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

<div class="form-page-wrap">
    <div class="sms-card">
        <div class="card-head">
            <i class="bi bi-pencil-square"></i>
            <h5>Edit Student &mdash; ID #<?= $id ?></h5>
        </div>
        <div class="card-body-pad">

            <?php if (isset($error)): ?>
            <div class="sms-alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <?= $error ?>
            </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-field">
                    <label class="sms-form-label">Full Name <span style="color:var(--danger)">*</span></label>
                    <input type="text" name="name" class="sms-input"
                        value="<?= htmlspecialchars($student['name']) ?>" required>
                </div>

                <div class="form-field">
                    <label class="sms-form-label">Email Address <span style="color:var(--danger)">*</span></label>
                    <input type="email" name="email" class="sms-input"
                        value="<?= htmlspecialchars($student['email']) ?>" required>
                </div>

                <div class="form-field">
                    <label class="sms-form-label">Phone Number</label>
                    <input type="text" name="phone" class="sms-input"
                        value="<?= htmlspecialchars($student['phone']) ?>">
                </div>

                <div class="form-field">
                    <label class="sms-form-label">Course / Program</label>
                    <input type="text" name="course" class="sms-input"
                        value="<?= htmlspecialchars($student['course']) ?>">
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-sms-success">
                        <i class="bi bi-check-lg"></i> Update Student
                    </button>
                    <a href="index.php" class="btn-sms-secondary">
                        <i class="bi bi-x"></i> Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>