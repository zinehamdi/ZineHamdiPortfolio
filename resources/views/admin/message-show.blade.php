@extends('layouts.admin')
@section('content')
  <div class="max-w-3xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-[#E8E8E8]">Message</h1>
      <a href="{{ route('admin.inbox') }}" class="text-[#A0A0A0] hover:text-[#00FF88] text-sm transition-colors">Back to
        Inbox</a>
    </div>

    <div class="bg-[#12121a] rounded-2xl border border-white/10 shadow-2xl shadow-black/50 p-6">
      <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-6 pb-6 border-b border-white/10">
        <div>
          <dt class="text-[#555] mb-1">From</dt>
          <dd class="font-medium text-[#E8E8E8]">{{ $msg->name }} <span
              class="text-[#00FF88] font-mono">({{ $msg->email }})</span></dd>
        </div>
        <div>
          <dt class="text-[#555] mb-1">Date</dt>
          <dd class="font-medium text-[#E8E8E8] font-mono">{{ $msg->created_at?->format('Y-m-d H:i') }}</dd>
        </div>
        <div>
          <dt class="text-[#555] mb-1">Locale</dt>
          <dd class="font-medium text-[#A0A0A0] uppercase font-mono">{{ $msg->locale }}</dd>
        </div>
        <div>
          <dt class="text-[#555] mb-1">Source</dt>
          <dd class="font-medium text-[#A0A0A0]">{{ $msg->source }}</dd>
        </div>
        <div class="md:col-span-2">
          <dt class="text-[#555] mb-1">Path</dt>
          <dd class="font-mono text-[#7B61FF]">{{ $msg->path }}</dd>
        </div>
        <div class="md:col-span-2">
          <dt class="text-[#555] mb-1">Referrer</dt>
          <dd class="font-mono text-[#555]">{{ $msg->referrer }}</dd>
        </div>
      </dl>
      <div class="text-[#E8E8E8] whitespace-pre-wrap leading-relaxed">{{ $msg->message }}</div>
    </div>
  </div>
@endsection