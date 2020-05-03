<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once 'user.php';

$objuser = new User();

// GET
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $stmnt = $objuser->runQuery("SELECT * FROM crud_users WHERE id=:id");
    $stmnt->execute(array(":id" => $id));
    $rowuser = $stmnt->fetch(PDO::FETCH_ASSOC);
}else{
    $id = null;
    $rowuser = null;
}

// POST
if(isset($_POST['btn_save'])){
    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    
    try {        
        if($id != null){
            if($objuser->Update($name, $email, $id)){
                $objuser->redirect('index.php?updated');
            }
        } else {
            if($objuser->Insert($name, $email)){
                $objuser->redirect('index.php?inserted');
            }else{
                $objuser->redirect('index.php?error');
            }
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

?>

<html>
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-grid.min.css">
        
    <title>CRUD</title>
    </head>
    <body>
        
        <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                
                <?php require_once 'includes/sidebar.php'; ?>
                <main  role="main" class="col-md-9 m1-sm-auto col-lg-10 px-4">
                    <h1 style="margin-top: 10px">Add/Edit Users</h1>
                    <p>Required fields are in(*)</p>
                    <form method="post">
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input class="form-control" type="text" name="id" id="id" value="<?php if (!empty(isset($rowuser['id']))){print($rowuser['id']);}?>" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Full Name"  value="<?php if (!empty(isset($rowuser['name']))){print($rowuser['name']);}?>" required maxlength="100">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="userone@gmail.com" value="<?php if (!empty(isset($rowuser['email']))){print($rowuser['email']);}?>" required  maxlength="100">
                        </div>
                        <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="save">
                    </form>
                </main>
            </div>
        </div>
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>