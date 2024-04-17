<?php

function conteudo(){

  $db = new DB();
  $db->conn();

  $dados = $db->select("post");

  foreach ($dados as $item) {
    $category = $db->find('category',$item->category_id);

    echo "
    <h2>$item->titulo - Categoria: $category->nome</h2>
    <section>
      <p>$item->descricao</p>
    </section>
    <h6>" . date('d/m/Y', strtotime($item->data_publicacao)) . "</h6>
    <section>
      <p>$item->descricao</p>
    </section>";
  }
}
?>