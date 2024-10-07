<?php
require 'db.php';

$query = $pdo->query("SELECT e.id, e.title, e.amount, e.description, e.expenses_date, c.label 
                      FROM expenses e JOIN categories c ON e.category_id = c.id");
$expenses = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <img src="logo.png" alt="Logo">
        <h1>Expense Tracker</h1>
        <a href="add.php">Add New Expense</a> 
    </nav>

    <table>
        <tr>
            <th>Title</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($expenses as $expense): ?>
            <tr>
                <td><?= htmlspecialchars($expense['title']) ?></td>
                <td><?= htmlspecialchars($expense['amount']) ?></td>
                <td><?= htmlspecialchars($expense['expenses_date']) ?></td>
                <td><?= htmlspecialchars($expense['label']) ?></td>
                <td>
                    <form action="edit.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $expense['id'] ?>">
                        <button type="submit" class="action-btn edit-btn">Edit</button>
                    </form>
                    <form action="delete.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $expense['id'] ?>">
                        <button type="submit" class="action-btn delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <footer>
        <p>Credits by: Prajjwal Maharjan</p>
    </footer>
</body>
</html>
