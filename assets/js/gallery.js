document.addEventListener("DOMContentLoaded", () => {
	const galleryGrid = document.querySelector(".gallery-grid");
	const filterButtons = document.querySelectorAll(".filter-btn");
	const lightbox = document.getElementById("lightbox");
	const lightboxImg = document.getElementById("lightbox-img");
	const lightboxCaption = document.getElementById("lightbox-caption");
	const closeBtn = document.querySelector(".lightbox-close");

	let allImages = []; // Cache for all fetched images

	// --- Fetch Gallery Data ---
	const loadGallery = async () => {
		try {
			const response = await fetch("api.php?action=get_gallery");
			if (!response.ok) throw new Error("Network response was not ok");
			allImages = await response.json();

			if (galleryGrid) {
				if (allImages.length === 0) {
					galleryGrid.innerHTML =
						'<p class="loading-placeholder">Could not load gallery images.</p>';
					return;
				}
				populateGallery(allImages);
				// Check for hash in URL to pre-filter
				const hash = window.location.hash.substring(1);
				if (hash) {
					const matchingButton = document.querySelector(
						`.filter-btn[data-filter="${hash}"]`
					);
					if (matchingButton) {
						matchingButton.click();
					}
				}
			}
		} catch (error) {
			console.error("Failed to fetch gallery:", error);
			if (galleryGrid)
				galleryGrid.innerHTML =
					'<p class="loading-placeholder">Error loading gallery.</p>';
		}
	};

	// --- Populate Gallery Grid ---
	const populateGallery = (images) => {
		galleryGrid.innerHTML = ""; // Clear existing images
		images.forEach((item) => {
			const galleryItem = document.createElement("div");
			galleryItem.classList.add("gallery-item");
			galleryItem.dataset.category = item.category;
			galleryItem.innerHTML = `
              <img src="${item.image_url}" alt="${item.caption}" loading="lazy">
              <div class="overlay">${item.caption || item.category}</div>
          `;
			galleryItem.addEventListener("click", () =>
				openLightbox(item.image_url, item.caption)
			);
			galleryGrid.appendChild(galleryItem);
		});
	};

	// --- Filter Logic ---
	filterButtons.forEach((button) => {
		button.addEventListener("click", () => {
			filterButtons.forEach((btn) => btn.classList.remove("active"));
			button.classList.add("active");

			const filter = button.dataset.filter;
			const filteredImages =
				filter === "all"
					? allImages
					: allImages.filter((image) => image.category === filter);

			populateGallery(filteredImages);
		});
	});

	// --- Lightbox Logic ---
	function openLightbox(src, caption) {
		if (lightbox && lightboxImg) {
			lightbox.style.display = "block";
			lightboxImg.src = src;
			lightboxCaption.textContent = caption || "";
		}
	}

	function closeLightbox() {
		if (lightbox) {
			lightbox.style.display = "none";
		}
	}

	if (closeBtn) closeBtn.addEventListener("click", closeLightbox);
	if (lightbox)
		lightbox.addEventListener("click", (e) => {
			// Close if the dark background is clicked, not the image itself
			if (e.target === lightbox) {
				closeLightbox();
			}
		});

	// --- Run Initialization ---
	loadGallery();
});
