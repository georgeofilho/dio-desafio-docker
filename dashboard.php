<?php
session_start();
include('includes/db.php');

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

$sql = "SELECT mercadoria.*, categoria.tipo FROM mercadoria LEFT JOIN categoria ON mercadoria.categoria_id = categoria.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Mercado</h1>
            <nav>
                <ul>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h2>Itens Cadastrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['quantidade']; ?></td>
                    <td><?php echo $row['tipo']; ?></td>
                    <td>
                        <a href="edit_mercadoria.php?id=<?php echo $row['id']; ?>">Editar</a>
                        <a href="delete_mercadoria.php?id=<?php echo $row['id']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="add_mercadoria.php"><button>Adicionar Mercadoria</button></a>
        <a href="view_logs.php"><button>Ver Logs</button></a>
    </div>
</body>
</html>
