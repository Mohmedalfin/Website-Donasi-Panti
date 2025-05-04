// Navbar & Header
(function () {
  "use strict";
  // Apply .scrolled class to the body as the page is scrolled down
  const toggleScrolled = () => {
    const body = document.querySelector("body");
    const header = document.querySelector("#header");

    if (
      !header.classList.contains("scroll-up-sticky") &&
      !header.classList.contains("sticky-top") &&
      !header.classList.contains("fixed-top")
    )
      return;

    window.scrollY > 100
      ? body.classList.add("scrolled")
      : body.classList.remove("scrolled");
  };

  // Event listeners for scroll and load
  document.addEventListener("scroll", toggleScrolled);
  window.addEventListener("load", toggleScrolled);

  // Mobile navigation toggle
  const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");
  const mobileNavToogle = () => {
    document.querySelector("body").classList.toggle("mobile-nav-active");
    mobileNavToggleBtn.classList.toggle("bi-list");
    mobileNavToggleBtn.classList.toggle("bi-x");
  };
  mobileNavToggleBtn?.addEventListener("click", mobileNavToogle);

  // Hide mobile nav on same-page/hash links
  document.querySelectorAll("#navmenu a").forEach((navmenu) => {
    navmenu.addEventListener("click", () => {
      if (document.querySelector(".mobile-nav-active")) {
        mobileNavToogle();
      }
    });
  });

  // Toggle mobile nav dropdowns
  document.querySelectorAll(".navmenu .toggle-dropdown").forEach((navmenu) => {
    navmenu.addEventListener("click", function (e) {
      e.preventDefault();
      const parent = this.parentNode;
      parent.classList.toggle("active");
      parent.nextElementSibling.classList.toggle("dropdown-active");
      e.stopImmediatePropagation();
    });
  });

  const preloader = document.querySelector("#preloader");
  if (preloader) {
    window.addEventListener("load", () => preloader.remove());
  }

  //  Scroll top button
  const scrollTop = document.querySelector(".scroll-top");

  const toggleScrollTop = () => {
    if (scrollTop) {
      window.scrollY > 100
        ? scrollTop.classList.add("active")
        : scrollTop.classList.remove("active");
    }
  };

  scrollTop?.addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  window.addEventListener("load", toggleScrollTop);
  document.addEventListener("scroll", toggleScrollTop);

  new PureCounter();
})();

// Scrolling Potensi Desa
let autoScrollInterval;

function startAutoScroll() {
  autoScrollInterval = setInterval(() => {
    const gallery = document.getElementById("gallery");
    const scrollAmount = gallery.offsetWidth / 3;

    if (gallery.scrollLeft + gallery.clientWidth >= gallery.scrollWidth - 50) {
      gallery.scrollTo({
        left: 0,
        behavior: "instant",
      });
    } else {
      gallery.scrollBy({
        left: scrollAmount,
        behavior: "smooth",
      });
    }
  }, 1000);
}

document.getElementById("gallery").addEventListener("mouseenter", () => {
  clearInterval(autoScrollInterval);
});

document.getElementById("gallery").addEventListener("mouseleave", () => {
  startAutoScroll();
});

function scrollGallery(scrollOffset) {
  clearInterval(autoScrollInterval);
  document.getElementById("gallery").scrollBy({
    left: scrollOffset,
    behavior: "smooth",
  });
  startAutoScroll();
}
startAutoScroll();
