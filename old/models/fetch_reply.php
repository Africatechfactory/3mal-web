<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../database/config.php";

if (isset($_GET['get_comment_id'])) {
    $get_comment_id = $_GET['get_comment_id'];
    try {
        $fetchdata = "SELECT * FROM reply WHERE comment_id = :comment_id ORDER BY id DESC";
        $stmt = $pdo->prepare($fetchdata);
        $stmt->execute(['comment_id' => $get_comment_id]);

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                $text = $row['text'];
                $date = $row['date'];
                $date_obj = date_create($date);
                $date_posted = date_format($date_obj, "d M, Y");
                $id = $row['id'];
?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="reply_item_response">
                            <h3><?php echo $name ?></h3>
                            <span><?php echo $date_posted; ?></span>
                            <div class="">
                                <p><?php echo $text ?></p>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            }
        } else {
            echo "<p class='no_reply'>No Reply</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
