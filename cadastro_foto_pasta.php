<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    define("UPLOAD_DIR", "./uploads/pfp/");
    define("MAX_SIZE", 5 * 1024 * 1024);

    require("database.php");

    $nome = $_POST["nome"];
    $raca = $_POST["raca"];
    $tutor = $_POST["tutor"];
    $idade = $_POST["idade"];
    
    $foto = $_FILES["foto"];
    $nomeFoto = $foto["name"];
    $localizacao = $foto["tmp_name"];
    $tamanho = $foto["size"];
    $tipo = $foto["type"];

    if (preg_match("/^image\/(png|jpg|gif|webp)$/", $tipo) && $nomeFoto != "" && $tamanho <= MAX_SIZE) {
        $novaLocalizacao = UPLOAD_DIR . $nomeFoto;
        
        $smt = $pdo->prepare("INSERT INTO gato (nome, raca, tutor, idade, foto_path) VALUES (:nome, :raca, :tutor, :idade, :foto)");
        $smt->bindParam(":nome", $nome);
        $smt->bindParam(":raca", $raca);
        $smt->bindParam(":tutor", $tutor);
        $smt->bindParam(":idade", $idade);
        $smt->bindParam(":foto", $novaLocalizacao);
        
        $smt->execute();
        move_uploaded_file($localizacao, $novaLocalizacao);
    } else {
        echo "erro!!!!!!!!!!!!!!!!!!!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form de cadastro</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-width: 100dvw;
            min-height: 100dvh;
            display: grid;
            place-content: center;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: fit-content;
            min-height: min-content;

            padding: 1.5rem;
            border-radius: 1rem;

            background-color: rgb(205, 132, 218);
        }

        input, select {
            display: block;
            margin-bottom: 1rem;

            border: none; 
            border-radius: 0.5rem;
            padding-inline: 0.5rem;
        }

        button[type="submit"] {
            margin-left: auto;
        }
    </style>
</head>

<!-- Hyper-text markup language -->
<!-- linguagem de marcar textos do caralho -->
<!-- HTTP - Hyper-text transfer protocol -->
<!-- Protocolo de transferência de texto do caralho -->

<!-- x Verbo -->
<!-- x URL -->
<!-- x Header -->
<!-- Body -->


<!-- Content-Type: "t" -->
<!-- mime type -->

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <label for="">Cor:</label>

        <select name="raca" required>
            <option value="laranja">Laranja</option>
            <option value="babi">Chitus</option>
            <option value="preto">Preto</option>
            <option value="malhado">Frajolinha</option>
            <option value="sinames">Gato da bia</option>
        </select>

        <label for="tutor">Tutor:</label>
        <input type="text" name="tutor">

        <label for="idade">Idade:</label>
        <input type="number" name="idade" required>

        <label for="foto">Foto do gato:</label>
        <input type="file" name="foto">

        <button type="submit">Cadastrar</button>
    </form>

    <?php
    $babi = "pretty";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<ul>";
        echo "<li>$nome</li>";
        echo "<li>$raca</li>";

        if ($babi == "pretty") {
            echo "<li>babi bonita</li>";
        }

        if (isset($_POST["tutor"]) && $_POST["tutor"] != "") {
            echo "<li>tem tutor</li>";
        } else {
            echo "<li>gato de rua</li>";
        }

        echo "</ul>";
    }
    ?>
</body>
</html>
