<?php
 /**
  *
  */
 class Helper
 {
  public static function uploadFile($target_dir, $name, $file_tmp, $file_size)

   {
     $uploadErr='';
       $file = strtolower(preg_replace('/[^a-zA-Z0-9.\']/', "", $name));;
       $target_file = $target_dir . basename($file);
       $upload_ok = 1;
       $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
   // Check if image file is a actual image or fake image
       if ($_FILES) {
           $check = getimagesize($file_tmp);
           if($check !== false) {
               $upload_ok = 1;
           } else {
               $uploadErr .= "File is not an image.";
               $upload_ok = 0;
           }
       }
   // Check if image file is already uploaded
       if (file_exists($target_file)) {
           $uploadErr .= "Sorry, file already exists.";
           $upload_ok = 0;
       }
   // Check file size
       if ($file_size > 90000000) {
           $uploadErr .= "Sorry, your file is too large.";
           $upload_ok = 0;
       }
   // Allow certain file formats
       if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
           && $imageFileType != "gif" ) {
           $uploadErr .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
           $upload_ok = 0;
       }
   // Check if $upload_ok is set to 0 by an error
       if ($upload_ok == 0) {
           $uploadErr .= "Sorry, your file was not uploaded.";
   // if everything is ok, try to upload file
       } else {
           if (move_uploaded_file($file_tmp, $target_file)) {
               return $file;
           } else {
               $uploadErr .= "Sorry, there was an error uploading your file.";
           }
       }
   }

   public static function  countNews()
   {
     $db= new Model();
     $counter =$db->query("select count(*) as count from news");
     return $counter[0]['count'];
   }

 }


 ?>
