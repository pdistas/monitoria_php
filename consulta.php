<?php
require("database.php");

if (isset($_GET["busca"]) && $_GET["busca"] != "") {
    $busca = $_GET["busca"];

    $smt = $pdo->prepare("SELECT * FROM gato WHERE nome = :nome");
    $smt->bindParam(":nome", $busca);
} else {
    $smt = $pdo->prepare("SELECT * FROM gato");
}

$smt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar gatos</title>
</head>
<body>
    <form>
        <input type="text" name="busca" placeholder="buscar gato">
        <button type="submit">Buscar</button>
    </form>

    <br>

    <table>
        <tr>
            <th>Nome</th>
            <th>Cor</th>
            <th>Tutor</th>
            <th>Idade</th>
        </tr>
        <?php 
        while ($row = $smt->fetch()) {
            echo "<tr>";
            echo "<td>{$row["nome"]}</td>";
            echo "<td>{$row["raca"]}</td>";
            echo "<td>{$row["tutor"]}</td>";
            echo "<td>{$row["idade"]}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
