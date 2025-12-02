<?php
include "../database/config.php";
include "../includes/functions.php";

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

try {
    // Check if required fields are set
    if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'])) {
        // Sanitize input
        $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
        $middle_name = htmlspecialchars($_POST['middle_name'] ?? null, ENT_QUOTES, 'UTF-8');
        $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars($_POST['phone'] ?? null, ENT_QUOTES, 'UTF-8');
        $gender = htmlspecialchars($_POST['gender'] ?? null, ENT_QUOTES, 'UTF-8');
        $country = htmlspecialchars($_POST['country'] ?? null, ENT_QUOTES, 'UTF-8');
        $nationality = htmlspecialchars($_POST['nationality'] ?? null, ENT_QUOTES, 'UTF-8');
        $occupation = htmlspecialchars($_POST['occupation'] ?? null, ENT_QUOTES, 'UTF-8');
        $organization = htmlspecialchars($_POST['organization'] ?? null, ENT_QUOTES, 'UTF-8');
        $member_of_yangg = htmlspecialchars($_POST['member_of_yangg'] ?? null, ENT_QUOTES, 'UTF-8');
        $attendance = htmlspecialchars($_POST['attendance'] ?? null, ENT_QUOTES, 'UTF-8');
        $hear_about_ays = htmlspecialchars($_POST['hear_about_ays'] ?? null, ENT_QUOTES, 'UTF-8');
        $africa_progress = htmlspecialchars($_POST['africa_progress'] ?? null, ENT_QUOTES, 'UTF-8');
        $africa_challenge = htmlspecialchars($_POST['africa_challenge'] ?? null, ENT_QUOTES, 'UTF-8');
        $heard_sdgs = htmlspecialchars($_POST['heard_sdgs'] ?? null, ENT_QUOTES, 'UTF-8');
        $resonate_sdgs = htmlspecialchars($_POST['resonate_sdgs'] ?? null, ENT_QUOTES, 'UTF-8');
        $africa_inspiration = htmlspecialchars($_POST['africa_inspiration'] ?? null, ENT_QUOTES, 'UTF-8');
        $africa_development = htmlspecialchars($_POST['africa_development'] ?? null, ENT_QUOTES, 'UTF-8');
        $motivation = htmlspecialchars($_POST['motivation'] ?? null, ENT_QUOTES, 'UTF-8');
        $expectations = htmlspecialchars($_POST['expectations'] ?? null, ENT_QUOTES, 'UTF-8');
        $keep_updates = htmlspecialchars($_POST['keep_updates'] ?? null, ENT_QUOTES, 'UTF-8');
        $attendance_type = htmlspecialchars($_POST['attendance_type'] ?? null, ENT_QUOTES, 'UTF-8');
        $registration_fee_aware = htmlspecialchars($_POST['registration_fee_aware'] ?? null, ENT_QUOTES, 'UTF-8');
        $willing_to_pay_fee = htmlspecialchars($_POST['willing_to_pay_fee'] ?? null, ENT_QUOTES, 'UTF-8');
        $travel_city = htmlspecialchars($_POST['travel_city'] ?? null, ENT_QUOTES, 'UTF-8');
        $visa_requirement = htmlspecialchars($_POST['visa_requirement'] ?? null, ENT_QUOTES, 'UTF-8');
        $timezone = htmlspecialchars($_POST['timezone'] ?? 'UTC', ENT_QUOTES, 'UTF-8');
        $userId = uniqid();

        // Set the timezone
        try {
            date_default_timezone_set($timezone);
        } catch (Exception $e) {
            date_default_timezone_set("UTC");
        }
        $created_date = date('Y/m/d h:i:s a', time());

        // Prepare the statement
        $stmt = $pdo->prepare("
            INSERT INTO registration (
                user_id, first_name, middle_name, last_name, email, phone, gender, country, nationality, occupation, organization,
                member_of_yangg, attendance, hear_about_ays, africa_progress, africa_challenge, heard_sdgs, resonate_sdgs,
                africa_inspiration, africa_development, motivation, expectations, keep_updates, attendance_type,
                registration_fee_aware, willing_to_pay_fee, travel_city, visa_requirement, created_date
            ) VALUES (
                :user_id, :first_name, :middle_name, :last_name, :email, :phone, :gender, :country, :nationality, :occupation, :organization,
                :member_of_yangg, :attendance, :hear_about_ays, :africa_progress, :africa_challenge, :heard_sdgs, :resonate_sdgs,
                :africa_inspiration, :africa_development, :motivation, :expectations, :keep_updates, :attendance_type,
                :registration_fee_aware, :willing_to_pay_fee, :travel_city, :visa_requirement, :created_date
            )
        ");

        // Execute the statement
        $stmt->execute([
            ':user_id' => $user_id,
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':phone' => $phone,
            ':gender' => $gender,
            ':country' => $country,
            ':nationality' => $nationality,
            ':occupation' => $occupation,
            ':organization' => $organization,
            ':member_of_yangg' => $member_of_yangg,
            ':attendance' => $attendance,
            ':hear_about_ays' => $hear_about_ays,
            ':africa_progress' => $africa_progress,
            ':africa_challenge' => $africa_challenge,
            ':heard_sdgs' => $heard_sdgs,
            ':resonate_sdgs' => $resonate_sdgs,
            ':africa_inspiration' => $africa_inspiration,
            ':africa_development' => $africa_development,
            ':motivation' => $motivation,
            ':expectations' => $expectations,
            ':keep_updates' => $keep_updates,
            ':attendance_type' => $attendance_type,
            ':registration_fee_aware' => $registration_fee_aware,
            ':willing_to_pay_fee' => $willing_to_pay_fee,
            ':travel_city' => $travel_city,
            ':visa_requirement' => $visa_requirement,
            ':created_date' => $created_date
        ]);

        // Check for successful insertion
        if ($stmt->rowCount() > 0) {
            echo json_encode(["status" => "success", "message" => "Registration successful!"]);
            // Send mail to user
        $to = $email;
        $subject = "Registration successful";
        $username = $first_name;
        $mailHeader = "Registration successful! 😊";
        $mailBody = "<p>Thank you for your registration to attend... </p>";
        $mail = sendEmail($to, $subject,  $mailHeader, $mailBody, $username);
        echo $mail;
        
        // Send mail to admin
        $to_admin = 'admin@3malgroup.com';
        $admin_subject = "Registration from Yangg";
        $admin_username = 'Admin';
        $admin_mailHeader = "Registration from Yangg";
        $admin_mailBody = "A user with the following details: Name: $first_name $last_name, Email: $email, just registered for ...";
        $admin_mail = sendEmail($to_admin, $admin_subject, $admin_mailHeader, $admin_mailBody,  $admin_username);
        echo $admin_mail;
        } else {
            echo json_encode(["status" => "error", "message" => "Registration failed."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Required fields are missing."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}

