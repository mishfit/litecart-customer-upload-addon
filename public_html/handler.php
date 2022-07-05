<?php 
  require_once('includes/app_header.inc.php');
if(!empty(array_filter($_FILES['print_image']['name']))){
    $_SESSION["temp_image_url"] = "";
    $all_image_url = "";
    $i=0;
    foreach ($_FILES['print_image']['tmp_name'] as $key => $value) {
        $i++;
        $temp = explode(".", $_FILES["print_image"]["name"][$key]);
        
        $newfilename = time() .$i. '.' . end($temp);
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/print_images/';
        
        $target_file = $target_dir . $newfilename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
         
        // Check file size
        if ($_FILES["print_image"]["size"][$key] > 5000000) {
          $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "svg" && $imageFileType != "webp" && $imageFileType != "pdf" && $imageFileType != "ps" && $imageFileType != "eps" && $imageFileType != "psd" && $imageFileType != "txt" && $imageFileType != "rtf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "xls" && $imageFileType != "xlsx") {
          $uploadOk = 0;
        }
         
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          
        } else {
          move_uploaded_file($_FILES["print_image"]["tmp_name"][$key], $target_file);
        }
        if($all_image_url==""){
          $all_image_url ="http://" . $_SERVER['SERVER_NAME'] .'/print_images/'.$newfilename;  
        }else{
        $all_image_url = $all_image_url.' , '."http://" . $_SERVER['SERVER_NAME'] .'/print_images/'.$newfilename;          
        }
        
        
    }
     $_SESSION["temp_image_url"] = $all_image_url;
    
}else{
    $_SESSION["temp_image_url"] = "";
}


?>