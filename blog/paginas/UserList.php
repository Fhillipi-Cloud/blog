<?php
include './header.php';
include '../db.class.php';
?>
<?php
$db = new DB();
$db->conn();

if (!empty($_GET['id'])) {
  $db->destroy("user", $_GET['id']);

  header('location: UserList.php');
}

if (!empty($_POST)) {
  // var_dump($_POST);
  // exit;
  $dados = $db->search("user", $_POST);
} else {
  $dados = $db->select("user");

}

?>

<div>
  <a href="../index.php"> Voltar para home </a><br>
  <h3>Listagem dos Usuários</h3>

  <form action="UserList.php" method="post">
    <select name="tipo">
      <option value="nome">Nome</option>
      <option value="data_birth">Data de Nascimento</option>
      <option value="data_user">Data de Registro</option>
    </select>
    <input type="text" name="valor" />
    <button type="submit">Buscar</button>
    <a href="UserForm.php"> Cadastrar </a>
  </form>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Data de Nascimento</th>
      <th scope="col">Data de Registo</th>
      <th scope="col">Ação</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($dados as $item) {
      echo "<tr>";
      echo "<th scope='row'>$item->id</th>";
      echo "<td>$item->titulo</td>";
      echo "<td>$item->descricao</td>";
      echo "<td>" . date('d/m/Y', strtotime($item->data_user)) . "</td>";
      echo "<td><a href='UserForm.php?id=$item->id'>Editar</a></td>";
      echo "<td><a onclick='return confirm(\"Deseja Excluir?\")'
                    href='UserList.php?id=$item->id'>Deletar</a>
                  </td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

<?php include "./footer.php" ?>