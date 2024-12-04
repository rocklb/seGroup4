function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
    } else {
        sidebar.style.width = "250px";
    }
}



// initialize cart
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// function to add item
function addToCart(product) {
    // check if product is in cart
    const existingItem = cart.find(item => item.name === product.name);

    if(existingItem) {
        // increment if item is there
        existingItem.quantity += 1;
    }
    else {
        // add new product 
        cart.push({ ...product, quantity: 1});
    }
    // save to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCartItems();
}

// function to remove an item 
function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCartItems();
}



// function to update item in cart
function updateQuantity(index, quantity) {
    if(quantity > 0) {

        // update quantity
        cart[index].quantity = quantity;

        //save cart
        localStorage.setItem('cart', JSON.stringify(cart));

        //update cart 
        loadCartItems();
    }
}

// load cart items
function loadCartItems() {
    const cartItemsContainer = document.querySelector('.cart-items');

    if(!cartItemsContainer) 
        return;

    // clear exisiting items
    cartItemsContainer.innerHTML = ''; 

    if(cart.length === 0) {
        cartItemsContainer.innerHTML = '<p> Your cart is empty.</p>';
        
        updateCartTotals();
        return;
    }

    cart.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.setAttribute('data-price', item.price);
        cartItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div class="item-details">
                <p>${item.name}</p>
                <p>Price: $${item.price.toFixed(2)}</p>
                <label for="quantity${index}">Quantity:</label>
                <input type="number" id="quantity${index}" value="${item.quantity}" min="1" data-index="${index}">
            </div>
            <button class="remove-btn" data-index="${index}">Remove</button>
        `;
        cartItemsContainer.appendChild(cartItem);
    });
    

    // quantity change
    const quantityInputs = document.querySelectorAll('.item-details input[type="number"]');
    quantityInputs.forEach(input => {
        input.addEventListener('change', (e) => {
            const index = parseInt(e.target.getAttribute('data-index'));
            const newQuantity = parseInt(e.target.value);
            
            if(newQuantity < 1) {
                // check for invalid input
                e.target.value = 1;
                return;
            }
            cart[index].quantity = newQuantity;
            localStorage.setItem('cart', JSON.stringify(cart));

            updateCartTotals();
        });
    });


    // listner for remove button
    const removeButtons = document.querySelectorAll('.remove-btn');

    removeButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const index = parseInt(button.getAttribute('data-index'));
            removeFromCart(index);
        });
    });

    updateCartTotals();
}






// listener for add cart button
document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

    addToCartButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            const productCard = button.closest('.product-card');
            const product = {
                name: productCard.querySelector('p').textContent,
                price: parseFloat(productCard.querySelector('.product-price').textContent.replace('$', '')),
                image: productCard.querySelector('img').src,
            };
            addToCart(product);
        });
    });
    loadCartItems();
});







// Function to update cart totals
function updateCartTotals() {
    const cartItems = document.querySelectorAll('.cart-item');
    const cartItemsContainer = document.querySelector('.cart-items');
    let totalItems = 0;
    let totalPrice = 0.0;

    if (cartItems.length === 0) {
        cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
        document.getElementById('total-items').textContent = '0';
        document.getElementById('total-price').textContent = '0.00';
        return;
    }

    cartItems.forEach(item => {
        const price = parseFloat(item.getAttribute('data-price'));
        const quantityInput = item.querySelector('input[type="number"]');
        const quantity = parseInt(quantityInput.value);

        totalItems += quantity;
        totalPrice += price * quantity;
    });

    // Update the totals in the DOM
    document.getElementById('total-items').textContent = totalItems;
    document.getElementById('total-price').textContent = totalPrice.toFixed(2);
}

// Event listeners for quantity changes and item removal
document.addEventListener('DOMContentLoaded', () => {
    const removeButtons = document.querySelectorAll('.remove-btn');
    const quantityInputs = document.querySelectorAll('.item-details input[type="number"]');

    // Initial calculation of totals
    updateCartTotals();

    // Handle item removal
    removeButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const cartItem = e.target.closest('.cart-item');
            cartItem.remove();
            updateCartTotals();
        });
    });

    // Handle quantity changes
    quantityInputs.forEach(input => {
        input.addEventListener('change', () => {
            if (input.value < 1) {
                input.value = 1;
            }
            updateCartTotals();
        });
    });
})
