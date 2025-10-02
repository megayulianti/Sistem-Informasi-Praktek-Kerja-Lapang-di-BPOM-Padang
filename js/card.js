document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".card");

  // Fungsi untuk mengatur lebar dan tampilan card info
  function updateCards() {
    cards.forEach((card) => {
      const cardInfo = card.querySelector(".card-info");
      if (card.classList.contains("active")) {
        card.style.width = "400px";
        cardInfo.classList.remove("hidden");
        cardInfo.classList.add("flex");
      } else {
        card.style.width = "214px";
        cardInfo.classList.remove("flex");
        cardInfo.classList.add("hidden");
      }
    });
  }

  // Inisialisasi card pertama sebagai aktif
  cards[0].classList.add("active");
  updateCards();

  // Tambahkan event listener untuk hover
  cards.forEach((card) => {
    card.addEventListener("mouseenter", () => {
      cards.forEach((c) => c.classList.remove("active"));
      card.classList.add("active");
      updateCards();
    });

    card.addEventListener("mouseleave", () => {
      cards.forEach((c) => c.classList.remove("active"));
      cards[0].classList.add("active"); // Kembalikan ke card pertama
      updateCards();
    });
  });
});
