@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.inbox') }}" class="text-sm underline">Inbox</a>
      <form method="POST" action="{{ route('admin.logout') }}">@csrf
        <button class="text-sm bg-black text-white rounded px-3 py-1">Logout</button>
      </form>
    </div>
  </div>
  @if(session('status'))<div class="p-3 bg-green-100 mb-4 rounded">{{ session('status') }}</div>@endif

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="p-4 bg-white rounded-2xl border border-[#e3e3e0]">
      <div class="text-sm text-gray-600">Orders</div>
      <div class="text-2xl font-bold">{{ $ordersCount ?? 0 }}</div>
    </div>
    <div class="p-4 bg-white rounded-2xl border border-[#e3e3e0]">
      <div class="text-sm text-gray-600">Subscriptions</div>
      <div class="text-2xl font-bold">{{ $subsCount ?? 0 }}</div>
    </div>
    <div class="p-4 bg-white rounded-2xl border border-[#e3e3e0]">
      <div class="text-sm text-gray-600">Visitors</div>
      <div class="text-2xl font-bold">{{ $visits ?? 0 }}</div>
    </div>
    <div class="p-4 bg-white rounded-2xl border border-[#e3e3e0]">
      <div class="text-sm text-gray-600">Leads</div>
      <div class="text-2xl font-bold">{{ $leads ?? 0 }}</div>
    </div>
    <div class="p-4 bg-white rounded-2xl border border-[#e3e3e0]">
      <div class="text-sm text-gray-600">Inbox</div>
      <div class="text-2xl font-bold">{{ $inboxCount ?? 0 }}</div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
      <div class="bg-white rounded-2xl border border-[#e3e3e0] p-4 overflow-x-auto">
        <div class="flex items-center justify-between mb-3">
          <h2 class="font-semibold">Recent Orders</h2>
          <a href="#" class="text-sm text-[#1b1b18]/70">View all</a>
        </div>
        <table class="min-w-full text-sm">
          <thead class="text-left text-gray-600">
            <tr><th class="p-2">Date</th><th class="p-2">Customer</th><th class="p-2">Total</th><th class="p-2">Status</th></tr>
          </thead>
          <tbody>
            @php $ros = collect($recentOrders ?? []); @endphp
            @forelse($ros as $o)
              <tr class="border-t">
                <td class="p-2 whitespace-nowrap">{{ $o->created_at?->format('Y-m-d') }}</td>
                <td class="p-2">{{ $o->customer_name ?? '—' }}</td>
                <td class="p-2">{{ number_format($o->total_cents/100, 2) }} {{ $o->currency }}</td>
                <td class="p-2">{{ ucfirst($o->status) }}</td>
              </tr>
            @empty
              <tr><td class="p-4" colspan="4">No orders yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="bg-white rounded-2xl border border-[#e3e3e0] p-4 overflow-x-auto">
        <div class="flex items-center justify-between mb-3">
          <h2 class="font-semibold">Recent Subscriptions</h2>
        </div>
        <table class="min-w-full text-sm">
          <thead class="text-left text-gray-600">
            <tr><th class="p-2">Date</th><th class="p-2">Email</th><th class="p-2">Plan</th><th class="p-2">Status</th></tr>
          </thead>
          <tbody>
            @php $rss = collect($recentSubs ?? []); @endphp
            @forelse($rss as $s)
              <tr class="border-t">
                <td class="p-2 whitespace-nowrap">{{ $s->created_at?->format('Y-m-d') }}</td>
                <td class="p-2">{{ $s->email }}</td>
                <td class="p-2">{{ $s->plan }}</td>
                <td class="p-2">{{ ucfirst($s->status) }}</td>
              </tr>
            @empty
              <tr><td class="p-4" colspan="4">No subscriptions yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="space-y-6">
      <div class="bg-white rounded-2xl border border-[#e3e3e0] p-4">
        <h2 class="font-semibold mb-3">Quick Message</h2>
        <form class="space-y-3" method="POST" action="{{ route('admin.message') }}">@csrf
          <div>
            <label class="block text-sm">Subject</label>
            <input type="text" name="subject" class="w-full border rounded px-3 py-2" required>
          </div>
          <div>
            <label class="block text-sm">Message</label>
            <textarea name="body" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
          </div>
          <div class="flex gap-3">
            <input type="text" name="from_name" class="w-1/2 border rounded px-3 py-2" placeholder="Your name">
            <input type="email" name="from_email" class="w-1/2 border rounded px-3 py-2" placeholder="Your email">
          </div>
          <x-button variant="primary" class="w-full">Send</x-button>
        </form>
      </div>

      <div class="bg-white rounded-2xl border border-[#e3e3e0] p-4">
        <h2 class="font-semibold mb-3">Maintenance</h2>
        <form method="POST" action="{{ route('admin.index') }}">@csrf
          <x-button variant="outline" class="w-full">Run content:index</x-button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
