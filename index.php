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

<div class="d-flex justify-content-between mb-3">
    <a href="create.php" class="btn btn-primary">+ Add Student</a>

    <form method="GET" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search name">
        <button class="btn btn-outline-success">Search</button>
    </form>
</div>

<table class="table table-bordered table-striped shadow">
<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Course</th>
    <th>Action</th>
</tr>
</thead>
<tbody>

<?php foreach($students as $student): ?>
<tr>
    <td><?= $student['id'] ?></td>
    <td><?= htmlspecialchars($student['name']) ?></td>
    <td><?= htmlspecialchars($student['email']) ?></td>
    <td><?= htmlspecialchars($student['phone']) ?></td>
    <td><?= htmlspecialchars($student['course']) ?></td>
    <td>
        <a href="edit.php?id=<?= $student['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete.php?id=<?= $student['id'] ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

<?php include 'includes/footer.php'; ?>