<?php
include './header.php';
include '../db.class.php';
?>
<?php
$db = new DB();
$db->conn();

if (!empty($_GET['id'])) {
  $db->destroy("post", $_GET['id']);

  header('location: PostList.php');
}

if (!empty($_POST)) {
  // var_dump($_POST);
  // exit;
  $dados = $db->search("post", $_POST);
} else {
  $dados = $db->select("post");

}

?>

<div>
  <a href="../index.php"> Voltar para home </a><br>
  <h3>Listagem de Posts</h3>

  <form action="PostList.php" method="post">
    <select name="tipo">
      <option value="titulo">Título</option>
      <option value="descrição">Descrição</option>
      <option value="data_publicacao">Data de Publicação</option>
    </select>
    <input type="text" name="valor" />
    <button type="submit">Buscar</button>
    <a href="PostForm.php"> Cadastrar </a>
  </form>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Título</th>
      <th scope="col">Descrição</th>
      <th scope="col">Categoria</th>
      <th scope="col">Data de Publicação</th>
      <th scope="col">Ação</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($dados as $item) {

      $category = $db->find('category',$item->category_id);
      
      echo "<tr>";
      echo "<th scope='row'>$item->id</th>";
      echo "<td>$item->titulo</td>";
      echo "<td>$item->descricao</td>";
      echo "<td>$category->nome</td>";
      echo "<td>" . date('d/m/Y', strtotime($item->data_publicacao)) . "</td>";
      echo "<td><a href='PostForm.php?id=$item->id'>Editar</a></td>";
      echo "<td><a onclick='return confirm(\"Deseja Excluir?\")'
                    href='PostList.php?id=$item->id'>Deletar</a>
                  </td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

<?php include "./footer.php" ?>