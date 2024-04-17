<?php
 include './header.php';
 include '../db.class.php';
?>

<?php
  $db = new DB();
  $db->conn();

  if(!empty($_POST['id'])){
    $db->update("register",$_POST);
    header("location: RegisterList.php");

  } else if($_POST){

    $_POST['data_register'] = date('Y-m-d');
    
    $db->insert("register",$_POST);
    header("location: RegisterList.php");
  }

  if(!empty($_GET['id'])){
    $register = $db->find("register", $_GET['id']);
  }
?>

    <h3>Formulário Cadastro</h3>

    <form action="RegisterForm.php" method="post">
        <input type="hidden" name="id" value="<?php echo !empty($register->id) ? $register->id :"" ?>">
        
        <label for="nome">Nome</label><br>
        <input type="text" name="nome" value="<?php echo !empty($register->nome) ? $register->nome :"" ?>"><br>

        <label for="email">E-mail</label><br>
        <textarea name="email" cols="30" rows="10"><?php echo !empty($register->email) ? $register->email :"" ?></textarea><br>

        <button type="submit"><?php echo !empty($_GET['id']) ? "Editar" : "Salvar" ?></button>
        <a href="RegisterList.php"> Voltar </a>

    </form>
<?php include "./footer.php" ?>
