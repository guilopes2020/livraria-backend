<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Executa o seeder.
     *
     * @return void
     */
    public function run()
    {
        // Dados de exemplo
        $books = [
            [
                'title'          => 'Dom Quixote',
                'author'         => 'Miguel de Cervantes',
                'description'    => 'Uma obra clássica da literatura espanhola.',
                'published_date' => '1605-01-16',
            ],
            [
                'title'          => '1984',
                'author'         => 'George Orwell',
                'description'    => 'Uma visão sombria do futuro sob um regime totalitário.',
                'published_date' => '1949-06-08',
            ],
            [
                'title'          => 'A Divina Comédia',
                'author'         => 'Dante Alighieri',
                'description'    => 'Uma viagem épica pelos reinos do inferno, purgatório e paraíso.',
                'published_date' => '1320-01-01',
            ],
            [
                'title'          => 'O Morro dos Ventos Uivantes',
                'author'         => 'Emily Brontë',
                'description'    => 'Uma história de paixão e vingança.',
                'published_date' => '1847-12-01',
            ],
            [
                'title'          => 'Cem Anos de Solidão',
                'author'         => 'Gabriel Garcia Márquez',
                'description'    => 'A saga da família Buendía na cidade fictícia de Macondo.',
                'published_date' => '1967-05-30',
            ],
        ];

        // Inserindo os dados na tabela `books`
        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
