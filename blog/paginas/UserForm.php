<?php
 include './header.php';
 include '../db.class.php';
?>

<?php
  $db = new DB();
  $db->conn();

  if(!empty($_POST['id'])){
    $db->update("user",$_POST);
    header("location: UserList.php");

  } else if($_POST){

    $_POST['data_user'] = date('Y-m-d');
    
    $db->insert("user",$_POST);
    header("location: UserList.php");
  }

  if(!empty($_GET['id'])){
    $user = $db->find("user", $_GET['id']);
    //var_dump($user);
  }
?>

    <h3>Formulário do Usuário</h3>

    <form action="PostForm.php" method="post">
        <input type="hidden" name="id" value="<?php echo !empty($user->id) ? $user->id :"" ?>">
        
        <label for="user">Nome</label><br>
        <input type="text" name="user" value="<?php echo !empty($user->user) ? $user->user :"" ?>"><br>

        <label for="data_birth">Data de Nascimento</label><br>
        <input type="date" name="data_birth" value="<?php echo !empty($user->data_birth) ? $user->data_birth :"" ?>"><br>

        <button type="submit"><?php echo !empty($_GET['id']) ? "Editar" : "Salvar" ?></button>
        <a href="UserList.php"> Voltar </a>

    </form>
<?php include "./footer.php" ?>
