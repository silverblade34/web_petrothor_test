<?php 
require('../conexion.php');

for ($i=0; $i < count($id) ; $i++) { 
    
    // sql to delete a record
    $sql = 'UPDATE tbprecioproveedor SET status=0 WHERE id='.$id[$i];

    if ($conn->query($sql) === TRUE) {
        $resultado=true;
    } else {
        $resultado=false;
    }


}
$conn->close();

?>