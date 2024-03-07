<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações Cadastradas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 200px;
        }
    </style>
</head>
<body>
    <h2>Informações Cadastradas</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Assinatura</th>
        </tr>
        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cadastro_db";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Consulta SQL para obter os dados cadastrados
        $sql = "SELECT nome, email, assinatura FROM cadastro";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Exibindo os dados em uma tabela
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td><img src='" . $row["assinatura"] . "' alt='Assinatura'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhum cadastro encontrado</td></tr>";
        }
        $conn->close();
        
        ?>
    </table>
    
</body>
</html>
