@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-semibold text-gray-900">Orders</h2><br>
    <a href="{{ route('orders.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Add Order</a>

    @if(session('success'))
        <div class="mt-4 text-green-500">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 overflow-hidden shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Order Date</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Customer</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Total Amount</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($orders as $order)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $order->order_date }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $order->customer->name ?? 'Unknown Customer' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $order->status }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('orders.show', $order) }}" class="text-blue-500 hover:underline">View</a> |
                            <a href="{{ route('orders.edit', $order) }}" class="text-yellow-500 hover:underline">Edit</a> |
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
