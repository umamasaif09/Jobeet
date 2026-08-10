document.addEventListener("DOMContentLoaded", function () {
	document.querySelectorAll(".back-button").forEach(function (button) {
		button.addEventListener("click", function () {
			history.back();
		});
	});

	const logoInput = document.getElementById("logo");
	const logoPreview = document.getElementById("logo-preview");

	logoInput.addEventListener("change", function () {
		const file = this.files[0];

		if (!file) return;

		logoPreview.src = URL.createObjectURL(file);
		logoPreview.style.display = "block";
	});
});
