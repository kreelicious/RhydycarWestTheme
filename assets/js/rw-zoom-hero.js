(() => {
  const heroes = document.querySelectorAll('.rw-zoom-hero');
  if (!heroes.length) return;

  heroes.forEach((hero) => {
    const x = (hero.dataset.zoomX || '73') + '%';
    const y = (hero.dataset.zoomY || '37') + '%';
    const scale = (hero.dataset.zoomScale || '220') + '%';

    hero.style.setProperty('--rwZoomX', x);
    hero.style.setProperty('--rwZoomY', y);
    hero.style.setProperty('--rwZoomScale', scale);

    // trigger after first paint
    requestAnimationFrame(() => {
      requestAnimationFrame(() => hero.classList.add('is-zoomed'));
    });

    // Optional: crossfade into an element close-up hero image after zoom
    const swap = hero.dataset.swapImage;
    if (swap) {
      setTimeout(() => {
        const bg = hero.querySelector('.rw-zoom-hero__bg');
        if (!bg) return;
        bg.style.opacity = '0';
        setTimeout(() => {
          bg.style.backgroundImage = `url('${swap}')`;
          bg.style.opacity = '1';
        }, 260);
      }, 1200);
    }
  });
})();
