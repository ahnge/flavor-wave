function addToCart(id) {
    // Get the product id list from local storage
    var cart = localStorage.getItem('cart');
    var cartList = [];
    if (cart) {
        cartList = JSON.parse(cart);
    }

    // Check if the product is already in the cart
    if (cartList.includes(id)) {
        return;
    }

    // Add the new product id to the list
    cartList.push(id);

    // Save the list to local storage
    localStorage.setItem('cart', JSON.stringify(cartList));

    // Show the 'Remove from Cart' button and hide the 'Add to Cart' button
    showRemoveButton(id);
    animateCartIcon()

}

function removeCart(id,isTrue = false) {
    // Get the product id list from local storage
    var cart = localStorage.getItem('cart');
    var cartList = [];
    if (cart) {
        cartList = JSON.parse(cart);
    }

    // Remove the product id from the list
    cartList = cartList.filter(itemId => itemId !== id);

    // Save the updated list to local storage
    localStorage.setItem('cart', JSON.stringify(cartList));

    // Show the 'Add to Cart' button and hide the 'Remove from Cart' button
    showAddButton(id);
    animateCartIcon()

    if(isTrue)
    {
        let  productItem = document.getElementById("productItem-"+id);
        let  itemQuantity = document.getElementById("quantity-"+id);
        let subTotalElement = document.getElementById('subTotal');
        let orderTotalElement = document.getElementById('orderTotal');

        let  price = productItem.getAttribute('data-price');
        let  quantity = itemQuantity.value;

        console.log(price,quantity);

        let subTotal = parseInt(subTotalElement.innerHTML) - (parseFloat(price) * parseInt(quantity));

        console.log(subTotal);

        subTotalElement.innerText = subTotal;
        orderTotalElement.innerText = subTotal;


        productItem.remove();
    }

}

function showRemoveButton(id) {
    let addToCartButton = document.getElementById('atc-' + id);
    let removeCartButton = document.getElementById('rmc-' + id);

    if (addToCartButton && removeCartButton) {
        addToCartButton.style.display = 'none';
        removeCartButton.style.display = 'inline-block'; // or 'block' based on your styling
    }
    // callAlert('success', 'Product added to cart')
}

function showAddButton(id) {
    let addToCartButton = document.getElementById('atc-' + id);
    let removeCartButton = document.getElementById('rmc-' + id);

    if (addToCartButton && removeCartButton) {
        addToCartButton.style.display = 'inline-block'; // or 'block' based on your styling
        removeCartButton.style.display = 'none';
    }
    // callAlert('success', 'Product removed from cart')
}

function animateCartIcon()
{
    let cartIcon = document.getElementById('cartIcon');
    cartIcon.classList.add('animate-ping');
    setTimeout(() => {
        cartIcon.classList.remove('animate-ping');
    }, 500);
}



