<?php
function strip_cleanUrl($string){
    $string = str_replace(' ', '-', strtolower($string)); // Replaces all spaces with hyphens.
       $string = preg_replace('/[^A-Za-z0-9\.-]/', '', $string); // Removes special chars.
       $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one
         $string = str_replace('.', '', $string); // Replaces multiple hyphens with single one
         $string = str_replace(' ', '-', $string); // Replaces multiple hyphens with single one
       return $string;	
    }
    function strip_clean($string){
    $string = str_replace(' ', '-', strtolower($string)); // Replaces all spaces with hyphens.
       $string = preg_replace('/[^A-Za-z0-9\.-]/', '', $string); // Removes special chars.
       $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one
         $string = str_replace('.', '', $string); // Replaces multiple hyphens with single one
       return $string;	
    }

    function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}


  function secure_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace('@','(at)',$data);
    $data = str_replace('?','(<question mark>)',$data);
    $data = str_replace('*','(star)',$data);
    $data = str_replace('%','(percentage)',$data);
    $data = str_replace('#','(hashtag)',$data);
    $data = str_replace('^','(angle)',$data);
    $data = str_replace('=','(equals)',$data);
    $data = str_replace('<','(less than)',$data);
    $data = str_replace('>','(greater than)',$data);
    $data = str_replace('{','({)',$data);
    $data = str_replace('}','(})',$data);
    $data = str_replace('~','(tilde)',$data);
    $data = str_replace(':','(:)',$data);
    $data = str_replace(';','(;)',$data);
    $data = str_replace('|','(|)',$data);
    $data = str_replace('_','(underscore)',$data);
    $data = str_replace("'","\'",$data);
    $data = str_replace('"','(")',$data);
    return $data;
    }
   function reverse_secure_input($data) {
    $data = str_replace('(at)','@',$data);
    $data = str_replace('<question mark>','(?)',$data);
    $data = str_replace('(star)','*',$data);
    $data = str_replace('(percentage)','%',$data);
    $data = str_replace('(hashtag)','#',$data);
    $data = str_replace('(angle)','^',$data);
    $data = str_replace('(equals)','=',$data);
    $data = str_replace('(less than)','<',$data);
    $data = str_replace('(greater than)','>',$data);
    $data = str_replace('({)','{',$data);
    $data = str_replace('(})','}',$data);
    $data = str_replace('(tilde)','~',$data);
    $data = str_replace('(:)',':',$data);
    $data = str_replace('(;)',';',$data);
    $data = str_replace('(|)','|',$data);
    $data = str_replace('(underscore)','_',$data);
    $data = str_replace("\'","'",$data);
    $data = str_replace('(")','"',$data);
    return $data;	 
   }

   function event_view_count($id,$pdo){
    $sql="SELECT views FROM events WHERE event_id= ?";
        $result = $pdo->prepare($sql);
        $result->execute([$id]);
        if($result->rowCount() == 1){
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $views=$row['views'];	
        $currents_views=$views+1;
        $sql_views="UPDATE events SET views = ? WHERE event_id = ? ";
        $sql_result = $pdo->prepare($sql_views);
        $sql_result->execute([$currents_views, $id]);
        return $currents_views;
        }
    }

    function blog_view_count($id,$pdo){
      $sql="SELECT views FROM blog WHERE blog_id= ?";
          $result = $pdo->prepare($sql);
          $result->execute([$id]);
          if($result->rowCount() == 1){
          $row = $result->fetch(PDO::FETCH_ASSOC);
          $views=$row['views'];	
          $currents_views=$views+1;
          $sql_views="UPDATE blog SET views = ? WHERE blog_id = ? ";
          $sql_result = $pdo->prepare($sql_views);
          $sql_result->execute([$currents_views, $id]);
          return $currents_views;
          }
      }
      
      function sendEmail($to, $subject, $mailHeader, $mailBody,  $username = '',) {
  $greeting = $username ? "Hello $username," : "Hello";
  $year = date("Y");
    $emailTemplate = '
    <!DOCTYPE html>
    <html lang="en">
       <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
       <body style="margin: 0; padding: 0;">
          <div style="width: 100%; background: #f7f7f7; padding: 50px 0;">
            <div style="width: 800px; margin: 0 auto;">
              <div style="width: 100%; margin: 0 auto; background: #fff; padding: 0px 0px;">
                <div style="background: #fff; background-position: center; background-repeat: no-repeat; background-size: cover; padding: 16px 10px; color: #fff;">
                   <div style="padding: 30px 15px;">
                      <div style="margin-bottom: 30px; ">
                         <img src="https://3malgroup.com/images/logo.png"  width="150px" height="auto" alt="3MAL Group" class="img-fluid">
                      </div>
                      <p class="hello" style="font-family: \'Trebuchet MS\', sans-serif; color: #000; font-weight: 300; font-size: 16px; margin-bottom: 40px;">' . $greeting . '</p>
                      <div style="text-align:left">
                         <h2 style="font-size: 25px; font-weight: 600; color: #000; font-family: \'Trebuchet MS\', sans-serif;">' . $mailHeader . '</h2>
                      </div>
                      <div class="mail-main-body-box" style="padding: 0px 0">
                         <div class="text-body" style="font-size: 16px; color: #333333; font-family: \'Trebuchet MS\', sans-serif; margin-bottom: 30px; font-weight: 300;">' . $mailBody . '</div>
                         <div>
                            <p style="font-size: 16px; color: #333333; font-family: \'Trebuchet MS\', sans-serif; margin-bottom: 0; line-height: 0; font-weight: 300;">
                               Best regards
                            </p>
                            <p style="font-size: 16px; color: #333333; font-family: \'Trebuchet MS\', sans-serif; margin-bottom: 0; font-weight: 600;">
                               Team 3MAL
                            </p>
                         </div>
                         <br>
                         <br>
                         <div style="text-align:center; margin: 0 auto;">
                            <p style="font-size: 16px; color: #777777; line-height: 30px; font-family: \'Trebuchet MS\', sans-serif; font-weight: 300; margin-bottom: 30px;">
                               For any feedback or inquiries, get in touch with us at
                               <a href="mailto:hello@3malgroup.com">hello@3malgroup.com</a>.
                            </p>
                            <div>
                               <a style="color: #000; text-decoration: none; margin: 0 10px;" href="https://www.facebook.com/3MALOFFICIAL?mibextid=ZbWKwL">
                               <img src="https://cdn1.iconfinder.com/data/icons/social-media-circle-7/512/Circled_Facebook_svg-256.png" alt="Facebook" width="27px" height="auto" />
                               </a>
                               <a style="color: #000; text-decoration: none; margin: 0 10px;" href="https://www.instagram.com/3mal_official?igsh=MTRzY3RzcjEzOW83aw==">
                               <img src="https://cdn1.iconfinder.com/data/icons/social-media-circle-7/512/Circled_Instagram_svg-256.png" alt="Instagram" width="27px" height="auto" />
                               </a>
                               <a style="color: #000;text-decoration: none; margin: 0 10px;" href="https://www.linkedin.com/company/3mal-group/" style="padding: 0px 0">
                                <img src="https://cdn1.iconfinder.com/data/icons/social-media-circle-7/512/Circled_Linkedin_svg-256.png" alt="Facebook" width="27px" height="auto" />
                               </a>
                                 <a style="color: #000;text-decoration: none; margin: 0 10px;" href="https://x.com/3mal_official?t=iWvRIQR8mRYJ729le5xxnA&s=09" style="padding: 0px 0">
                               <img src="https://cdn4.iconfinder.com/data/icons/social-media-black-white-2/1227/X-128.png" alt="Facebook" width="23px" height="auto" />
                               </a>
                            </div>
                         </div>
                         <div style="margin: 0 auto; margin-top: 30px;">
                            <p style="font-size: 12px; color: #666666; font-weight: 300; font-family: \'Trebuchet MS\', sans-serif; text-align: center;">
                               &copy; 3MAL Group '.$year.'. 
                            </p>
                         </div>
                      </div>
                   </div>
                </div>
              </div>
            </div>
          </div>
       </body>
    </html>
    ';
    $message = $emailTemplate;
    $header = "From: 3MAL Group <admin@3malgroup.com> \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    $retval = mail($to, $subject, $message, $header);
}



 function resizeImage($file, $outputFile, $maxWidth = 800, $maxHeight = 600) {
    list($originalWidth, $originalHeight, $imageType) = getimagesize($file);

    // Calculate the scaling ratio
    $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);
    $newWidth = max(1, (int)($originalWidth * $ratio));
    $newHeight = max(1, (int)($originalHeight * $ratio));

    $newImage = imagecreatetruecolor($newWidth, $newHeight);

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($file);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($file);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($file);
            break;
        case IMAGETYPE_WEBP:
            $sourceImage = imagecreatefromwebp($file);
            break;
        default:
            throw new Exception('Unsupported image type.');
    }

    imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($newImage, $outputFile, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($newImage, $outputFile, 9);
            break;
        case IMAGETYPE_GIF:
            imagegif($newImage, $outputFile);
            break;
        case IMAGETYPE_WEBP:
            imagewebp($newImage, $outputFile, 90);
            break;
    }

    imagedestroy($sourceImage);
    imagedestroy($newImage);

    return true;
}



function uploadMultipleImages($pdo, $item_id, $uploadDir, $file_path, $date) {
    if (isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0) {
        $errors = [];

        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $fileName = $_FILES['images']['name'][$i];
            $fileTmpName = $_FILES['images']['tmp_name'][$i];
            $fileError = $_FILES['images']['error'][$i];

            if ($fileError === UPLOAD_ERR_OK) {
                $resizedFileName = uniqid() . '_' . basename($fileName);
                $resizedImagePath = $uploadDir . $resizedFileName;

                try {
                    $resized = resizeImage($fileTmpName, $resizedImagePath);

                    if ($resized) {
                        $img_url = $file_path . $resizedFileName;
                        $upload_img = "INSERT INTO images (data_id, image_url, created_date) VALUES (:data_id, :image_url, :created_date)";
                        $img_stmt = $pdo->prepare($upload_img);
                        $img_stmt->execute([
                            'data_id' => $item_id,
                            'image_url' => $img_url,
                            'created_date' => $date
                        ]);
                    } else {
                        $errors[] = "Error resizing $fileName.";
                    }
                } catch (Exception $e) {
                    $errors[] = "Error processing $fileName: " . $e->getMessage();
                }
            } else {
                $errors[] = "Error uploading $fileName: " . $fileError;
            }
        }

        if (empty($errors)) {
            return "All images uploaded successfully.";
        } else {
            return implode("<br>", $errors);
        }
    } else {
        return "Please select at least one image to upload.";
    }
}

function generateSafeFileName($filename, $extension) {
$filename = preg_replace('/[^a-zA-Z0-9-_\.]/', '', $filename);
$unique_id = uniqid();
$safe_filename = $filename . '_' . $unique_id . '.' . $extension;
return $safe_filename;
}

   ?>