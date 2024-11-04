<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o endpoint de criação de um novo livro.
     *
     * @return void
     */
    public function test_can_create_book()
    {
        $data = [
            'title'          => 'O Senhor dos Anéis',
            'author'         => 'J.R.R. Tolkien',
            'description'    => 'Uma aventura épica na Terra Média.',
            'published_date' => '1954-07-29',
        ];

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'O Senhor dos Anéis']);
        $this->assertDatabaseHas('books', $data);
    }

    /**
     * Testa o endpoint de listagem de livros.
     *
     * @return void
     */
    public function test_can_list_books()
    {
        Book::factory()->count(3)->create();

        $response = $this->getJson('/api/books');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'title', 'author', 'description', 'published_date']
                     ]
                 ]);
    }

    /**
     * Testa o endpoint de visualização de um livro específico.
     *
     * @return void
     */
    public function test_can_show_book()
    {
        $book = Book::factory()->create();

        $response = $this->getJson("/api/books/{$book->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => $book->title]);
    }

    /**
     * Testa o endpoint de atualização de um livro.
     *
     * @return void
     */
    public function test_can_update_book()
    {
        $book = Book::factory()->create();

        $data = [
            'title'          => 'O Hobbit',
            'author'         => 'J.R.R. Tolkien',
            'description'    => 'Uma história anterior a O Senhor dos Anéis.',
            'published_date' => '1937-09-21',
        ];

        $response = $this->putJson("/api/books/{$book->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'O Hobbit']);
        $this->assertDatabaseHas('books', $data);
    }

    /**
     * Testa o endpoint de exclusão de um livro.
     *
     * @return void
     */
    public function test_can_delete_book()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
