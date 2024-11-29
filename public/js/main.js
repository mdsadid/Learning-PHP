document.addEventListener("DOMContentLoaded", () => {
    const userMenuButton = document.getElementById("user-menu-button");
    const dropdownMenu = document.getElementById("dropdown-menu");

    if (userMenuButton) {
        userMenuButton.addEventListener("click", () => {
            const isHidden = dropdownMenu.classList.contains("opacity-0");

            if (isHidden) {
                // Show dropdown with animation
                dropdownMenu.classList.remove("opacity-0", "scale-95");
                dropdownMenu.classList.add("opacity-100", "scale-100");
            } else {
                // Hide dropdown with animation
                dropdownMenu.classList.remove("opacity-100", "scale-100");
                dropdownMenu.classList.add("opacity-0", "scale-95");
            }
        });
    }

    // Optional: Close dropdown if clicked outside
    document.addEventListener("click", (e) => {
        if (!userMenuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove("opacity-100", "scale-100");
            dropdownMenu.classList.add("opacity-0", "scale-95");
        }
    });
});
