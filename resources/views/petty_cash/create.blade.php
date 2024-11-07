{{-- resources/views/petty_cash/create.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Request Petty Cash</h2>
        <form action="{{ route('petty_cash.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="amount">Amount Needed:</label>
                <input type="number" step="0.01" name="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason for Request:</label>
                <textarea name="reason" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="attachment">Attach Receipt (Optional):</label>
                <input type="file" name="attachment" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>
@endsection
