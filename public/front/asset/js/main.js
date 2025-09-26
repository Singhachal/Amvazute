document.addEventListener("DOMContentLoaded", function () {
    const dropdownSubmenus = document.querySelectorAll(".dropdown-submenu");

    dropdownSubmenus.forEach(function (submenu) {
        submenu.addEventListener("mouseenter", function () {
            const submenuDropdown = submenu.querySelector(".dropdown-menu");
            if (submenuDropdown) submenuDropdown.classList.add("show");
        });

        submenu.addEventListener("mouseleave", function () {
            const submenuDropdown = submenu.querySelector(".dropdown-menu");
            if (submenuDropdown) submenuDropdown.classList.remove("show");
        });
    });
});
            // Optional: Listen to file selection
            document.getElementById('resume-upload').addEventListener('change', function() {
              if (this.files.length > 0) {
                alert('Selected file: ' + this.files[0].name);
              }
            });

// document.addEventListener("DOMContentLoaded", function () {
//     const dropdown = document.getElementById("typeDropdown");
//     const current = dropdown.querySelector(".current");
//     const options = dropdown.querySelectorAll(".option");
//     const list = dropdown.querySelector(".dropdown-list");

//     // Toggle open on click
//     dropdown.addEventListener("click", function () {
//         dropdown.classList.toggle("open");
//     });

//     // Set selected option
//     options.forEach((option) => {
//         option.addEventListener("click", function (e) {
//             e.stopPropagation(); // Prevent dropdown from immediately closing

//             current.textContent = this.textContent;
//             options.forEach((opt) => opt.classList.remove("selected"));
//             this.classList.add("selected");

//             dropdown.classList.remove("open");
//         });
//     });

//     // Close when clicking outside
//     document.addEventListener("click", function (e) {
//         if (!dropdown.contains(e.target)) {
//             dropdown.classList.remove("open");
//         }
//     });
// });



