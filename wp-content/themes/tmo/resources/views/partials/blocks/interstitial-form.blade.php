<div class="block -interstitialForm">
  <div class="container">
    <div class="interstitial__content">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>
    <div class="interstitial__form">
      <form
        action="/schedule-demo/"
        method="get"
        class="wpcf7-form init"
        novalidate="novalidate"
        data-status="init"
      >
        <div class="input">
          <label for="schedule-demo-email">Your Email</label>
          <span class="wpcf7-form-control-wrap email">
            <input
              type="email"
              name="email"
              value=""
              size="40"
              class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
              id="schedule-demo-email"
              aria-required="true"
              aria-invalid="false"
              placeholder="Your Email"
            >
          </span>
        </div>

        <div class="actions">
          <input type="submit" value="Schedule a Demo" class="wpcf7-form-control has-spinner wpcf7-submit">
        </div>
      </form>
    </div>
  </div>
</div>
