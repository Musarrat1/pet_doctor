// Product card hover effect
document.addEventListener('DOMContentLoaded', function() {
  const productCards = document.querySelectorAll('.product-card');
  
  productCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.querySelector('.product-image').style.transform = 'scale(1.03)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.querySelector('.product-image').style.transform = 'scale(1)';
    });
  });

  const shopNowButtons = document.querySelectorAll('.shop-now');
shopNowButtons.forEach(button => {
  button.addEventListener('click', () => {
    window.location.href = 'profile.php';
  });
});

  // Add to cart functionality
 const addToCartButtons = document.querySelectorAll('.product-card button.add-to-cart');
  
  addToCartButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      // Get product info
      const productCard = this.closest('.product-card');
      const productName = productCard.querySelector('h3').textContent;
      const productPrice = productCard.querySelector('.text-petgreen-600').textContent;
      
      // Update cart count
      const cartCount = document.querySelector('.fa-shopping-cart + span');
      let currentCount = parseInt(cartCount.textContent);
      cartCount.textContent = currentCount + 1;
      
      // Show added notification
      showNotification(`${productName} added to cart!`);
    });
  });

  // Notification function
  function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-4 right-4 bg-purple-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center notification';
    notification.innerHTML = `
      <i class="fas fa-check-circle mr-2"></i>
      <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
      notification.classList.add('opacity-0', 'transition-opacity', 'duration-300');
      setTimeout(() => notification.remove(), 300);
    }, 3000);
  }

  // Mobile menu toggle
  const mobileMenuButton = document.querySelector('.md\\:hidden');
  const navMenu = document.querySelector('nav');
  
  mobileMenuButton.addEventListener('click', function() {
    navMenu.classList.toggle('hidden');
    navMenu.classList.toggle('block');
    navMenu.classList.toggle('absolute');
    navMenu.classList.toggle('top-16');
    navMenu.classList.toggle('left-0');
    navMenu.classList.toggle('right-0');
    navMenu.classList.toggle('bg-white');
    navMenu.classList.toggle('shadow-lg');
    navMenu.classList.toggle('p-4');
    navMenu.classList.toggle('z-50');
  });

  // Search functionality
  const searchButton = document.querySelector('.fa-search').parentElement;
  const searchInput = document.querySelector('input[type="text"]');
  
  searchButton.addEventListener('click', function() {
    const searchTerm = searchInput.value.trim();
    if (searchTerm) {
      // In a real app, this would filter products
      alert(`Searching for: ${searchTerm}`);
    }
  });
  
  searchInput.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      const searchTerm = searchInput.value.trim();
      if (searchTerm) {
        alert(`Searching for: ${searchTerm}`);
      }
    }
  });

  // Pagination
  const paginationButtons = document.querySelectorAll('nav button');
  paginationButtons.forEach(button => {
    button.addEventListener('click', function() {
      // Remove active class from all buttons
      paginationButtons.forEach(btn => btn.classList.remove('bg-purple-400', 'text-white'));
      
      // Add active class to clicked button if it's a number
      if (!this.querySelector('i')) {
        this.classList.add('bg-purple-400', 'text-white');
      }
      
      // In a real app, this would load the appropriate page
      alert(`Loading page ${this.textContent.trim()}`);
    });
  });

  // Newsletter form
  const newsletterForm = document.querySelector('.max-w-md');
  newsletterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input').value;
    if (email) {
      alert(`Thank you for subscribing with ${email}! Check your email for a 10% off coupon.`);
      this.querySelector('input').value = '';
    }
  });
});