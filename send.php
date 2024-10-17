<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $emailTo = $_POST['email'];
    $subject = $_POST['subject'];
    $jobTitle = $_POST['job_title'] ?? '';
    $companyName = $_POST['company_name'] ?? '';
    $startDate = $_POST['start_date'] ?? '';
    $interviewerName = $_POST['interviewer_name'] ?? '';
    $previousSubject = $_POST['previous_subject'] ?? '';
    $recommendationPurpose = $_POST['recommendation_purpose'] ?? '';

    // Initialize the PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set Gmail SMTP server
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'yashdoifode1439@gmail.com';            // Your Gmail address
        $mail->Password   = 'mvub juzg shso fhpa';                  // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $mail->Port       = 587; 

        // Recipients
        $mail->setFrom('mailer@example.com', 'Sub Mailer');
        $mail->addAddress($emailTo);

        $mail->isHTML(true);
        $mail->Subject = "Regarding: $subject";

        // Generate the email body based on the subject
        switch ($subject) {
            case 'appointment':
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif;'>
                        <h2>Appointment Letter</h2>
                        <p>Dear {$name},</p>
                        <p>We are pleased to offer you the position of {$jobTitle} at {$companyName}. Your start date is {$startDate}. We look forward to having you on our team!</p>
                        <p>Best Regards,<br>Company Name</p>
                    </div>
                ";
                break;

            case 'leave':
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif;'>
                        <h2>Leave Application</h2>
                        <p>Dear Sir/Madam,</p>
                        <p>I am writing to inform you that I am unwell and would like to request a leave of absence from work due to sickness. Please grant me leave starting from [Start Date] to [End Date].</p>
                        <p>Thank you for your understanding.</p>
                        <p>Best Regards,<br>{$name}</p>
                    </div>
                ";
                break;

            case 'holiday':
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif;'>
                        <h2>Holiday Request</h2>
                        <p>Dear Sir/Madam,</p>
                        <p>I am writing to request leave from [Start Date] to [End Date] for personal reasons. I hope you understand my situation and approve my request.</p>
                        <p>Thank you for your consideration.</p>
                        <p>Best Regards,<br>{$name}</p>
                    </div>
                ";
                break;

            case 'job_application':
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif;'>
                        <h2>Job Application</h2>
                        <p>Dear Hiring Manager,</p>
                        <p>I am writing to apply for the position of {$jobTitle} at {$companyName}. I believe my skills and experience make me an excellent candidate for this role. I am eager to contribute to your team's success and would welcome the opportunity to discuss how my background fits with your needs.</p>
                        <p>Looking forward to your positive response.</p>
                        <p>Best Regards,<br>{$name}</p>
                    </div>
                ";
                break;

            case 'thankyou':
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif;'>
                        <h2>Thank You for the Interview</h2>
                        <p>Dear {$interviewerName},</p>
                        <p>Thank you for taking the time to interview me for the position of {$jobTitle} at {$companyName}. I appreciate the opportunity to learn more about the role and your organization. I am excited about the possibility of joining your team and contributing to your company's goals.</p>
                        <p>Best Regards,<br>{$name}</p>
                    </div>
                ";
                break;

            case 'followup':
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif;'>
                        <h2>Follow-Up on Previous Email</h2>
                        <p>Dear Sir/Madam,</p>
                        <p>I hope this message finds you well. I am writing to follow up on my previous email regarding '{$previousSubject}'. I would appreciate any updates or feedback you could provide on this matter.</p>
                        <p>Thank you for your time and consideration.</p>
                        <p>Best Regards,<br>{$name}</p>
                    </div>
                ";
                break;

            case 'recommendation':
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif;'>
                        <h2>Request for Recommendation Letter</h2>
                        <p>Dear [Recipient's Name],</p>
                        <p>I am reaching out to kindly request a letter of recommendation from you for my application to {$recommendationPurpose}. Your support would greatly assist me in pursuing this opportunity. I am happy to provide any necessary information to make this process easier for you.</p>
                        <p>Thank you for considering my request.</p>
                        <p>Best Regards,<br>{$name}</p>
                    </div>
                ";
                break;

            case 'feedback':
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif;'>
                        <h2>Client Feedback Request</h2>
                        <p>Dear [Client's Name],</p>
                        <p>I hope you are doing well. As part of our commitment to providing excellent service, we value your feedback regarding your recent experience with our services. Your insights will help us improve and better meet your needs in the future.</p>
                        <p>Please feel free to share any suggestions or comments you may have.</p>
                        <p>Best Regards,<br>{$name}</p>
                    </div>
                ";
                break;

            default:
                $mail->Body = "<p>No template available for the selected subject.</p>";
        }

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Email sent successfully!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
    }
}
?>