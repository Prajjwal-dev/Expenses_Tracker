<?php
require 'db.php';

$id = $_GET['id'];
$expenseQuery = $pdo->prepare("SELECT * FROM expenses WHERE id = ?");
$expenseQuery->execute([$id]);
$expense = $expenseQuery->fetch(PDO::FETCH_ASSOC);

$categoriesQuery = $pdo->query("SELECT * FROM categories");
$categories = $categoriesQuery->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];

    $stmt = $pdo->prepare("UPDATE expenses SET title = ?, amount = ?, expenses_date = ?, description = ?, category_id = ? WHERE id = ?");
    $stmt->execute([$title, $amount, $date, $description, $category_id, $id]);

    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <img src="logo.png" alt="Logo">
        <h1>Expense Tracker</h1>
        <a href="index.php">Home</a>
    </nav>

    <div class="form-container">
        <h1>Edit Expense</h1>
        <form method="POST">
            <label>Title</label>
            <input type="text" name="title" value="<?= htmlspecialchars($expense['title']) ?>" required>

            <label>Amount</label>
            <input type="number" name="amount" step="0.01" value="<?= htmlspecialchars($expense['amount']) ?>" required>

            <label>Date</label>
            <input type="date" name="date" value="<?= htmlspecialchars($expense['expenses_date']) ?>" required>

            <label>Category</label>
            <select name="category" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $expense['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['label']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Description</label>
            <textarea name="description"><?= htmlspecialchars($expense['description']) ?></textarea>

            <button type="submit">Update Expense</button>
        </form>
    </div>

    <footer>
        <p>Credits by: Prajjwal Maharjan</p>
    </footer>
</body>
</html>
