<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $categoria_id = $_POST['categoria_id'];

    $sql = "INSERT INTO mercadoria (nome, quantidade, categoria_id) VALUES ('$nome', '$quantidade', '$categoria_id')";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM categoria";
$categorias = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Mercadoria</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Mercado</h1>
        </div>
    </header>
    <div class="container">
        <form method="POST" action="">
            <div>
                <label>Nome</label>
                <input type="text" name="nome" required>
            </div>
            <div>
                <label>Quantidade</label>
                <input type="number" name="quantidade" required>
            </div>
            <div>
                <label>Categoria</label>
                <select name="categoria_id" required>
                    <?php while ($row = $categorias->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['tipo']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Adicionar">
            </div>
        </form>
        <a href="add_categoria.php"><button>Adicionar Categoria</button></a>
    </div>
</body>
</html>
