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

<section id="contact" class="py-12 lg:py-20" @if($rtl) dir="rtl" @endif aria-labelledby="contact-heading">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="bg-[#dbdbd7] p-6 sm:p-8 lg:p-12 rounded-2xl section-shadow transition-all duration-300">
          <header class="mb-8">
            <h2 id="contact-heading" class="text-[#1b1b18] uppercase font-black text-3xl sm:text-4xl mb-4">{{ $tr('contact.title','Contact') }}</h2>
            <p class="text-[#1b1b18]/80 text-lg sm:text-xl mb-8">{{ $tr('contact.subtitle','Let’s build something together!') }}</p>
          </header>

          <p class="text-[#1b1b18]/80 text-base sm:text-lg leading-relaxed mb-8">
            {{ $tr('contact.description','Looking for a complete digital solution at startup-friendly cost? Reach out and let’s make your idea real. I’m available for freelance projects, collaborations, and consulting.') }}
          </p>

          <!-- Contact Methods -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 lg:mb-8">
            <div class="bg-white rounded-xl p-6 text-center section-shadow transition-all duration-300">
              <div class="w-16 h-16 mx-auto mb-4 bg-[#FFA400] rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-[#1b1b18]" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4M20,8L12,13L4,8V6L12,11L20,6V8Z"/>
                </svg>
              </div>
              <h4 class="font-bold text-[#1b1b18] mb-2">{{ $tr('contact.email.label','Email') }}</h4>
              <p class="text-sm text-[#1b1b18]/70">{{ $email }}</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center section-shadow transition-all duration-300">
              <div class="w-16 h-16 mx-auto mb-4 bg-[#FFA400] rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-[#1b1b18]" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"/>
                </svg>
              </div>
              <h4 class="font-bold text-[#1b1b18] mb-2">{{ $tr('contact.phone.label','Phone') }}</h4>
              <p class="text-sm text-[#1b1b18]/70">{{ $phone }}</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center section-shadow transition-all duration-300">
              <div class="w-16 h-16 mx-auto mb-4 bg-[#FFA400] rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-[#1b1b18]" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22S19,14.25 19,9A7,7 0 0,0 12,2Z"/>
                </svg>
              </div>
              <h4 class="font-bold text-[#1b1b18] mb-2">{{ $tr('contact.location.label','Location') }}</h4>
              <p class="text-sm text-[#1b1b18]/70">{{ $location }}</p>
            </div>
          </div>

          <!-- Contact Form -->
          <div class="bg-white rounded-xl p-6 section-shadow transition-all duration-300">
            <h3 class="font-bold text-[#1b1b18] mb-6">{{ $tr('contact.form.title','Send Message') }}</h3>
            <form method="POST" action="{{ route('contact.submit', ['locale' => app()->getLocale()]) }}" class="space-y-4">
              @csrf
              <!-- Honeypot field to catch bots (keep empty). Using uncommon name and hidden type to avoid browser autofill. -->
              <input type="hidden" name="hp_field" value="" autocomplete="off">

              @if(session('status'))
                <div class="rounded-lg border border-emerald-600/20 bg-emerald-600/10 text-emerald-900 px-4 py-3">{{ session('status') }}</div>
              @endif
              @if($errors->any())
                <div class="rounded-lg border border-red-600/20 bg-red-600/10 text-red-900 px-4 py-3">
                  <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label for="name" class="block text-sm font-medium text-[#1b1b18] mb-1">{{ $tr('contact.form.name','Name') }}</label>
                  <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-[#1b1b18]/20 rounded-lg focus:ring-2 focus:ring-[#FFA400]/60 focus:border-[#FFA400]">
                </div>
                <div>
                  <label for="email" class="block text-sm font-medium text-[#1b1b18] mb-1">{{ $tr('contact.form.email','Email') }}</label>
                  <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-3 py-2 border border-[#1b1b18]/20 rounded-lg focus:ring-2 focus:ring-[#FFA400]/60 focus:border-[#FFA400]">
                </div>
              </div>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label for="phone" class="block text-sm font-medium text-[#1b1b18] mb-1">{{ $tr('contact.form.phone','Phone (optional)') }}</label>
                  <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border border-[#1b1b18]/20 rounded-lg focus:ring-2 focus:ring-[#FFA400]/60 focus:border-[#FFA400]">
                </div>
                <div>
                  <label for="budget" class="block text-sm font-medium text-[#1b1b18] mb-1">{{ $tr('contact.form.budget','Budget (optional)') }}</label>
                  <input type="text" id="budget" name="budget" value="{{ old('budget') }}" class="w-full px-3 py-2 border border-[#1b1b18]/20 rounded-lg focus:ring-2 focus:ring-[#FFA400]/60 focus:border-[#FFA400]">
                </div>
              </div>
              
              <div>
                <label for="message" class="block text-sm font-medium text-[#1b1b18] mb-1">{{ $tr('contact.form.message','Message') }}</label>
                <textarea id="message" name="message" rows="4" required class="w-full px-3 py-2 border border-[#1b1b18]/20 rounded-lg focus:ring-2 focus:ring-[#FFA400]/60 focus:border-[#FFA400]">{{ old('message') }}</textarea>
              </div>
              
              <button type="submit" class="w-full bg-[#FFA400] hover:bg-[#1b1b18] text-[#1b1b18] hover:text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                {{ $tr('contact.form.submit','Send Message') }}
              </button>
            </form>
          </div>

          <div class="text-center mt-8">
            <p class="text-[#1b1b18]/80 font-bold text-lg">{{ $tr('contact.thanks','THANKS FOR VISITING MY PORTFOLIO!') }}</p>
          </div>
    </div>
  </div>
</section>
