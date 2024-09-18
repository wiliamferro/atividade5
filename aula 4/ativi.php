<?php
$servername = 'localhost';
$usename= 'root';
$password = 'root'; 
$dbname = 'sistemas_pedidos'; 

$conn = new mysqli($servername,$usename,$password,$dbname);

if($conn ->connect_error){
    die("falha na conexão:" . $con -> connect_error);
}

if(isset($_POST['create'])){
    $nome_cliente = $_POST['nome_cliente'];
    $nome_produto = $_POST['nome_produto'];
    $quantidade = $_POST['quantidade'];
    $data_pedido = $_POST['data_pedido']; 
    
    $sql = "INSERT INTO pedidos (nome_cliente, nome_produto, quantidade, data_pedido) VALUES ('$nome_cliente', '$nome_produto', $quantidade, '$data_pedido')";
    if ($conn->query($sql) === TRUE) {
        echo "Novo pedido adicionado com sucesso.<br>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }


}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM pedidos WHERE id=$id";
    if ($mysqli->query($sql) === TRUE) {
        echo "Pedido excluído com sucesso.";
    } else {
        echo "Erro: " . $sqli . "<br>" . $conn->error;
    }
}

$result = $conn->query("select * from pedidos");

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Crud</title>

</head>
<body>
    <h2>adicionar pedido</h2>
    <form method="POST" action="">

    Nome do Cliente: <input type="text" name="nome_cliente" required><br>
    Nome do Produto: <input type="text" name="nome_produto" required><br>
    Quantidade: <input type="number" name="quantidade" required><br>
    Data do Pedido: <input type="date" name="data_pedido" required><br>
    <input type="submit" name="add" value="Adicionar Pedido">
    </form>

    <h2>Ler pedidos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome Cliente</th>
            <th>Nome Produto</th>
            <th>Quantidade</th>
            <th>Data Pedido</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome_cliente']; ?></td>
            <td><?php echo $row['nome_produto']; ?></td>
            <td><?php echo $row['quantidade']; ?></td>
            <td><?php echo $row['data_pedido']; ?></td>
            <td>
                <a href="index1.php?edit=<?php echo $row['id']; ?>">Editar</a> |
                <a href="index1.php?delete=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>

</html>