function editCart(el, action) {
    switch (action) {
        case '-':
            if (el.parentElement.children[1].value > 0)
            {
                el.parentElement.children[1].value--;
            }
            else
            {
                return;
            }
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
    $.post("callback.php", { itemId: $d1, itemCount: $d2, action: $d3 }, function(data, status) {if (status != 'success'){alert("Action Error: "+status)}});
    updateTotalPrice();
}

function updateTotalPrice()
{
    var cost = 0;
    let elements = document.querySelector("#cartList").children;
    for (let i = 0; i < elements.length; i++) {
        const element = elements[i];
        if (element.hasAttribute('data-productid'))
        {
            numberOfItems = element.querySelector('input').value;
            productPrice = element.dataset.productprice;
            cost += parseInt(productPrice * numberOfItems);
        }   
    }

    document.getElementById('total-price').innerText = "Total: " + cost + " Kr";

}
