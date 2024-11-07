{{-- resources/views/petty_cash/index.blade.php --}}


<x-app-layout>

    <body class="font-sans antialiased bg-color:f1f3f6">
        <div class="d-flex">
            <!-- Sidebar -->
            <div class="sidebar bg-dark text-white" style="min-height: 100vh; width: 250px;">
                <!-- Company Logo -->
                <div class="text-center py-4">
                    <img src="path/to/your/logo.png" alt="Company Logo" class="img-fluid" style="max-width: 150px;">
                </div>
                <h2 class="text-center">Petty Cash</h2>
                <ul class="nav flex-column">
                    {{-- <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('pettycash.create') }}">Dashboard</a>
                    </li> --}}
                    {{-- <li class="nav-item"> --}}
                    {{-- <a class="nav-link text-white" href="#submit-request" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Submit Request</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link text-white" href="#view-requests">View Requests</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link text-white" href="#manage-users">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#settings">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#logout">Logout</a>
                    </li> --}}
                </ul>
            </div>



            <div class="container">
                <h2>Petty Cash Requests</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    New Request
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Petty Cash</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <h2>Request Petty Cash</h2>
                                    <form id="pettycashform" action="{{ route('petty_cash.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="amount">Amount Needed:</label>
                                            <input type="number" step="0.01" name="amount" class="form-control"
                                                required>
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- @section('content') --}}

                {{-- @endsection --}}


                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td>${{ number_format($request->amount, 2) }}</td>
                                <td>{{ $request->reason }}</td>
                                <td>{{ ucfirst($request->status) }}</td>
                                <td>
                                    @if ($request->status == 'pending' && auth()->user()->isHoD())
                                        <form action="{{ route('petty_cash.approve', $request->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                    @endif

                                    @if ($request->status == 'approved' && auth()->user()->isBranchManager())
                                        <form action="{{ route('petty_cash.approve', $request->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                    @endif

                                    @if ($request->status != 'rejected')
                                        <form action="{{ route('petty_cash.reject', $request->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</x-app-layout>
