document
  .getElementById("add-image-button")
  .addEventListener("click", function () {
    document.querySelector(".ql-image").click();
  });
document
  .getElementById("add-video-button")
  .addEventListener("click", function () {
    document.querySelector(".ql-video").click();
  });

document.addEventListener("keydown", function (event) {
  if (event.ctrlKey && event.shiftKey) {
    switch (event.key.toLowerCase()) {
      case "v":
        document.querySelector(".ql-video").click();
        break;
      case "i":
        document.querySelector(".ql-image").click();
        break;
    }
    event.preventDefault();
  }
});
