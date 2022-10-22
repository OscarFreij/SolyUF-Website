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


async function createProduct()
{
    let name = document.getElementById('createProductModalInputTitle').value;
    let imageData = "";
    let imageFile = document.getElementById('createProductModalInputImage').files[0];
    if (typeof imageFile != "undefined")
    {
        imageData = btoa(encodeURIComponent(await readFileAsDataURL(imageFile)));
    }
    let description = document.getElementById('createProductModalInputDescription').value;
    let price = document.getElementById('createProductModalInputPrice').value;

    $d1 = name;
    $d2 = imageData;
    $d3 = description;
    $d4 = price;
    $d5 = "addProduct";
    $.post("callback.php", { name: $d1, imageData: $d2, description: $d3, price: $d4, action: $d5 }, function(data, status) {if (status != 'success'){alert("Action Error: "+status)}else{location.reload();}});
}


async function readFileAsDataURL(file) {
    let result_base64 = await new Promise((resolve) => {
        let fileReader = new FileReader();
        fileReader.onload = (e) => resolve(fileReader.result);
        fileReader.readAsDataURL(file);
    });

    //console.log(result_base64); // aGV5IHRoZXJl...

    return result_base64;
}