export default class MobileMenu
{
  constructor(el)
  {
    this._el = $(el);
    this._toggleButton = $('<button class="menu-toggle" type="button" aria-label="true"><span role="button">Open Menu</span></button>');
    this.init();
  }

  set open(open = false)
  {
    $('body').toggleClass('menu-open', open);
    this._open = open;
  }

  get open()
  {
    return this._open;
  }

  addListeners()
  {
    $('body').on(
      'click.mobileMenu',
      $.proxy(this.closeMenu, this)
    );

    this._el.on(
      'click.mobileMenu',
      '.submenu-toggle',
      $.proxy(this.toggleSubMenu, this)
    );

    this._toggleButton.on(
      'click.mobileMenu',
      $.proxy(this.toggleMenu, this)
    );

    this._el.on(
      'click.mobileMenu',
      '.tabs a',
      $.proxy(this.onTabClick, this)
    );
  }

  closeMenu(e)
  {
    const target = $(e.target)
    const isMenu = target.closest('.menu-header-container').length;
    const isButton = target.is(this._toggleButton) || target.closest(this._toggleButton).length;

    if (this.open && !isMenu && !isButton) {
      this.open = false;
    }
  }

  init()
  {
    this.setup();
    this.addListeners();
    this.open = false;
  }

  onTabClick(e)
  {
    if (window.innerWidth < 1260) {
      e.preventDefault();
    }
  }

  setup()
  {
    const menuItems = this._el.find('.menu-item-has-children');

    this._el.before(this._toggleButton);

    menuItems.each((i, el) => {
      if (!$(el).parents('.layout-tab').length) {
        const toggleButton = $('<button class="submenu-toggle" type="button" aria-label="true"><span role="button">Open Submenu</span></button>');
        $(el).append(toggleButton);
        // $(el).children('.sub-menu').addClass('hidden');
      }
    });
  }

  closeSubMenu(menu)
  {
    return new Promise((resolve) => {
      menu
        .addClass('slide-up')
        .removeClass('is-open')
        .children('.sub-menu')
          .slideUp(300, () => {
            menu
              .removeClass('slide-up')
              .children('.sub-menu').attr('style', '');
            resolve();
          });
    });
  }

  openSubMenu(menu)
  {
    return new Promise((resolve) => {
      menu
        .addClass('slide-down')
        .children('.sub-menu')
          .slideDown(300, () => {
            menu
              .addClass('is-open')
              .removeClass('slide-down')
              .children('.sub-menu').attr('style', '');
            resolve();
        });
    });
  }

  toggleMenu()
  {
    this.open = !this.open;
  }

  toggleSubMenu(e)
  {
    const button = $(e.currentTarget);
    const parent = button.parent();

    if (!parent.hasClass('is-animating')) {
      parent.addClass('is-animating');

      new Promise((resolve) => {
        parent.hasClass('is-open')
          ? this.closeSubMenu(parent).then(resolve)
          : this.openSubMenu(parent).then(resolve);
      })
        .then(() => {
          parent.removeClass('is-animating');
        });
    }
  }
}
