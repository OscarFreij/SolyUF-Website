<?php

class db
{
    private $container;
    private $pdo;

    public function __construct(container $container)
    {
        $this->container = $container;    
        
        try 
        {
            $credentials = $this->container->credentials()->getDBCredentials();
            $servername = $credentials['servername'];
            $dbname = $credentials['dbname'];
            $username = $credentials['username'];
            $password = $credentials['password'];

            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("PDO Connection Astablished", 0);
        }
        catch(PDOException $e)
        {
            throw new Exception("PDO Connection Error: ".$e->getMessage(), 200);
        }   
    }
    
    public function GetPreparedStatement($statementName)
    {
        switch ($statementName) {
            case 'getItem':
                $stmtString = "SELECT * FROM items WHERE `id` = :id";
                break;
            case 'getItems':
                $stmtString = "SELECT * FROM items WHERE 1";
                break;
            case 'createItem':
                $stmtString = "INSERT INTO items (name, description, image, price) VALUES (:name, :description, :image, :price)";
                break;
            case 'deleteItems':
                $stmtString = "DELETE FROM items WHERE `id` = :id";
                break;
            case 'getOrder':
                $stmtString = "SELECT * FROM orders WHERE `id` = :id";
                break;
            case 'getOrders':
                $stmtString = "SELECT * FROM orders WHERE 1";
                break;    
            case 'createOrder':
                $stmtString = "INSERT INTO orders (email, phonenumber, address, postalcode, city, orderData, totalPrice) VALUES (:email, :phonenumber, :address, :postalcode, :city, :orderData, :totalPrice);";
                break;
            case 'toggleOrderPaid':
                $stmtString = "UPDATE orders SET paid = (:paid) WHERE id = :id";
                break;
            case 'toggleOrderSent':
                $stmtString = "UPDATE orders SET sent = (:sent) WHERE id = :id";
                break;
            default:
                throw new Exception("No prepared statement with matching name - (statementName):$statementName", 210);
                return;
        }

        $stmt = $this->pdo->prepare($stmtString);
        return $stmt;
    }

    public function GetLastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }
}
