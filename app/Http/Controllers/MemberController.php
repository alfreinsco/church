<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Family;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view members')->only(['index', 'show']);
        $this->middleware('permission:create members')->only(['create', 'store']);
        $this->middleware('permission:edit members')->only(['edit', 'update']);
        $this->middleware('permission:delete members')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $query = Member::with(['family', 'father', 'mother', 'spouse', 'createdBy']);
            
            // Filter by status
            if ($request->has('status') && $request->status !== '') {
                $query->where('status', $request->status);
            }
            
            // Filter by gender
            if ($request->has('gender') && $request->gender !== '') {
                $query->where('gender', $request->gender);
            }
            
            // Filter by marital status
            if ($request->has('marital_status') && $request->marital_status !== '') {
                $query->where('marital_status', $request->marital_status);
            }
            
            // Search by name
            if ($request->has('search') && $request->search !== '') {
                $query->where('name', 'like', '%' . $request->search . '%');
            }
            
            $members = $query->paginate(15);
            $families = Family::all();
            
            DB::commit();
            
            return view('members.index', compact('members', 'families'));
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data jemaat: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $families = Family::all();
            $members = Member::select('id', 'name')->get();
            
            return view('members.create', compact('families', 'members'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: ' . $e->getMessage(),
                'icon' => 'error'
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
                'email' => 'nullable|email|unique:members,email',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'birth_date' => 'nullable|date',
                'birth_place' => 'nullable|string|max:255',
                'gender' => 'required|in:laki-laki,perempuan',
                'marital_status' => 'required|in:belum menikah,menikah,cerai,janda,duda',
                'occupation' => 'nullable|string|max:255',
                'education' => 'nullable|string|max:255',
                'baptism_date' => 'nullable|date',
                'baptism_place' => 'nullable|string|max:255',
                'sidi_date' => 'nullable|date',
                'sidi_place' => 'nullable|string|max:255',
                'marriage_date' => 'nullable|date',
                'marriage_place' => 'nullable|string|max:255',
                'status' => 'required|in:aktif,tidak aktif,pindah,meninggal',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'notes' => 'nullable|string',
                'father_id' => 'nullable|exists:members,id',
                'mother_id' => 'nullable|exists:members,id',
                'spouse_id' => 'nullable|exists:members,id',
                'family_id' => 'nullable|exists:families,id'
            ]);
            
            $data = $request->all();
            $data['created_by'] = Auth::id();
            
            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = time() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/members'), $photoName);
                $data['photo'] = 'uploads/members/' . $photoName;
            }
            
            Member::create($data);
            
            DB::commit();
            
            return redirect()->route('members.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data jemaat berhasil ditambahkan',
                'icon' => 'success'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
                'icon' => 'error'
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $member = Member::with([
                'family', 'father', 'mother', 'spouse', 'children',
                'ministries.ministry', 'offerings', 'attendances.event',
                'createdBy', 'updatedBy'
            ])->findOrFail($id);
            
            return view('members.show', compact('member'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat data jemaat: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $member = Member::findOrFail($id);
            $families = Family::all();
            $members = Member::where('id', '!=', $id)->select('id', 'name')->get();
            
            return view('members.edit', compact('member', 'families', 'members'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memuat form: ' . $e->getMessage(),
                'icon' => 'error'
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
            
            $member = Member::findOrFail($id);
            
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|unique:members,email,' . $id,
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'birth_date' => 'nullable|date',
                'birth_place' => 'nullable|string|max:255',
                'gender' => 'required|in:laki-laki,perempuan',
                'marital_status' => 'required|in:belum menikah,menikah,cerai,janda,duda',
                'occupation' => 'nullable|string|max:255',
                'education' => 'nullable|string|max:255',
                'baptism_date' => 'nullable|date',
                'baptism_place' => 'nullable|string|max:255',
                'sidi_date' => 'nullable|date',
                'sidi_place' => 'nullable|string|max:255',
                'marriage_date' => 'nullable|date',
                'marriage_place' => 'nullable|string|max:255',
                'status' => 'required|in:aktif,tidak aktif,pindah,meninggal',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'notes' => 'nullable|string',
                'father_id' => 'nullable|exists:members,id',
                'mother_id' => 'nullable|exists:members,id',
                'spouse_id' => 'nullable|exists:members,id',
                'family_id' => 'nullable|exists:families,id'
            ]);
            
            $data = $request->all();
            $data['updated_by'] = Auth::id();
            
            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo
                if ($member->photo && file_exists(public_path($member->photo))) {
                    unlink(public_path($member->photo));
                }
                
                $photo = $request->file('photo');
                $photoName = time() . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/members'), $photoName);
                $data['photo'] = 'uploads/members/' . $photoName;
            }
            
            $member->update($data);
            
            DB::commit();
            
            return redirect()->route('members.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data jemaat berhasil diperbarui',
                'icon' => 'success'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage(),
                'icon' => 'error'
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
            
            $member = Member::findOrFail($id);
            
            // Delete photo if exists
            if ($member->photo && file_exists(public_path($member->photo))) {
                unlink(public_path($member->photo));
            }
            
            $member->delete();
            
            DB::commit();
            
            return redirect()->route('members.index')->with('swal', [
                'title' => 'Berhasil',
                'text' => 'Data jemaat berhasil dihapus',
                'icon' => 'success'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('swal', [
                'title' => 'Error',
                'text' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }
}
