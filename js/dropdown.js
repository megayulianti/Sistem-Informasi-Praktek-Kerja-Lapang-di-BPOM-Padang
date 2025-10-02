document.addEventListener("DOMContentLoaded", () => {
  // Ambil semua tombol dropdown, menu, dan panah
  const dropdownButtons = document.querySelectorAll(".dropdown-button");
  const dropdownMenus = document.querySelectorAll(".dropdown-menu");
  const dropdownArrows = document.querySelectorAll(".dropdown-arrow");

  // Fungsi untuk menangani klik pada tombol dropdown
  dropdownButtons.forEach((button, index) => {
    const menu = dropdownMenus[index];
    const arrow = dropdownArrows[index];

    button.addEventListener("click", () => {
      if (menu.classList.contains("opacity-0")) {
        // Sembunyikan semua dropdown lainnya
        dropdownMenus.forEach((m) => {
          m.classList.add("opacity-0");
          m.classList.remove("opacity-100");
        });
        dropdownArrows.forEach((a) => (a.style.transform = "rotate(0deg)"));

        // Tampilkan dropdown yang dipilih
        menu.classList.remove("opacity-0");
        menu.classList.add("opacity-100");
        arrow.style.transform = "rotate(180deg)";
      } else {
        // Sembunyikan dropdown saat diklik lagi
        menu.classList.remove("opacity-100");
        menu.classList.add("opacity-0");
        arrow.style.transform = "rotate(0deg)";
      }
    });
  });

  // Fungsi untuk menutup dropdown saat mengklik di luar
  document.addEventListener("click", (event) => {
    dropdownButtons.forEach((button, index) => {
      const menu = dropdownMenus[index];
      const arrow = dropdownArrows[index];

      if (!button.contains(event.target) && !menu.contains(event.target)) {
        menu.classList.remove("opacity-100");
        menu.classList.add("opacity-0");
        arrow.style.transform = "rotate(0deg)";
      }
    });
  });
});
