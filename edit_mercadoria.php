<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $categoria_id = $_POST['categoria_id'];

    $sql = "UPDATE mercadoria SET nome='$nome', quantidade='$quantidade', categoria_id='$categoria_id' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM mercadoria WHERE id=$id";
    $result = $conn->query($sql);
    $mercadoria = $result->fetch_assoc();

    $sql = "SELECT * FROM categoria";
    $categorias = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Mercadoria</title>
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
            <input type="hidden" name="id" value="<?php echo $mercadoria['id']; ?>">
            <div>
                <label>Nome</label>
                <input type="text" name="nome" value="<?php echo $mercadoria['nome']; ?>" required>
            </div>
            <div>
                <label>Quantidade</label>
                <input type="number" name="quantidade" value="<?php echo $mercadoria['quantidade']; ?>" required>
            </div>
            <div>
                <label>Categoria</label>
                <select name="categoria_id" required>
                    <?php while ($row = $categorias->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $mercadoria['categoria_id']) echo 'selected'; ?>>
                            <?php echo $row['tipo']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Atualizar">
            </div>
        </form>
    </div>
</body>
</html>
