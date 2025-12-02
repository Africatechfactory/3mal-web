<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once "../database/config.php";
require_once "../includes/functions.php";

if (isset($_GET['fetch_caseStudy_home']) && $_GET['fetch_caseStudy_home'] == 'caseStudy_home') {
    try {
       $query = "SELECT c.data_id, c.title, c.tag, MAX(i.image_url) AS image_url
          FROM case_study c
          INNER JOIN images i ON c.data_id = i.data_id
          GROUP BY c.data_id, c.title, c.tag
          ORDER BY c.id DESC
          LIMIT 4";

                  
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $case_studies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($case_studies)) {
            $data = [];
            foreach ($case_studies as $case_study) {
                $formattedTitle = htmlspecialchars($case_study['title'], ENT_QUOTES, 'UTF-8');
                $tag = htmlspecialchars($case_study['tag'], ENT_QUOTES, 'UTF-8');
                $header_title = strip_cleanUrl($case_study['title']);

                $array = [
                    'data_id' => $case_study['data_id'],
                    'title' => $formattedTitle,
                    'image_url' => $case_study['image_url'],
                    'tag' => $tag,
                    'formated_title' => $header_title
                ];
                $data[] = $array;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No case study found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}


else if (isset($_GET['filterCategory']) && !empty($_GET['filterCategory'])) {
    $category = $_GET['filterCategory'];
    if ($category == 'all') {
        $query = "SELECT c.data_id, c.title, c.tag, MAX(i.image_url) AS image_url 
                  FROM case_study c
                  INNER JOIN images i ON c.data_id = i.data_id
                  GROUP BY c.data_id, c.title, c.tag 
                  ORDER BY c.id ASC";
    } else {
        $query = "SELECT c.data_id, c.title, c.tag, MAX(i.image_url) AS image_url 
                  FROM case_study c
                  INNER JOIN images i ON c.data_id = i.data_id
                  WHERE category = ?
                  GROUP BY c.data_id, c.title, c.tag 
                  ORDER BY c.id ASC";
    }
    try {
        $stmt = $pdo->prepare($query);

        if ($category != 'all') {
            $stmt->execute([$category]);
        } else {
            $stmt->execute();
        }

        $case_studies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($case_studies)) {
            $data = [];

            foreach ($case_studies as $case_study) {
                $formattedTitle = htmlspecialchars($case_study['title'], ENT_QUOTES, 'UTF-8');
                $tag = htmlspecialchars($case_study['tag'], ENT_QUOTES, 'UTF-8');
                $header_title = strip_cleanUrl($case_study['title']);
                $data_id = $case_study['data_id'];

                $data[] = [
                    'data_id' => $data_id,
                    'title' => $formattedTitle,
                    'image_url' => $case_study['image_url'],
                    'tag' => $tag,
                    'formated_title' => $header_title
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No case studies found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 
elseif (isset($_GET['fetch_all_caseStudy']) && $_GET['fetch_all_caseStudy'] == 'caseStudy_all') {
    // Fetch all case studies
    try {
        $query = "SELECT c.data_id, c.title, c.tag, MAX(i.image_url) AS image_url  
                  FROM case_study c
                  INNER JOIN images i ON c.data_id = i.data_id
                  GROUP BY c.data_id, c.title, c.tag 
                  ORDER BY c.id ASC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $case_studies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($case_studies)) {
            $data = [];
            foreach ($case_studies as $case_study) {
                $formattedTitle = htmlspecialchars($case_study['title'], ENT_QUOTES, 'UTF-8');
                $tag = htmlspecialchars($case_study['tag'], ENT_QUOTES, 'UTF-8');
                $header_title = strip_cleanUrl($case_study['title']);
                $data_id = $case_study['data_id'];

                $array = [
                    'data_id' => $data_id,
                    'title' => $formattedTitle,
                    'image_url' => $case_study['image_url'],
                    'tag' => $tag,
                    'formated_title' => $header_title
                ];
                $data[] = $array;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No case studies found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 




elseif (isset($_GET['fetch_posts_home']) && $_GET['fetch_posts_home']== 'posts_home') {
    try {
        $status = 'published';
        $query = "SELECT b.blog_id, b.title, b.created_date, i.image_url
                  FROM blog b
                  INNER JOIN images i ON b.blog_id = i.data_id
                  WHERE b.status = ? LIMIT 3";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$status]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($posts)) {
            $data = [];
            foreach ($posts as $post) {
            $formattedTitle = htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
            $header_title = strip_cleanUrl($post['title']);
            $rawDate = $post['created_date'];
            $dateObj = new DateTime($rawDate);
            $formattedDate = $dateObj->format('j M, Y');
            
            $array = [
                'blog_id' => $post['blog_id'],
                'title' => $formattedTitle,
                'image_url' => $post['image_url'],
                'created_date' => $formattedDate,
                'formated_title' => $header_title
            ];
                $data[] = $array;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No posts found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 



elseif (isset($_GET['fetch_all_posts']) && $_GET['fetch_all_posts']== 'posts_all') {
    try {
        $status = 'published';
        $query = "SELECT b.blog_id, b.title, b.created_date, i.image_url
                  FROM blog b
                  INNER JOIN images i ON b.blog_id = i.data_id
                  WHERE b.status = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$status]);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($posts)) {
            $data = [];
            foreach ($posts as $post) {
            $formattedTitle = htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
            $header_title = strip_cleanUrl($post['title']);
            $rawDate = $post['created_date'];
            $dateObj = new DateTime($rawDate);
            $formattedDate = $dateObj->format('j M, Y');
            
            $array = [
                'blog_id' => $post['blog_id'],
                'title' => $formattedTitle,
                'image_url' => $post['image_url'],
                'created_date' => $formattedDate,
                'formated_title' => $header_title
            ];
                $data[] = $array;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No posts found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

elseif (isset($_GET['fetch_gallery_home']) && $_GET['fetch_gallery_home']== 'gallery_home') {
    try {
        $query = "SELECT g.data_id, g.title, 
                 MIN(i.image_url) AS image_url  
          FROM gallery g
          INNER JOIN images i ON g.data_id = i.data_id
          GROUP BY g.data_id, g.title LIMIT 6";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($images)) {
            $data = [];
            foreach ($images as $image) {
            $formattedTitle = htmlspecialchars($image['title'], ENT_QUOTES, 'UTF-8');
            
            $array = [
                'data_id' => $image['data_id'],
                'title' => $formattedTitle,
                'image_url' => $image['image_url'],
            ];
                $data[] = $array;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No image(s) found in gallery']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 


elseif (isset($_GET['fetch_all_gallery']) && $_GET['fetch_all_gallery']== 'gallery_all') {
    try {
        $query = "SELECT g.data_id, g.title, 
                 MIN(i.image_url) AS image_url  
          FROM gallery g
          INNER JOIN images i ON g.data_id = i.data_id
          GROUP BY g.data_id, g.title";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($images)) {
            $data = [];
            foreach ($images as $image) {
            $formattedTitle = htmlspecialchars($image['title'], ENT_QUOTES, 'UTF-8');
            
            $array = [
                'data_id' => $image['data_id'],
                'title' => $formattedTitle,
                'image_url' => $image['image_url'],
            ];
                $data[] = $array;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No image(s) found in gallery']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
?>