<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Book;

use App\Http\Requests\StoreBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $books = Book::paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', "Buku \"{$validated['judul']}\" berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:'.date('Y'),
            'isbn' => 'nullable|string|max:20',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|integer',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', "Buku \"{$validated['judul']}\" berhasil diperbarui (data dummy, belum tersimpan ke database).");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
    
}
