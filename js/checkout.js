let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

function checkCart() {
    var cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('listCart='));
    if (cookieValue) {
        cartItems = JSON.parse(cookieValue.split('=')[1]);
    }
}

checkCart();

function addCartToHTML() {
    let listCartHTML = document.querySelector('.returnCart .list');
    listCartHTML.innerHTML = '';
    let totalQuantityHTML = document.querySelector('.totalQuantity');
    let totalPriceHTML = document.querySelector('.totalPrice');

    let totalQuantity = 0;
    let totalPrice = 0;

    if (cartItems) {
        cartItems.forEach(product => {
            if (product) {
                let newP = document.createElement('div');
                newP.classList.add('item');

                newP.innerHTML = `
    <img src="${product.image}" alt="">
    <div class="info">
        <div class="price">${product.price}/1 product</div>
    </div>
    <div class="quantity">${product.quantity}</div>
    <div class="returnPrice">$${product.quantity * product.price}</div>`;


                listCartHTML.appendChild(newP);
                totalQuantity += product.quantity;
                totalPrice += product.quantity * product.price;
            }
        });
    }

    totalQuantityHTML.innerText = totalQuantity;
    totalPriceHTML.innerText = '$' + totalPrice;
}

addCartToHTML();

function checkout() {
    alert("Congratulations! You've successfully checked out.");
}
