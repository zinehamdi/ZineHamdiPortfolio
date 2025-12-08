@php
  $rtl = app()->getLocale() === 'ar';
  $tr = function(string $key, string $def) {
    $v = __($key);
    return $v === $key ? $def : $v;
  };
  $email = 'zinehamdi8@gmail.com';
  $phone = '+216 25 777 926';
  $location = 'Kairouan, Tunisia';
@endphp

<section id="contact" class="py-10 lg:py-14 mlp-bg-root border-t border-mlp-border-subtle/50" @if($rtl) dir="rtl" @endif aria-labelledby="contact-heading">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    
    <!-- Section Header -->
    <header class="mb-12 text-center mlp-glass-subtle rounded-mlp-md p-6 border border-mlp-border-subtle/60">
      <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 rounded-full bg-[#12121a] border border-[#00FF88]/20">
        <span class="w-2 h-2 bg-[#00FF88] rounded-full animate-pulse"></span>
        <span class="text-[#A0A0A0] text-sm font-mono">contact.send()</span>
      </div>
      <h2 id="contact-heading" class="section-title mb-4">{{ $tr('contact.title','Let\'s Work Together') }}</h2>
      <p class="section-subtitle mx-auto">{{ $tr('contact.subtitle','Ready to start your project? Send me a message and I\'ll respond within 24 hours') }}</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      
      <!-- Contact Info Cards -->
      <div class="space-y-4">
        @php $contactMethods = [
          ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => $tr('contact.email.label','Email'), 'value' => $email, 'href' => 'mailto:'.$email, 'color' => '#00FF88'],
          ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => $tr('contact.phone.label','Phone'), 'value' => $phone, 'href' => 'tel:'.str_replace(' ', '', $phone), 'color' => '#7B61FF'],
          ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'label' => $tr('contact.location.label','Location'), 'value' => $location, 'href' => '#', 'color' => '#FF6B35'],
        ]; @endphp
        @foreach($contactMethods as $i => $c)
          <a href="{{ $c['href'] }}" class="block mlp-card mlp-metal-sheen border border-mlp-border-subtle/70 p-5 group animate-fade-in-up" style="animation-delay: {{ $i * 0.1 }}s;">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-all group-hover:scale-110 mlp-laser-orbit" style="background: {{ $c['color'] }}20;">
                <svg class="w-6 h-6 transition-colors" style="color: {{ $c['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $c['icon'] }}"/>
                </svg>
              </div>
              <div>
                <p class="text-sm text-[#A0A0A0]">{{ $c['label'] }}</p>
                <p class="font-semibold text-[#E8E8E8] group-hover:text-[#00FF88] transition-colors">{{ $c['value'] }}</p>
              </div>
            </div>
          </a>
        @endforeach
        
        <!-- Social Links -->
        <div class="mlp-card mlp-metal-sheen border border-mlp-border-subtle/70 p-5 mt-6">
          <p class="text-sm text-[#A0A0A0] mb-4">{{ $tr('contact.social','Find me on') }}</p>
          <div class="flex gap-3">
            @php $socials = [
              ['href' => 'https://github.com/zinehamdi', 'icon' => 'M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z', 'label' => 'GitHub'],
              ['href' => 'https://linkedin.com/in/zinehamdi', 'icon' => 'M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z', 'label' => 'LinkedIn'],
            ]; @endphp
            @foreach($socials as $s)
              <a href="{{ $s['href'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $s['label'] }}" class="w-10 h-10 rounded-lg bg-[#12121a] border border-white/5 flex items-center justify-center text-[#A0A0A0] hover:text-[#00FF88] hover:border-[#00FF88]/30 transition-all">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $s['icon'] }}"/></svg>
              </a>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="lg:col-span-2 mlp-card-strong mlp-metal-sheen p-6 sm:p-8 border border-mlp-border-subtle/70">
        <h3 class="text-xl font-bold text-[#E8E8E8] mb-6">{{ $tr('contact.form.title','Send a Message') }}</h3>
        <form method="POST" action="{{ route('contact.submit', ['locale' => app()->getLocale()]) }}" class="space-y-5">
          @csrf
          <input type="hidden" name="hp_field" value="" autocomplete="off">

          @if(session('status'))
            <div class="rounded-lg border border-[#00FF88]/30 bg-[#00FF88]/10 text-[#00FF88] px-4 py-3">{{ session('status') }}</div>
          @endif
          @if($errors->any())
            <div class="rounded-lg border border-red-500/30 bg-red-500/10 text-red-400 px-4 py-3">
              <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
              </ul>
            </div>
          @endif
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label for="name" class="block text-sm font-medium text-[#A0A0A0] mb-2">{{ $tr('contact.form.name','Name') }}</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-input">
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-[#A0A0A0] mb-2">{{ $tr('contact.form.email','Email') }}</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required class="form-input">
            </div>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label for="phone" class="block text-sm font-medium text-[#A0A0A0] mb-2">{{ $tr('contact.form.phone','Phone (optional)') }}</label>
              <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-input">
            </div>
            <div>
              <label for="budget" class="block text-sm font-medium text-[#A0A0A0] mb-2">{{ $tr('contact.form.budget','Budget (optional)') }}</label>
              <input type="text" id="budget" name="budget" value="{{ old('budget') }}" class="form-input">
            </div>
          </div>
          
          <div>
            <label for="message" class="block text-sm font-medium text-[#A0A0A0] mb-2">{{ $tr('contact.form.message','Message') }}</label>
            <textarea id="message" name="message" rows="4" required class="form-input resize-none">{{ old('message') }}</textarea>
          </div>
          
          <button type="submit" class="btn-primary w-full group">
            <span>{{ $tr('contact.form.submit','Send Message') }}</span>
            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
          </button>
        </form>
      </div>
    </div>

    <!-- Footer text -->
    <div class="text-center mt-12">
      <p class="text-[#A0A0A0]">{{ $tr('contact.thanks','Thanks for visiting my portfolio!') }}</p>
    </div>
  </div>
</section>
