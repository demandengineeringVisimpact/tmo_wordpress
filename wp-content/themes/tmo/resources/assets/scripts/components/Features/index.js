export default class Features
{
  constructor(el)
  {
    this._el = $(el);
    this._media = this._el.find('.features__media img');
    this.init();
  }

  init()
  {
    this._el.find('.feature__body').hide();
    this._el.on('click', '.feature', $.proxy(this.toggle, this));
    this._el.addClass('initialized');
    this._el.find('.feature').first().click();

    if (window.location.hash) {
      this.goToHash()
    }
  }

  goToHash()
  {
    const feature = $(window.location.hash);
    const boundingRect = feature.closest('.block.-features')[0].getBoundingClientRect();

    window.scrollTo({
      top: boundingRect.top,
      behavior: 'smooth',
    });

    if (feature.index()) {
      feature.click();
    }
  }

  hideSiblings(feature)
  {
    feature
      .siblings('.is-open')
      .removeClass('is-open')
      .find('.feature__body')
        .slideUp();
  }

  toggle(e)
  {
    const feature = $(e.currentTarget);
    const body = feature.find('.feature__body');
    const toggled = body.is(':visible');
    this.hideSiblings(feature);
    feature.toggleClass('is-open', !toggled);
    body.slideToggle(!toggled);
    this._media.attr('src', feature.data('figure'))
  }
}
