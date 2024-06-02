<?php
include('includes/db.php');

$sql = "SELECT * FROM log";
$logs = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ver Logs</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Mercado</h1>
        </div>
    </header>
    <div class="container">
        <h2>Logs</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Tabela</th>
                <th>Operação</th>
                <th>Dados</th>
                <th>Data</th>
            </tr>
            <?php while ($row = $logs->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['tabela']; ?></td>
                    <td><?php echo $row['operacao']; ?></td>
                    <td><?php echo $row['dados']; ?></td>
                    <td><?php echo $row['data']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="dashboard.php"><button>Voltar</button></a>
    </div>
</body>
</html>
