<?php
include 'config/database.php';
include 'includes/header.php';

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $stmt = $pdo->prepare("SELECT * FROM students WHERE name LIKE ?");
    $stmt->execute(["%$search%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
}

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-header">
    <h1>
        All Students
        <small>Manage and view enrolled students</small>
    </h1>
    <a href="create.php" class="btn-sms-primary">
        <i class="bi bi-person-plus-fill"></i> Add Student
    </a>
</div>

<div class="sms-card">

    <!-- Toolbar with search -->
    <div class="toolbar">
        <form method="GET" class="search-wrap">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                placeholder="Search by student name…"
                value="<?= htmlspecialchars($search) ?>"
                autocomplete="off"
            >
            <button type="submit" class="btn-search">Go</button>
        </form>
        <div style="font-size:.83rem;color:var(--muted);">
            <i class="bi bi-people me-1"></i>
            <?= count($students) ?> record<?= count($students) !== 1 ? 's' : '' ?> found
        </div>
    </div>

    <?php if (!empty($search)): ?>
    <div class="search-result-info">
        <i class="bi bi-funnel-fill"></i>
        Showing results for <strong>&ldquo;<?= htmlspecialchars($search) ?>&rdquo;</strong>
        <a href="index.php"><i class="bi bi-x-circle me-1"></i>Clear filter</a>
    </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="sms-table-wrap">
        <table class="sms-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($students)): ?>
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="bi bi-person-x"></i>
                            <p>No students found<?= $search ? ' matching &ldquo;' . htmlspecialchars($search) . '&rdquo;' : '' ?>.</p>
                        </div>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach($students as $student): ?>
                <tr>
                    <td class="id-cell"><?= $student['id'] ?></td>
                    <td class="name-cell">
                        <i class="bi bi-person-circle me-1" style="color:var(--muted);"></i>
                        <?= htmlspecialchars($student['name']) ?>
                    </td>
                    <td>
                        <a href="mailto:<?= htmlspecialchars($student['email']) ?>" style="color:var(--navy);text-decoration:none;">
                            <?= htmlspecialchars($student['email']) ?>
                        </a>
                    </td>
                    <td style="color:var(--muted);"><?= htmlspecialchars($student['phone']) ?: '—' ?></td>
                    <td><span class="course-badge"><?= htmlspecialchars($student['course']) ?: '—' ?></span></td>
                    <td>
                        <div class="action-wrap">
                            <a href="edit.php?id=<?= $student['id'] ?>" class="btn-edit">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <a href="delete.php?id=<?= $student['id'] ?>"
                               class="btn-delete"
                               onclick="return confirm('Delete <?= htmlspecialchars(addslashes($student['name'])) ?>? This cannot be undone.')">
                                <i class="bi bi-trash-fill"></i> Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div><!-- /sms-card -->

<?php include 'includes/footer.php'; ?>