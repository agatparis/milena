// Mouse effect

const cursor = document.getElementById("cursor");

document.body.addEventListener("mousemove", function (e) {
  (cursor.style.left = e.clientX + "px"), (cursor.style.top = e.clientY + "px");
});

const links = document.querySelectorAll("a");

links.forEach((link) => {
  console.log(link.parentElement.className);
  if (link.parentElement.className != "site-title") {
    link.addEventListener("mouseover", function () {
      cursor.style.display = "none";
      cursor.style.transition = "all 1ms ease";
    });
    link.addEventListener("mouseout", function () {
      cursor.style.display = "block";
      cursor.style.transition = "all 1ms ease";
    });
  }
});

document
  .getElementById("menu-open-close-item")
  .addEventListener("mouseover", function () {
    cursor.style.display = "none";
    cursor.style.opacity = "0";
    cursor.style.transition = "all 1ms ease";
  });
document
  .getElementById("menu-open-close-item")
  .addEventListener("mouseout", function () {
    cursor.style.display = "block";
    cursor.style.opacity = "1";
    cursor.style.transition = "all 1ms ease";
  });

const brandingLink = document.querySelector(".site-title a");

brandingLink.addEventListener("mouseover", function () {
  cursor.style.display = "none";
  cursor.style.opacity = "0";
  cursor.style.transition = "all 1ms ease";
});
brandingLink.addEventListener("mouseout", function () {
  cursor.style.display = "block";
  cursor.style.opacity = "1";
  cursor.style.transition = "all 1ms ease";
});
