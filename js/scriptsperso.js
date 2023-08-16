// Mouse effect

console.log("script chargé");

const cursor = document.getElementById("cursor");

document.body.addEventListener("mousemove", function (e) {
  (cursor.style.left = e.clientX + "px"), (cursor.style.top = e.clientY + "px");
});
