export function portfolioTabs() {
  return {
    tab: 'all',
    setTab(k) { this.tab = k; },
    is(k) { return this.tab === k; },
    btnClass(k) {
      return this.is(k)
        ? 'bg-[#00FF88] text-[#0a0a0f] border-[#00FF88] shadow-[0_0_20px_rgba(0,255,136,0.3)]'
        : 'text-[#A0A0A0] border-white/10 bg-white/5 hover:bg-white/10 hover:text-white';
    },
    ariaSelected(k) { return this.is(k).toString(); },
    showFor(cat) { return this.is('all') || this.is(cat); },
  };
}
