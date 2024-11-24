<?php

if (isset($_COOKIE['carrinho'])) {
   
    $produto_ids = explode(",", $_COOKIE['carrinho']);
    
    echo "<h2>Produtos no Carrinho</h2>";

    foreach ($produto_ids as $id) {
        echo "Produto ID: " . $id . "<br>";
    }
} else {
    echo "Seu carrinho está vazio.";
}
?>
