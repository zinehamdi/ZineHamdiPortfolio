<div class="max-w-2xl mx-auto p-6 bg-white/5 backdrop-blur-sm rounded-2xl border border-brand-accent/20 shadow-[0_0_30px_rgba(0,255,136,0.05)]" x-data="quoteWizard">
    <div class="flex items-center justify-between mb-8 text-sm">
        <div class="flex-1 flex items-center gap-2">
            <div class="w-full h-1 rounded {{ $step >= 1 ? 'bg-brand-accent shadow-[0_0_10px_rgba(0,255,136,0.4)]' : 'bg-white/10' }}"></div>
            <span class="hidden sm:inline {{ $step >= 1 ? 'text-brand-accent' : 'text-gray-500' }}">{{ __('quote.business.title') }}</span>
        </div>
        <div class="flex-1 flex items-center gap-2">
            <div class="w-full h-1 rounded {{ $step >= 2 ? 'bg-brand-accent shadow-[0_0_10px_rgba(0,255,136,0.4)]' : 'bg-white/10' }}"></div>
            <span class="hidden sm:inline {{ $step >= 2 ? 'text-brand-accent' : 'text-gray-500' }}">{{ __('quote.needs.title') }}</span>
        </div>
        <div class="flex-1 flex items-center gap-2">
            <div class="w-full h-1 rounded {{ $step >= 3 ? 'bg-brand-accent shadow-[0_0_10px_rgba(0,255,136,0.4)]' : 'bg-white/10' }}"></div>
            <span class="hidden sm:inline {{ $step >= 3 ? 'text-brand-accent' : 'text-gray-500' }}">{{ __('quote.budget.title') }}</span>
        </div>
        <div class="flex-1 flex items-center gap-2">
            <div class="w-full h-1 rounded {{ $step >= 4 ? 'bg-brand-accent shadow-[0_0_10px_rgba(0,255,136,0.4)]' : 'bg-white/10' }}"></div>
            <span class="hidden sm:inline {{ $step >= 4 ? 'text-brand-accent' : 'text-gray-500' }}">{{ __('quote.contact.title') }}</span>
        </div>
    </div>

    @if($selected_slug)
        <div class="mb-6 text-sm text-center">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-accent/10 text-brand-accent border border-brand-accent/20 shadow-[0_0_15px_rgba(0,255,136,0.2)]">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M16.704 5.29a1 1 0 010 1.42l-7.25 7.25a1 1 0 01-1.414 0L3.296 9.217a1 1 0 111.414-1.414l3.04 3.04 6.543-6.543a1 1 0 011.41-.01z"/></svg>
                <span class="font-bold tracking-wide">{{ strtoupper($selected_slug) }} PACKAGE SELECTED</span>
            </span>
        </div>
    @endif

    <div class="space-y-6">
        <input type="text" wire:model.lazy="website" class="hidden" tabindex="-1" autocomplete="off" />

        @if($step === 1)
            <div class="grid gap-6 animate-fade-in-up">
                <div>
                    <label class="block mb-2 font-bold text-white">{{ __('quote.business.fields.business_type') }}</label>
                    <select wire:model.live="business_type" class="w-full p-3 bg-black/20 border border-brand-accent/20 rounded-xl text-white focus:border-brand-accent focus:ring-1 focus:ring-brand-accent outline-none transition-all">
                        <option value="">Select Industry...</option>
                        <option value="food">Food & Beverage</option>
                        <option value="olive_oil">Olive Oil / Agriculture</option>
                        <option value="services">Professional Services</option>
                        <option value="retail">E-Commerce / Retail</option>
                        <option value="tech">Technology / SaaS</option>
                        <option value="other">Other</option>
                    </select>
                    @error('business_type') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block mb-2 font-bold text-white">{{ __('quote.business.fields.company') }}</label>
                    <input type="text" wire:model.live="company" class="w-full p-3 bg-black/20 border border-brand-accent/20 rounded-xl text-white focus:border-brand-accent focus:ring-1 focus:ring-brand-accent outline-none transition-all" placeholder="e.g. Acme Corp">
                    @error('company') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        @elseif($step === 2)
            <div class="grid gap-4 animate-fade-in-up">
                @foreach(['need_website','need_content','need_ai','need_seo'] as $field)
                <label class="flex items-center gap-4 p-4 rounded-xl border border-brand-accent/10 bg-white/5 hover:bg-white/10 hover:border-brand-accent/30 cursor-pointer transition-all group">
                    <input type="checkbox" wire:model.live="{{ $field }}" class="w-5 h-5 rounded border-brand-accent/30 text-brand-accent focus:ring-brand-accent bg-black/20">
                    <span class="text-white font-medium group-hover:text-brand-accent transition-colors">{{ __('quote.needs.' . $field) }}</span>
                </label>
                @endforeach
                @error('needs') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
            </div>
        @elseif($step === 3)
            <div class="animate-fade-in-up">
                <label class="block mb-4 font-bold text-white">{{ __('quote.budget.budget_range') }}</label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach(['<=1000','1000-2500','>=2500'] as $r)
                        <label class="relative border rounded-xl p-4 flex flex-col items-center justify-center gap-2 cursor-pointer transition-all {{ $budget_range === $r ? 'border-brand-accent bg-brand-accent/10 shadow-[0_0_15px_rgba(0,255,136,0.2)]' : 'border-brand-accent/20 bg-white/5 hover:border-brand-accent/50' }}">
                            <input type="radio" class="hidden" value="{{ $r }}" wire:model.live="budget_range">
                            <span class="font-bold text-white {{ $budget_range === $r ? 'text-brand-accent' : '' }}">{{ __('quote.budget.ranges.'.$r) }}</span>
                            <span class="text-sm text-gray-400">{{ $currency }}</span>
                        </label>
                    @endforeach
                </div>
                @error('budget_range') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
            </div>
        @elseif($step === 4 && !$price_estimate_min)
            <div class="grid gap-4 animate-fade-in-up">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 font-bold text-white">{{ __('quote.contact.name') }}</label>
                        <input type="text" wire:model.live="name" class="w-full p-3 bg-black/20 border border-brand-accent/20 rounded-xl text-white focus:border-brand-accent focus:ring-1 focus:ring-brand-accent outline-none transition-all">
                        @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 font-bold text-white">{{ __('quote.contact.email') }}</label>
                        <input type="email" wire:model.live="email" class="w-full p-3 bg-black/20 border border-brand-accent/20 rounded-xl text-white focus:border-brand-accent focus:ring-1 focus:ring-brand-accent outline-none transition-all">
                        @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label class="block mb-2 font-bold text-white">{{ __('quote.contact.phone') }}</label>
                    <input type="text" wire:model.live="phone" class="w-full p-3 bg-black/20 border border-brand-accent/20 rounded-xl text-white focus:border-brand-accent focus:ring-1 focus:ring-brand-accent outline-none transition-all">
                </div>
                <div>
                    <label class="block mb-2 font-bold text-white">{{ __('quote.contact.notes') }}</label>
                    <textarea wire:model.live="notes" rows="3" class="w-full p-3 bg-black/20 border border-brand-accent/20 rounded-xl text-white focus:border-brand-accent focus:ring-1 focus:ring-brand-accent outline-none transition-all"></textarea>
                </div>
                <label class="flex items-center gap-3 mt-2 cursor-pointer group">
                    <input type="checkbox" wire:model.live="agree_terms" class="w-5 h-5 rounded border-brand-accent/30 text-brand-accent focus:ring-brand-accent bg-black/20">
                    <span class="text-gray-400 text-sm group-hover:text-white transition-colors">{{ __('quote.contact.agree_terms') }}</span>
                </label>
                @error('agree_terms') <span class="text-red-500 text-sm block">{{ $message }}</span> @enderror
                @error('rate') <span class="text-red-500 text-sm block">{{ $message }}</span> @enderror
            </div>
        @elseif($step === 4 && $price_estimate_min)
            <div class="text-center animate-fade-in-up py-8">
                <div class="w-20 h-20 mx-auto bg-brand-accent/10 rounded-full flex items-center justify-center mb-6 border border-brand-accent/20 shadow-[0_0_30px_rgba(0,255,136,0.3)]">
                    <svg class="w-10 h-10 text-brand-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h2 class="text-3xl font-black text-white mb-4">{{ __('quote.result.title') }}</h2>
                <p class="text-xl text-gray-300 mb-2">{{ __('quote.result.message') }}</p>
                <div class="text-4xl font-black text-brand-accent mb-8 drop-shadow-[0_0_10px_rgba(0,255,136,0.5)]">
                    {{ $price_estimate_min }}–{{ $price_estimate_max }} {{ $currency }}
                </div>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="https://wa.me/21625777926" target="_blank" class="w-full sm:w-auto px-8 py-3 bg-brand-accent text-brand-primary font-bold rounded-xl hover:bg-brand-accent/90 transition-all shadow-[0_0_20px_rgba(0,255,136,0.3)] flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        {{ __('quote.result.whatsapp') }}
                    </a>
                    <button type="button" class="w-full sm:w-auto px-8 py-3 bg-white/10 text-white font-bold rounded-xl hover:bg-white/20 transition-all border border-white/10">
                        {{ __('quote.actions.download_pdf') }}
                    </button>
                </div>
            </div>
        @endif

        <div class="flex justify-between pt-6 border-t border-white/10">
            @if($step > 1 && !($step === 4 && $price_estimate_min))
                <button type="button" wire:click="prevStep" class="px-6 py-2 rounded-xl border border-white/20 text-gray-400 hover:text-white hover:border-white/40 transition-all">{{ __('quote.actions.prev') }}</button>
            @else
                <span></span>
            @endif
            
            @if(!($step === 4 && $price_estimate_min))
                <button type="button" wire:click="nextStep" wire:loading.attr="disabled"
                    class="px-8 py-2 bg-brand-accent text-brand-primary font-bold rounded-xl hover:bg-brand-accent/90 transition-all shadow-[0_0_15px_rgba(0,255,136,0.3)] disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="nextStep">{{ $step < 4 ? __('quote.actions.next') : __('quote.actions.submit') }}</span>
                    <span wire:loading wire:target="nextStep">Processing...</span>
                </button>
            @endif
        </div>
    </div>
</div>
