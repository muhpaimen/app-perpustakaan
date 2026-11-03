<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use function PHPUnit\Framework\returnArgument;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private array $members = [
        ['id' => 1, 'nama' => 'Siti Aminah', 'nim' => '2310501001', 'email' => 'siti.aminah@pens.ac.id', 'nomor_telepon' => '081234567890', 'status' => 'aktif'],
        ['id' => 2, 'nama' => 'Budi Santoso', 'nim' => '2310501002', 'email' => 'budi.santoso@pens.ac.id', 'nomor_telepon' => '081298765432', 'status' => 'aktif'],
        ['id' => 3, 'nama' => 'Dewi Lestari', 'nim' => '2310501003', 'email' => 'dewi.lestari@pens.ac.id', 'nomor_telepon' => '081211122233', 'status' => 'nonaktif'],
    ];
    public function index()
    {
        $members = Member::paginate(10);

        $members = Member::when(request('search'), fn ($query, $search) => $query->where('nama', 'like', "%{$search}%"))->paginate(10);

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        Member::create($validated);

        return redirect()->route('members.index')
        ->with('success', "Anggota \"{$validated['nama']}\" berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "MemberController@store, id: {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMemberRequest $request, string $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:100',
            'email' => 'required|unique:members,email',
            'nomor_telepon' => 'required|string|min:11',
            'alamat' => 'required|string',
            'status' => 'required|string|in:Aktif,Tidak Aktif'
        ]);

        $member->update($validated);
        return redirect()->route('members.index')
            ->with('success', "Kategori \"{$validated['nama']}\" berhasil diperbarui");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
