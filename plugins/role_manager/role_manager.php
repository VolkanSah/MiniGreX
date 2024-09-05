<?php


// Überprüfen, ob der Benutzer Admin ist
if (!user_has_role($_SESSION['user_id'], 'admin')) {
    die('Zugriff verweigert');
}

// Rolle hinzufügen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_role'])) {
    $role_name = sanitizeInput($_POST['role_name']);
    add_role($role_name);
}

// Rolle löschen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_role'])) {
    $role_id = (int)$_POST['role_id'];
    delete_role($role_id);
}

// Alle Rollen abrufen
$stmt = $pdo->query("SELECT * FROM roles");
$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$csrf_token = generate_csrf_token();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Manager</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Role Manager</h1>

        <h2>Rolle hinzufügen</h2>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div class="form-group">
                <label for="role_name">Rollenname:</label>
                <input type="text" id="role_name" name="role_name" class="form-control" required>
            </div>
            <button type="submit" name="add_role" class="btn btn-primary">Rolle hinzufügen</button>
        </form>

        <h2>Rollen löschen</h2>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div class="form-group">
                <label for="role_id">Rolle:</label>
                <select id="role_id" name="role_id" class="form-control" required>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['id']; ?>"><?php echo $role['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="delete_role" class="btn btn-danger">Rolle löschen</button>
        </form>

        <h2>Vorhandene Rollen</h2>
        <ul>
            <?php foreach ($roles as $role): ?>
                <li><?php echo $role['name']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

