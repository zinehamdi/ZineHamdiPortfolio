@extends('layouts.admin')
@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Message</h1>
    <a href="{{ route('admin.inbox') }}" class="text-sm underline">Back to Inbox</a>
  </div>

  <div class="bg-white rounded-2xl border border-[#e3e3e0] p-4">
    <dl class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm mb-4">
      <div><dt class="text-gray-600">From</dt><dd class="font-medium">{{ $msg->name }} ({{ $msg->email }})</dd></div>
      <div><dt class="text-gray-600">Date</dt><dd class="font-medium">{{ $msg->created_at?->format('Y-m-d H:i') }}</dd></div>
      <div><dt class="text-gray-600">Locale</dt><dd class="font-medium">{{ $msg->locale }}</dd></div>
      <div><dt class="text-gray-600">Source</dt><dd class="font-medium">{{ $msg->source }}</dd></div>
      <div class="md:col-span-2"><dt class="text-gray-600">Path</dt><dd class="font-mono">{{ $msg->path }}</dd></div>
      <div class="md:col-span-2"><dt class="text-gray-600">Referrer</dt><dd class="font-mono">{{ $msg->referrer }}</dd></div>
    </dl>
    <div class="prose max-w-none whitespace-pre-wrap">{{ $msg->message }}</div>
  </div>
</div>
@endsection
