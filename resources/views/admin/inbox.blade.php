@extends('layouts.admin')
@section('content')
  <div class="max-w-7xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-[#E8E8E8]">Inbox</h1>
      <div class="flex items-center gap-4">
        <form method="GET" class="flex gap-2">
          <input type="text" name="q" value="{{ $q }}" placeholder="Search..."
            class="mlp-glass-subtle border border-mlp-border-subtle/70 rounded-mlp-md px-4 py-2.5 text-mlp-text-main placeholder-mlp-text-muted focus:outline-none focus:ring-2 focus:ring-mlp-laser-green/50 transition-all w-64">
          <button class="mlp-btn-laser px-5 py-2.5 text-sm font-bold">Search</button>
        </form>
        <a href="{{ route('admin.dashboard') }}"
          class="mlp-glass-subtle border border-mlp-border-subtle/70 hover:border-mlp-gold/70 px-4 py-2 text-sm font-medium text-mlp-text-muted rounded-mlp-md transition-all hover:shadow-mlp-laser-green">Back
          to Dashboard</a>
      </div>
    </div>

    <div class="bg-[#12121a] rounded-2xl border border-white/10 shadow-2xl shadow-black/50 overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="text-left border-b border-white/10 bg-white/5">
          <tr>
            <th class="p-4 text-[#A0A0A0] font-semibold">Date</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">From</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Email</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Snippet</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Locale</th>
            <th class="p-4 text-[#A0A0A0] font-semibold">Source</th>
          </tr>
        </thead>
        <tbody>
          @forelse($items as $m)
            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
              <td class="p-4 whitespace-nowrap"><a href="{{ route('admin.inbox.show', $m->id) }}"
                  class="text-[#00FF88] hover:underline">{{ $m->created_at?->format('Y-m-d H:i') }}</a></td>
              <td class="p-4 text-[#E8E8E8]">{{ $m->name }}</td>
              <td class="p-4 text-[#A0A0A0] font-mono">{{ $m->email }}</td>
              <td class="p-4 text-[#555]">{{ \Illuminate\Support\Str::limit($m->message, 80) }}</td>
              <td class="p-4 text-[#A0A0A0] uppercase font-mono">{{ $m->locale }}</td>
              <td class="p-4 text-[#A0A0A0]">{{ $m->source }}</td>
            </tr>
          @empty
            <tr>
              <td class="p-6 text-center text-[#555]" colspan="6">No messages yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6">{{ $items->links() }}</div>
  </div>
@endsection