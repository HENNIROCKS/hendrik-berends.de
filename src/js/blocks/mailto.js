export function activateMailtoLinks() {
  const links = document.querySelectorAll(".js-mailto-link");

  links.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();
      const { name, domain, tld } = link.dataset;
      window.location.href = `mailto:${name}@${domain}.${tld}`;
    });
  });
}
