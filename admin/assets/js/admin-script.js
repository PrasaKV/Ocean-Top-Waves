document.addEventListener("DOMContentLoaded", () => {
	// This script is purely for UI enhancements in the PHP-driven admin panel.

	// --- Toast Notification Logic ---
	const showToast = (title, message, type = "success") => {
		let wrapper = document.getElementById("toast-notification-wrapper");
		if (!wrapper) {
			wrapper = document.createElement("div");
			wrapper.id = "toast-notification-wrapper";
			wrapper.className = "toast-notification-wrapper";
			document.body.appendChild(wrapper);
		}

		const toast = document.createElement("div");
		toast.className = `toast ${type}`;

		const iconClass =
			type === "success" ? "fas fa-check-circle" : "fas fa-times-circle";

		toast.innerHTML = `
					<div class="toast-icon"><i class="${iconClass}"></i></div>
					<div class="toast-content">
							<p class="toast-title">${title}</p>
							<p class="toast-message">${message}</p>
					</div>
					<button class="toast-close">&times;</button>
					<div class="toast-progress"></div>
			`;

		wrapper.appendChild(toast);

		// Animate in
		setTimeout(() => toast.classList.add("show"), 100);

		// Auto-remove after 5 seconds
		const timeout = setTimeout(() => {
			toast.classList.add("hide");
			toast.addEventListener("transitionend", () => toast.remove());
		}, 5000);

		// Allow manual closing
		toast.querySelector(".toast-close").addEventListener("click", () => {
			clearTimeout(timeout);
			toast.classList.add("hide");
			toast.addEventListener("transitionend", () => toast.remove());
		});
	};

	// --- Sidebar Mobile Toggle ---
	const sidebar = document.querySelector(".sidebar");
	const menuToggle = document.querySelector(".admin-header .menu-toggle");
	if (menuToggle && sidebar) {
		menuToggle.addEventListener("click", () => {
			sidebar.classList.toggle("active");
		});
	}

	// --- Make this globally available for the inline script from PHP ---
	window.showAdminToast = showToast;
});
