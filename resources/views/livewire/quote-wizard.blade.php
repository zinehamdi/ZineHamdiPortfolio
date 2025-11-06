<div class="max-w-2xl mx-auto p-6 bg-white rounded-2xl border border-brand-ink/10" x-data="quoteWizard">
    <div class="flex items-center justify-between mb-6 text-sm">
        <div class="flex-1 flex items-center gap-2">
            <div class="w-8 h-1 rounded bg-{{ $step >= 1 ? 'brand' : 'gray-300' }}"></div>
            <span>{{ __('quote.business.title') }}</span>
        </div>
        <div class="flex-1 flex items-center gap-2">
            <div class="w-8 h-1 rounded bg-{{ $step >= 2 ? 'brand' : 'gray-300' }}"></div>
            <span>{{ __('quote.needs.title') }}</span>
        </div>
        <div class="flex-1 flex items-center gap-2">
            <div class="w-8 h-1 rounded bg-{{ $step >= 3 ? 'brand' : 'gray-300' }}"></div>
            <span>{{ __('quote.budget.title') }}</span>
        </div>
        <div class="flex-1 flex items-center gap-2">
            <div class="w-8 h-1 rounded bg-{{ $step >= 4 ? 'brand' : 'gray-300' }}"></div>
            <span>{{ __('quote.contact.title') }}</span>
        </div>
    </div>

    @if($selected_slug)
        <div class="mb-4 text-sm">
            <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-amber-100 text-amber-800">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M16.704 5.29a1 1 0 010 1.42l-7.25 7.25a1 1 0 01-1.414 0L3.296 9.217a1 1 0 111.414-1.414l3.04 3.04 6.543-6.543a1 1 0 011.41-.01z"/></svg>
                <span>{{ strtoupper($selected_slug) }} selected</span>
            </span>
        </div>
    @endif
    <form wire:submit.prevent="nextStep" class="space-y-6">
        <input type="text" wire:model.lazy="website" class="hidden" tabindex="-1" autocomplete="off" />

        @if($step === 1)
            <div class="grid gap-4">
                <div>
                    <label class="block mb-2 font-semibold">{{ __('quote.business.fields.business_type') }}</label>
                    <select wire:model.defer="business_type" class="w-full p-2 border rounded">
                        <option value="">—</option>
                        <option value="food">Food</option>
                        <option value="olive_oil">Olive Oil</option>
                        <option value="services">Services</option>
                        <option value="retail">Retail</option>
                        <option value="other">Other</option>
                    </select>
                    @if(isset($errors['business_type'])) <span class="text-red-600 text-sm">{{ $errors['business_type'][0] }}</span> @endif
                </div>
                <div>
                    <label class="block mb-2 font-semibold">{{ __('quote.business.fields.company') }}</label>
                    <input type="text" wire:model.defer="company" class="w-full p-2 border rounded">
                    @if(isset($errors['company'])) <span class="text-red-600 text-sm">{{ $errors['company'][0] }}</span> @endif
                </div>
            </div>
        @elseif($step === 2)
            <div class="grid gap-3">
                @foreach(['need_website','need_content','need_ai','need_seo'] as $field)
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" wire:model.defer="{{ $field }}" class="rounded">
                    <span>{{ __('quote.needs.' . $field) }}</span>
                </label>
                @endforeach
            </div>
        @elseif($step === 3)
            <div>
                <label class="block mb-2 font-semibold">{{ __('quote.budget.budget_range') }}</label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach(['<=1000','1000-2500','>=2500'] as $r)
                        <label class="border rounded-lg p-3 flex items-center gap-2 cursor-pointer {{ $budget_range === $r ? 'ring-2 ring-amber-500' : '' }}">
                            <input type="radio" class="hidden" value="{{ $r }}" wire:model="budget_range">
                            <span class="font-semibold">{{ __('quote.budget.ranges.'.$r) }}</span>
                            <span class="text-gray-500">{{ $currency }}</span>
                        </label>
                    @endforeach
                </div>
                @if(isset($errors['budget_range'])) <span class="text-red-600 text-sm">{{ $errors['budget_range'][0] }}</span> @endif
            </div>
        @elseif($step === 4 && !$price_estimate_min)
            <div class="grid gap-4">
                <div>
                    <label class="block mb-2 font-semibold">{{ __('quote.contact.name') }}</label>
                    <input type="text" wire:model.defer="name" class="w-full p-2 border rounded">
                    @if(isset($errors['name'])) <span class="text-red-600 text-sm">{{ $errors['name'][0] }}</span> @endif
                </div>
                <div>
                    <label class="block mb-2 font-semibold">{{ __('quote.contact.email') }}</label>
                    <input type="email" wire:model.defer="email" class="w-full p-2 border rounded">
                    @if(isset($errors['email'])) <span class="text-red-600 text-sm">{{ $errors['email'][0] }}</span> @endif
                </div>
                <div>
                    <label class="block mb-2 font-semibold">{{ __('quote.contact.phone') }}</label>
                    <input type="text" wire:model.defer="phone" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-semibold">{{ __('quote.contact.notes') }}</label>
                    <textarea wire:model.defer="notes" class="w-full p-2 border rounded"></textarea>
                </div>
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" wire:model="agree_terms" class="rounded">
                    <span>{{ __('quote.contact.agree_terms') }}</span>
                </label>
                @if(isset($errors['agree_terms'])) <span class="text-red-600 text-sm">{{ $errors['agree_terms'][0] ?? __('quote.agree_required') }}</span> @endif
                @if(isset($errors['rate'])) <span class="text-red-600 text-sm">{{ $errors['rate'][0] }}</span> @endif
            </div>
        @elseif($step === 4 && $price_estimate_min)
            <div class="text-center">
                <h2 class="text-2xl font-bold mb-2">{{ __('quote.result.title') }}</h2>
                <p class="text-lg mb-1">{{ __('quote.result.message') }}
                    <span class="font-bold">{{ $price_estimate_min }}–{{ $price_estimate_max }} {{ $currency }}</span>
                </p>
                <p class="mb-4"></p>
                <div class="flex items-center justify-center gap-3">
                    <a href="https://wa.me/21600000000" target="_blank" class="px-5 py-2 bg-brand-accent text-white rounded">{{ __('quote.result.whatsapp') }}</a>
                    <button type="button" class="px-5 py-2 bg-gray-200 rounded">{{ __('quote.actions.download_pdf') }}</button>
                </div>
            </div>
        @endif

        <div class="flex justify-between pt-2">
            @if($step > 1 && !($step === 4 && $price_estimate_min))
                <button type="button" wire:click="prevStep" class="px-5 py-2 rounded border">{{ __('quote.actions.prev') }}</button>
            @else
                <span></span>
            @endif
                <button type="submit" class="px-6 py-2 bg-brand-accentDark text-white rounded">
                {{ $step < 4 ? __('quote.actions.next') : __('quote.actions.submit') }}
            </button>
        </div>
    </form>
</div>
