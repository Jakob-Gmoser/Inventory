document.addEventListener("DOMContentLoaded", () => {
  const userMenu = document.querySelector(".user-menu");
  const usernameBtn = userMenu.querySelector(".username");
  const dropdown = userMenu.querySelector(".dropdown-menu");

  usernameBtn.addEventListener("click", () => {
    const isExpanded = usernameBtn.getAttribute("aria-expanded") === "true";
    usernameBtn.setAttribute("aria-expanded", !isExpanded);
    userMenu.classList.toggle("show");
  });

  document.addEventListener("click", (event) => {
    if (!userMenu.contains(event.target)) {
      userMenu.classList.remove("show");
      usernameBtn.setAttribute("aria-expanded", "false");
    }
  });
});
