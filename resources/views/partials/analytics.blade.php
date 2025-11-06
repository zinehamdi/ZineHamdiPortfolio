@if(env('GA4_ID'))
<!-- Google Analytics 4 -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GA4_ID') }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);} gtag('js', new Date());
  gtag('config', '{{ env('GA4_ID') }}');
</script>
@endif
@if(env('MATOMO_URL') && env('MATOMO_SITE_ID'))
<!-- Matomo -->
<script>
  var _paq = window._paq = window._paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u='{{ rtrim(env('MATOMO_URL'), '/') }}/';
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '{{ env('MATOMO_SITE_ID') }}']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
@endif
