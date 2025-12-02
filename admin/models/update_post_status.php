<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include "../../includes/session.php";
include "../../database/config.php";
include "../../includes/functions.php";

if (isset($_GET['draft_post'])) {
    $blog_id = isset($_GET['draft_post']) ? $_GET['draft_post'] : null;
    $status = 'draft';
    try {
        $query = "UPDATE blog 
                  SET status  = :status
                  WHERE blog_id = :blog_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'status' => $status,
            'blog_id' => $blog_id,
        ]);
        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update post status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['publish_post'])) {
    $blog_id = isset($_GET['publish_post']) ? $_GET['publish_post'] : null;
    $status = 'published';
    try {
        $query = "UPDATE blog 
                  SET status  = :status
                  WHERE blog_id = :blog_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'status' => $status,
            'blog_id' => $blog_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update post status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['trash_post'])) {
    $blog_id = isset($_GET['trash_post']) ? $_GET['trash_post'] : null;
    $status = 'trashed';
    try {
        $query = "UPDATE blog 
                  SET status  = :status
                  WHERE blog_id = :blog_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'status' => $status,
            'blog_id' => $blog_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update post status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['trash_listing'])) {
    $store_id = isset($_GET['trash_listing']) ? $_GET['trash_listing'] : null;
    $status = 'trashed';
    try {
        $query = "UPDATE listings
                  SET status  = :status
                  WHERE store_id = :store_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'status' => $status,
            'store_id' => $store_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update listing status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['publish_listing'])) {
    $store_id = isset($_GET['publish_listing']) ? $_GET['publish_listing'] : null;
    $status = 'published';
    try {
        $query = "UPDATE listings
                  SET status  = :status
                  WHERE store_id = :store_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'status' => $status,
            'store_id' => $store_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update listing status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['archive_listing'])) {
    $store_id = isset($_GET['archive_listing']) ? $_GET['archive_listing'] : null;
    $status = 'archived';
    try {
        $query = "UPDATE listings
                  SET status  = :status
                  WHERE store_id = :store_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'status' => $status,
            'store_id' => $store_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update listing status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['trash_casestudy'])) {
     $data_id = isset($_GET['trash_casestudy']) ? $_GET['trash_casestudy'] : null;
    $status = 'trashed';
    try {
        $query = "UPDATE case_study
                  SET pub_status  = :pub_status
                  WHERE data_id = :data_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'pub_status' => $status,
            'data_id' => $data_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update case study status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['publish_casestudy'])) {
     $data_id = isset($_GET['publish_casestudy']) ? $_GET['publish_casestudy'] : null;
    $status = 'published';
    try {
        $query = "UPDATE case_study
                  SET pub_status  = :pub_status
                  WHERE data_id = :data_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'pub_status' => $status,
            'data_id' => $data_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update case study status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['archive_casestudy'])) {
    $data_id = isset($_GET['archive_casestudy']) ? $_GET['archive_casestudy'] : null;
    $status = 'archived';
    try {
        $query = "UPDATE case_study
                  SET pub_status  = :pub_status
                  WHERE data_id = :data_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'pub_status' => $status,
            'data_id' => $data_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update case study status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 


else if (isset($_GET['trash_event'])) {
     $data_id = isset($_GET['trash_event']) ? $_GET['trash_event'] : null;
    $status = 'trashed';
    try {
        $query = "UPDATE events
                  SET pub_status  = :pub_status
                  WHERE event_id = :event_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'pub_status' => $status,
            'event_id' => $data_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update event status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['publish_event'])) {
     $data_id = isset($_GET['publish_event']) ? $_GET['publish_event'] : null;
    $status = 'published';
    try {
        $query = "UPDATE events
                  SET pub_status  = :pub_status
                  WHERE event_id = :event_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'pub_status' => $status,
            'event_id' => $data_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update event status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else if (isset($_GET['archive_event'])) {
    $data_id = isset($_GET['archive_event']) ? $_GET['archive_event'] : null;
    $status = 'archived';
    try {
        $query = "UPDATE events
                  SET pub_status  = :pub_status
                  WHERE event_id = :event_id";

        $query_stmt = $pdo->prepare($query);
        $query_stmt->execute([
            'pub_status' => $status,
            'event_id' => $data_id,
        ]);

        if ($query_stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update event status']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 

else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
