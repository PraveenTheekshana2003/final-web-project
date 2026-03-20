const toggle = document.getElementById('darkModeToggle');
const savedColorScheme = localStorage.getItem('color-scheme');

if (toggle) {
    if (savedColorScheme === 'dark') {
        toggle.checked = true;
        document.documentElement.style.colorScheme = 'dark';
    } else {
        document.documentElement.style.colorScheme = 'light';
    }

    toggle.addEventListener('change', function () {
        if (this.checked) {
            document.documentElement.style.colorScheme = 'dark';
            localStorage.setItem('color-scheme', 'dark');
        } else {
            document.documentElement.style.colorScheme = 'light';
            localStorage.setItem('color-scheme', 'light');
        }
    });
}

// Sync dark mode on pages without the toggle (e.g. login.html)
if (!toggle) {
    if (savedColorScheme === 'dark') {
        document.documentElement.style.colorScheme = 'dark';
    }
}


const carousels = document.querySelectorAll('.book-carousel');

carousels.forEach((carousel) => {
    const track = carousel.querySelector('.track');
    const next = carousel.querySelector('.next');
    const prev = carousel.querySelector('.prev');
    const cards = track.querySelectorAll('.book-card');
    let index = 0;
    const cardWidth = cards[0].offsetWidth + 20;

    next.addEventListener('click', () => {
        if (index < cards.length - 1) index++;
        track.style.transform = `translateX(-${index * cardWidth}px)`;
    });

    prev.addEventListener('click', () => {
        if (index > 0) index--;
        track.style.transform = `translateX(-${index * cardWidth}px)`;
    });

    document.addEventListener('keydown', (e) => {
        if (carousel.getBoundingClientRect().top < window.innerHeight && carousel.getBoundingClientRect().bottom > 0) {
            if (e.key === 'ArrowRight') {
                if (index < cards.length - 1) index++;
                track.style.transform = `translateX(-${index * cardWidth}px)`;
            } else if (e.key === 'ArrowLeft') {
                if (index > 0) index--;
                track.style.transform = `translateX(-${index * cardWidth}px)`;
            }
        }
    });
});

/**
 * Resolve the correct path to a root-level PHP file from any page depth.
 * e.g. from auth/login.php we need '../session_check.php'
 *      from index.html or cart.php at root we need 'session_check.php'
 */
function getRootPath(filename) {
    const path = window.location.pathname;
    // Count directory depth below the project root
    // We detect depth by checking if we're inside a subdirectory
    const parts = path.split('/').filter(p => p !== '');
    // Find the project folder name — everything after it is depth
    // A simple heuristic: if the current file is inside a subfolder, go up one level
    const currentFile = parts[parts.length - 1] || '';
    const inSubDir = path.includes('/auth/');
    return inSubDir ? '../' + filename : filename;
}

// Add book to cart — requires login first
function addToCart(title, price, image) {
    const sessionUrl = getRootPath('session_check.php');
    fetch(sessionUrl)
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(data => {
            if (!data.logged_in) {
                alert('You must be logged in to add books to your cart!');
                window.location.href = getRootPath('login.html');
                return;
            }
            const book = { title, price, image, id: Date.now() };
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            cartItems.push(book);
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            window.location.href = getRootPath('cart.php');
        })
        .catch((err) => {
            console.error('Session check error:', err);
            alert('Could not verify your session. Please make sure the site is running via XAMPP (not opened as a file).');
        });
}

// Cross-page filtering for explore.html
window.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname.includes('explore.html')) {
        const filter = localStorage.getItem('filter');
        if (filter) {
            if (typeof filterBooks === 'function') {
                filterBooks(filter);
                localStorage.removeItem('filter');
            }
        }
    }

    // Initialize Cart (cart.php is a PHP page so pathname ends with cart.php)
    if (window.location.pathname.includes('cart.php') || window.location.pathname.includes('cart')) {
        renderCart();
    }
});

function renderCart() {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    const cartItemsList = document.getElementById('cartItemsList');
    const cartContent = document.getElementById('cartContent');
    const emptyMessage = document.getElementById('emptyMessage');
    const subtotalElem = document.getElementById('subtotal');
    const totalPriceElem = document.getElementById('totalPrice');
    const itemCountElem = document.getElementById('itemCount');

    if (!cartItemsList) return;

    if (cartItems.length > 0) {
        cartItemsList.innerHTML = '';
        let total = 0;

        cartItems.forEach((item) => {
            // Support price stored as "1500.00", "Rs. 1500.00", or a plain number
            const priceStr = String(item.price).replace('Rs. ', '').replace(/,/g, '');
            const priceVal = parseFloat(priceStr) || 0;
            total += priceVal;

            const itemHtml = `
                <div class="cart-card">
                    <div class="d-flex align-items-center">
                        <img src="${item.image}" class="book-thumb me-4" alt="${item.title}">
                        <div>
                            <h3 class="fw-bold m-0">${item.title}</h3>
                            <p class="text-white-50 mb-3">Book</p>
                            <h4 class="text-white fw-bold">Rs. ${priceVal.toLocaleString('en-IN', {minimumFractionDigits: 2})}</h4>
                        </div>
                        <div class="ms-auto">
                            <button class="btn btn-outline-danger rounded-circle" onclick="removeItem(${item.id})">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            cartItemsList.insertAdjacentHTML('beforeend', itemHtml);
        });

        itemCountElem.innerText = cartItems.length;
        subtotalElem.innerText = 'Rs. ' + total.toLocaleString('en-IN', { minimumFractionDigits: 2 });
        totalPriceElem.innerText = 'Rs. ' + total.toLocaleString('en-IN', { minimumFractionDigits: 2 });

        cartContent.style.display = 'flex';
        emptyMessage.style.display = 'none';
    } else {
        cartContent.style.display = 'none';
        emptyMessage.style.display = 'block';
    }
}

function removeItem(id) {
    let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
    cartItems = cartItems.filter(item => item.id !== id);
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    renderCart();
}

function clearCart() {
    localStorage.removeItem('cartItems');
    renderCart();
}
