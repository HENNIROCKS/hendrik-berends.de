export function initSliders() {
  document.querySelectorAll(".js-slider").forEach(setUpSlider);
}

function setUpSlider(slider) {
  const track = slider.querySelector(".js-slider-track");
  const originals = Array.from(slider.querySelectorAll(".js-slider-slide"));
  const previousButton = slider.querySelector(".js-slider-prev");
  const nextButton = slider.querySelector(".js-slider-next");

  if (!track || originals.length === 0) {
    return;
  }

  // Full-bleed measurement is pointless (and its CSS variables unused) once
  // the block opts out of the breakout via the "fullWidth" block option.
  const fullBleed = !slider.classList.contains("js-slider-contained");

  // With a single image there is nothing to loop or step through.
  const looping = originals.length > 1;
  const slides = looping ? addClones(track, originals) : originals;
  const setSize = originals.length;
  // Index of the first original inside the extended list of slides.
  const setStart = looping ? setSize : 0;

  let activeIndex = -1;

  const scrollBehavior = () =>
    window.matchMedia("(prefers-reduced-motion: reduce)").matches
      ? "auto"
      : "smooth";

  // The block breaks out of the layout container to full viewport width.
  // Measuring the surrounding column keeps that exact even in columns
  // that are not centered, and documentElement.clientWidth excludes the
  // scrollbar, which a plain 100vw would not.
  const updateBleed = () => {
    if (!fullBleed) {
      return;
    }

    const column = slider.parentElement;

    slider.style.setProperty(
      "--slider-bleed-left",
      `${column ? column.getBoundingClientRect().left : 0}px`,
    );
    slider.style.setProperty(
      "--slider-width",
      `${document.documentElement.clientWidth}px`,
    );
  };

  const setActive = (index) => {
    if (index === activeIndex) {
      return;
    }

    activeIndex = index;

    slides.forEach((slide, position) => {
      slide.classList.toggle("is-active", position === index);
    });
  };

  // The slide whose center is closest to the center of the track – more
  // reliable than a visibility threshold, since the neighbours are
  // deliberately visible too.
  const findNearest = () => {
    const center = track.scrollLeft + track.clientWidth / 2;
    let nearest = 0;
    let smallestDistance = Infinity;

    slides.forEach((slide, position) => {
      const distance = Math.abs(
        slide.offsetLeft + slide.offsetWidth / 2 - center,
      );

      if (distance < smallestDistance) {
        smallestDistance = distance;
        nearest = position;
      }
    });

    return nearest;
  };

  const offsetOf = (slide) =>
    slide.offsetLeft - (track.clientWidth - slide.offsetWidth) / 2;

  const goTo = (index, behavior = scrollBehavior()) => {
    const slide = slides[Math.max(0, Math.min(index, slides.length - 1))];

    track.scrollTo({ left: offsetOf(slide), behavior });
  };

  // Jumps back into the middle copy once a clone has become the active
  // slide. The clone sets are identical, so scrolling by exactly one set
  // width lands on the same picture and the jump is invisible – as long
  // as it happens while the track is at rest, which is why it is tied to
  // "scrollend" and not to the scroll event itself.
  const wrap = () => {
    if (!looping) {
      return;
    }

    // The pending animation frame may not have run yet.
    setActive(findNearest());

    if (activeIndex >= setStart && activeIndex < setStart + setSize) {
      return;
    }

    const target =
      activeIndex < setStart ? activeIndex + setSize : activeIndex - setSize;

    goTo(target, "auto");
    setActive(target);
  };

  previousButton?.addEventListener("click", () => goTo(activeIndex - 1));
  nextButton?.addEventListener("click", () => goTo(activeIndex + 1));

  // Capture phase on the track: GLightbox binds its own click handler to
  // the links, and stopping the event on an ancestor during capture is
  // the only reliable way to keep it from getting there. A click on a
  // cropped neighbour centers it instead of opening the lightbox.
  track.addEventListener(
    "click",
    (event) => {
      const slide = event.target.closest(".js-slider-slide");

      if (!slide || slide.classList.contains("is-active")) {
        return;
      }

      event.preventDefault();
      event.stopPropagation();
      goTo(slides.indexOf(slide));
    },
    true,
  );

  let frame = null;

  const scheduleUpdate = () => {
    if (frame !== null) {
      return;
    }

    frame = requestAnimationFrame(() => {
      frame = null;
      setActive(findNearest());
    });
  };

  track.addEventListener("scroll", scheduleUpdate, { passive: true });

  if ("onscrollend" in window) {
    track.addEventListener("scrollend", wrap);
  } else {
    // Safari only got "scrollend" recently – fall back to a short idle
    // period after the last scroll event, which is also past the end of
    // any momentum scrolling.
    let idleTimer = null;

    track.addEventListener(
      "scroll",
      () => {
        window.clearTimeout(idleTimer);
        idleTimer = window.setTimeout(wrap, 120);
      },
      { passive: true },
    );
  }

  let resizeFrame = null;
  let lastWidth = document.documentElement.clientWidth;

  window.addEventListener("resize", () => {
    // On iOS a resize also fires when the URL bar slides in and out
    // during normal vertical scrolling. Only the width matters here, and
    // re-centering on every one of those would be pure fidgeting.
    if (resizeFrame !== null || document.documentElement.clientWidth === lastWidth) {
      return;
    }

    resizeFrame = requestAnimationFrame(() => {
      resizeFrame = null;
      lastWidth = document.documentElement.clientWidth;
      updateBleed();
      // Slide positions changed, so the current slide has to be
      // re-centered instead of leaving the track between two snap points.
      goTo(activeIndex, "auto");
    });
  });

  updateBleed();

  if (looping) {
    goTo(setStart, "auto");
    setActive(setStart);
  } else {
    setActive(findNearest());
  }
}

/**
 * Puts a copy of the whole set before and after the originals, so there
 * is always a neighbour to peek in on both sides. The clones are inert:
 * hidden from screen readers, out of the tab order and not part of any
 * lightbox gallery.
 */
function addClones(track, originals) {
  const before = document.createDocumentFragment();
  const after = document.createDocumentFragment();

  const clonesBefore = [];
  const clonesAfter = [];

  originals.forEach((slide) => {
    [
      [before, clonesBefore],
      [after, clonesAfter],
    ].forEach(([fragment, collected]) => {
      const clone = slide.cloneNode(true);

      clone.setAttribute("aria-hidden", "true");
      clone.removeAttribute("aria-label");
      clone.removeAttribute("role");

      clone.querySelectorAll("a").forEach((link) => {
        link.setAttribute("tabindex", "-1");
        link.classList.remove("js-lightbox");
        link.removeAttribute("data-gallery");
        // A clone can briefly be the active slide while the track is
        // still scrolling towards it, and the click handler lets clicks
        // on the active slide through to the lightbox. Without the
        // lightbox class that click would follow the href and navigate
        // to the bare image file.
        link.removeAttribute("href");
      });

      fragment.appendChild(clone);
      collected.push(clone);
    });
  });

  track.insertBefore(before, track.firstChild);
  track.appendChild(after);

  return [...clonesBefore, ...originals, ...clonesAfter];
}
