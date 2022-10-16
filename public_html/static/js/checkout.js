function placeOrder() {
    $d1 = document.getElementById('confirmOrderModalInputEmail').value;
    $d2 = document.getElementById('confirmOrderModalInputPhone').value;
    $d3 = document.getElementById('confirmOrderModalInputAdress').value;
    $d4 = document.getElementById('confirmOrderModalInputPostalCode').value;
    $d5 = document.getElementById('confirmOrderModalInputCity').value;
    $d6 = "placeOrder";

    $s1 = validateEmail(document.getElementById('confirmOrderModalInputEmail').value);
    $s2 = validatePhone(document.getElementById('confirmOrderModalInputPhone').value);
    $s3 = validateAddress(document.getElementById('confirmOrderModalInputAdress').value);
    $s4 = validatePostalcode(document.getElementById('confirmOrderModalInputPostalCode').value);
    
    if (!$s1 || !$s2 || !$s3 || !$s4)
    {
        // Validity check failed, abort order placement. //
        return;
    }

    $.post("callback.php", { orderEmail: $d1, orderPhone: $d2, orderAddress: $d3, orderPostalcode: $d4, orderCity: $d5, action: $d6 }, function(data, status) {if (status != 'success'){alert("Action Error: "+status)}else{window.location.href = window.location.origin+"/?page=order&orderid="+data;}});
}


function validatePhone($number)
{
    let $success = /^[\+]?[0-9]{3}[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/i.test($number);
    if (!$success)
    {
        alert("Telefonnummer i fel format!");
    }
    return $success;
}

function validateEmail($email)
{
    let $success = /([a-z|A-Z|0-9]+)?[@]([a-z|A-Z|0-9]+)?[\.].+/i.test($email);
    if (!$success)
    {
        alert("Mejladress i fel format!");
    }
    return $success;
}

function validateAddress($address)
{
    let $success = /(.+\D)?[0-9]+/i.test($address);
    if (!$success)
    {
        alert("Adress är i fel format!");
    }
    return $success;
}

function validatePostalcode($postalcode)
{
    let $success = /([0-9]{5})|([0-9]{3}?[ ]?[0-9]{2})/i.test($postalcode);
    if (!$success)
    {
        alert("Postnummer är i fel format!");
    }
    return $success;
}