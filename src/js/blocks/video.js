export function playVideoOnClick() {
  const placeholders = document.querySelectorAll(".js-video");

  placeholders.forEach((placeholder) => {
    const button = placeholder.querySelector(".js-video-button");

    if (button) {
      button.addEventListener("click", () => {
        placeholder.innerHTML = placeholder.getAttribute("data-video");
      });
    }
  });
}
