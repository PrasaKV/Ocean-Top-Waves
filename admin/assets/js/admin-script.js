document.addEventListener("DOMContentLoaded", () => {
	// Exit if not on the admin page
	if (!document.querySelector(".admin-wrapper")) return;

	// --- STATE ---
	const state = {
		packages: [],
		gallery: [],
		carousel: [],
	};

	// --- SELECTORS ---
	const navLinks = document.querySelectorAll(".nav-link");
	const contentPanels = document.querySelectorAll(".content-panel");

	// Package Selectors
	const packagesList = document.getElementById("packages-list");
	const packageForm = document.getElementById("package-form");
	const clearPackageFormBtn = document.getElementById("clear-package-form");

	// Gallery Selectors
	const galleryList = document.getElementById("gallery-list");
	const galleryForm = document.getElementById("gallery-upload-form");

	// Settings Selectors
	const whatsappForm = document.getElementById("whatsapp-form");
	const passwordForm = document.getElementById("password-form");

	// --- API HELPER ---
	const apiCall = async (action, body = null) => {
		try {
			const options = {
				method: "POST",
				headers: { "Content-Type": "application/json" },
				body: body ? JSON.stringify(body) : null,
			};
			// Use GET for fetching data
			const fetchOptions =
				action === "admin_get_all" ? { method: "GET" } : options;
			const response = await fetch(`../api.php?action=${action}`, fetchOptions);
			if (!response.ok) {
				const errorData = await response.json();
				throw new Error(
					errorData.error || `HTTP error! status: ${response.status}`
				);
			}
			return await response.json();
		} catch (error) {
			console.error("API Call Failed:", error);
			alert(`An error occurred: ${error.message}`);
			return null;
		}
	};

	// --- RENDER FUNCTIONS ---
	const renderPackages = () => {
		if (!packagesList) return;
		packagesList.innerHTML =
			state.packages
				.map(
					(p) => `
          <div class="data-list-item">
              <p><strong>${p.name}</strong> - $${parseFloat(p.price).toFixed(
						2
					)}</p>
              <div class="actions">
                  <button class="btn-edit btn-edit-package" data-id="${
										p.id
									}">Edit</button>
                  <button class="btn-danger btn-delete-package" data-id="${
										p.id
									}">Delete</button>
              </div>
          </div>
      `
				)
				.join("") || "<p>No packages found. Add one using the form below.</p>";
	};

	const renderGallery = () => {
		if (!galleryList) return;
		galleryList.innerHTML =
			state.gallery
				.map(
					(g) => `
          <div class="gallery-admin-item">
              <img src="${g.image_url}" alt="${g.caption}" loading="lazy">
              <p><strong>${g.caption || "No caption"}</strong><br><small>(${
						g.category
					})</small></p>
              <button class="btn-danger btn-delete-gallery" data-id="${
								g.id
							}">Delete</button>
          </div>
      `
				)
				.join("") ||
			"<p>No gallery images found. Add one using the form above.</p>";
	};

	const renderSettings = () => {
		if (!whatsappForm) return;
		const whatsappNumber = state.settings.find(
			(s) => s.setting_key === "whatsapp_number"
		);
		if (whatsappNumber) {
			document.getElementById("whatsapp-number").value = whatsappNumber.setting_value;
		}
	};

	// --- EVENT HANDLERS ---
	const handlePackageFormSubmit = async (e) => {
		e.preventDefault();
		const id = document.getElementById("package-id").value;
		const payload = {
			id: id ? id : null,
			name: document.getElementById("package-name").value,
			price: document.getElementById("package-price").value,
			features: document.getElementById("package-features").value,
		};
		const result = await apiCall("save_package", payload);
		if (result && result.success) {
			clearPackageForm();
			await fetchData();
		}
	};

	const handleGalleryFormSubmit = async (e) => {
		e.preventDefault();
		const payload = {
			image_url: document.getElementById("gallery-image-url").value,
			caption: document.getElementById("gallery-caption").value,
			category: document.getElementById("gallery-category").value,
		};
		const result = await apiCall("save_gallery_image", payload);
		if (result && result.success) {
			galleryForm.reset();
			await fetchData();
		}
	};

	const handlePackagesListClick = async (e) => {
		const target = e.target;
		if (target.classList.contains("btn-delete-package")) {
			const id = target.dataset.id;
			if (confirm("Are you sure you want to delete this package?")) {
				const result = await apiCall("delete_package", { id });
				if (result) await fetchData();
			}
		}
		if (target.classList.contains("btn-edit-package")) {
			const id = target.dataset.id;
			const pkg = state.packages.find((p) => p.id == id);
			if (pkg) {
				document.getElementById("package-id").value = pkg.id;
				document.getElementById("package-name").value = pkg.name;
				document.getElementById("package-price").value = pkg.price;
				document.getElementById("package-features").value = pkg.features;
				packageForm.scrollIntoView({ behavior: "smooth" });
			}
		}
	};

	const handleGalleryListClick = async (e) => {
		if (e.target.classList.contains("btn-delete-gallery")) {
			const id = e.target.dataset.id;
			if (confirm("Are you sure you want to delete this image?")) {
				const result = await apiCall("delete_gallery_image", { id });
				if (result) await fetchData();
			}
		}
	};

	const clearPackageForm = () => packageForm.reset();

	const handleWhatsappFormSubmit = async (e) => {
		e.preventDefault();
		const payload = {
			key: "whatsapp_number",
			value: document.getElementById("whatsapp-number").value,
		};
		const result = await apiCall("save_setting", payload);
		if (result && result.success) {
			alert("WhatsApp number updated successfully!");
			await fetchData();
		}
	};

	const handlePasswordFormSubmit = async (e) => {
		e.preventDefault();
		const currentPassword = document.getElementById("current-password").value;
		const newPassword = document.getElementById("new-password").value;
		const confirmPassword = document.getElementById("confirm-password").value;

		if (newPassword !== confirmPassword) {
			alert("New passwords do not match.");
			return;
		}

		const payload = { currentPassword, newPassword };
		const result = await apiCall("change_password", payload);
		if (result && result.success) {
			alert("Password changed successfully!");
			passwordForm.reset();
		}
	};

	// --- NAVIGATION ---
	const handleNavClick = (e) => {
		e.preventDefault();
		const targetId = e.target.getAttribute("href").substring(1);

		navLinks.forEach((l) => l.classList.remove("active"));
		e.target.classList.add("active");

		contentPanels.forEach((panel) => {
			panel.classList.toggle("active", panel.id === targetId);
		});
	};

	// --- INITIALIZATION ---
	const fetchData = async () => {
		const data = await apiCall("admin_get_all");
		if (data) {
			state.packages = data.packages || [];
			state.gallery = data.gallery || [];
			state.carousel = data.carousel || [];
			state.settings = data.settings || [];
			renderPackages();
			renderGallery();
			renderSettings();
			// renderCarousel(); // Future implementation
		}
	};

	// Bind Events
	navLinks.forEach((link) => link.addEventListener("click", handleNavClick));
	if (packageForm)
		packageForm.addEventListener("submit", handlePackageFormSubmit);
	if (galleryForm)
		galleryForm.addEventListener("submit", handleGalleryFormSubmit);
	if (packagesList)
		packagesList.addEventListener("click", handlePackagesListClick);
	if (galleryList)
		galleryList.addEventListener("click", handleGalleryListClick);
	if (clearPackageFormBtn)
		clearPackageFormBtn.addEventListener("click", clearPackageForm);
	if (whatsappForm)
		whatsappForm.addEventListener("submit", handleWhatsappFormSubmit);
	if (passwordForm)
		passwordForm.addEventListener("submit", handlePasswordFormSubmit);

	// Initial data load
	fetchData();
});
