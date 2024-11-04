<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Listar livros com paginação e busca
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        $books = $query->paginate(10);

        return response()->json($books);
    }

    // Criar novo livro
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_date' => 'nullable|date',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    // Visualizar um livro específico
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return response()->json($book);
    }

    // Atualizar um livro
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_date' => 'nullable|date',
        ]);

        $book->update($request->all());

        return response()->json($book);
    }

    // Deletar um livro
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}
