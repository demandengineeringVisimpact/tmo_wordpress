const LAYOUTS = {
  'HORIZONTAL': 'HORIZONTAL',
  'VERTICAL': 'VERTICAL',
};

export default class Tabs
{
  constructor(el)
  {
    this._el = $(el);
    this._tabs = this._el.find('.tab');
    this._layout = this._el.closest('.block').hasClass('layout-vertical')
      ? LAYOUTS.VERTICAL
      : LAYOUTS.HORIZONTAL;
    this.init();
  }

  get active()
  {
    return this._active;
  }

  set active(active = 0)
  {
    this._active = active;
    this.toggle();
  }

  addListeners()
  {
    this._tabs.on('click', '.tab__action', $.proxy(this.changeTab, this));
    this._changer.on('change', $.proxy(this.changeSelected, this));
    this._headers.on('click', '.tab__action', $.proxy(this.changeTab, this));
  }

  setup()
  {
    this._headers = $('<div class="tab__headers" />');
    this._changer = $('<select class="tabs__changer" />');
    this._tabs.each((i, el) => {
      const value = $(el).find('.tab__action').text();
      this._changer.append(`<option value="${i}">${value}</option>`);
      if (this._layout === LAYOUTS.VERTICAL) {
        this._headers.append($(el).find('.tab__header'));
      }
    });

    if (this._layout === LAYOUTS.VERTICAL) {
      this._el.prepend(this._headers);
    }

    this._el.prepend(this._changer);
    this.active = 0;
  }

  init()
  {
    this.setup()
    this.addListeners()

    this._el.addClass('initialized');
  }

  changeTab(e)
  {
    if (this._layout === LAYOUTS.VERTICAL) {
      this.active = $(e.currentTarget).parent().index();
    } else {
      this.active = $(e.delegateTarget).index() - 1;
    }
  }

  changeSelected(e)
  {
    this.active = parseInt($(e.currentTarget).val());
  }

  toggle()
  {
    this._changer.val(this._active);
    this._tabs.eq(this._active)
      .addClass('is-active')
      .siblings()
      .removeClass('is-active');
    this._headers.children()
      .eq(this._active)
      .addClass('is-active')
      .siblings()
      .removeClass('is-active');

    this._tabs.each((i, el) => {
      const video = $(el).find('video');
      if (video.length && i === this._active) {
        video[0].play();
      }

      if (video.length && i !== this._active) {
        video[0].pause();
      }
    });
  }
}
