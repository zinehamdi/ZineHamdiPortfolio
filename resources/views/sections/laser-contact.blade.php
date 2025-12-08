<section class="mlp-bg-root border-t border-mlp-border-subtle/50">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-0 py-14 sm:py-16 lg:py-20">
    <div class="laser-contact-panel mlp-card-strong mlp-metal-sheen relative overflow-hidden p-8 sm:p-10 rounded-mlp-xl">
      <div class="absolute inset-0 mlp-laser-beam opacity-60"></div>
      <div class="relative space-y-6">
        <div class="space-y-3">
          <p class="text-xs uppercase tracking-[0.3em] text-mlp-text-muted">Contact</p>
          <h2 class="text-2xl sm:text-3xl lg:text-4xl font-display font-semibold text-mlp-text-main">Laser Contact Panel</h2>
          <p class="text-sm sm:text-base text-mlp-text-muted max-w-2xl">Tell me about your next metallic build. I’ll respond with a tailored, motion-first plan.</p>
        </div>

        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
          @csrf
          <div class="grid gap-4 sm:gap-5 sm:grid-cols-2">
            <label class="flex flex-col gap-2 text-sm text-mlp-text-muted">
              <span>Name</span>
              <input name="name" required class="mlp-glass-subtle rounded-mlp-md px-3 py-2 text-mlp-text-main bg-transparent border border-mlp-border-subtle/70 focus:outline-none focus:ring-2 focus:ring-mlp-laser-blue/60" />
            </label>
            <label class="flex flex-col gap-2 text-sm text-mlp-text-muted">
              <span>Email</span>
              <input type="email" name="email" required class="mlp-glass-subtle rounded-mlp-md px-3 py-2 text-mlp-text-main bg-transparent border border-mlp-border-subtle/70 focus:outline-none focus:ring-2 focus:ring-mlp-laser-green/60" />
            </label>
          </div>
          <label class="flex flex-col gap-2 text-sm text-mlp-text-muted">
            <span>Project vision</span>
            <textarea name="message" rows="4" required class="mlp-glass-subtle rounded-mlp-md px-3 py-2 text-mlp-text-main bg-transparent border border-mlp-border-subtle/70 focus:outline-none focus:ring-2 focus:ring-mlp-gold/60"></textarea>
          </label>
          <div class="flex flex-wrap items-center gap-4">
            <button type="submit" class="mlp-btn-gold px-6 py-2.5 text-sm font-semibold">Initiate laser brief</button>
            <div class="mlp-laser-orbit px-3 py-1 rounded-mlp-pill text-xs text-mlp-text-muted flex items-center gap-2">
              <span class="w-1.5 h-1.5 rounded-full bg-mlp-laser-blue"></span>
              <span>Laser border animates on focus</span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
