<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order skickad!</title>
    <style>
        .logo
        {
            height: 135px;
            width: 256px;
            object-fit: cover;
        }
        body
        {
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Order #<b><?=$orderNumber?></b> skickad!</h1>
    <p>Din order är nu skickad till nedan adress</p>
    <p><?=$address?>, <?=$postalcode?> <?=$city?></p>
    <br>
    <a href="https://solyuf.offthegridcg.me/?page=order&orderid=<?=$orderId?>">Klicka här för att komma till din order</a>
    <br>
    <div>
    <h3>Med vänliga hälsningar // Team Soly UF</h3>
    <a href="https://solyuf.offthegridcg.me" title="Klicka på mig för att komma till hemsidan!">
        <img class="logo" src="https://solyuf.offthegridcg.me/static/images/soly_dark.png" alt="Soly UF Logga">
    </a>    
</div>
</body>
</html>