<?php

// 02 CREER UNE CLASSE QUI GERE LE CRUD
class PersonDB{

    private $db;

    // 2-4 recuperer ($conn) de la personne connecter a la BDD avec l appel au __construct
    public function __construct($conn)
        {
            $this ->db = $conn;
            //2-5 ->db est pret pour le crud
        }

    //03 CREER LES FONCTIONS CRUD
    // 3-1 creer la fonction CREATE (besoin des champs de la table USERS)

    public function create($firstname, $lastname, $email, $adress){
        /*
        // 3-1-2 creer la variable statement (besoin d'une connection. cette connection il vas la ramene de 2-5)

        // $stmt = $this ->db

        //3-1-3 preparer la requete INSERT des parametres de la fonction create

        $stmt = $this->db->prepare("INSERT INTO `users`( `firstname`, `lastname`, `email`, `adress`) VALUES (:firstname,:lastname,:email,:adress)");

        // 3-1-4 lier (`firstname`, `lastname`, `email`, `adress`) à une valeur (:firstname,:lastname,:email,:adress) :ECIRE

        $stmt ->bindparam(":firstname",$firstname);
        $stmt ->bindparam(":lastname",$lastname);
        $stmt ->bindparam(":email",$email);
        $stmt ->bindparam(":adress",$adress);

        // 3-1-5 Execussion de la requette: LIRE
        $stmt->execute();

        // 3-1-6 retourner la requette
        return true;


        */
    
        // tester CREATE
        try {
            $stmt = $this->db->prepare("INSERT INTO `users`( `firstname`, `lastname`, `email`, `adress`) VALUES (:firstname,:lastname,:email,:adress)");
        
            $stmt ->bindparam(":firstname",$firstname);
            $stmt ->bindparam(":lastname",$lastname);
            $stmt ->bindparam(":email",$email);
            $stmt ->bindparam(":adress",$adress);

            $stmt->execute();
        
            return true;
            
        
        }catch(PDOException $e){
        echo "ERROR: ". $e->getMessage();
        return false;
        }

    }

    // 3-2 les operations sur le select ID
    // ID: rensegne sur une table
    // 3-2-1 recuperer (ID) de la personne avec la fonction getID

    public function getID ($id){

        // 3-2-2 creer la variable statement (besoin d'une connection. cette connection il vas la ramene de 2-5)

        // $stmt = $this ->db

        //3-2-3 preparer la requete de SELECT des parametres de la fonction getID

        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE id=:id");


        // 3-2-4  Execussion de la requette
        //$stmt->execute();
        // 3-2-5  Execussion de ID sous forme de tableau
        $stmt->execute(array(":id"=>$id));
            
        // 3-2-6 Recuperer des résultats dans la variable editRow
        // $editRow = $stmt->fetch();
        // 3-2-7 utiliser le PDO pour acceder a la BDD
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);

        // 3-2-8 retourner la requette
        return $editRow;
        
}


    
    // 3-3 creer la fonction UPDATE

    /*copyColle create
    -ce qui change:
    3-3-1 creer la fonction UPDATE (besoin du champ $id en plus )
    3-3-2 preparer la requete UPDATE des parametres de la fonction update
    3-3-3 lier (`id`) à une valeur ($id): ECRIRE
    */
    public function update($id,$firstname, $lastname, $email, $adress){

        try {
            $stmt = $this->db->prepare("UPDATE `users` SET `firstname`=:firstname,`lastname`=:lastname,`email`=:email,`adress`=:adress WHERE `id`=:id");
        
            $stmt ->bindparam(":firstname",$firstname);
            $stmt ->bindparam(":lastname",$lastname);
            $stmt ->bindparam(":email",$email);
            $stmt ->bindparam(":adress",$adress);
            $stmt ->bindparam(":id",$id);

            //LIRE
            $stmt->execute();
        
            return true;
            
        
        }catch(PDOException $e){
        echo "ERROR: ". $e->getMessage();
        return false;
        }

    }


    // 3-4 creer la fonction DELETE
    /*copyColle create
    -ce qui change:
    3-4-1 creer la fonction DELETE (besoin uniquement du champ $id de la table USERS)
    3-4-2 preparer la requete DELETE des parametres de la fonction delete
    */

    public function delete($id){

            try {
                $stmt = $this->db->prepare("DELETE FROM `users` WHERE `id`=:id");

                $stmt ->bindparam(":id",$id);

                $stmt->execute();
                
                return true;
            }catch(PDOException $e){
            echo "ERROR: ". $e->getMessage();
            return false;
            }
    
    }



    // 3-4 creer la fonction READ
    // 3-4-1 nomer la fonction READ 
    public function read(){

            // 3-4-2 creer la variable stmt qui nous permetra uniquement de lire
            // $stmt = $this ->db

            //3-4-3 preparer la requete SELECT pour lecture

            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE 1");
           
            // 3-4-5 Execussion de la requette:LIRE
            $stmt->execute();


            //3-4-6 condition d'acces a la BDD
            /*
             si tu accedes la BDD fait moi un comptage de cellules des tables et si c est > 0 => tu as trouvé une information (valeur) dans la BDD.
            
            */

            if ($stmt->rowCount()>0) {
                while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                
               ?>
               <!-- partie html: 3-4-7 preparer le tableau de read -->
            <tr>
                <td> <?php echo $row['id']; ?> </td>
                <td> <?php echo $row['firstname']; ?> </td>
                <td> <?php echo $row['lastname']; ?> </td>
                <td> <?php echo $row['email']; ?> </td>
                <td> <?php echo $row['adress']; ?> </td>
                
                <td><a href="edit.php?edit_id= <?php echo $row['id']; ?>" class="uk-icon-link uk-margin-small-right" uk-icon="file-edit"></a></td>
                
                <td> <a href="delete.php?delete_id= <?php echo $row['id']; ?>" class="uk-icon-link" uk-icon="trash"></a></td> 
                
            
               <?php
                }

                } else{

                ?>

                <td> No records </td>
            </tr>   
                <?php

            }



    }
    








}