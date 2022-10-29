function addNewToCart(id) {
    alert("Produkt lagd i varukorgen!");
    let elements = document.querySelector("#cartList").children;
    for (let i = 0; i < elements.length; i++) {
        const element = elements[i];
        if (element.hasAttribute('data-productid'))
        {
            if (element.dataset.productid == id)
            {
                element.children[0].children[1].children[2].click();
                return;
            }
        }   
    }

    $d1 = id;
    $d2 = 1;
    $d3 = "editCart";
    $.post("callback.php", { itemId: $d1, itemCount: $d2, action: $d3 }, function(data, status) {if (status != 'success'){alert("Action Error: "+status)}else{location.reload();}});
}
