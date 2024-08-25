// document
//   .getElementById("add-image-button")
//   .addEventListener("click", function () {
//     document.querySelector(".ql-image").click();
//   });
// document
//   .getElementById("add-video-button")
//   .addEventListener("click", function () {
//     document.querySelector(".ql-video").click();
//   });

// document.addEventListener("keydown", function (event) {
//   if (event.ctrlKey && event.shiftKey) {
//     switch (event.key.toLowerCase()) {
//       case "v":
//         document.querySelector(".ql-video").click();
//         break;
//       case "i":
//         document.querySelector(".ql-image").click();
//         break;
//     }
//     event.preventDefault();
//   }
// });





document.addEventListener('DOMContentLoaded', function () {
  const targetNode = document.querySelector('.ql-toolbar');
  
  if (!targetNode) {
      console.error('Элемент .ql-toolbar не найден.');
      return;
  }

  const observerConfig = { childList: true, subtree: true };

  // Инициализация MutationObserver до вызова observerCallback
  const observer = new MutationObserver(observerCallback);

  function observerCallback(mutationsList, observer) {
      const videoButton = document.querySelector('.ql-toolbar .ql-video');
      const imageButton = document.querySelector('.ql-toolbar .ql-image');
      const newToolbar = document.getElementById('toolbarFloating');

      let buttonsMoved = 0;

      if (videoButton && newToolbar && !newToolbar.contains(videoButton)) {
          newToolbar.appendChild(videoButton);
          buttonsMoved++;
      }

      if (imageButton && newToolbar && !newToolbar.contains(imageButton)) {
          newToolbar.appendChild(imageButton);
          buttonsMoved++;
      }

      // Если обе кнопки перемещены, отключаем наблюдатель
      if (buttonsMoved === 2) {
          observer.disconnect();
      }
  }

  observer.observe(targetNode, observerConfig);

  // Выполняем начальную проверку на случай, если кнопки уже добавлены
  observerCallback([], observer);
});






