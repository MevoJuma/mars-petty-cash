{{-- resources/views/transactions/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaction History</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Amount</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Date Requested</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>${{ number_format($request->amount, 2) }}</td>
                    <td>{{ $request->reason }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>{{ $request->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
