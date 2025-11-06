export function portfolioTabs() {
  return {
    tab: 'all',
    setTab(k) { this.tab = k; },
    is(k) { return this.tab === k; },
    btnClass(k) {
      return this.is(k)
        ? 'text-[#1b1b18] bg-[#FFA400]'
        : 'text-[#1b1b18]/60 hover:text-[#1b1b18] hover:bg-white/50';
    },
    ariaSelected(k) { return this.is(k).toString(); },
    showFor(cat) { return this.is('all') || this.is(cat); },
  };
}
