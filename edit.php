<!-- 11: 
importer person.php + la connexion BDD
importer le header.php
importer le footer.php
valide la creation d'un user

-->

<?php
    include_once 'dbConnection.php';
    include_once 'header.php';
    include_once 'footer.php';


    
    //11 valide la modification d'un user avec le formulaire
    //11-1(isset($_POST["name"])) voir (11-4-1)
    if (  isset($_POST["btn-update"])  ) {

        //11-2 : recuperer les $id avec $_GET["edit_id"] 

        $id=$_GET["edit_id"];
        $firstname=$_POST["firstname"];
        $lastname=$_POST["lastname"];
        $email=$_POST["email"];
        $adress=$_POST["adress"];

        //11-3 recuperer le update function voir (3-3-1)
        if ($person->update($id,$firstname, $lastname, $email, $adress)) {

            //11-3-1: une methode pour revenir a la page index une fois les modif sont validés
            header('location: indexx.php');
        }else {
            echo'failed';
            
        }
    }


    // 11-5 : extraction 
    //si edit_id porte le $id qui equivaux, fait une extraction.
    // extract est une methode: partir de l'objet personne et ramener son id (voir 3-2-1)

    if (isset($_GET["edit_id"])) {
        
        $id = $_GET["edit_id"];//11-5-1 preciser que le $id que j ai besoin est celui de la page modifié
        extract($person->getID($id));
    }


?>

<!-- 11-4 copycolle du form voir (07) -->


<div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
    <div>
        <div class="uk-card uk-card-default uk-card-body">
            <h3 class="uk-card-title">Edit informations</h3>
            
            <form method="post">
                <!--11-4-2 recuprere les valeur qui arrivent de la BDD voir (3-3-1): 
                $id,$firstname, $lastname, $email, $adress
                value = " php echo $ "


                --> 
                <fieldset class="uk-fieldset">

                    <div class="uk-margin">
                        <input class="uk-input" type="text" value = "<?php echo "$firstname"  ?>" name="firstname">
                    </div>

                    <div class="uk-margin">
                        <input class="uk-input" type="text" value = "<?php echo "$lastname"  ?>" name="lastname">
                    </div>

                    <div class="uk-margin">
                        <input class="uk-input" type="email" value = "<?php echo "$email"  ?>" name="email">
                    </div>

                    <div class="uk-margin">
                        <input class="uk-input" type="text" value = "<?php echo "$adress"  ?>" name="adress">
                    </div>

                </fieldset>

                <!--11-4-1 name = "btn-update" --> 
                <button class="uk-button uk-button-primary" type="submit" name="btn-update">Update</button>
            </form>

        </div>
    </div>

</div>












