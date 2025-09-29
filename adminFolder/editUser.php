<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied");
}

include '../db.php';
$id = (int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fn = $_POST['first_name'];
    $ln = $_POST['last_name'];
    $role = $_POST['role'];
    $pdo->prepare("UPDATE users SET first_name=?, last_name=?, role=? WHERE id=?")
        ->execute([$fn, $ln, $role, $id]);
    header("Location: allUser.php");
    exit;
}

$user = $pdo->prepare("SELECT * FROM users WHERE id=?");
$user->execute([$id]);
$data = $user->fetch(PDO::FETCH_ASSOC);
?>
<form method="post">
  <input name="first_name" value="<?= htmlspecialchars($data['first_name']) ?>"><br>
  <input name="last_name" value="<?= htmlspecialchars($data['last_name']) ?>"><br>
  <select name="role">
    <option value="user" <?= $data['role']=='user'?'selected':'' ?>>User</option>
    <option value="admin" <?= $data['role']=='admin'?'selected':'' ?>>Admin</option>
  </select><br>
  <button type="submit">Update</button>
</form>