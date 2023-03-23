import Awards from '../components/Awards';
import CountrySwap from '../components/CountrySwap';
import CustomerList from '../components/CustomerList';
import FAQs from '../components/FAQs';
import Features from '../components/Features';
import Feed from '../components/Feed';
import Hero from '../components/Hero';
import History from '../components/History';
import Logos from '../components/Logos';
import MajorSolutions from '../components/MajorSolutions';
import MobileMenu from '../components/MobileMenu';
import Ratings from '../components/Ratings';
import SideMenu from '../components/SideMenu';
import Solutions from '../components/Solutions';
import Stats from '../components/Stats';
import TabMenu from '../components/TabMenu';
import Tabs from '../components/Tabs';
import Testimonials from '../components/Testimonials';

export default {
  init() {
    new MobileMenu($('.menu-header-container')[0]);
    const countrySwap = new CountrySwap();
    countrySwap.swap();

    $('.fancybox').fancybox();
    $('.block.-hero').each((i, el) => { new Hero(el); });
    $('.block.-ratings').each((i, el) => { new Ratings(el); });
    $('.block.-solutions').each((i, el) => { new Solutions(el); });
    $('.block.-major-solutions').each((i, el) => { new MajorSolutions(el); });
    $('.nav-primary .layout-tab').each((i, el) => { new TabMenu(el); });
    $('.block.-testimonials').each((i, el) => { new Testimonials(el); });
    $('.block.-awards .swiper').each((i, el) => { new Awards(el); });
    $('.block.-history .swiper').each((i, el) => { new History(el); });
    $('.block.-faqs .faqs').each((i, el) => { new FAQs(el); });
    $('.block.-features.layout-accordion').each((i, el) => { new Features(el); });
    $('.block.-tabs .tabs').each((i, el) => { new Tabs(el); });
    $('.feed.-resources .swiper, .feed.-webinars .swiper, .block.-carousel .swiper, .block.-posts-feed .swiper').each((i, el) => { new Feed(el); });
    $('.side-menu__aside').each((i, el) => { new SideMenu(el); });
    $('.post-type-archive-clients .swiper').each((i, el) => { new Logos(el); });
    $('.block.-customerList .swiper').each((i, el) => { new CustomerList(el); });
    $('.block.-stats.layout-text_below').each((i, el) => { new Stats(el); });
    $('.card').on('click', '.card__title', (e) => {
      const action = $(e.delegateTarget).find('.card__action');
      if (action.length) {
        window.location.href = action.attr('href');
      }
    });
  },
  finalize() {
    const forms = $('.wpcf7-form');
    const urlParams = new URLSearchParams(window.location.search);

    if (forms.length) {
      const timer = () => {
        forms.each((i, el) => {
          if (!$(el).hasClass('init')) {
            setTimeout(timer, 100)
          }

          if (urlParams.has('email')) {
            $('[name="email"]').val(urlParams.get('email'));
          }
        })
      }
      setTimeout(timer, 100);
    }

    $('#wpcf7-f307-p308-o1').on('wpcf7mailsent', (e) => {
      $(e.currentTarget).find('.input, .actions').hide();
    });
  },
};
