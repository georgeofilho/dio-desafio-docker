<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO categoria (tipo) VALUES ('$tipo')";
    if ($conn->query($sql) === TRUE) {
        header('Location: add_mercadoria.php');
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Categoria</title>
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
                <label>Tipo</label>
                <input type="text" name="tipo" required>
            </div>
            <div>
                <input type="submit" value="Adicionar">
            </div>
        </form>
    </div>
</body>
</html>
