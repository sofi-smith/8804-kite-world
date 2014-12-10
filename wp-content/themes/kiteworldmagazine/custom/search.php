<?php
    $conn = new PDO("mysql:host=213.171.200.74;dbname=kiteworldnew","kiteworldnew","Edw4rd6s");
    $sql = "SELECT wp_terms.term_id AS id, wp_terms.name from wp_terms JOIN wp_term_taxonomy ON wp_terms.term_id = wp_term_taxonomy.term_id WHERE parent = :continent ORDER BY name ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':continent',$_GET['c']);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo '<option value="">All</option>';
    foreach ($result as $row):
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    endforeach;




