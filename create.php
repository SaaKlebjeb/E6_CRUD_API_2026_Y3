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

<div class="page-header">
    <h1>
        Add Student
        <small>Enroll a new student into the system</small>
    </h1>
    <a href="index.php" class="btn-sms-secondary">
        <i class="bi bi-arrow-left"></i> Back to List
    </a>
</div>

<div class="form-page-wrap">
    <div class="sms-card">
        <div class="card-head">
            <i class="bi bi-person-plus-fill"></i>
            <h5>New Student Details</h5>
        </div>
        <div class="card-body-pad">
            <form method="POST">
                <div class="form-field">
                    <label class="sms-form-label">Full Name <span style="color:var(--danger)">*</span></label>
                    <input name="name" class="sms-input" placeholder="e.g. John Doe" required autocomplete="off">
                </div>

                <div class="form-field">
                    <label class="sms-form-label">Email Address <span style="color:var(--danger)">*</span></label>
                    <input name="email" type="email" class="sms-input" placeholder="e.g. john@email.com" required>
                </div>

                <div class="form-field">
                    <label class="sms-form-label">Phone Number</label>
                    <input name="phone" class="sms-input" placeholder="e.g. +1 555 000 0000">
                </div>

                <div class="form-field">
                    <label class="sms-form-label">Course / Program</label>
                    <input name="course" class="sms-input" placeholder="e.g. Computer Science">
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-sms-success">
                        <i class="bi bi-check-lg"></i> Save Student
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