document.addEventListener("DOMContentLoaded", () => {
	const header = document.querySelector(".modern-header");
	const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
	const navMenuContainer = document.querySelector(".nav-menu-container");

	// --- MOCK API DATA for Carousel (as it was removed from DB request) ---
	const carouselData = [
		{
			background_image_url: "/assets/images/carousel/carousel-image-1.jpg",
			catch_phrase: "Discover the Perfect Wave",
			sub_text:
				"Sri Lanka's pristine coastline is calling. Let us guide you to the ultimate surfing experience.",
			button_text: "Explore Lessons",
			button_url: "#surfing-lessons",
		},
		{
			background_image_url: "/assets/images/carousel/carousel-image-2.webp",
			catch_phrase: "Your Adventure, Our Passion",
			sub_text:
				"From turquoise waves to lush green hills, we offer more than just surfing—we offer unforgettable memories.",
			button_text: "See Our Tours",
			button_url: "#explore",
		},
		{
			background_image_url: "/assets/images/carousel/carousel-image-3.jpg",
			catch_phrase: "Crafted with Island Soul",
			sub_text:
				"Discover handcrafted treasures made by local artisans — each souvenir tells the story of our island’s vibrant heritage.",
			button_text: "Explore Collection",
			button_url: "#services",
		},
	];

	const fetchData = async (action) => {
		try {
			const response = await fetch(`api.php?action=${action}`);
			if (!response.ok) {
				throw new Error(`HTTP error! status: ${response.status}`);
			}
			return await response.json();
		} catch (error) {
			console.error(`Failed to fetch ${action}:`, error);
			if (action === "get_settings") return {};
			return [];
		}
	};

	// --- Header Scroll Effect ---
	const handleScroll = () => {
		if (window.scrollY > 50) {
			header.classList.add("scrolled");
		} else {
			header.classList.remove("scrolled");
		}
	};
	window.addEventListener("scroll", handleScroll, { passive: true });

	// --- Mobile Menu ---
	if (mobileMenuToggle && navMenuContainer) {
		mobileMenuToggle.addEventListener("click", () => {
			mobileMenuToggle.classList.toggle("active");
			navMenuContainer.classList.toggle("active");
		});
		document.querySelectorAll(".nav-link").forEach((link) => {
			link.addEventListener("click", () => {
				mobileMenuToggle.classList.remove("active");
				navMenuContainer.classList.remove("active");
			});
		});
	}

	// --- Hero Carousel (Using local data as requested) ---
	const initCarousel = (() => {
		const slidesContainer = document.querySelector(".carousel-slides");
		const indicatorsContainer = document.querySelector(".carousel-indicators");
		let currentSlide = 0;
		let slides = [];
		let indicators = [];
		let carouselInterval;

		const load = () => {
			const data = carouselData;
			if (!slidesContainer || data.length === 0) {
				slidesContainer.innerHTML = `<p style="color:white;text-align:center;padding:2rem;">Could not load slides.</p>`;
				return;
			}
			slidesContainer.innerHTML = "";
			indicatorsContainer.innerHTML = "";
			data.forEach((slide) => {
				const slideEl = document.createElement("div");
				slideEl.className = "carousel-slide";
				slideEl.style.backgroundImage = `url('${slide.background_image_url}')`;
				slideEl.innerHTML = `
                  <div class="carousel-content">
                    <h1 class="catch-phrase">${slide.catch_phrase}</h1>
                    <p class="sub-text">${slide.sub_text}</p>
                    <a href="${slide.button_url}" class="btn carousel-cta">
                      <span>${slide.button_text}</span>
                      <i class="fas fa-arrow-right"></i>
                    </a>
                  </div>`;
				slidesContainer.appendChild(slideEl);
				const indicatorEl = document.createElement("div");
				indicatorEl.className = "carousel-indicator";
				indicatorEl.addEventListener("click", () =>
					goToSlide(slides.indexOf(slideEl))
				);
				indicatorsContainer.appendChild(indicatorEl);
			});
			slides = Array.from(document.querySelectorAll(".carousel-slide"));
			indicators = Array.from(document.querySelectorAll(".carousel-indicator"));
			document.querySelector(".carousel-next")?.addEventListener("click", next);
			document.querySelector(".carousel-prev")?.addEventListener("click", prev);
			goToSlide(0);
			startAutoplay();
		};
		const goToSlide = (index) => {
			if (!slides.length) return;
			slides[currentSlide].classList.remove("active");
			indicators[currentSlide].classList.remove("active");
			currentSlide = (index + slides.length) % slides.length;
			slides[currentSlide].classList.add("active");
			indicators[currentSlide].classList.add("active");
			resetAutoplay();
		};
		const next = () => goToSlide(currentSlide + 1);
		const prev = () => goToSlide(currentSlide - 1);
		const startAutoplay = () => {
			carouselInterval = setInterval(next, 7000);
		};
		const resetAutoplay = () => {
			clearInterval(carouselInterval);
			startAutoplay();
		};
		return { load };
	})();

	// --- Load Dynamic Content ---
	const loadDynamicContent = async (containerSelector, dataType, renderFn) => {
		const container = document.querySelector(containerSelector);
		if (!container) return;
		const data = await fetchData(dataType);
		if (!data || data.length === 0) {
			container.innerHTML = `<div class="loading-placeholder"><p>Could not load content.</p></div>`;
			return;
		}
		container.innerHTML = "";
		data.forEach((item) => container.appendChild(renderFn(item)));
		initializeScrollAnimations();
	};

	const renderPackage = (pkg) => {
		const card = document.createElement("div");
		card.className = "package-card animate-on-scroll";
		const featuresHtml = pkg.features
			.split(",")
			.map((f) => `<li>${f.trim()}</li>`)
			.join("");
		const whatsappText = `Hi! I'm interested in the ${pkg.name} package.`;
		card.innerHTML = `
          <h3>${pkg.name}</h3>
          <div class="price">$${parseFloat(pkg.price).toFixed(
						2
					)}<span>/person</span></div>
          <ul>${featuresHtml}</ul>
          <a href="#" target="_blank" class="btn whatsapp-link" data-text="${whatsappText}">
            <span>Book Now</span> <i class="fas fa-arrow-right"></i>
          </a>`;
		return card;
	};

	const renderTestimonial = (testimonial) => {
		const card = document.createElement("div");
		card.className = "testimonial-card animate-on-scroll";
		card.innerHTML = `
          <p>"${testimonial.quote}"</p>
          <span class="author">— ${testimonial.author}</span>`;
		return card;
	};

	// --- Load WhatsApp Links ---
	const loadWhatsAppNumber = async () => {
		const settings = await fetchData("get_settings");
		if (settings && settings.whatsapp_number) {
			const whatsappNumber = settings.whatsapp_number;
			const baseUri = `https://wa.me/${whatsappNumber}`;
			// document
			// 	.querySelector(".whatsapp-float-modern")
			// 	?.setAttribute(
			// 		"href",
			// 		`${baseUri}?text=${encodeURIComponent("Hello Ocean Top Waves!")}`
			// 	);
			document.querySelectorAll(".whatsapp-link").forEach((link) => {
				const text =
					link.dataset.text || "Hi! I'm interested in your services.";
				link.href = `${baseUri}?text=${encodeURIComponent(text)}`;
			});
		}
	};

	// --- Scroll Animation ---
	const initializeScrollAnimations = () => {
		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.classList.add("is-visible");
						observer.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.1 }
		);
		document
			.querySelectorAll(".animate-on-scroll")
			.forEach((el) => observer.observe(el));
	};

	// --- Smooth Scroll for Anchor Links ---
	document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
		anchor.addEventListener("click", function (e) {
			const href = this.getAttribute("href");
			if (href !== "#") {
				e.preventDefault();
				const target = document.querySelector(href);
				if (target) {
					target.scrollIntoView({ behavior: "smooth", block: "start" });
				}
			}
		});
	});

	// --- Initializations ---
	const init = async () => {
		initCarousel.load();
		await loadDynamicContent(
			".packages-container",
			"get_packages",
			renderPackage
		);
		await loadDynamicContent(
			".testimonials-container",
			"get_testimonials",
			renderTestimonial
		);
		await loadWhatsAppNumber();
		initializeScrollAnimations();
	};

	init();
});
