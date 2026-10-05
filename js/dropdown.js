document.addEventListener("DOMContentLoaded", () => {
  const toggles = document.querySelectorAll("[data-toggle='dropdown']");

  function closeAll(except = null) {
    document.querySelectorAll(".dropdown-menu").forEach(menu => {
      if (menu !== except) {
        menu.classList.add(
          "opacity-0",
          "scale-95",
          "-translate-y-2",
          "pointer-events-none"
        );
      }
    });
  }

  toggles.forEach(toggle => {
    const targetId = toggle.dataset.target;
    const menu = document.getElementById(targetId);

    if (!menu) return;

    toggle.addEventListener("click", (event) => {
      event.preventDefault();
      event.stopPropagation();

      const isClosed = menu.classList.contains("opacity-0");

      closeAll(menu);

      menu.classList.toggle("opacity-0", !isClosed);
      menu.classList.toggle("scale-95", !isClosed);
      menu.classList.toggle("-translate-y-2", !isClosed);
      menu.classList.toggle("pointer-events-none", !isClosed);
    });

    menu.addEventListener("click", (event) => {
      event.stopPropagation();
    });
  });

  document.addEventListener("click", () => {
    closeAll();
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeAll();
    }
  });
});
