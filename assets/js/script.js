document.addEventListener("DOMContentLoaded", () => {
	const carouselContainer = document.querySelector(".hero-carousel .slide");
	const packagesContainer = document.querySelector(".packages-container");

	// --- API Fetch Functions ---
	const fetchData = async (action) => {
		try {
			const response = await fetch(`api.php?action=${action}`);
			if (!response.ok)
				throw new Error(`HTTP error! status: ${response.status}`);
			return await response.json();
		} catch (error) {
			console.error(`Failed to fetch ${action}:`, error);
			return []; // Return empty array on error
		}
	};

	// --- Load Carousel ---
	const loadCarousel = async () => {
		const data = await fetchData("get_carousel");
		if (carouselContainer) {
			carouselContainer.innerHTML = ""; // Clear placeholder
			if (data.length === 0) {
				carouselContainer.innerHTML =
					'<p class="loading-placeholder">Could not load carousel slides.</p>';
				return;
			}
			data.forEach((slide) => {
				const itemDiv = document.createElement("div");
				itemDiv.className = "item";
				itemDiv.style.backgroundImage = `url('${slide.background_image_url}')`;
				itemDiv.innerHTML = `
                  <div class="content">
                      <div class="name">${slide.catch_phrase}</div>
                      <div class="des">${slide.sub_text}</div>
                      <a href="${slide.button_url}" style="background-color:${slide.button_color};">${slide.button_text}</a>
                  </div>
              `;
				carouselContainer.appendChild(itemDiv);
			});
			initializeCarousel();
		}
	};

	// --- Load Packages ---
	const loadPackages = async () => {
		const data = await fetchData("get_packages");
		if (packagesContainer) {
			packagesContainer.innerHTML = ""; // Clear placeholder
			if (data.length === 0) {
				packagesContainer.innerHTML =
					'<p class="loading-placeholder">Could not load packages.</p>';
				return;
			}
			data.forEach((pkg) => {
				const packageCard = document.createElement("div");
				packageCard.className = "package-card animate-on-scroll";
				const featuresHtml = pkg.features
					.split(",")
					.map((f) => `<li>${f.trim()}</li>`)
					.join("");
				const whatsappText = `Hi! I'm interested in the ${pkg.name} package.`;

				packageCard.innerHTML = `
                  <h3>${pkg.name}</h3>
                  <div class="price">$${parseFloat(pkg.price).toFixed(
										2
									)}<span>/person</span></div>
                  <ul>${featuresHtml}</ul>
                  <a href="#" target="_blank" class="btn whatsapp-link" data-text="${whatsappText}">Book Now</a>
              `;
				packagesContainer.appendChild(packageCard);
			});
			initializeScrollAnimations();
		}
	};

	// --- Carousel Logic ---
	function initializeCarousel() {
		const slide = document.querySelector(".hero-carousel .slide");
		const items = document.querySelectorAll(".hero-carousel .item");
		if (items.length === 0) return;

		let current = 0;
		const totalItems = items.length;

		const goToSlide = (slideIndex) => {
			slide.style.transform = `translateX(-${slideIndex * 100}%)`;
			current = slideIndex;
		};

		const nextSlide = () => {
			current = (current + 1) % totalItems;
			goToSlide(current);
		};

		const prevSlide = () => {
			current = (current - 1 + totalItems) % totalItems;
			goToSlide(current);
		};

		let autoSlide = setInterval(nextSlide, 5000);

		document.querySelector(".next").addEventListener("click", () => {
			nextSlide();
			clearInterval(autoSlide);
			autoSlide = setInterval(nextSlide, 5000);
		});

		document.querySelector(".prev").addEventListener("click", () => {
			prevSlide();
			clearInterval(autoSlide);
			autoSlide = setInterval(nextSlide, 5000);
		});

		goToSlide(0); // Initialize position
	}

	// --- Scroll Animation Logic ---
	function initializeScrollAnimations() {
		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.classList.add("is-visible");
					}
				});
			},
			{ threshold: 0.1 }
		);

		document.querySelectorAll(".animate-on-scroll").forEach((element) => {
			observer.observe(element);
		});
	}

	// --- Load WhatsApp Number ---
	const loadWhatsAppNumber = async () => {
		const data = await fetchData("get_whatsapp");
		if (data && data.setting_value) {
			const whatsappNumber = data.setting_value;
			document.querySelectorAll(".whatsapp-link").forEach((link) => {
				const baseText = link.dataset.text || "Hi! I'm interested in your services.";
				link.href = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(baseText)}`;
			});
		}
	};

	// --- Run Initialization ---
	loadCarousel();
	loadPackages();
	loadWhatsAppNumber();
});
