<!-- pareil que edit. ce qui change:
* $_POST["btn-delete"]
* on aura besoin que: $id=$_GET["delete_id"]; => le click sue delete, je supprime la cellule de id
* 

-->
<?php
    include_once 'dbConnection.php';
    include_once 'header.php';
    include_once 'footer.php';


    if (  isset($_POST["btn-delete"])  ) {
        $id=$_GET["delete_id"];

        if ($person->delete($id)) {

            header('location: indexx.php');
        }else {
            echo'failed';
            
        }
    }


    if (isset($_GET["delete_id"])) {
        
        // $id = $_GET["delete_id"];
        // extract($person->getID($id));

?>
<!-- 12 inserer un tableau -->

<table class="uk-table">
    <caption>Table Caption</caption>
    <thead> 
        <!-- voir 6-2 -->
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-Mail</th>
            <th>Address</th>
        </tr>
    </thead>
 
    <tbody>

        <!-- voir 3-4 
    
    ce qui change:
    * where id=:id on aura besoin que de l id
    * ajouter un tableau dans $stmt->execute(); voir (3-2-5)
    * PDO::FETCH_BOTH
    *  $stmt = $conn->prepare()

    
    
        -->
        <tr>
            <?php  
                
                $stmt = $conn->prepare("SELECT * FROM `users` WHERE id=:id");
                $stmt->execute(array(":id"=>$_GET["delete_id"]));
            
                while ($row=$stmt->fetch(PDO::FETCH_BOTH)){
                
               ?>
                <tr>
                    <td> <?php echo $row['id']; ?> </td>
                    <td> <?php echo $row['firstname']; ?> </td>
                    <td> <?php echo $row['lastname']; ?> </td>
                    <td> <?php echo $row['email']; ?> </td>
                    <td> <?php echo $row['adress']; ?> </td>

                    <!-- 13: inserer un button qui fait partis du tableau 
                    13-1 name="btn-delete"
                    13-2 value= php echo $row['id']; 
                    13-3 method="post"; 
                    -->
                    <td>     

                        <form method="post">
                            <input type="hidden" value="<?php echo $row['id']; ?>">
                            <button class="uk-button uk-button-danger" type="submit" name="btn-delete">Delete</button>
                        </form>

                    </td>
                </tr>

                <?php
                }
            
            ?>
    </tbody>
</table>

<?php
}


?>

