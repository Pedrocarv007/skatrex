<html>
    <head>
        <title>Upload de imagem</title>
        <style>
            body{
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                min-height: 100vh;
            }
            #img-container{
                width: 190px;
                height: 150px;
                border: 1px solid black;
            }
            #preview{
                width: 190px;
                height: 150px;
            }

        </style>
    </head>
    <body>
        <?php if (isset($_GET['error'])): ?>
               <p><?php echo $_GET['error']; ?></p>
        <?php endif ?>
        <form action="upload.php" method="post" enctype="multipart/form-data">

        <input id="img-input" type="file" name="my_image">
        <div id="img-container">
            <img id="preview" src="">
        </div>
        <input type="submit" name="submit" value="Upload">

        </form>
         <script>
            function readImage() {
              if (this.files && this.files[0]) {
                  var file = new FileReader();
                  file.onload = function(e) {
                      document.getElementById("preview").src = e.target.result;
                  };       
                  file.readAsDataURL(this.files[0]);
              }
            }
            document.getElementById("img-input").addEventListener("change", readImage, false);
         </script>
    </body>
</html>