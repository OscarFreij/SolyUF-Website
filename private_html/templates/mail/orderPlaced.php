<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order lagd!</title>
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
        tr
        {
            border-bottom: 1px solid black;
        }
        tr:hover
        {
            background-color: #D6EEEE;
        }
        table
        {
            border-collapse: collapse;
            width: 80%;
        }
    </style>
</head>
<body>
<h1>Order #<b><?=$orderId?></b> registrerad!</h1>
    <p>Din order är nu registrerad hos oss med nedan uppgifter</p>
    <p><b>Mejladress:</b> <?=$email?></p>
    <p><b>Telefonnummer:</b> <?=$phonenumber?></p>
    <p><b>Adress: </b><?=$address?>, <?=$postalcode?> <?=$city?></p>
    <br>
    <table align="center">
        <tr>
            <th>
                Produkt
            </th>
            <th>
                Antal
            </th>
        </tr>
        <?=$orderTableRows?>
    </table>
    <br>
    <h3>För att se din order och betala (med Swish) så klickar du på länken nedan</h3>
    <a href="https://solyuf.offthegridcg.me/?page=order&orderid=<?=$orderId?>">Klicka här för att komma till din order</a>
    <br>
    <p><b>Om du inte lagt denna order ber vi dig svara på detta mejlet omgående så vi kan avbryta den</b></p>
    <br>
    <div>
    <h3>Med vänliga hälsningar // Team Soly UF</h3>
    <a href="https://solyuf.offthegridcg.me" title="Klicka på mig för att komma till hemsidan!">
        <img class="logo" src="https://solyuf.offthegridcg.me/static/images/soly_dark.png" alt="Soly UF Logga">
    </a>    
</div>
</body>
</html>