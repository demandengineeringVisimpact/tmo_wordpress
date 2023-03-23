export default class TabMenu
{
  constructor(el)
  {
    this._el = $(el);
    this._container = this._el.children('.sub-menu').first();
    this.init();
  }

  set active(idx = 0)
  {
    this._container.find('.tabs .menu-item')
      .removeClass('active')
      .eq(idx)
      .addClass('active');
    this._container.find('.tabs-content .sub-menu')
      .removeClass('active')
      .eq(idx)
      .addClass('active');
    this._active = idx;
  }

  get active()
  {
    return this._active;
  }

  addListeners()
  {
    this._container.on(
      'mouseenter.TabMenu',
      '.tabs .menu-item',
      $.proxy(this.onMouseEnter, this)
    );

    this._container.on(
      'mouseenter.TabMenu',
      '.tabs .menu-item',
      $.proxy(this.onTabClick, this)
    );
  }

  init()
  {
    this.setup();
    this.addListeners();
    this.active = 0;
  }

  setup() {
    const menuItems = this._container.children('.menu-item');
    const tabs = $('<div class="tabs" />');
    const tabsContent = $('<div class="tabs-content" />');

    menuItems.each((i, el) => {
      const classes = Array.from(el.classList).filter((value) => value.indexOf('layout') === 0 || value.indexOf('columns') === 0);
      $(el).children('.sub-menu').addClass(classes);
    });

    tabs.append(menuItems);
    tabsContent.append(menuItems.children('.sub-menu'));
    this._container.append(tabs, tabsContent);
  }

  onMouseEnter(e)
  {
    const target = $(e.currentTarget);
    this.active = target.index();
  }

  onTabClick(e)
  {
    const target = $(e.currentTarget);
    this.active = target.index();
  }
}
