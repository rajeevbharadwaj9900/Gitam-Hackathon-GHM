const placeholderImage = 'path/to/placeholder.png'; // Replace with a valid placeholder image path

// Load products from local storage when the page is loaded
function loadProducts() {
    const productList = document.getElementById('product-list');
    const products = JSON.parse(localStorage.getItem('products')) || [];
    const selectedCategory = document.getElementById('category-select').value;
    const selectedFilter = document.getElementById('filter-select').value;

    let filteredProducts = selectedCategory ? 
        products.filter(product => product.category === selectedCategory && !product.sold) : 
        products.filter(product => !product.sold);

    switch (selectedFilter) {
        case 'price-low-high':
            filteredProducts.sort((a, b) => a.price - b.price);
            break;
        case 'price-high-low':
            filteredProducts.sort((a, b) => b.price - a.price);
            break;
        case 'newest':
            filteredProducts.sort((a, b) => new Date(b.dateAdded) - new Date(a.dateAdded));
            break;
        case 'popular':
            filteredProducts.sort((a, b) => b.popularity - a.popularity);
            break;
    }

    productList.innerHTML = ''; // Clear the product list
    filteredProducts.forEach(product => {
        const productItem = document.createElement('div');
        productItem.className = 'product-item';
        productItem.onclick = () => window.location.href = `product_detail.html?id=${product.id}`;
        productItem.innerHTML = `
            <img src="${product.image || placeholderImage}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>Price: $${product.price}</p>
        `;
        productList.appendChild(productItem);
    });
}

// Initialize carousel with products
function initializeCarousel() {
    const carouselTrack = document.getElementById('carousel-track');
    const products = JSON.parse(localStorage.getItem('products')) || [];
    const availableProducts = products.filter(product => !product.sold);
    carouselTrack.innerHTML = ''; // Clear the carousel track
    availableProducts.forEach(product => {
        const carouselItem = document.createElement('div');
        carouselItem.className = 'carousel-item';
        carouselItem.onclick = () => window.location.href = `product_detail.html?id=${product.id}`; // Make items interactive
        carouselItem.innerHTML = `
            <img src="${product.image || placeholderImage}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>Price: $${product.price}</p>
        `;
        carouselTrack.appendChild(carouselItem);
    });

    // Adjust the track width based on the number of items
    const itemWidth = document.querySelector('.carousel-item').offsetWidth + 10; // Including margin
    const trackWidth = availableProducts.length * itemWidth; // Calculate total track width
    carouselTrack.style.width = `${trackWidth}px`;
}

let currentIndex = 0;

function moveCarousel(direction) {
    const carouselTrack = document.getElementById('carousel-track');
    const items = document.querySelectorAll('.carousel-item');
    const itemWidth = items[0].offsetWidth + 10; // Including margin
    const maxIndex = items.length - 1;

    if (direction === 'next') {
        currentIndex++;
        if (currentIndex > maxIndex) {
            currentIndex = 0; // Reset to the first item
        }
    } else {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = maxIndex; // Reset to the last item
        }
    }

    const translateX = -currentIndex * itemWidth;
    carouselTrack.style.transform = `translateX(${translateX}px)`;
}

document.addEventListener('DOMContentLoaded', () => {
    loadProducts();
    initializeCarousel();
    setInterval(() => moveCarousel('next'), 2000); // Move the carousel every 2 seconds

    document.getElementById('carousel-button-next').addEventListener('click', () => moveCarousel('next'));
    document.getElementById('carousel-button-prev').addEventListener('click', () => moveCarousel('prev'));
});

// Search products based on the input value
function searchProducts() {
    const query = document.getElementById('search-input').value.toLowerCase();
    if (query) {
        localStorage.setItem('searchQuery', query);
        window.location.href = 'search_results.html';
    } else {
        alert('Please enter a search term.');
    }
}
