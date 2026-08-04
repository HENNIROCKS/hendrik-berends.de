export function revealLoadedImages() {
  document.querySelectorAll("img").forEach((img) => {
    const markLoaded = () => {
      img.classList.add("is-loaded");
      img.closest("picture")?.classList.add("is-loaded");
    };

    if (img.complete) {
      markLoaded();
    } else {
      img.addEventListener("load", markLoaded, { once: true });
    }
  });
}
