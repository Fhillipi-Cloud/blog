<?php
include './header.php';
include '../db.class.php';

function conteudo()
{

  $db = new DB();
  $db->conn();

  $dados = $db->select("post");

  foreach ($dados as $item) {

    echo "
    <h2>$item->titulo</h2>
      <h6>" . date('d/m/Y', strtotime($item->data_publicacao)) . "</h6>
    <section>
      <p>$item->descricao</p>
    </section>";
  }

}