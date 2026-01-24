@extends('layouts.admin')

@section('content')
<div class="grid md:grid-cols-4 gap-4">
    <div class="card p-4 rounded-xl">
        <h2 class="text-sm uppercase tracking-wide text-slate-400">Services</h2>
        <div class="text-3xl font-semibold">{{ $serviceCount }}</div>
    </div>
    <div class="card p-4 rounded-xl">
        <h2 class="text-sm uppercase tracking-wide text-slate-400">Packages</h2>
        <div class="text-3xl font-semibold">{{ $packageCount }}</div>
    </div>
    <div class="card p-4 rounded-xl">
        <h2 class="text-sm uppercase tracking-wide text-slate-400">Paid Revenue</h2>
        <div class="text-3xl font-semibold">${{ number_format($paidRevenue, 2) }}</div>
    </div>
    <div class="card p-4 rounded-xl">
        <h2 class="text-sm uppercase tracking-wide text-slate-400">Conversion</h2>
        <div class="text-3xl font-semibold">
            {{ isset($leadStats['won']) && $leadStats->sum() ? round(($leadStats['won'] ?? 0)/$leadStats->sum()*100,2) : 0 }}%
        </div>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="card p-4 rounded-xl">
        <h2 class="text-lg font-semibold mb-2 text-white">Order Status</h2>
        <div class="space-y-2">
            @foreach (\App\Models\Order::STATUSES as $status)
                <div class="flex justify-between text-sm">
                    <span class="capitalize">{{ str_replace('_',' ',$status) }}</span>
                    <span class="font-semibold">{{ $orderStats[$status] ?? 0 }}</span>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card p-4 rounded-xl">
        <h2 class="text-lg font-semibold mb-2 text-white">Lead Funnel</h2>
        <div class="space-y-2">
            @foreach (['new','contacted','quoted','won','lost'] as $status)
                <div class="flex justify-between text-sm">
                    <span class="capitalize">{{ $status }}</span>
                    <span class="font-semibold">{{ $leadStats[$status] ?? 0 }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="card p-4 rounded-xl">
        <h2 class="text-lg font-semibold mb-3 text-white">Recent Orders</h2>
        <div class="space-y-2">
            @forelse ($recentOrders as $order)
                <div class="flex items-center justify-between text-sm">
                    <div>
                        <div class="font-semibold">{{ $order->customer_name }}</div>
                        <div class="text-slate-400">{{ $order->status }} • {{ $order->created_at->format('M d') }}</div>
                    </div>
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-sky-400">View</a>
                </div>
            @empty
                <p class="text-slate-500 text-sm">No orders yet.</p>
            @endforelse
        </div>
    </div>
    <div class="card p-4 rounded-xl">
        <h2 class="text-lg font-semibold mb-3 text-white">Recent Leads</h2>
        <div class="space-y-2">
            @forelse ($recentLeads as $lead)
                <div class="flex items-center justify-between text-sm">
                    <div>
                        <div class="font-semibold">{{ $lead->name }}</div>
                        <div class="text-slate-400">{{ $lead->status }} • {{ $lead->created_at->format('M d') }}</div>
                    </div>
                    <a href="{{ route('admin.leads.edit', $lead) }}" class="text-sky-400">View</a>
                </div>
            @empty
                <p class="text-slate-500 text-sm">No leads yet.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="card p-4 rounded-xl">
    <h2 class="text-lg font-semibold mb-3 text-white">Popular Blog Posts</h2>
    <div class="grid md:grid-cols-3 gap-3 text-sm">
        @forelse ($topPosts as $post)
            <div class="border border-slate-800 rounded p-3">
                <div class="font-semibold">{{ $post->title }}</div>
                <div class="text-slate-400">Views: {{ $post->view_count }}</div>
            </div>
        @empty
            <p class="text-slate-500">No posts yet.</p>
        @endforelse
    </div>
</div>
@endsection
