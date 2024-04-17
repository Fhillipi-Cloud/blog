<?php
include './header.php';
include '../db.class.php';
?>

<?php
$db = new DB();
$db->conn();

if (!empty($_POST['id'])) {
  $db->update("post", $_POST);
  header("location: PostList.php");
} else if ($_POST) {

  $_POST['data_publicacao'] = date('Y-m-d');

  $db->insert("post", $_POST);
  header("location: PostList.php");
}

if (!empty($_GET['id'])) {
  $post = $db->find("post", $_GET['id']);
  //var_dump($post);
}

$categories = $db->select("category");

?>

<h3>Formulário Post</h3>

<form action="PostForm.php" method="post">
  <input type="hidden" name="id" value="<?php echo !empty($post->id) ? $post->id : "" ?>">

  <label for="titulo">Titulo</label><br>
  <input type="text" name="titulo" value="<?php echo !empty($post->titulo) ? $post->titulo : "" ?>"><br>

  <label for="descricao">Descrição</label><br>

  <textarea name="descricao" cols="30" rows="10"><?php echo !empty($post->descricao) ? $post->descricao : "" ?></textarea><br>

  <!-- 
        <label for="data_publicacao">Data Publicação</label><br> 
        <input type="date" name="data_publicacao"  value="<?php // echo !empty($post->data_publicacao) ? $post->data_publicacao :"" 
                                                          ?>"><br>
          -->

  <label for="data_birth">Categoria</label><br>
  <select name="category_id">
    <?php

    foreach ($categories as $item) {

      $selected = !empty($post->category_id) && $post->category_id === $item->id  ? "selected" : "";

      echo "<option value='" . $item->id . "' >$item->nome</option>";
 
    }
    ?>
  </select><br>
  <button type="submit"><?php echo !empty($_GET['id']) ? "Editar" : "Salvar" ?></button>
  <a href="PostList.php"> Voltar </a>

</form>
<?php include "./footer.php" ?>