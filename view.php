<?php include "db_conn.php"; ?>
<html>
    <head>
        <title>view</title>
    </head>
    <body>
        <a href="index.php">&#8592;</a>
        <?php
         $stmt = $connection->prepare('select image_url from images');
         $stmt->execute();
         $imagelist = $stmt->fetchAll();
       
         foreach($imagelist as $image) {
         ?>
          <img src="uploads/<?=$image['image_url']?>" width="180" heigth="135">
           <?php
           }
           ?>
    </body>
</html>