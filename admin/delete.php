<?php

   
include 'header_admin.php';

    $nameError = $descriptionError = $priceError = $categoryError = $imageError = "";
    $name = $description = $price = $category = $image = "";


    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }
    if(!empty($_POST['id']))
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM guides WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("Location: index.php");
    }

function checkInput($data){
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
}

?>

<body>
    <div class="mt-3 text-center">
        <img src="../img/logo.png" width="10%" height="10%" >  
    </div> 
        

    <div class="container delete col-md-8">
        <div class="row delete">
             
            <form class="form col-md-6" action="delete.php " method="post" role="form" style="display: column;">
                <h1><strong>Supprimer un item</strong></h1>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <p class="alert alert-warning block"><i>Etes-vous sûr de vouloir supprimer ce guide? </i></p>
                <div class="form-actions">
                    <button id="yes" type="submit" class="btn btn-warning">Oui</button>
                        <a id="no" class="btn btn-danger " href="index.php ">Non</a>
                </div>
                </form>
        </div>
    </div>
</body>
</html>
