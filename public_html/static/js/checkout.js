function placeOrder() {
    let orderObject = new Object();
    orderObject.orderEmail = document.getElementById('confirmOrderModalInputEmail').value;
    orderObject.orderPhone = document.getElementById('confirmOrderModalInputPhone').value;
    orderObject.orderAddress = document.getElementById('confirmOrderModalInputAdress').value;
    orderObject.orderPostalcode = document.getElementById('confirmOrderModalInputPostalCode').value.replace(/\s/g, '');
    orderObject.orderCity = document.getElementById('confirmOrderModalInputCity').value;
    orderObject.action = "placeOrder";

    if (!validateInput(orderObject))
    {
        // Validity check failed, abort order placement. //
        return;
    }

    $.post("callback.php", orderObject, function(data, status) {if (status != 'success'){alert("Action Error: "+status)}else{window.location.href = window.location.origin+"/?page=order&orderid="+data;}});
}

function validateInput(obj)
{
    if (validatePhone(obj.orderPhone) && validateEmail(obj.orderEmail) && validateAddress(obj.orderAddress) && validatePostalcode(obj.orderPostalcode))
    {
        return true;
    }
    return false;
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
