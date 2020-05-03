<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once 'user.php';

$objuser = new User();

if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    try {
        if($id != null){
            if($objuser->Delete($id)){
                $objuser->redirect('index.php?deleted');
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
        <link rel="stylesheet" href="js/feather.min.js">
        <link rel="stylesheet" href="js/jquery.min.js">
        <link rel="stylesheet" href="js/popper.min.js">
        <link rel="stylesheet" href="js/bootstrap.min.js">
    </head>
    <body>
        
        <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                
                <?php require_once 'includes/sidebar.php'; ?>
                <main role="main" class="col-md-9 m1-sm-auto col-lg-10 px-4">
                    <h1 style="margin-top: 10px">Data Table</h1>
                    
                    <?php
                    if(isset($_GET['updated'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">'
                        . '<strong>User!<strong> Updated with success.'
                                . '<button type="button" class="close" data-dismiss="alert" aria-label="close">'
                                . '<span aria-hidden="true"> &times; </span>'
                                . '</button>'
                                . '</div>';
                    }
                    else if(isset($_GET['deleted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">'
                        . '<strong>User!<strong> Deleted with success.'
                                . '<button type="button" class="close" data-dismiss="alert" aria-label="close">'
                                . '<span aria-hidden="true"> &times; </span>'
                                . '</button>'
                                . '</div>';
                    }
                    if(isset($_GET['inserted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">'
                        . '<strong>User!<strong> Inserted with success.'
                                . '<button type="button" class="close" data-dismiss="alert" aria-label="close">'
                                . '<span aria-hidden="true"> &times; </span>'
                                . '</button>'
                                . '</div>';
                    }
                    if(isset($_GET['error'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">'
                        . '<strong>DB Error!<strong> Something went wrong. Try Again'
                                . '<button type="button" class="close" data-dismiss="alert" aria-label="close">'
                                . '<span aria-hidden="true"> &times; </span>'
                                . '</button>'
                                . '</div>';
                    }
                    ?>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thread>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thread>
                            <?php 
                            $query = "SELECT * FROM crud_users";
                            $stmnt = $objuser->runQuery($query);
                            $stmnt->execute();
                            ?>
                            
                            <tbody>
                                <?php
                                if($stmnt->rowCount() > 0){
                                    while ($rowuser = $stmnt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>
                                    <td><?php print($rowuser['id']); ?></td>
                                    
                                    <td>
                                        <a href="form.php?edit_id=<?php print($rowuser['id']); ?>">
                                        <?php print($rowuser['name']); ?>
                                        </a>
                                    </td>
                                    
                                    <td><?php print($rowuser['email']); ?></td>
                                    
                                    <td>
                                        <a class="confirma" onclick="return confirm('Are you sure you want to delete this user?');" href="index.php?delete_id=<?php print($rowuser['id']); ?>">
                                            <span data-feather="trash"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                        
                    </div>
                </main>
            </div>
        </div>
        <?php include_once 'includes/footer.php'; ?>
        
        
    </body>
</html>
