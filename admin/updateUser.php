<?php

   
include ('header_admin.php');


    $users_firstError = $users_lastError = $users_phoneError = $users_emailError = $users_rankError = "";
    $users_first = $users_last = $users_phone = $users_email = $users_rank = "";

if(isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id'])){
    $users_id = $_GET['id'];
    
}

if(!empty($_POST))
{
    $users_first = checkInput($_POST['users_first']);
    $users_last = checkInput($_POST['users_last']);
    $users_phone = checkInput($_POST['users_phone']);
    $users_email = checkInput($_POST['users_email']);
    $users_rank = $_POST['users_rank'];
    $isSuccess = true;
    //Debug lines
    /*echo "<pre>";
    echo $users_first;
    echo $users_last; 
    echo $users_email;
    echo $users_phone;
    echo $users_rank;
    echo "</pre>";*/
    if(empty($users_first))
    {
        $users_firstError = "Ce champ ne peut pas être vide";
        $isSuccess = false;
    }
    if(empty($users_last))
    {
        $users_lastError = "Ce champ ne peut pas être vide";
        $isSuccess = false;
    }
    if(empty($users_phone))
    {
        $users_phoneError = "Ce champ ne peut pas être vide";
        $isSuccess = false;
    }
    if(empty($users_email))
    {
        $users_emailError = "Ce champ ne peut pas être vide";
        $isSuccess = false;
    }
    if(empty($users_rank))
    {
        $users_rankError = "Ce champ ne peut pas être vide";
        $isSuccess = false;
    }
    
    if($isSuccess)
    {
        $user = new User($users_email,'',$users_id,$users_first,$users_last,$users_phone,$users_rank);
        
        try{
            
            
            $user->update($db);
            
             header("Location:index.php");
           

        } catch (CustomException $e){
            echo $e->getMessage();
        }

    }
    

    
} else {

    $userInfos = User::getUser($db,$users_id);

    


}
function checkInput($data){
    
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    
}

?> 

<body>
    <h1 class="text-logo text-center" style="color: #fff;"><i class="fas fa-id-badge"></i> Guider </h1>

    <div class="container insert mb-5 pb-5 pt-2">
        <div class="row">

            <h1 class="text-center pt-3"><strong>Modifier un utilisateur</strong></h1>
            <br/>
            <form class="form pt-2" action="updateUser.php?id=<?= $users_id ?>" method="POST" role="form">
                <div class="form-group ">
                    <br/>
                    <label class="insert" for="users_last">Nom:</label>
                    <input type="text " class="form-control" id="nom" name="users_last" placeholder="Nom" value="<?= $userInfos['users_last']; ?>">
                    <span class="help-inline"><?php echo $users_lastError; ?></span>
                </div>

                <div class="form-group ">
                    <label class="insert" for="users_first">Prénom:</label>
                    <input type="text " class="form-control" id="prenom" name="users_first" placeholder="Prénom" value="<?= $userInfos['users_first']; ?>">
                    <span class="help-inline"><?php echo $users_firstError; ?></span>

                </div>

                <div class="form-group ">
                    <label class="insert" for="users_phone">Téléphone:</label>
                    <input type="text " class="form-control" id="phone" name="users_phone" placeholder="xx xx xx xx xx" value="<?= $userInfos['users_phone']; ?>">
                    <span class="help-inline"><?php echo $users_phoneError; ?></span>

                    <label class="insert" for="users_email">Email:</label>
                    <input type="email" class="form-control" id="email" name="users_email" placeholder="email@email.com" value="<?= $userInfos['users_email']; ?>">
                    <span class="help-inline"><?php echo $users_emailError; ?></span>

                    <label class="insert" for="users_rank">Rang:</label>
                    <select name="users_rank" id="rank">
                        <option value="1" <?php if ($userInfos['users_rank'] == 1){ ?>selected="selected" <?php } ?>>Utilisateur</option>
                        <option value="2" <?php if ($userInfos['users_rank'] == 2){ ?>selected="selected" <?php } ?>>Guide</option>
                        <option value="3" <?php if ($userInfos['users_rank'] == 3){ ?>selected="selected" <?php } ?>>Administrateur</option>
                    </select>
                    <span class="help-inline"><?php echo $users_rankError; ?></span>

                </div>
                    
                <div class="form-actions">
                    <button type="submit" class="btn btn-success mr-2"><i class="fas fa-pencil-alt"></i>Mettre à jour</button>
                    <a class="btn btn-primary " href="index.php "><i class="fas fa-arrow-left"></i> Retour</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
