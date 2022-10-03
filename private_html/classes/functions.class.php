<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

//Import QRCode generator
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

//Load Composer's autoloader
require_once '../private_html/vendor/autoload.php';

class functions
{
    private $container;

    public function __construct(container $container)
    {
        $this->container = $container;    
    }

    #region Items
    public function CreateItem($name, $description, $image, $price)
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('createItem');
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
            echo "New record created successfully";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function GetItems()
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('getItems');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            echo count($result)." record/s selected successfully";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function GetItem($id)
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('getItem');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            echo count($result)." record/s selected successfully";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function DeleteItem($id)
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('deleteItem');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            echo "Record successfully deleted";
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }
    #endregion

    #region Orders

    #endregion

    #region Contact Form & Mail

    public function sendFormEmail(Array $data)
    {
        $credArray = $this->container->credentials()->getMailCredentials();
        $to = $data['email'];
        $reciver = $credArray['emailReceivers'];
        $phone = $data['phone'];
        #$msg = $data['msg'];

        $subject = "Meddelande från solyuf.offthegridcg.me :-)";

        #TEMPORARY#

        $msg = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>
        Kontaktinformation: <a href='mailto:$to'>$to</a> :: <a href='tel:$phone'>$phone</a>
        </p>
        <p>
        ".htmlspecialchars($data['msg'], ENT_SUBSTITUTE)."
        </p>
        </body>
        </html>
        ";

        #TEMPORARY#

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try 
        {
            //Server settings
            $mail->SMTPDebug  = SMTP::DEBUG_OFF;                    //Enable verbose debug output
            $mail->isSMTP();                                        //Send using SMTP
            $mail->CharSet    = "UTF-8";                            //Set mail charset
            $mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                               //Enable SMTP authentication
            #$mail->Username   = $credArray['username'];             //SMTP username
            #$mail->Password   = $credArray['password'];             //SMTP password
            $mail->AuthType = 'XOAUTH2';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
            $mail->Port       = 465;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $email = $credArray['oauthUserEmail'];
            $clientId = $credArray['oauthClientId'];
            $clientSecret = $credArray['oauthClientSecret'];

            //Obtained by configuring and running get_oauth_token.php
            //after setting up an app in Google Developer Console.
            $refreshToken = $credArray['oauthRefreshToken'];

            //Create a new OAuth2 provider instance
            $provider = new Google(
                [
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                ]
            );

            //Pass the OAuth provider instance to PHPMailer
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider' => $provider,
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                        'refreshToken' => $refreshToken,
                        'userName' => $email,
                    ]
                )
            );


            //Recipients
            $mail->setFrom($credArray['oauthUserEmail'], "Knifetownburgers ".substr($credArray['oauthUserEmail'], 0, strpos($credArray['oauthUserEmail'], '.') ));
            $mail->addAddress("$reciver");
            $mail->addReplyTo("$to");

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            error_log("Successfully sent email to $reciver");
        } catch (Exception $e) {
            error_log("sendEmail.php got an error -> Error: {$mail->ErrorInfo}");
        }
    }

    #endregion

    #region QR Code

    public function GenerateQRCode(string $phone, int $price, int $orderId)
    {
        $data = "C$phone;$price;Soly UF - Order#$orderId;0";
        return (new QRCode)->render($data);
    }
    #endregion

}
?>