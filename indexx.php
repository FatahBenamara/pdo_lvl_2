<?php
    // 05: importer person.php + la connexion BDD
    include_once 'dbConnection.php';

    //9-1: importer le header.php
    include_once 'header.php';

    //10-1: importer le footer.php
    include_once 'footer.php';

    //08 valide la creation d'un user avec le formulaire

    //8-1 (isset($_POST["name"]))


    if (  isset($_POST["btn-save"])  ) {
        
        //8-2 lier les variable de create (voir 3-1) avec leur $_POST["name"]

        $firstname=$_POST["firstname"];
        $lastname=$_POST["lastname"];
        $email=$_POST["email"];
        $adress=$_POST["adress"];

        //8-3 insertion des $_POST["name"] dans la base de donnee une fois que je click sur save du form
        //8-3-1 Execussion de la requette en passant par la fonction create
        if ($person->create($firstname, $lastname, $email, $adress)) {
            
        //8-3-2 retourner la requete vers indexx (meme page)

            echo '<script> windows.location.href="indexx.php";</script>';



        }else {
            echo'failed';
            
        }
    }


?>
            
            <!-- 6-2 -->

            <div class="uk-padding-large uk-grid-match">
                <div>
                    <div class="uk-card uk-card-primary uk-card-body">
                        <h3 class="uk-card-title">Primary</h3>
                        
                        <p uk-margin>
                            <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-example"><a href="" uk-icon="icon: users"></a></button>
                        </p>

                        <table class="uk-table uk-table-hover uk-table-divider">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>E-Mail</th>
                                    <th>Address</th>
                                </tr>
                            </thead>

                            <!-- 6-3: importer le tableau preparer dans la class PersonDB 
                            6-3-1 importer person.php ... fait (voir 05)
                            6-3-2 importer le tableau de read (voir 3-4-7)
                            -->
                            <tbody>
                            <!-- 6-3-2-1 importer l'instance qui est dans le dbConnection (voir 2-3) 
                                6-3-2-2 montrer le chemin qui mene vers sa fonction (voir 3-4-1) 
                            -->

                            <?php $person -> read();  ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div id="modal-example" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <h2 class="uk-modal-title">Add new person</h2>


                    <!-- 07: creer un formulaire d'insert -->
                    <form method="post">
                        <fieldset class="uk-fieldset">
                            <!-- 7-1 lier le name form avec les valeurs de la table users (voir 3-1-4)  -->
                            <div class="uk-margin">
                                <input class="uk-input" type="text" placeholder="First Name" name="firstname">
                            </div>

                            <div class="uk-margin">
                                <input class="uk-input" type="text" placeholder="Last Name" name="lastname">
                            </div>

                            <div class="uk-margin">
                                <input class="uk-input" type="email" placeholder="Email" name="email">
                            </div>

                            <div class="uk-margin">
                                <input class="uk-input" type="text" placeholder="Address" name="adress">
                            </div>

                        </fieldset>
                        <!--7-2 type = "submit" -->
                        <button class="uk-button uk-button-primary" type="submit" name="btn-save">Save</button>
                    </form>
                </div>
            </div>

