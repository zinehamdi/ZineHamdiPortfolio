@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
  <h1 class="text-2xl font-bold mb-4">Leads</h1>

  <form method="GET" action="{{ route('admin.leads') }}" class="mb-4 flex flex-wrap gap-3 items-end">
    <div>
      <label class="block text-sm font-medium">Search (name/email)</label>
      <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="e.g. alice@example.com" class="border rounded px-3 py-2 w-64">
    </div>
    <div>
      <label class="block text-sm font-medium">Stage</label>
      <select name="stage" class="border rounded px-3 py-2">
        <option value="">All</option>
        @foreach(($stages ?? []) as $s)
          <option value="{{ $s }}" @selected(($stage ?? '') === $s)>{{ ucfirst($s) }}</option>
        @endforeach
      </select>
    </div>
    <div>
  <x-button variant="outline">Filter</x-button>
    </div>
    <div>
  <x-button variant="primary" href="{{ route('admin.leads.export', ['q' => $q, 'stage' => $stage]) }}">Export CSV</x-button>
    </div>
  </form>

  <div class="overflow-x-auto bg-white rounded border border-brand-ink/10">
    <table class="min-w-full">
      <thead>
        <tr class="text-left bg-gray-50">
          <th class="p-2">Created</th>
          <th class="p-2">Name</th>
          <th class="p-2">Email</th>
          <th class="p-2">Locale</th>
          <th class="p-2">Package</th>
          <th class="p-2">Budget</th>
          <th class="p-2">Estimate</th>
          <th class="p-2">Stage</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $lead)
          <tr class="border-t">
            <td class="p-2 text-gray-600">{{ $lead->created_at?->format('Y-m-d H:i') }}</td>
            <td class="p-2">{{ $lead->name }}</td>
            <td class="p-2">{{ $lead->email }}</td>
            <td class="p-2">{{ $lead->locale }}</td>
            <td class="p-2">{{ $lead->package_id ?: '—' }}</td>
            <td class="p-2">{{ $lead->budget_range ?: '—' }}</td>
            <td class="p-2">{{ $lead->price_estimate_min }}–{{ $lead->price_estimate_max }} {{ $lead->currency }}</td>
            <td class="p-2">{{ ucfirst($lead->stage) }}</td>
          </tr>
        @empty
          <tr>
            <td class="p-4" colspan="8">No leads found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection
