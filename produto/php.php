<?php
require_once 'index.html';

$connection = new PDO("sqlsrv:Database=seplaiz;server=localhost\SQLEXPRESS", "pedro", "0607");

$id = '';
$imagem = '';
$prod_name = '';
$prod_category = '';
$prod_price = '';
$stock = '';
function getPosts()
{
$posts = array();
$posts[0] = $_POST['id'];
$posts[1] = $_POST['prod_name'];
$posts[2] = $_POST['prod_category'];
$posts[3] = $_POST['prod_price'];
$posts[4] = $_POST['stock'];

return $posts;
}

if (isset($_POST['Adicionar_Produto']))
{
    $data = getPosts();
    if(empty($data[1]) || empty($data[2]) || empty($data[3]) || empty($data[4]))
    {
      echo 'Insira Os Dados Do Produto!!';
    }
    else {

        $img_name = $_FILES ['my_image']['name'];
        $img_size = $_FILES ['my_image']['size'];
        $tmp_name = $_FILES ['my_image']['tmp_name'];
        $error = $_FILES ['my_image']['error'];
    
        if ($error === 0) {
            if ($img_size > 125000) {
                $em = "Sorry, your file is too large.";
                 header("location: index.php?error=$em");
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
    
                $allowed_exs = array("jpg", "jpeg", "png");
    
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
     
    }
  }


      $insertstmt = $connection->prepare("INSERT INTO produtos(imagem,prod_name,prod_category,prod_price,stock) VALUES(('$new_img_name'),:prod_name,:prod_category,:prod_price,:stock)");
      $insertstmt->execute(array(
        ':prod_name' => $data[1],
        ':prod_category' => $data[2],
        ':prod_price' => $data[3],
        ':stock' => $data[4],
      ));
      
      if ($insertstmt) 
      {
        echo 'Produto Inserido!!';
      }
    }
    
  }
}