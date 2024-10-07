<?php
require 'db.php';

$query = $pdo->query("SELECT * FROM categories");
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];

    $stmt = $pdo->prepare("INSERT INTO expenses (title, amount, expenses_date, description, category_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $amount, $date, $description, $category_id]);

    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
        <nav>
        <img src="logo.png" alt="Logo">
        <h1>Expenses Tracker</h1>
        <div>
            <a href="index.php">Home</a>
            <a href="add.php">Add New Expense</a>
        </div>
    </nav>
    <h1>Add New Expense</h1>
    <form method="POST">
        <label>Title</label><br>
        <input type="text" name="title" required><br>
        <label>Amount</label><br>
        <input type="number" name="amount" step="0.01" required><br>
        <label>Date</label><br>
        <input type="date" name="date" required><br>
        <label>Category</label><br>
        <select name="category" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['label']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Description</label><br>
        <textarea name="description"></textarea><br>
        <button type="submit">Add Expense</button>
    </form>
    <footer>
        <p>Credits by: Prajjwal Maharjan</p>
    </footer>
</body>
</html>
