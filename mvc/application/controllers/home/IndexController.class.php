<?php

// application/controllers/admin/IndexController.class.php


class IndexController extends BaseController{

    public function mainAction(){

        include CURR_VIEW_PATH . "main.html";

        // Load Captcha class

        $this->loader->library("Captcha");

        $captcha = new Captcha;

        $captcha->hello();

        $userModel = new UserModel("user");

        $users = $userModel->getUsers();

    }

    public function indexAction(){

        //               $userModel = new UserModel("user_list");

        //$users = $userModel->getUsers();

        // Load View template

        include  CURR_VIEW_PATH . "index.html";

    }

    public function menuAction(){

        include CURR_VIEW_PATH . "menu.html";

    }

    public function dragAction(){

        include CURR_VIEW_PATH . "drag.html";

    }

    public function topAction(){

        include CURR_VIEW_PATH . "top.html";

    }

    public function SendMailAction(){
        // Replace this with your own email address
        $siteOwnersEmail = 'a1722yz@aiit.ac.jp';


        if($_POST) {

           $name = trim(stripslashes($_POST['contactName']));
           $email = trim(stripslashes($_POST['contactEmail']));
           $subject = trim(stripslashes($_POST['contactSubject']));
           $contact_message = trim(stripslashes($_POST['contactMessage']));
           
           // Check Name
                if (strlen($name) < 2) {
                        echo "<script>alert('Please enter your name!');history.back();</script>"; 
                        exit;
                }
                // Check Email
                if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
                        echo "<script>alert('Please enter a valid email address!');history.back();</script>";
                        exit;
                }
                // Check Message
                if (strlen($contact_message) < 15) {
                        echo "<script>alert('Please enter your message. It should have at least 15 characters!');history.back();</script>";
                        exit;
                }
           // Subject
                if ($subject == '') { $subject = "Contact Form Submission"; }


           // Set Message
           $message .= "Email from: " . $name . "<br />";
           $message .= "Email address: " . $email . "<br />";
           $message .= "Message: <br />";
           $message .= $contact_message;
           $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

           // Set From: header
           $from =  $name . " <" . $email . ">";

           // Email Headers
                $headers = "From: " . $from . "\r\n";
                $headers .= "Reply-To: ". $email . "\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


           if (!$error) {

              ini_set("sendmail_from", $siteOwnersEmail); // for windows server
              $mail = mail($siteOwnersEmail, $subject, $message, $headers);

                if ($mail) { echo "<script>alert('Your mail have been send!');history.back();</script>"; 
                            }
              else {echo "<script>alert('Something went wrong. Please try again!');history.back();</script>"; 
                    exit;
              }

                } # end if - no validation error

                else {

                        $response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
                        $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
                        $response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;

                        echo $response;

                } # end if - there was a validation error

        }
}
}
