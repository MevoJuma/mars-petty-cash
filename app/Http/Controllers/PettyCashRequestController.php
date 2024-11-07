<?php

namespace App\Http\Controllers;

use App\Models\PettyCashRequest;
use App\Notifications\PettyCashRequestStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\auth;

class PettyCashRequestController extends Controller
{

    public function index()
    {
        //Fetch requests according to user role
        if (auth()->user()->isHOD()) {
            $requests = PettyCashRequest::where('status', 'pending')->get();
        } elseif (auth()->user()->isBranchManager()) {
            $requests = PettyCashRequest::where('status', 'approved')->get();
        } elseif (auth()->user()->isGeneralManager()) {
            $requests = PettyCashRequest::where('status', ['approved', 'pending'])->get();
        } else {
            $requests = [];
        }

        return view('petty_cash.index', compact('requests'));
    }
    
    public function create()
    {
        return view('petty_cash.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'reason' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        //Handle file upload if present
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachment');
        }

        //Create a new petty cash request
        PettyCashRequest::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'reason' => $request->reason,
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('petty_cash.create')->with('success', 'Request submitted successfully!');
    }



    public function approve(Request $request, PettyCashRequest $pettyCashRequest)
    {
        $this->authorize('approve', $pettyCashRequest);
        $pettyCashRequest->status = 'approved';
        $pettyCashRequest->save();

        $pettyCashRequest->user->notify(new PettyCashRequestStatus($pettyCashRequest, 'approved'));

        return redirect()->route('petty_cash.index')->with('success', 'Request approved successfully!');
    }

    public function reject(Request $request, PettyCashRequest $pettyCashRequest)
    {
        $this->authorize('reject', $pettyCashRequest);

        $pettyCashRequest->status = 'rejected';
        $pettyCashRequest->save();

        $pettyCashRequest->user->notify(new PettyCashRequestStatus($pettyCashRequest, 'rejected'));

        return redirect()->route('petty_cash.index')->with('success', 'Request rejected successfully!');
    }

    // app/Http/Controllers/PettyCashRequestController.php

    public function transactionHistory()
    {
        $requests = auth()->user()->pettyCashRequests()->orderBy('created_at', 'desc')->get();

        return view('transactions.index', compact('requests'));
    }

}
