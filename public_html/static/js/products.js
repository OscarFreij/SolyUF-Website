function addNewToCart(id) {

    let elements = document.querySelector("#cartList").children;
    for (let i = 0; i < elements.length; i++) {
        const element = elements[i];
        if (element.hasAttribute('data-productid'))
        {
            if (element.dataset.productid == id)
            {
                document.querySelector("#cartList").children[0].children[0].children[1].children[2].click();
                return;
            }
        }   
    }

    $d1 = id;
    $d2 = 1;
    $d3 = "editCart";
    $.post("callback.php", { itemId: $d1, itemCount: $d2, action: $d3 });
    location.reload();
}