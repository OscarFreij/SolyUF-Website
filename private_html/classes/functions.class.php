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
            error_log("New record created successfully");
        }
        catch(PDOException $e)
        {
            error_log( "Error: " . $e->getMessage());
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
            error_log( count($result)." record/s selected successfully");
            return $result;
        }
        catch(PDOException $e)
        {
            error_log( "Error: " . $e->getMessage());
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
            error_log( count($result)." record/s selected successfully");
            return $result[0];
        }
        catch(PDOException $e)
        {
            error_log( "Error: " . $e->getMessage());
        }
    }

    public function DeleteItem($id)
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('deleteItem');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            error_log( "Record successfully deleted");
        }
        catch(PDOException $e)
        {
            error_log( "Error: " . $e->getMessage());
        }
    }
    #endregion

    #region Orders
    public function CreateOrder($email, $phonenumber, $address, $postalcode, $city, $orderData, $totalPrice)
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('createOrder');
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phonenumber', $phonenumber);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':postalcode', $postalcode);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':orderData', $orderData);
            $stmt->bindParam(':totalPrice', $totalPrice);
            $stmt->execute();
            error_log("New record created successfully");
            $_SESSION['cart'] = null; // Clear cart when order is created //
            return $this->container->db()->GetLastInsertedId();
        }
        catch(PDOException $e)
        {
            error_log( "Error: " . $e->getMessage());
        }
    }

    public function GetOrders()
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('getOrders');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            error_log( count($result)." record/s selected successfully");
            return $result;
        }
        catch(PDOException $e)
        {
            error_log( "Error: " . $e->getMessage());
        }
    }

    public function GetOrder($id)
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('getOrder');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            error_log( count($result)." record/s selected successfully");
            return $result[0];
        }
        catch(PDOException $e)
        {
            error_log( "Error: " . $e->getMessage());
        }
    }

    public function ToggleOrderPaid($id, bool $paid)
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('toggleOrderPaid');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':paid', $paid);
            $stmt->execute();
            error_log("Record alterd successfully");
        }
        catch(PDOException $e)
        {
            error_log( "Error: " . $e->getMessage());
        }
    }

    public function ToggleOrderSent($id, bool $sent)
    {
        try
        {
            $stmt = $this->container->DB()->GetPreparedStatement('toggleOrderSent');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':sent', $sent);
            $stmt->execute();
            error_log("Record alterd successfully");
        }
        catch(PDOException $e)
        {
            error_log( "Error: " . $e->getMessage());
        }
    }
    #endregion

    #region Contact Form & Mail

    public function sendFormEmail(Array $data)
    {
        $credArray = $this->container->credentials()->getMailCredentials();
        $email = $data['email'];
        $reciver = $credArray['emailReceivers'];
        $phonenumber = $data['phone'];
        $subject = "Meddelande från solyuf.offthegridcg.me :-)";
        $message = htmlspecialchars($data['msg'], ENT_SUBSTITUTE);
        ob_start();
        include "../private_html/templates/mail/contactFormSent.php";
        $msg = ob_get_clean();
        $this->SendEmail($email, $reciver, $subject, $msg, $credArray);
    }

    public function sendOrderPaidEmail(int $orderId, string $email)
    {
        $subject = "Soly UF - Betalning bekreftad - Order #$orderId";
        
        ob_start();
        include "../private_html/templates/mail/orderPaid.php";
        $msg = ob_get_clean();
        $this->SendEmail(null, $email, $subject, $msg);
    }

    public function sendOrderPlacedEmail(int $orderId, string $email, string $phonenumber, string $address, string $postalcode, string $city, string $orderTableRows)
    {
        $subject = "Soly UF - Beställning registrerad - Order #$orderId";
        
        ob_start();
        include "../private_html/templates/mail/orderPlaced.php";
        $msg = ob_get_clean();
        $this->SendEmail(null, $email, $subject, $msg);
    }

    public function sendOrderSentEmail(int $orderId, string $email, string $address, string $postalcode, string $city)
    {
        $subject = "Soly UF - Beställning skickad - Order #$orderId";
        
        ob_start();
        include "../private_html/templates/mail/orderPlaced.php";
        $msg = ob_get_clean();
        $this->SendEmail(null, $email, $subject, $msg);
    }

    private function SendEmail(string $reply = null, string $destination, string $subject, string $message, array $credArray = null)
    {
        if (is_null($credArray))
        {
            $credArray = $this->container->credentials()->getMailCredentials();
        }

        if (is_null($reply))
        {
            $reply = $credArray['oauthUserEmail'];
        }

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
            $mail->setFrom($credArray['oauthUserEmail'], "Soly UF ");
            $mail->addAddress("$destination");
            $mail->addReplyTo("$reply");

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            error_log("Successfully sent email to $destination");
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
