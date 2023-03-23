let lastKnownScrollPosition = 0;
let ticking = false;

function debounce(callback) {
  const direction = lastKnownScrollPosition < window.scrollY;
  lastKnownScrollPosition = window.scrollY;

  if (!ticking) {
    window.requestAnimationFrame(function() {
      callback(direction);
      ticking = false;
    });

    ticking = true;
  }
}

export default {
  init() {
    function setActive(section) {
      const id = section.attr('id');
      const sideMenu = $('.side-menu ul');
      const sideMenuPos = sideMenu[0].getBoundingClientRect().top;
      const menuItem = $(`.side-menu [href="#${id}"]`).parent();
      const menuItemPos = menuItem[0].getBoundingClientRect().top;
      const top = menuItemPos - sideMenuPos;

      sideMenu.attr('style', `--active-top: ${top}px;`)

      menuItem
        .addClass('active')
        .siblings()
          .removeClass('active');

      section.addClass('active')
        .siblings()
          .removeClass('active');
    }

    function checkScrollPos(direction) {
      const sections = $('.posts h2');
      const sideMenu = $('.side-menu ul');
      const sideMenuPos = sideMenu[0].getBoundingClientRect().top;
      sections.each((i, el) => {
        const section = $(el);
        const top = el.getBoundingClientRect().top
        if ((direction && top <= sideMenuPos) || (!direction && top <= sideMenuPos)) {
          setActive(section);
        }
      });
    }

    $(document).on('scroll', debounce.bind(null, checkScrollPos));

    $('.side-menu a').on('click', (e) => {
      e.preventDefault();
      const id = $(e.currentTarget).attr('href');
      const section = $(id);
      const top = window.scrollY + section[0].getBoundingClientRect().top;
      window.scrollTo({
        top,
        behavior: 'smooth',
      });
    })
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
