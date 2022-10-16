function placeOrder() {
    $d1 = document.getElementById('confirmOrderModalInputEmail').value;
    $d2 = document.getElementById('confirmOrderModalInputPhone').value;
    $d3 = document.getElementById('confirmOrderModalInputAdress').value;
    $d4 = document.getElementById('confirmOrderModalInputPostalCode').value;
    $d5 = document.getElementById('confirmOrderModalInputCity').value;
    $d6 = "placeOrder";
    $.post("callback.php", { orderEmail: $d1, orderPhone: $d2, orderAddress: $d3, orderPostalcode: $d4, orderCity: $d5, action: $d6 }, function(data, status) {if (status != 'success'){alert("Action Error: "+status)}else{window.location.href = window.location.origin+"/?page=order&orderid="+data;}});
}
