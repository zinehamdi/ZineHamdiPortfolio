@extends('layouts.admin')
@section('content')
  <div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-[#E8E8E8] mb-6">Leads</h1>

    {{-- Filter Form --}}
    <div class="bg-[#12121a] rounded-2xl border border-white/10 shadow-xl shadow-black/30 p-6 mb-6">
      <form method="GET" action="{{ route('admin.leads') }}" class="flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-[200px]">
          <label class="block text-sm font-medium text-[#A0A0A0] mb-2">Search (name/email)</label>
          <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="e.g. alice@example.com"
            class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-2.5 text-[#E8E8E8] placeholder-[#555] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all">
        </div>
        <div class="min-w-[150px]">
          <label class="block text-sm font-medium text-[#A0A0A0] mb-2">Stage</label>
          <select name="stage"
            class="w-full bg-[#0a0a0f] border border-white/10 rounded-xl px-4 py-2.5 text-[#E8E8E8] focus:outline-none focus:ring-2 focus:ring-[#00FF88]/50 transition-all">
            <option value="">All</option>
            @foreach(($stages ?? []) as $s)
              <option value="{{ $s }}" @selected(($stage ?? '') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
        </div>
        <div class="flex gap-3">
          <button type="submit"
            class="mlp-glass-subtle border border-mlp-border-subtle/70 hover:border-mlp-gold/70 px-5 py-2.5 text-sm font-semibold text-white rounded-mlp-md transition-all hover:shadow-mlp-laser-green">Filter</button>
          <a href="{{ route('admin.leads.export', ['q' => $q, 'stage' => $stage]) }}"
            class="mlp-btn-laser px-5 py-2.5 text-sm font-bold">Export CSV</a>
        </div>
      </form>
    </div>

    {{-- Leads Table --}}
    <div class="overflow-x-auto bg-[#12121a] rounded-2xl border border-white/10 shadow-2xl shadow-black/50">
      <table class="min-w-full">
        <thead>
          <tr class="text-left bg-white/5 border-b border-white/10">
            <th class="p-4 text-[#A0A0A0] font-semibold">Created</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Name</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Email</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Locale</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Package</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Budget</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Estimate</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Stage</th>
          </tr>
        </thead>
        <tbody>
          @forelse($items as $lead)
            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
              <td class="p-4 text-[#555] font-mono text-sm">{{ $lead->created_at?->format('Y-m-d H:i') }}</td>
              <td class="p-4 text-[#E8E8E8]">{{ $lead->name }}</td>
              <td class="p-4 text-[#A0A0A0] font-mono">{{ $lead->email }}</td>
              <td class="p-4 text-[#A0A0A0] uppercase font-mono">{{ $lead->locale }}</td>
              <td class="p-4 text-[#A0A0A0]">{{ $lead->package_id ?: '—' }}</td>
              <td class="p-4 text-[#A0A0A0]">{{ $lead->budget_range ?: '—' }}</td>
              <td class="p-4 text-[#00FF88] font-mono">{{ $lead->price_estimate_min }}–{{ $lead->price_estimate_max }}
                {{ $lead->currency }}
              </td>
              <td class="p-4">
                <span
                  class="px-2.5 py-1 rounded-full text-xs font-medium bg-[#7B61FF]/20 text-[#7B61FF]">{{ ucfirst($lead->stage) }}</span>
              </td>
            </tr>
          @empty
            <tr>
              <td class="p-6 text-center text-[#555]" colspan="8">No leads found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
  </div>
@endsection