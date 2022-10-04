function editCart(el, action) {
    switch (action) {
        case '-':
            el.parentElement.children[1].value--;
            break;
        case '+':
            el.parentElement.children[1].value++;
            break;
        case 'i':

            break;
        default:
            
            break;
    }

    var id = el.parentElement.parentElement.parentElement.dataset.productid;
    var basePrice = el.parentElement.parentElement.parentElement.dataset.productprice;
    var newCount = el.parentElement.children[1].value;
    //Set new price in Cart UI
    el.parentElement.parentElement.children[2].children[0].innerText = (newCount*basePrice)+" Kr";

    $d1 = id;
    $d2 = newCount;
    $d3 = "editCart";
    $.post("callback.php", { itemId: $d1, itemCount: $d2, action: $d3 });
}