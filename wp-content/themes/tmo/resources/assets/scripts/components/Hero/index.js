export default class Hero
{
  constructor(el)
  {
    this._el = $(el)
    this.init()
  }

  init()
  {
    this._el.addClass('hide')

    setTimeout(() => {
      this._el.removeClass('hide')

      if (this._el.hasClass('layout-inline_video')) {
        this._el.find('.card__video')[0].play();
      }
    }, 1000);
  }
}
