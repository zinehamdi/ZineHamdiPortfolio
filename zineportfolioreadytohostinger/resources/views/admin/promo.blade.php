@extends('layouts.admin')

@section('title', 'Edit Vlog/Promo')

@section('content')
  <div class="max-w-2xl mx-auto bg-white rounded-2xl border border-brand-ink/10 p-6">
    <h1 class="text-xl font-extrabold mb-4">Edit Vlog/Promo</h1>

    @if(session('status'))
      <div class="mb-4 rounded border border-green-500/30 bg-green-50 text-green-900 px-4 py-2">{{ session('status') }}</div>
    @endif

  <form id="promo-form" method="POST" action="{{ route('admin.promo.save') }}" enctype="multipart/form-data">
      @csrf
      @php $loc = app()->getLocale(); @endphp
      <div class="grid gap-4">
        <div>
          <label class="block text-sm font-medium mb-1">Language visibility</label>
          @php $currentLocale = old('locale', $promo->locale ?? ''); @endphp
          <select name="locale" class="w-full border rounded px-3 py-2">
            <option value="" {{ $currentLocale === '' ? 'selected' : '' }}>All languages (show everywhere)</option>
            <option value="en" {{ $currentLocale === 'en' ? 'selected' : '' }}>English (en)</option>
            <option value="fr" {{ $currentLocale === 'fr' ? 'selected' : '' }}>Français (fr)</option>
            <option value="ar" {{ $currentLocale === 'ar' ? 'selected' : '' }}>العربية (ar)</option>
          </select>
          <p class="text-xs text-gray-500 mt-1">Choose a specific language to show it only on that localized homepage. Use "All languages" to show on every locale.</p>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Title</label>
          <input name="title" value="{{ old('title', $promo->title ?? '') }}" class="w-full border rounded px-3 py-2" required>
          @error('title')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Text</label>
          <textarea name="text" rows="4" class="w-full border rounded px-3 py-2">{{ old('text', $promo->text ?? '') }}</textarea>
        </div>
        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium mb-1">CTA Label</label>
            <input name="cta" value="{{ old('cta', $promo->cta ?? '') }}" class="w-full border rounded px-3 py-2">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Link (URL)</label>
            <input name="link" value="{{ old('link', $promo->link ?? '') }}" class="w-full border rounded px-3 py-2" placeholder="/en/blog or https://...">
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Image</label>
          <div class="grid gap-2">
            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
            <div class="text-xs text-gray-500">Or paste a path below (optional)</div>
            <input name="image_path" value="{{ old('image_path', $promo->image_path ?? 'images/hero-promo.jpg') }}" class="w-full border rounded px-3 py-2" placeholder="images/hero-promo.jpg">
          </div>
          @php
            $preview = isset($promo) && $promo->image_path ? (file_exists(public_path($promo->image_path)) ? asset($promo->image_path) : (str_starts_with($promo->image_path, 'storage/') ? asset($promo->image_path) : null)) : null;
          @endphp
          @if($preview)
            <img src="{{ $preview }}" alt="Preview" class="mt-3 rounded border w-full max-w-sm">
          @endif
        </div>
      </div>
      <div class="mt-6 flex gap-3">
        <button type="submit" class="px-6 py-2 bg-brand-accentDark text-white rounded">Save</button>
  <button type="submit" name="view" value="1" class="px-6 py-2 bg-[#1b1b18] text-[#FFA400] rounded">Save & View</button>
      </div>
    </form>
  </div>
@endsection
