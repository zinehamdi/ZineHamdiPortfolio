export function vlogCard() {
  return {
    expanded: false,
    clampPx: 160,
    _rzTimer: null,
    get isRtl() { return document.documentElement.dir === 'rtl'; },
    ['x-init']() {
      // Run a microtask so DOM is ready then recalc
      queueMicrotask(() => { this.recalc(); });
      // Debounced resize handler (CSP-safe, no inline @resize)
      const onResize = () => {
        clearTimeout(this._rzTimer);
        this._rzTimer = setTimeout(() => { this.recalc(); }, 200);
      };
      window.addEventListener('resize', onResize);
      // Cleanup on teardown
      this.$watch('$el', (el) => {
        if (!el || !el.isConnected) {
          window.removeEventListener('resize', onResize);
          clearTimeout(this._rzTimer);
        }
      });
    },
    toggle() { this.expanded = !this.expanded; },
    styleTextWrap() { return this.expanded ? 'max-height: none' : ('max-height: ' + this.clampPx + 'px'); },
    async computeClamp() {
      const intro = document.getElementById('introCard');
      const card = this.$refs.card;
      const text = this.$refs.textWrap;
      if (!intro || !card || !text) return;
      const prevExpanded = this.expanded;
      const prevMax = text.style.maxHeight;
      this.expanded = true;
      text.style.maxHeight = 'none';
      await this.$nextTick();
      const fullTextH = text.scrollHeight;
      const cardExpandedH = card.offsetHeight;
      const staticH = cardExpandedH - fullTextH;
      const targetTextH = intro.offsetHeight - staticH;
      const clamp = Math.max(96, Math.min(fullTextH, targetTextH));
      this.clampPx = Number.isFinite(clamp) && clamp > 0 ? clamp : 160;
      this.expanded = false;
      text.style.maxHeight = prevMax || (this.clampPx + 'px');
      await this.$nextTick();
    },
    async recalc() {
      if (window.matchMedia('(min-width: 1024px)').matches) {
        await this.computeClamp();
      } else {
        this.clampPx = 160;
        this.expanded = false;
        if (this.$refs && this.$refs.textWrap) this.$refs.textWrap.style.maxHeight = (this.clampPx + 'px');
      }
    },
  };
}
