<?php if(array_key_exists('vid', $_GET) && !empty($_GET['vid'])) : ?>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload']))
        {
            $target_dir = "public/uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if(isset($_POST["submit"])) 
            {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) 
                {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } 
                else 
                {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            if (file_exists($target_file)) 
            {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 500000) 
            {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
            {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) 
            {
                echo "Sorry, your file was not uploaded.";
            } 
            else 
            {
                $query = "SELECT vehicle_id FROM filenames WHERE vehicle_id = ?";
                $params = [$_GET['vid']];
                require_once DATABASE_CONTROLLER;
                $record = getRecord($query, $params);
                if(empty($record))
                {
                    $query = "INSERT INTO filenames (vehicle_id, file_name) VALUES (?,?)";
                    $params = [
                                $_GET['vid'],
                                basename( $_FILES["fileToUpload"]["name"])
                            ];
                
                    executeDML($query, $params);
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
                    {
                        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    }
                    else 
                    {
                        echo "Sorry, there was an error uploading your file.";
                    }        
                }
                else
                {
                   echo "You already uploaded an image for this vehicle!";
                }       
            }
        }
    ?>

    <form method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="upload">
    </form>
<?php else: ?>
    <?header('Location: index.php?P=listv');?>
<?php endif; ?>