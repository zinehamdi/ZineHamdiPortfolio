<div class="mt-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-10 grid gap-6 md:grid-cols-3 text-[#1b1b18]/90">
    <div>
      @php($brandLogo = file_exists(public_path('images/zinedev.png')) ? asset('images/zinedev.png') : asset('favicon.ico'))
      <div class="flex items-center gap-3 mb-3">
        <img src="{{ $brandLogo }}" alt="ZINDEV logo" class="h-9 w-9 rounded-xl object-contain bg-white" loading="lazy">
  <span class="font-semibold">Hamdi Zine</span>
      </div>
  <p class="text-sm text-[#1b1b18]/70">Crafting premium Laravel sites and AI-powered experiences.</p>
    </div>
    <div>
      <h3 class="font-semibold mb-3">Social</h3>
      <ul class="space-y-2 text-sm">
        @php($social = config('site.social'))
        @if(!empty($social['github']))
          <li><a class="hover:text-gold" href="{{ $social['github'] }}" target="_blank" rel="noopener">GitHub</a></li>
        @endif
        @if(!empty($social['linkedin']))
          <li><a class="hover:text-gold" href="{{ $social['linkedin'] }}" target="_blank" rel="noopener">LinkedIn</a></li>
        @endif
        @if(!empty($social['instagram']))
          <li><a class="hover:text-gold" href="{{ $social['instagram'] }}" target="_blank" rel="noopener">Instagram</a></li>
        @endif
      </ul>
    </div>
    <div>
      <h3 class="font-semibold mb-3">Contact</h3>
      <ul class="space-y-2 text-sm">
        @php($email = config('site.admin_email'))
        @if($email)
          <li><a class="hover:text-gold" href="mailto:{{ $email }}">{{ $email }}</a></li>
        @endif
        @php($digits = preg_replace('/\D+/', '', (string) config('site.whatsapp_number')))
        @if($digits)
          <li><a class="hover:text-gold" href="https://wa.me/{{ $digits }}" target="_blank" rel="noopener">WhatsApp</a></li>
        @endif
      </ul>
    </div>
  </div>
  <div>
  <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-4 text-xs text-[#1b1b18]/60">&copy; {{ date('Y') }} Hamdi Zine. {{ __('common.footer.rights') ?? 'All rights reserved.' }}</div>
  </div>
</div>
