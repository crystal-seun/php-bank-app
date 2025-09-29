<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. Admins only.");
}

include '../db.php';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    header("Location: allUser.php");
    exit;
}

$stmt = $pdo->query("SELECT id, first_name, last_name, email,password, role FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>All Users</h1>
<table borde="1" cellpadding="5">
  <tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Actions</th>
    <th>password</th>
  </tr>
  <?php foreach ($users as $user): ?>
  <tr>
    <td><?= $user['id'] ?></td>
    <td><?= htmlspecialchars($user['first_name']) ?></td>
    <td><?= htmlspecialchars($user['last_name']) ?></td>
    <td><?= htmlspecialchars($user['email']) ?></td>
    <td><?= htmlspecialchars($user['role']) ?></td>
    <td><?= htmlspecialchars($user['password']) ?></td>
    <td>
      <a href="editUser.php?id=<?= $user['id'] ?>">Edit</a> |
      <a href="allUser.php?delete=<?= $user['id'] ?>" 
         onclick="return confirm('Delete this user?')">Delete</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>