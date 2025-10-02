document.addEventListener("DOMContentLoaded", () => {
  const tabContents = [
    {
      chefName: "Phoenix Satcheup",
      category: "Pizza",
      location: "Jakarta, Indonesia",
      experience: "12 Years",
      restaurant: "Pearl Dolphin",
      restaurantImage: "./assets/images/thumbnails/resto-4.png",
      chefImage: "./assets/images/thumbnails/chef-1.png",
    },
    {
      chefName: "Chamber Botfrag",
      category: "Vegan",
      location: "Bandung, Indonesia",
      experience: "8 Years",
      restaurant: "Green Garden",
      restaurantImage: "./assets/images/thumbnails/resto-3.png",
      chefImage: "./assets/images/thumbnails/chef-2.webp",
    },
    {
      chefName: "Asep Vandal",
      category: "Roast Chicken",
      location: "Sunda, Indonesia",
      experience: "10 Years",
      restaurant: "Sundanese Delight",
      restaurantImage: "./assets/images/thumbnails/resto-2.png",
      chefImage: "./assets/images/thumbnails/chef-3.webp",
    },
    {
      chefName: "I Made Invoker",
      category: "Beef Steak",
      location: "Bali, Indonesia",
      experience: "15 Years",
      restaurant: "Bali Bistro",
      restaurantImage: "./assets/images/thumbnails/resto-1.png",
      chefImage: "./assets/images/thumbnails/chef-4.webp",
    },
  ];

  const tabs = document.querySelectorAll(".tab-item");

  function updateTabContent(index) {
    const selectedContent = tabContents[index];
    const chefImageElement = document.querySelector(".tab-content img");
    if (chefImageElement) chefImageElement.src = selectedContent.chefImage;

    const chefNameElement = document.querySelector(".tab-content h2");
    if (chefNameElement) chefNameElement.textContent = selectedContent.chefName;

    // const locationElement = document.querySelector(".tab-content .text-muted");
    // if (locationElement) locationElement.textContent = selectedContent.location;

    const experienceElement = document.querySelector(".experience-years");
    if (experienceElement)
      experienceElement.textContent = selectedContent.experience;

    const restaurantNameElement = document.querySelector(".resto-name");
    if (restaurantNameElement)
      restaurantNameElement.textContent = selectedContent.restaurant;

    const restaurantImageElement = document.querySelector(
      ".tab-content .h-[132px] img"
    );
    if (restaurantImageElement)
      restaurantImageElement.src = selectedContent.restaurantImage;
  }

  function setActiveTab(index) {
    tabs.forEach((tab) => {
      tab.classList.remove("bg-white");
      const profileDetailsLink = tab.querySelector("a");
      if (profileDetailsLink) {
        profileDetailsLink.classList.remove("opacity-100");
        profileDetailsLink.classList.add("opacity-0");
      }
      const locationIcon = tab.querySelector(".location-icon");
      if (locationIcon) {
        locationIcon.classList.remove("bg-muted");
        locationIcon.classList.add("bg-foreground");
      }
    });

    const activeTab = tabs[index];
    activeTab.classList.add("bg-white");
    const profileDetailsLink = activeTab.querySelector("a");
    if (profileDetailsLink) {
      profileDetailsLink.classList.remove("opacity-0");
      profileDetailsLink.classList.add("opacity-100");
    }
    const locationIcon = activeTab.querySelector(".location-icon");
    if (locationIcon) {
      locationIcon.classList.remove("bg-foreground");
      locationIcon.classList.add("bg-muted");
    }
  }

  tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
      setActiveTab(index);
      updateTabContent(index);
    });
  });

  setActiveTab(0);
  updateTabContent(0);
});
