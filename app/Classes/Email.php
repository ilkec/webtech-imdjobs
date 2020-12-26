<?php
namespace App\Classes;

    // Load Composer's autoloader
    require '../vendor/autoload.php';

class Email
{
    public function sendGrid()
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("interact@mail.com", "Interact");
        $email->setSubject("Interact internships");
        $email->addTo("tim.koenig25@gmail.com", "Dear user");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html",
            "<strong>We have some suggested internships for you</strong>"
        );
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}
