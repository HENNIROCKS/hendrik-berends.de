export function loadMoreArticles() {
  const element = document.querySelector(".js-articles");
  const button = document.querySelector(".js-more");

  if (!element || !button) return;

  let page = parseInt(element.getAttribute("data-page"));

  if (!page) {
    button.classList.add("hidden");
  }

  const fetchArticles = async () => {
    if (!page) return;

    let url = `${window.location.href.split("#")[0]}.json/page:${page}`;

    try {
      const response = await fetch(url);
      const { html, more } = await response.json();

      if (html) {
        element.insertAdjacentHTML("beforeend", html);
        element.setAttribute("data-page", more ? page + 1 : 0);
        page = more ? page + 1 : 0;
        button.classList.toggle("hidden", !more || !page);
      }
    } catch (error) {
      console.log("Fetch error: ", error);
      button.classList.add("hidden");
    }
  };

  button.addEventListener("click", fetchArticles);
}
