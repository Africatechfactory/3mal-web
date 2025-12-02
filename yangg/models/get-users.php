<?php
include "../database/config.php";
include "../includes/functions.php";

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

if(isset($_GET['fetch_all_users'])){
    try {
    $query = "SELECT 
                id, 
                first_name, 
                last_name, 
                email, 
                phone, 
                nationality, 
                gender, 
                attendance
              FROM registration";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($users) {
        $data = [];
        foreach ($users as $user) {
            // Sanitize and format user data
            $formattedName = htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8');
            $formattedEmail = htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8');
            $formattedPhone = htmlspecialchars($user['phone'], ENT_QUOTES, 'UTF-8');
            $formattedNationality = htmlspecialchars($user['nationality'], ENT_QUOTES, 'UTF-8');
            $formattedGender = htmlspecialchars($user['gender'], ENT_QUOTES, 'UTF-8');
            $formattedAttendanceMode = htmlspecialchars($user['attendance'], ENT_QUOTES, 'UTF-8');

            // Create a formatted user array
            $array = [
                'id' => $user['id'],
                'name' => $formattedName,
                'email' => $formattedEmail,
                'phone' => $formattedPhone,
                'nationality' => $formattedNationality,
                'gender' => $formattedGender,
                'attendance' => $formattedAttendanceMode
            ];
            $data[] = $array;
        }
        // Return the data in JSON format
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'No users found']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
}

$userId = isset($_GET['id']) ? $_GET['id'] : null;

if (isset($_GET['fetch_by_id']) && $userId) {
    try {
        // Query to fetch full user details by ID
        $query = "SELECT 
                    id, 
                    first_name, 
                    middle_name, 
                    last_name, 
                    email, 
                    phone, 
                    gender, 
                    country, 
                    nationality, 
                    occupation, 
                    organization, 
                    member_of_yangg, 
                    attendance, 
                    hear_about_ays, 
                    africa_progress, 
                    africa_challenge, 
                    heard_sdgs, 
                    resonate_sdgs, 
                    africa_inspiration, 
                    africa_development, 
                    motivation, 
                    expectations, 
                    keep_updates, 
                    attendance_type, 
                    registration_fee_aware, 
                    willing_to_pay_fee, 
                    travel_city, 
                    visa_requirement, 
                    created_date
                  FROM registration WHERE id = :id";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $formattedData = [
                'id' => $user['id'],
                'first_name' => htmlspecialchars($user['first_name'], ENT_QUOTES, 'UTF-8'),
                'middle_name' => htmlspecialchars($user['middle_name'], ENT_QUOTES, 'UTF-8'),
                'last_name' => htmlspecialchars($user['last_name'], ENT_QUOTES, 'UTF-8'),
                'email' => htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'),
                'phone' => htmlspecialchars($user['phone'], ENT_QUOTES, 'UTF-8'),
                'gender' => htmlspecialchars($user['gender'], ENT_QUOTES, 'UTF-8'),
                'country' => htmlspecialchars($user['country'], ENT_QUOTES, 'UTF-8'),
                'nationality' => htmlspecialchars($user['nationality'], ENT_QUOTES, 'UTF-8'),
                'occupation' => htmlspecialchars($user['occupation'], ENT_QUOTES, 'UTF-8'),
                'organization' => htmlspecialchars($user['organization'], ENT_QUOTES, 'UTF-8'),
                'member_of_yangg' => htmlspecialchars($user['member_of_yangg'], ENT_QUOTES, 'UTF-8'),
                'attendance' => htmlspecialchars($user['attendance'], ENT_QUOTES, 'UTF-8'),
                'hear_about_ays' => htmlspecialchars($user['hear_about_ays'], ENT_QUOTES, 'UTF-8'),
                'africa_progress' => htmlspecialchars($user['africa_progress'], ENT_QUOTES, 'UTF-8'),
                'africa_challenge' => htmlspecialchars($user['africa_challenge'], ENT_QUOTES, 'UTF-8'),
                'heard_sdgs' => htmlspecialchars($user['heard_sdgs'], ENT_QUOTES, 'UTF-8'),
                'resonate_sdgs' => htmlspecialchars($user['resonate_sdgs'], ENT_QUOTES, 'UTF-8'),
                'africa_inspiration' => htmlspecialchars($user['africa_inspiration'], ENT_QUOTES, 'UTF-8'),
                'africa_development' => htmlspecialchars($user['africa_development'], ENT_QUOTES, 'UTF-8'),
                'motivation' => htmlspecialchars($user['motivation'], ENT_QUOTES, 'UTF-8'),
                'expectations' => htmlspecialchars($user['expectations'], ENT_QUOTES, 'UTF-8'),
                'keep_updates' => htmlspecialchars($user['keep_updates'], ENT_QUOTES, 'UTF-8'),
                'attendance_type' => htmlspecialchars($user['attendance_type'], ENT_QUOTES, 'UTF-8'),
                'registration_fee_aware' => htmlspecialchars($user['registration_fee_aware'], ENT_QUOTES, 'UTF-8'),
                'willing_to_pay_fee' => htmlspecialchars($user['willing_to_pay_fee'], ENT_QUOTES, 'UTF-8'),
                'travel_city' => htmlspecialchars($user['travel_city'], ENT_QUOTES, 'UTF-8'),
                'visa_requirement' => htmlspecialchars($user['visa_requirement'], ENT_QUOTES, 'UTF-8'),
                'created_date' => $user['created_date']
            ];

            // Return the full user details as JSON
            echo json_encode($formattedData);
        } else {
            echo json_encode(["error" => "User not found"]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} 
?>