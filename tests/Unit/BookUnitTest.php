<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se é possível criar um livro com os atributos corretos.
     *
     * @return void
     */
    public function test_create_book_with_correct_attributes()
    {
        $book = Book::factory()->create([
            'title'          => 'Test Book Title',
            'author'         => 'Test Author',
            'description'    => 'Test Description',
            'published_date' => '2023-10-15',
        ]);

        $this->assertEquals('Test Book Title', $book->title);
        $this->assertEquals('Test Author', $book->author);
        $this->assertEquals('Test Description', $book->description);
        $this->assertEquals('2023-10-15', $book->published_date->toDateString());
    }

    /**
     * Testa a funcionalidade de conversão do atributo de data.
     *
     * @return void
     */
    public function test_published_date_is_cast_to_date()
    {
        $book = Book::factory()->create([
            'published_date' => '2023-10-15',
        ]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $book->published_date);
        $this->assertEquals('2023-10-15', $book->published_date->toDateString());
    }

    /**
     * Testa se o título do livro é obrigatório.
     *
     * @return void
     */
    public function test_book_title_is_required()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Book::factory()->create([
            'title' => null,
        ]);
    }

    /**
     * Testa a atualização de um livro.
     *
     * @return void
     */
    public function test_update_book_attributes()
    {
        $book = Book::factory()->create();

        $book->update([
            'title'       => 'Updated Title',
            'author'      => 'Updated Author',
            'description' => 'Updated Description',
        ]);

        $this->assertEquals('Updated Title', $book->title);
        $this->assertEquals('Updated Author', $book->author);
        $this->assertEquals('Updated Description', $book->description);
    }

    /**
     * Testa a exclusão de um livro.
     *
     * @return void
     */
    public function test_delete_book()
    {
        $book = Book::factory()->create();
        $bookId = $book->id;

        $book->delete();

        $this->assertDatabaseMissing('books', ['id' => $bookId]);
    }
}
