<?php
namespace App\Classes;

    // Load Composer's autoloader
    require '../vendor/autoload.php';

class Email
{
    public function sendGrid($mail, $internship)
    {
        //get link
        $fullUri = $_SERVER['REQUEST_URI']; //gets current page
        $link = "http://$_SERVER[HTTP_HOST]"; //gets base url

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("interact@mail.com", "Interact");
        $email->setSubject("Interact internships");
        $email->addTo($mail, "Dear user");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html",
            "<strong>Recently an internship near you was added</strong>
            <h1>" . $internship->title . "</h1>
            <p>description: " . $internship->description . "</p>
            If you are interested in this internship, you can check it out by <a href=" . $link . "/companies/" . $internship->companies_id . "/internships/" . $internship->id . ">clicking here!</a>
            "
        );
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}
