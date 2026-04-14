// main.js

document.addEventListener('DOMContentLoaded', () => {
    
    // Load featured products dynamically
    const featuredGrid = document.getElementById('featured-products');
    if (featuredGrid) {
        fetch('api/get_featured_products.php')
            .then(res => res.json())
            .then(data => {
                if (data.error) {
                    featuredGrid.innerHTML = `<p>${data.error}</p>`;
                    return;
                }
                if (data.length === 0) {
                    featuredGrid.innerHTML = `<p style="grid-column: 1 / -1;">No featured products available at the moment.</p>`;
                    return;
                }
                featuredGrid.innerHTML = '';
                data.forEach(product => {
                    const card = document.createElement('div');
                    card.className = 'card';
                    card.innerHTML = `
                        <div class="card-img-container">
                            <img src="${product.image}" alt="${product.name}" class="card-img">
                            <div class="card-overlay">
                                <a href="product.php?id=${product.id}" class="btn btn-outline" style="border-width:2px; font-size:0.9rem;">Click here to order</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">${product.name}</h3>
                            <div class="card-price">₹${product.price}</div>
                            <a href="product.php?id=${product.id}" class="btn btn-primary" style="width: 100%;">Order Now</a>
                        </div>
                    `;
                    featuredGrid.appendChild(card);
                });
            })
            .catch(err => {
                console.error("Error fetching products:", err);
                featuredGrid.innerHTML = `<p style="grid-column: 1 / -1;">Failed to load products.</p>`;
            });
    }

    // Scroll Reveal Animation (Intersection Observer)
    const reveals = document.querySelectorAll('.reveal');
    const revealCallback = function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target); // Only animate once
            }
        });
    };
    const revealObserver = new IntersectionObserver(revealCallback, {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    });
    reveals.forEach(reveal => {
        revealObserver.observe(reveal);
    });

    // Active Navigation Highlight
    const sections = document.querySelectorAll("section[id]");
    const navLi = document.querySelectorAll(".nav-links li a");
    
    window.addEventListener("scroll", () => {
        let current = "";
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - 150) {
                current = section.getAttribute("id");
            }
        });

        navLi.forEach((a) => {
            a.classList.remove("active");
            if (a.getAttribute("href").includes(current) && current !== "") {
                a.classList.add("active");
            } else if (current === "" && a.getAttribute("href") === "index.html") {
                // Default to Home if at the very top
                a.classList.add("active");
            }
        });
    });

    // Form Validation for order.php
    const orderForm = document.getElementById('orderForm');
    if (orderForm) {
        orderForm.addEventListener('submit', function(e) {
            const phone = document.getElementById('phone').value;
            const phoneRegex = /^[0-9\-\+\s\(\)]{7,15}$/;
            if (!phoneRegex.test(phone)) {
                e.preventDefault();
                alert("Please enter a valid phone number.");
            }
        });
    }
});
