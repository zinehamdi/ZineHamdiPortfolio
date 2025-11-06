export function quoteWizard(){
  return {
    ['x-init']() {
      // Attach a normal listener without inline arrow function usage in templates
      const handler = (e) => {
        try {
          // Use Livewire instance from Alpine context
          this.$wire && this.$wire.selectPackage(e.detail.slug);
        } catch (_) {}
      };
      window.addEventListener('choose-package', handler);
      // Clean up when Alpine tears down this component
      this.$watch('$el', (el) => {
        if (!el || !el.isConnected) {
          window.removeEventListener('choose-package', handler);
        }
      });
    },
  }
}
