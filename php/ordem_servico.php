<?php
    include("conection.php");
    session_start();  

    session_start();
    $veiculo = $_SESSION['placa'];
    session_write_close();

    session_start();
    $cliente = $_SESSION['telefone'];
    session_write_close();

    
    session_start();
    $servico1 = $_SESSION['id1_tabela_auxiliar'];
    session_write_close();

    $query_tabela_auxiliar = "SELECT id
        FROM tabela_auxiliar
        WHERE servico1 = $servico1";

    $result = $mysqli->query($query_tabela_auxiliar);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 
        $tabela_auxiliar = $row["id"];
    }

    /*---------------------*/
   
    $hoje = date('d/m/Y');
    
    
    $sql = "INSERT INTO `ordem_servico` (cliente, veiculo, servico, data) 
    VALUES ('$cliente', '$veiculo', '$tabela_auxiliar', '$hoje')";

    $result= mysqli_query ($mysqli, $sql);

    $_SESSION['cliente'] = $cliente ;
    $_SESSION['veiculo'] = $veiculo ;
    $_SESSION['tabela_auxiliar'] = $tabela_auxiliar;
    $_SESSION['hoje'] = $hoje;

    header("Location: /automecanicapj/Ordem-de-Servico/php/pdf.php");
    session_write_close();
?>