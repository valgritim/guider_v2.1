<?php


include 'header_admin.php';

if(!empty($_GET['id']))
{
    $id = checkInput($_GET['id']);
}


function checkInput($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
}
if(!empty($_POST['id']))
{

    $id = checkInput($_POST['id']);
    User::delete($db,$id);
    header("Location: index.php?delete=success");
    exit();
}
?>

<body>
    <div class="mt-3 text-center">
        <img src="../img/logo.png" width="10%" height="10%" >  
    </div> 


    <div class="container delete col-md-8">
        <div class="row delete">
           
            <form class="form col-md-6" action="deleteUser.php" method="post" role="form" style="display: column;">
                <h1><strong>Supprimer un utilisateur</strong></h1>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <p class="alert alert-warning block"><i>Etes-vous sûr de vouloir supprimer cet utilisateur ? </i></p>
                <div class="form-actions">
                    <button id="yes" type="submit" class="btn btn-warning">Oui</button>
                    <a id="no" class="btn btn-danger " href="index.php ">Non</a>
                </div>
            </form>
          
            
        </div>
    </div>
</body>
</html>
