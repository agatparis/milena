// Mouse effect

const cursor = document.getElementById("cursor");

document.body.addEventListener("mousemove", function (e) {
  (cursor.style.left = e.clientX + "px"), (cursor.style.top = e.clientY + "px");
});
const links = document.querySelectorAll("a");
links.forEach((link) => {
  link.addEventListener("mouseover", function () {
    cursor.style.display = "none";
    cursor.style.transition = "all 10ms ease";
  });
  link.addEventListener("mouseout", function () {
    cursor.style.display = "block";
    cursor.style.transition = "all 10ms ease";
  });
});
document
  .getElementById("menu-button")
  .addEventListener("mouseover", function () {
    cursor.style.display = "none";
    cursor.style.transition = "all 10ms ease";
  });
document
  .getElementById("menu-button")
  .addEventListener("mouseout", function () {
    cursor.style.display = "block";
    cursor.style.transition = "all 10ms ease";
  });
