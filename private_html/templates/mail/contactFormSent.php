<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt formulär för Soly UF</title>
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
    <h1>Kontaktförfrågan från Soly UF hemsidan</h1>
    <p><b>Kontaktuppgifter:</b> <a href="mailto:<?=$email?>"></a><?=$email?> <a href="tel:<?=$phonenumber?>"></a><?=$phonenumber?></p>
    <p><b>Meddelande:</b> <?=$message?></p>
    <br>
    <div>
    <h3>Med vänliga hälsningar // Team Soly UF</h3>
    <a href="https://solyuf.offthegridcg.me" title="Klicka på mig för att komma till hemsidan!">
        <img class="logo" src="https://solyuf.offthegridcg.me/static/images/soly_dark.png" alt="Soly UF Logga">
    </a>    
</div>
</body>
</html>