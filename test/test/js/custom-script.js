jQuery(document).ready(function ($) {
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 200) {
            $('.site-header').addClass('sticky');
        } else {
            $('.site-header').removeClass('sticky');
        }
    });

});

// document.addEventListener("DOMContentLoaded", function () {
//   const buttons = document.querySelectorAll("#theme-toggle .theme-btn");
//   const body = document.body;

//   function applyTheme(theme) {
    
//     body.classList.remove("dark-theme", "light-theme", "auto-theme");

//     // Add selected theme
//     body.classList.add(`${theme}-theme`);

//     // Save theme
//     localStorage.setItem("site-theme", theme);

//     // Style buttons
//     buttons.forEach(btn => {
//       if (btn.dataset.theme === theme) {
//         btn.style.setProperty("background-color", "#99C1B3", "important");
//         btn.style.setProperty("color", "#ffffff", "important");
//       } else {
//         btn.style.setProperty("background-color", "transparent", "important");
//         btn.style.setProperty("color", "#ffffff", "important");
//       }
//     });
//   }

//   const savedTheme = localStorage.getItem("site-theme") || "auto";
//   applyTheme(savedTheme);

//   buttons.forEach(btn => {
//     btn.addEventListener("click", () => {
//       applyTheme(btn.dataset.theme);
//     });
//   });
// });
document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll("#theme-toggle .theme-btn");
  const body = document.body;
  const main = document.querySelector('main');
  const header = document.querySelector('header');

  function applyTheme(theme) {
    // Remove previous theme classes
    body.classList.remove("dark-theme", "light-theme", "auto-theme");
    main.classList.remove("dark-theme", "light-theme", "auto-theme");
    header.classList.remove("dark-theme", "light-theme", "auto-theme");

    // Add selected theme
    body.classList.add(`${theme}-theme`);
    main.classList.add(`${theme}-theme`);
    header.classList.add(`${theme}-theme`);

    // Save theme
    localStorage.setItem("site-theme", theme);

    // Style buttons
    buttons.forEach(btn => {
      if (btn.dataset.theme === theme) {
        btn.style.setProperty("background-color", "#99C1B3", "important");
        btn.style.setProperty("color", "#ffffff", "important");
      } else {
        btn.style.setProperty("background-color", "transparent", "important");
        btn.style.setProperty("color", "#ffffff", "important");
      }
    });
  }

  const savedTheme = localStorage.getItem("site-theme") || "auto";
  applyTheme(savedTheme);

  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      applyTheme(btn.dataset.theme);
    });
  });
});

  document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.notification-btn-2');
    const popups = document.querySelectorAll('.notification-popup-2');
    const closeButtons = document.querySelectorAll('.close-popup');
  
    buttons.forEach((btn, index) => {
      btn.addEventListener('click', () => {
        if (popups[index]) {
          popups[index].style.display = 'flex';
          document.body.classList.add('popup-open');
        }
      });
    });
  
    closeButtons.forEach((closeBtn, index) => {
      closeBtn.addEventListener('click', () => {
        if (popups[index]) {
          popups[index].style.display = 'none';
          document.body.classList.remove('popup-open');
        }
      });
    });
  });
  
document.addEventListener('DOMContentLoaded', function () {
  const searchIcons = document.querySelectorAll('.search-icon');
  const popups = document.querySelectorAll('.popup-search');

  searchIcons.forEach(function (icon, index) {
    icon.addEventListener('click', () => {
      // Hide all popups first
      popups.forEach(p => p.style.display = 'none');

      // Show the matching popup (assuming order matches icon)
      const popup = popups[index] || popups[0]; // fallback
      popup.style.display = 'flex';
      document.body.classList.add('popup-open');

      const input = popup.querySelector('.live-search');
      input?.focus();

      // Close button inside this popup
      const closeBtn = popup.querySelector('.close-search');
      closeBtn?.addEventListener('click', () => {
        popup.style.display = 'none';
        popup.querySelector('.search-results').innerHTML = '';
        popup.querySelector('.search-results').style.display = 'none';
        input.value = '';
        document.body.classList.remove('popup-open');
      });

      // Live search handling...
      input.addEventListener('keyup', function (e) {
        const query = input.value.trim();
        const results = popup.querySelector('.search-results');

        if (e.key === 'Enter') {
          const firstLink = results.querySelector('a');
          if (firstLink) {
            window.location.href = firstLink.href;
          }
          return;
        }

        if (query.length < 3) {
          results.innerHTML = '';
          results.style.display = 'none';
          return;
        }

        fetch(liveSearch.ajaxurl, {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'action=live_search&q=' + encodeURIComponent(query)
        })
        .then(res => res.text())
        .then(data => {
          results.innerHTML = data;
          results.style.display = 'block';
        })
        .catch(() => {
          results.innerHTML = '<div>Erro ao buscar resultados.</div>';
          results.style.display = 'block';
        });
      });
    });
  });
});


document.addEventListener('DOMContentLoaded', function () {
  const toggleBtn = document.querySelector('.main-header-menu-toggle');

  if (!toggleBtn) return;

  toggleBtn.addEventListener('click', function () {
    // Wait a bit for class to toggle
    setTimeout(() => {
      if (toggleBtn.classList.contains('toggled')) {
        document.documentElement.style.overflow = 'hidden'; // Lock scroll
      } else {
        document.documentElement.style.overflow = ''; // Unlock scroll
      }
    }, 10);
  });
});














  