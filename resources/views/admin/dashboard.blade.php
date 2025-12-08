@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto">
  <!-- Header -->
  <div class="flex items-center justify-between mb-8">
    <div>
      <h1 class="text-2xl font-bold text-[#E8E8E8]">Admin Dashboard</h1>
      <p class="text-[#A0A0A0] text-sm font-mono">Welcome back, admin</p>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.inbox') }}" class="text-sm text-[#00FF88] hover:text-[#7B61FF] transition-colors">View Inbox</a>
    </div>
  </div>

  <!-- Stats Grid -->
  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
    @php $stats = [
      ['label' => 'Orders', 'value' => $ordersCount ?? 0, 'color' => '#00FF88', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
      ['label' => 'Subscriptions', 'value' => $subsCount ?? 0, 'color' => '#7B61FF', 'icon' => 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z'],
      ['label' => 'Visitors', 'value' => $visits ?? 0, 'color' => '#FF6B35', 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
      ['label' => 'Leads', 'value' => $leads ?? 0, 'color' => '#FFD700', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
      ['label' => 'Inbox', 'value' => $inboxCount ?? 0, 'color' => '#00BFFF', 'icon' => 'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4'],
    ]; @endphp
    @foreach($stats as $stat)
      <div class="glass-card p-4">
        <div class="flex items-center gap-3 mb-2">
          <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: {{ $stat['color'] }}20;">
            <svg class="w-5 h-5" style="color: {{ $stat['color'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
            </svg>
          </div>
        </div>
        <div class="text-2xl font-bold text-[#E8E8E8]">{{ $stat['value'] }}</div>
        <div class="text-sm text-[#A0A0A0]">{{ $stat['label'] }}</div>
      </div>
    @endforeach
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
      <!-- Recent Orders -->
      <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="font-bold text-[#E8E8E8]">Recent Orders</h2>
          <a href="#" class="text-sm text-[#00FF88] hover:text-[#7B61FF]">View all</a>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="text-left text-[#A0A0A0] border-b border-white/10">
              <tr><th class="p-3">Date</th><th class="p-3">Customer</th><th class="p-3">Total</th><th class="p-3">Status</th></tr>
            </thead>
            <tbody>
              @php $ros = collect($recentOrders ?? []); @endphp
              @forelse($ros as $o)
                <tr class="border-b border-white/5 hover:bg-white/5">
                  <td class="p-3 whitespace-nowrap text-[#A0A0A0]">{{ $o->created_at?->format('Y-m-d') }}</td>
                  <td class="p-3 text-[#E8E8E8]">{{ $o->customer_name ?? '—' }}</td>
                  <td class="p-3 text-[#00FF88] font-mono">{{ number_format($o->total_cents/100, 2) }} {{ $o->currency }}</td>
                  <td class="p-3">
                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $o->status === 'completed' ? 'bg-[#00FF88]/20 text-[#00FF88]' : 'bg-[#FFD700]/20 text-[#FFD700]' }}">
                      {{ ucfirst($o->status) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr><td class="p-4 text-[#A0A0A0]" colspan="4">No orders yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Recent Subscriptions -->
      <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="font-bold text-[#E8E8E8]">Recent Subscriptions</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="text-left text-[#A0A0A0] border-b border-white/10">
              <tr><th class="p-3">Date</th><th class="p-3">Email</th><th class="p-3">Plan</th><th class="p-3">Status</th></tr>
            </thead>
            <tbody>
              @php $rss = collect($recentSubs ?? []); @endphp
              @forelse($rss as $s)
                <tr class="border-b border-white/5 hover:bg-white/5">
                  <td class="p-3 whitespace-nowrap text-[#A0A0A0]">{{ $s->created_at?->format('Y-m-d') }}</td>
                  <td class="p-3 text-[#E8E8E8]">{{ $s->email }}</td>
                  <td class="p-3 text-[#7B61FF] font-mono">{{ $s->plan }}</td>
                  <td class="p-3">
                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-[#00FF88]/20 text-[#00FF88]">
                      {{ ucfirst($s->status) }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr><td class="p-4 text-[#A0A0A0]" colspan="4">No subscriptions yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="space-y-6">
      <!-- Quick Message -->
      <div class="glass-card p-6">
        <h2 class="font-bold text-[#E8E8E8] mb-4">Quick Message</h2>
        <form class="space-y-4" method="POST" action="{{ route('admin.message') }}">@csrf
          <div>
            <label class="block text-sm text-[#A0A0A0] mb-2">Subject</label>
            <input type="text" name="subject" class="form-input" required>
          </div>
          <div>
            <label class="block text-sm text-[#A0A0A0] mb-2">Message</label>
            <textarea name="body" rows="4" class="form-input resize-none" required></textarea>
          </div>
          <div class="grid grid-cols-2 gap-3">
            <input type="text" name="from_name" class="form-input" placeholder="Your name">
            <input type="email" name="from_email" class="form-input" placeholder="Your email">
          </div>
          <button type="submit" class="btn-primary w-full">Send Message</button>
        </form>
      </div>

      <!-- Maintenance -->
      <div class="glass-card p-6">
        <h2 class="font-bold text-[#E8E8E8] mb-4">Maintenance</h2>
        <form method="POST" action="{{ route('admin.index') }}">@csrf
          <button type="submit" class="btn-outline w-full">Run content:index</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
