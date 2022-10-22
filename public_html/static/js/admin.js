function confirmPayment(id)
{
    var $accept = confirm("Är du säker att du vill markera Order# "+id+" som betalad?\nKlicka OK för att godkänna.\n\nOBS: DETTA GÅR EJ ATT ÅNGRA!");

    if ($accept)
    {
        $d1 = id;
        $d2 = "toggleOrderPaid";
        $.post("callback.php", { orderId: $d1, action: $d2 }, function(data, status) {if (status != 'success'){alert("Action Error: "+status)}else{location.reload();}});
    }   
}



function confirmSent(id)
{
    var $accept = confirm("Är du säker att du vill markera Order# "+id+" som skickad?\nKlicka OK för att godkänna.\n\nOBS: DETTA GÅR EJ ATT ÅNGRA!");

    if ($accept)
    {
        $d1 = id;
        $d2 = "toggleOrderSent";
        $.post("callback.php", { orderId: $d1, action: $d2 }, function(data, status) {if (status != 'success'){alert("Action Error: "+status)}else{location.reload();}});
    }   
}