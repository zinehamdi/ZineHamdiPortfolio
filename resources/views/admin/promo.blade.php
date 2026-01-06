@extends('layouts.admin')

@section('title', 'Edit Vlog/Promo')

@section('content')
  <div class="max-w-2xl mx-auto bg-[#12121a] rounded-2xl border border-white/10 shadow-2xl shadow-black/50 p-8">
    <h1 class="text-xl font-extrabold text-[#E8E8E8] mb-6">Edit Vlog/Promo</h1>

    @if(session('status'))
      <div class="mb-6 p-4 rounded-xl bg-[#00FF88]/10 border border-[#00FF88]/30 text-[#00FF88]">{{ session('status') }}
      </div>
    @endif

    <form id="promo-form" method="POST" action="{{ route('admin.promo.save') }}" enctype="multipart/form-data">
      @csrf
      @php $loc = app()->getLocale(); @endphp
      <div class="grid gap-5">
        <div>
          <label class="block text-sm font-medium text-[#A0A0A0] mb-2">Language visibility</label>
          @php $currentLocale = old('locale', $promo->locale ?? ''); @endphp
          <select name="locale"
            class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all">
            <option value="" {{ $currentLocale === '' ? 'selected' : '' }}>All languages (show everywhere)</option>
            <option value="en" {{ $currentLocale === 'en' ? 'selected' : '' }}>English (en)</option>
            <option value="fr" {{ $currentLocale === 'fr' ? 'selected' : '' }}>Français (fr)</option>
            <option value="ar" {{ $currentLocale === 'ar' ? 'selected' : '' }}>العربية (ar)</option>
          </select>
          <p class="text-xs text-[#555] mt-2">Choose a specific language to show it only on that localized homepage. Use
            "All languages" to show on every locale.</p>
        </div>
        <div>
          <label class="block text-sm font-medium text-[#A0A0A0] mb-2">Title</label>
          <input name="title" value="{{ old('title', $promo->title ?? '') }}"
            class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all"
            required>
          @error('title')<div class="text-red-400 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
          <label class="block text-sm font-medium text-[#A0A0A0] mb-2">Text</label>
          <textarea name="text" rows="4"
            class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all resize-none">{{ old('text', $promo->text ?? '') }}</textarea>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-[#A0A0A0] mb-2">CTA Label</label>
            <input name="cta" value="{{ old('cta', $promo->cta ?? '') }}"
              class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all">
          </div>
          <div>
            <label class="block text-sm font-medium text-[#A0A0A0] mb-2">Link (URL)</label>
            <input name="link" value="{{ old('link', $promo->link ?? '') }}"
              class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all"
              placeholder="/en/blog or https://...">
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-[#A0A0A0] mb-2">Image</label>
          <div class="grid gap-3">
            <input type="file" name="image" accept="image/*"
              class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#A0A0A0] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#00FF88]/10 file:text-[#00FF88] hover:file:bg-[#00FF88]/20 focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all cursor-pointer">
            <div class="text-xs text-[#555]">Or paste a path below (optional)</div>
            <input name="image_path" value="{{ old('image_path', $promo->image_path ?? 'images/hero-promo.jpg') }}"
              class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-3 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all"
              placeholder="images/hero-promo.jpg">
          </div>
          @php
            $preview = isset($promo) && $promo->image_path ? (file_exists(public_path($promo->image_path)) ? asset($promo->image_path) : (str_starts_with($promo->image_path, 'storage/') ? asset($promo->image_path) : null)) : null;
          @endphp
          @if($preview)
            <img src="{{ $preview }}" alt="Preview" class="mt-4 rounded-xl border border-white/10 w-full max-w-sm">
          @endif
        </div>
      </div>
      <div class="mt-8 flex gap-4 pt-6 border-t border-mlp-border-subtle/50">
        <button type="submit" class="mlp-btn-laser px-8 py-3 text-sm font-bold">Save</button>
        <button type="submit" name="view" value="1" class="mlp-btn-gold px-8 py-3 text-sm font-bold">Save & View</button>
      </div>
    </form>
  </div>
@endsection