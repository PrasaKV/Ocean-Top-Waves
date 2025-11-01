document.addEventListener("DOMContentLoaded", () => {
	const header = document.querySelector(".modern-header");
	const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
	const navMenuContainer = document.querySelector(".nav-menu-container");

	// --- MOCK API DATA ---
	// In a real application, this would be fetched from a server (e.g., api.php)
	const apiData = {
		carousel: [
			{
				background_image_url: "/assets/images/carousel/image-1.jpg",
				catch_phrase: "Discover the Perfect Wave",
				sub_text:
					"Sri Lanka's pristine coastline is calling. Let us guide you to the ultimate surfing experience.",
				button_text: "Explore Lessons",
				button_url: "#surfing-lessons",
			},
			{
				background_image_url: "/assets/images/carousel/image-2.webp",
				catch_phrase: "Your Adventure, Our Passion",
				sub_text:
					"From turquoise waves to lush green hills, we offer more than just surfing—we offer unforgettable memories.",
				button_text: "See Our Tours",
				button_url: "#explore",
			},
			{
				background_image_url: "/assets/images/carousel/image-3.jpg",
				catch_phrase: "Crafted with Island Soul",
				sub_text:
					"Discover handcrafted treasures made by local artisans — each souvenir tells the story of our island’s vibrant heritage.",
				button_text: "Explore Collection",
				button_url: "#services",
			},
		],
		packages: [
			{
				name: "Beginner's Bliss",
				price: "65.00",
				features:
					"2-hour private lesson, Safety briefing, Surfboard & rash guard, GoPro photos",
			},
			{
				name: "Wave Rider",
				price: "180.00",
				features:
					"3-day package (2h/day), Video analysis, Intermediate techniques, Free T-shirt",
			},
			{
				name: "Pro Surfer",
				price: "350.00",
				features:
					"5-day intensive camp, Advanced coaching, Secret spot tour, All gear included",
			},
		],
		testimonials: [
			{
				quote:
					"An absolutely incredible experience! The instructors were patient and so knowledgeable. I stood up on my first day! Highly recommend Ocean Top Waves to anyone visiting Sri Lanka.",
				author: "Sarah L., Australia",
			},
			{
				quote:
					"We booked the 3-day package and it was the highlight of our trip. The team is fantastic, the gear is top-notch, and the vibes are just perfect. Can't wait to come back!",
				author: "Mark & Jen, UK",
			},
			{
				quote:
					"Not only did I improve my surfing, but their island tours were also amazing. The wildlife safari was breathtaking. They truly offer the complete Sri Lankan adventure package.",
				author: "Alex G., Germany",
			},
		],
		whatsapp: {
			setting_value: "94771234567", // Example Sri Lankan number
		},
	};

	const fetchData = async (action) => {
		console.log(`Fetching ${action}...`);
		// Simulate network delay
		await new Promise((resolve) => setTimeout(resolve, 500));
		switch (action) {
			case "get_carousel":
				return apiData.carousel;
			case "get_packages":
				return apiData.packages;
			case "get_testimonials":
				return apiData.testimonials;
			case "get_whatsapp":
				return apiData.whatsapp;
			default:
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

	// --- Hero Carousel ---
	const initCarousel = (() => {
		const slidesContainer = document.querySelector(".carousel-slides");
		const indicatorsContainer = document.querySelector(".carousel-indicators");
		let currentSlide = 0;
		let slides = [];
		let indicators = [];
		let carouselInterval;

		const load = async () => {
			const data = await fetchData("get_carousel");
			if (!slidesContainer || data.length === 0) {
				slidesContainer.innerHTML = `<p style="color:white;text-align:center;padding:2rem;">Could not load slides.</p>`;
				return;
			}
			slidesContainer.innerHTML = "";
			indicatorsContainer.innerHTML = "";

			data.forEach((slide, index) => {
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
				indicatorEl.addEventListener("click", () => goToSlide(index));
				indicatorsContainer.appendChild(indicatorEl);
			});

			slides = document.querySelectorAll(".carousel-slide");
			indicators = document.querySelectorAll(".carousel-indicator");

			document.querySelector(".carousel-next")?.addEventListener("click", next);
			document.querySelector(".carousel-prev")?.addEventListener("click", prev);

			enableSwipe();
			goToSlide(0);
			startAutoplay();
		};

		const goToSlide = (index) => {
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

		const enableSwipe = () => {
			let touchStartX = 0;
			slidesContainer.addEventListener(
				"touchstart",
				(e) => (touchStartX = e.changedTouches[0].screenX),
				{ passive: true }
			);
			slidesContainer.addEventListener("touchend", (e) => {
				const touchEndX = e.changedTouches[0].screenX;
				if (touchStartX - touchEndX > 50) next();
				if (touchStartX - touchEndX < -50) prev();
			});
		};

		return { load };
	})();

	// --- Load Dynamic Content ---
	const loadDynamicContent = async (containerSelector, dataType, renderFn) => {
		const container = document.querySelector(containerSelector);
		if (!container) return;

		const data = await fetchData(dataType);
		if (data.length === 0) {
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
        <span>Book Now</span>
        <i class="fas fa-arrow-right"></i>
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
		const data = await fetchData("get_whatsapp");
		if (data && data.setting_value) {
			const whatsappNumber = data.setting_value;
			const baseUri = `https://wa.me/${whatsappNumber}`;

			document
				.querySelector(".whatsapp-float-modern")
				?.setAttribute(
					"href",
					`${baseUri}?text=${encodeURIComponent("Hello Ocean Top Waves!")}`
				);

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

	// --- Newsletter Form ---
	const newsletterForm = document.querySelector(".newsletter-form");
	if (newsletterForm) {
		newsletterForm.addEventListener("submit", function (e) {
			e.preventDefault();
			const button = this.querySelector("button");
			button.innerHTML = `<span>Subscribed!</span><i class="fas fa-check"></i>`;
			button.style.background = "#28a745";
			setTimeout(() => {
				button.innerHTML = `<span>Subscribe</span><i class="fas fa-paper-plane"></i>`;
				button.style.background = "";
				this.reset();
			}, 3000);
		});
	}

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
		loadDynamicContent(".packages-container", "get_packages", renderPackage);
		loadDynamicContent(
			".testimonials-container",
			"get_testimonials",
			renderTestimonial
		);
		await loadWhatsAppNumber();
		initializeScrollAnimations();
	};

	init();
});
