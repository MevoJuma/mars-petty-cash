{{-- resources/views/notifications/index.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Notifications</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <ul class="list-group">
            @foreach (auth()->user()->notifications as $notification)
                <li class="list-group-item">
                    <strong>Request ID:</strong> {{ $notification->data['request_id'] }} <br>
                    <strong>Amount:</strong> ${{ number_format($notification->data['amount'], 2) }} <br>
                    <strong>Reason:</strong> {{ $notification->data['reason'] }} <br>
                    <strong>Status:</strong> {{ ucfirst($notification->data['status']) }}
                    <span class="badge badge-info">{{ $notification->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
