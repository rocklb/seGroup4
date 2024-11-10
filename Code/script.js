function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
    } else {
        sidebar.style.width = "250px";
    }
}

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