<?php

if (isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];


    if (isset($_COOKIE['carrinho'])) {
       
        $carrinho = $_COOKIE['carrinho'] . "," . $produto_id;
    } else {
       
        $carrinho = $produto_id;
    }

   
    setcookie('carrinho', $carrinho, time() + 1200, '/'); 

    echo "Produto adicionado ao carrinho. <br>";
    echo "Volte para a página anterior e clique no 'Ver carrinho' para ver o produto.";
} else {
    echo "Nenhum produto foi selecionado.";
}
?>
