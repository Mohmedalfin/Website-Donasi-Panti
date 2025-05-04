// Admin Stats
new PureCounter();

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

  // Preloader
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
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  window.addEventListener("load", toggleScrollTop);
  document.addEventListener("scroll", toggleScrollTop);

  new PureCounter();
})();

// Video Slider Navigation
const btns = document.querySelectorAll(".nav-btn");
const slides = document.querySelectorAll(".video-slide");
const contents = document.querySelectorAll(".home .content");

var sliderNav = function (manual) {
  btns.forEach((btn) => {
    btn.classList.remove("active");
  });
  slides.forEach((slide) => {
    slide.classList.remove("active");
  });
  contents.forEach((content) => {
    content.classList.remove("active");
  });
  btns[manual].classList.add("active");
  slides[manual].classList.add("active");
  contents[manual].classList.add("active");
};

btns.forEach((btn, i) => {
  btn.addEventListener("click", () => {
    sliderNav(i);
  });
});

// Scroll Header
window.addEventListener("scroll", function () {
  const header = document.querySelector("header");
  if (window.scrollY > 50) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});

// Intro Kades Animations
document.addEventListener("DOMContentLoaded", function () {
  const socialIcons = document.querySelectorAll(".social-media a");
  socialIcons.forEach((icon) => {
    icon.addEventListener("mouseover", () => {
      icon.style.transform = "scale(1.2)";
      icon.style.color = "#ffcc00";
    });

    icon.addEventListener("mouseout", () => {
      icon.style.transform = "scale(1)";
      icon.style.color = "white";
    });
  });

  // Footer Visibility Animation on Scroll
  const footer = document.querySelector("footer");
  window.addEventListener("scroll", () => {
    const footerPosition = footer.getBoundingClientRect().top;
    const screenPosition = window.innerHeight / 1.2;

    if (footerPosition < screenPosition) {
      footer.style.opacity = "1";
      footer.style.transform = "translateY(0)";
    }
  });
});

// CSS for Animations
const footerStyle = document.createElement("style");
footerStyle.textContent = `
  footer {
    transition: all 0.5s ease;
    opacity: 0;
    transform: translateY(20px);
  }

  .social-media a {
    transition: all 0.3s ease;
  }

  .back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #0f6b5d;
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    cursor: pointer;
    display: none;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
  }

  .back-to-top:hover {
    background: #ffcc00;
    transform: scale(1.1);
  }
`;

document.head.appendChild(footerStyle);

// Pengaduan
function toggleForm() {
  var form = document.getElementById("formPengaduan");
  if (form.style.display === "block") {
    form.style.display = "none";
  } else {
    form.style.display = "block";
  }
}
