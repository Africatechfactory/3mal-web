<?php

function redirect_to( $location = NULL ) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

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

    function get_timeago ($ptime)
{
	$estimate_time = time() - $ptime;
	if($estimate_time <1)
	{
		return '< 1 sec';
	}
	$condition = array(
					12 * 30 * 24 *60 *60 => 'year',
					30 * 24 *60 *60      => 'month',
					24 *60 *60           => 'day',
					60 *60               => 'hour',
					60                   => 'min',
					1                  	 => 'sec',
					
					);
	foreach ($condition as $secs => $str)
	{
		$d = $estimate_time / $secs;
		
		if($d >=1){
		$r =round( $d );
		return $r. ' '. $str . ($r > 1 ? 's' : '');
		}
	}
}


function tutorDays($tutor_id,$add_each_day,$pdo){
	foreach($add_each_day as $i){
		$sql = "INSERT INTO tutor_days(tutor_id, days) VALUES(:tutor_id, :days)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
		'tutor_id' => $tutor_id,
		'days' => $i
			]);
	}		
	}
	function deleteTutorDays($tutor_id,$pdo){
			$sql = "DELETE FROM tutor_days  WHERE tutor_id = :tutor_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'tutor_id' => $tutor_id]);	
		}

	function studentDays($student_id,$add_each_day,$pdo){
		foreach($add_each_day as $i){
			$sql = "INSERT INTO student_days(student_id, days) VALUES(:student_id, :days)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([
			'student_id' => $student_id,
			'days' => $i
				]);
		}		
		}
		function schoolCurriculum($school_id,$add_each_curriculum,$pdo){
			foreach($add_each_curriculum as $i){
				$sql = "INSERT INTO school_curr(school_id, title) VALUES(:school_id, :title)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([
				'school_id' => $school_id,
				'title' => $i
					]);
			}		
			}

			function schoolTraining($school_id,$add_each_training,$pdo){
				foreach($add_each_training as $i){
					$sql = "INSERT INTO school_training(school_id, title) VALUES(:school_id, :title)";
					$stmt = $pdo->prepare($sql);
					$stmt->execute([
					'school_id' => $school_id,
					'title' => $i
						]);
				}		
				}

		function deleteStudentDays($student_id,$pdo){
			$sql = "DELETE FROM student_days  WHERE student_id = :student_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'student_id' => $student_id]);	
		}
	function tutorGrade($tutor_id,$add_each_grade,$pdo){
		foreach($add_each_grade as $i){
			$sql = "INSERT INTO tutor_grade(tutor_id, grade_title) VALUES(:tutor_id, :grade_title)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([
			'tutor_id' => $tutor_id,
			'grade_title' => $i
				]);
		}		
		}
		function deleteTutorGrade($tutor_id,$pdo){
			$sql = "DELETE FROM tutor_grade  WHERE tutor_id = :tutor_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'tutor_id' => $tutor_id]);	
		}
		function tutorPackages($tutor_id,$add_each_package,$pdo){
			foreach($add_each_package as $i){
				$sql = "INSERT INTO tutor_package(tutor_id, package_title) VALUES(:tutor_id, :package_title)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([
				'tutor_id' => $tutor_id,
				'package_title' => $i
					]);
			}		
			}
			function deleteTutorPackages($tutor_id,$pdo){
				$sql = "DELETE FROM tutor_package  WHERE tutor_id = :tutor_id";
				$stmt = $pdo->prepare($sql);
				$stmt->execute([
					'tutor_id' => $tutor_id]);	
			}
			function studentPackages($student_id,$add_each_package,$pdo){
				foreach($add_each_package as $i){
					$sql = "INSERT INTO student_package(student_id, package_title) VALUES(:student_id, :package_title)";
					$stmt = $pdo->prepare($sql);
					$stmt->execute([
					'student_id' => $student_id,
					'package_title' => $i
						]);
				}		
				}
				function deleteStudentPackages($student_id,$pdo){
					$sql = "DELETE FROM student_package  WHERE student_id = :student_id";
					$stmt = $pdo->prepare($sql);
					$stmt->execute([
						'student_id' => $student_id]);	
				}
				function get_attendance_percentage($pdo, $student_id)
				{
					$query = "SELECT ROUND((SELECT COUNT(*) FROM attendance WHERE status = 'present' AND student_id = '".$student_id."') * 100 / COUNT(*)) AS percentage FROM attendance WHERE student_id = '".$student_id."'
					";
				
					$statement = $pdo->prepare($query);
					$statement->execute();
					$result = $statement->fetchAll();
					foreach($result as $row)
					{
						if($row["percentage"] > 0)
						{
							return $row["percentage"] . '%';
						}
						else
						{
							return 'NA';
						}
					}
				}
	
				
				function guarantor_details($tutor_id,$guarantor_id,$g_name,$g_phone,$g_id,$t_id,$url,$pdo) {
				    $img1 = $_FILES['g_id']['name'];
				    $img2 = $_FILES['t_id']['name'];
				    $target_dir = "../images/id/";
				    $upload_url1 = $url."images/id/".basename($img1); 
                    $upload_url2 = $url."images/id/".basename($img2); 
                    $target_file1 = $target_dir.basename($img1);
                    $target_file2 = $target_dir.basename($img2);
                    $img_file_type1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
                    $img_file_type2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
                    $check1 = getimagesize($_FILES['g_id']['tmp_name']);
                    $check2 = getimagesize($_FILES['t_id']['tmp_name']);
				      
				      $ext1 = substr($img1, strlen($img1)-4,strlen($img1));
				      $ext2 = substr($img2, strlen($img2)-4,strlen($img2));
				      
				      $allowed = array(".JPG", ".JPEG", ".jpg", ".jpeg", ".PNG", ".png", ".gif");
				      
				      if($check1 == false || $check2 == false){
				          echo "Kindly upload a valid image";
				      } 
				      else if(!in_array($ext1,$allowed)){
				          echo "Kindly upload guarantor ID";
				      } 
				      else if(!in_array($ext2, $allowed)){
				          echo "Kinldy upload your ID";
				      } else {
				          move_uploaded_file($_FILES['g_id']['tmp_name'], $target_file1);
				          move_uploaded_file($_FILES['t_id']['tmp_name'], $target_file2);
                            $sql = "INSERT INTO guarantor(tutor_id, name, phone, g_image_url, t_image_url, guarantor_id) VALUES(:tutor_id, :name, :phone, :g_image_url, :t_image_url, :guarantor_id)";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                            'tutor_id' => $tutor_id,
                            'name' => $g_name,
                            'phone' => $g_phone,
                            'g_image_url' => $upload_url1,
                            't_image_url' => $upload_url2,
                            'guarantor_id' => $guarantor_id
                            ]);
                            }
				}
				
	function fileUpload($c_title, $c_week, $upload_content, $content_url, $course_id, $lesson_id, $date, $pdo){
	foreach($_FILES['content_file']['tmp_name'] as $i => $tmp_name){
		$filename = $_FILES['content_file']['name'][$i];
		$filetype = $_FILES['content_file']['type'][$i];
		$filesize = $_FILES['content_file']['size'][$i];
		$filetmp  = $_FILES['content_file']['tmp_name'][$i];
		$allowed =  array('gif','GIF','PNG','png','jpg','jpeg','JPEG', 'webp','JPG', 'mp4', 'mp3', 'doc', 'DOC', 'docx', 'DOCX', 'ppt', 'pptx', 'PPT', 'PPTX', 'pdf', 'PDF');
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$imagename = str_replace(" ","-",$filename).'-'.rand(5,time()).".";
		$imagename=strip_clean($imagename).".".$ext;
		$target_path    = $upload_content.$imagename;
		$destination  = $content_url.$imagename;
		if(!empty($filename) && in_array($ext,$allowed)){
			if(move_uploaded_file($filetmp,$target_path)){
			    $sql = "INSERT INTO course_files(course_id, lesson_id, week, title, file_url, date) VALUES(:course_id, :lesson_id, :week, :title, :file_url, :date)";
                 $stmt = $pdo->prepare($sql);
                 $stmt->execute([
                 'course_id' => $course_id,
                 'lesson_id' => $lesson_id,
                 'week' => $week_title,
                 'title' => $c_title,
                 'file_url' => $destination,
                 'date' => $date
                     ]);
			}
		}
		else{
		echo "File type not valid";
		
		}
}
}

?>