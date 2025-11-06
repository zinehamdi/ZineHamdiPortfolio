@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Inbox</h1>
    <div class="flex items-center gap-3">
      <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ $q }}" placeholder="Search..." class="border rounded px-3 py-2">
        <button class="bg-black text-white rounded px-3 py-2">Search</button>
      </form>
      <a href="{{ route('admin.dashboard') }}" class="text-sm underline">Back to Dashboard</a>
    </div>
  </div>

  <div class="bg-white rounded-2xl border border-[#e3e3e0] p-0 overflow-x-auto">
    <table class="min-w-full text-sm">
      <thead class="text-left text-gray-600">
        <tr>
          <th class="p-3">Date</th>
          <th class="p-3">From</th>
          <th class="p-3">Email</th>
          <th class="p-3">Snippet</th>
          <th class="p-3">Locale</th>
          <th class="p-3">Source</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $m)
          <tr class="border-t">
            <td class="p-3 whitespace-nowrap"><a href="{{ route('admin.inbox.show', $m->id) }}" class="underline">{{ $m->created_at?->format('Y-m-d H:i') }}</a></td>
            <td class="p-3">{{ $m->name }}</td>
            <td class="p-3">{{ $m->email }}</td>
            <td class="p-3">{{ \Illuminate\Support\Str::limit($m->message, 80) }}</td>
            <td class="p-3">{{ $m->locale }}</td>
            <td class="p-3">{{ $m->source }}</td>
          </tr>
        @empty
          <tr><td class="p-4" colspan="6">No messages yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection
