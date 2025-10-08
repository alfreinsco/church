<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // 'permission:view events' => ['index', 'show'],
            // 'permission:create events' => ['create', 'store'],
            // 'permission:edit events' => ['edit', 'update'],
            // 'permission:delete events' => ['destroy'],
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            $query = Event::with(['organizer', 'registrations.member', 'createdBy']);

            // Filter by status
            if ($request->has('status') && $request->status !== '') {
                $query->where('status', $request->status);
            }

            // Filter by type
            if ($request->has('type') && $request->type !== '') {
                $query->where('type', $request->type);
            }

            // Search by name
            if ($request->has('search') && $request->search !== '') {
                $query->where('name', 'like', '%'.$request->search.'%');
            }

            // Filter by start date
            if ($request->has('start_date') && $request->start_date !== '') {
                $query->where('start_date', '>=', $request->start_date);
            }

            $events = $query->orderBy('start_date', 'desc')->paginate(15);

            DB::commit();

            return view('events.index', compact('events'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data kegiatan: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $members = Member::select('id', 'name')->get();

            return view('events.create', compact('members'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'type' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'start_time' => 'nullable|date_format:H:i',
                'end_time' => 'nullable|date_format:H:i',
                'location' => 'nullable|string|max:255',
                'max_participants' => 'nullable|integer|min:1',
                'status' => 'required|in:akan datang,sedang berlangsung,selesai,dibatalkan',
                'organizer_id' => 'nullable|exists:members,id',
                'notes' => 'nullable|string',
            ]);

            $data = $request->all();
            $data['created_by'] = Auth::id();

            Event::create($data);

            DB::commit();

            return redirect()->route('events.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data kegiatan berhasil ditambahkan',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menyimpan data: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $event = Event::with([
                'organizer', 'registrations.member',
                'createdBy', 'updatedBy',
            ])->findOrFail($id);

            return view('events.show', compact('event'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data kegiatan: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $event = Event::findOrFail($id);
            $members = Member::select('id', 'name')->get();

            return view('events.edit', compact('event', 'members'));

        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $event = Event::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'type' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'start_time' => 'nullable|date_format:H:i',
                'end_time' => 'nullable|date_format:H:i',
                'location' => 'nullable|string|max:255',
                'max_participants' => 'nullable|integer|min:1',
                'status' => 'required|in:akan datang,sedang berlangsung,selesai,dibatalkan',
                'organizer_id' => 'nullable|exists:members,id',
                'notes' => 'nullable|string',
            ]);

            $data = $request->all();
            $data['updated_by'] = Auth::id();

            $event->update($data);

            DB::commit();

            return redirect()->route('events.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data kegiatan berhasil diperbarui',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memperbarui data: '.$e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $event = Event::findOrFail($id);
            $event->delete();

            DB::commit();

            return redirect()->route('events.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data kegiatan berhasil dihapus',
                'icon' => 'success',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menghapus data: '.$e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
