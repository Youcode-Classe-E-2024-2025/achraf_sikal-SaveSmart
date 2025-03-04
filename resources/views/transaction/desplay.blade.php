@extends('layouts.app')

@section('title', 'Transaction')

@section('content')
<div class="p-14">
<div class="bg-gray-50 dark:text-white dark:bg-gray-800 rounded-lg overflow-hidden">
@forelse($transactions as $transaction)
    <div class="border-b p-4 transition-colors">
        <div class="flex justify-between items-center">
            <div>
                <p class="font-medium">Added by: {{ $transaction->profile->name }}</p>
                <br class="text-gray-600 text-sm">Created at: <br> {{ $transaction->created_at->format('j M Y, H:i') }}</p>
            </div>
            @php
            $amount = $transaction->amount;
            if($transaction->type =='expense'){
                $amount = -$transaction->amount;
            }
            @endphp
            <p class="font-bold {{ $amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ number_format($amount,2) }} USD
            </p>
        </div>
    </div>
@empty
    <div class="p-4">
        <p class="text-gray-600">No transactions found.</p>
    </div>
@endforelse
<div class="mt-4">
    {{ $transactions->links() }}
</div>
</div>
@endsection
