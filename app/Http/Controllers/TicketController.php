<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;
    public function index(Request $request)
    {
        //
    $this->authorize('viewAny', Ticket::class);

        $user = $request->user();

        // Query builder dengan eager loading (Minggu 2)
        $query = Ticket::with(['user', 'assignee']);

        // AUTHORIZATION: Filter berdasarkan role (Minggu 4 Hari 2)
        if ($user->isUser()) {
            // User biasa hanya lihat ticket sendiri
            $query->where('user_id', $user->id);
        } elseif ($user->isStaff()) {
            // Staff bisa lihat semua, tapi highlight assigned
            $query->orderByRaw('CASE WHEN assigned_to = ? THEN 0 ELSE 1 END', [$user->id]);
        }
        // Admin: tidak ada filter (lihat semua)

        // Filter by status (optional)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tickets = $query->latest()->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create', Ticket::class);
        return view('tickets.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        //
        // $this->authorize('create', Ticket::class);
        $validate = $request->validated();

        $validate['user_id'] = auth()->id();
        $validated['status'] = 'open';
        $tickte = Ticket::create($validate);
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
        $this->authorize('view', $ticket);

        // Load relationships
        $ticket->load(['user', 'assignee']);

        // Staff list untuk admin assign (Minggu 4 Hari 2)
        $staffList = [];
        if (Gate::allows('assign-tickets')) {
            $staffList = User::whereIn('role', ['staff', 'admin'])->get();
        }

        return view('tickets.show', compact('ticket', 'staffList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
        $this->authorize('update', $ticket);

        return view('tickets.edit', compact('ticket'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
        $this->authorize('update', $ticket);

        // ✅ Validasi sudah OTOMATIS terjadi!
        // UpdateTicketRequest memvalidasi: title, description, status, priority

        // Update tiket dengan data yang sudah valid
        $ticket->update($request->validated());

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Tiket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Tiket berhasil dihapus!');
    }
   public function updateStatus(Request $request, Ticket $ticket): RedirectResponse
    {
        // Manual authorization untuk custom policy method
        $this->authorize('changeStatus', $ticket);

        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $ticket->update($validated);

        return back()->with('success', 'Status ticket berhasil diupdate!');
    }

    /**
     * Assign ticket to staff member
     *
     * MINGGU 4 HARI 2: Admin only action via Gate
     */
    public function assign(Request $request, Ticket $ticket): RedirectResponse
    {
        // Check gate for assign permission
        $this->authorize('assign', $ticket);

        $validated = $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $ticket->update($validated);

        $message = $validated['assigned_to']
            ? 'Ticket berhasil di-assign!'
            : 'Assignment ticket berhasil dihapus!';

        return back()->with('success', $message);
    }

}
