export default class SideMenu
{
  constructor(el)
  {
    this._el = $(el);
    this._nav = this._el.find('.nav');
    this.init();
  }

  addListeners()
  {
    this._mobileMenu.on('change', $.proxy(this.goToPage, this));
  }

  goToPage(e)
  {
    const menu = $(e.currentTarget);
    const url = menu.val();
    window.location.href = url;
  }

  setup()
  {
    this._mobileMenu = $('<select class="nav-mobile" />');

    this._nav.find('.menu-item').each((i, el) => {
      const item = $(el).children('a');
      const href = item.attr('href');
      const text = item.text();
      const selected = $(el).hasClass('current-menu-item') ? 'selected' : '';
      this._mobileMenu.append(`<option value="${href}" ${selected}>${text}</option>`);
    });

    this._nav.before(this._mobileMenu);
  }

  init()
  {
    this.setup();
    this.addListeners();
  }
}
