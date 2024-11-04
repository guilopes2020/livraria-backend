<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * Define os atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'description',
        'published_date'
    ];

    /**
     * Converte automaticamente os campos especificados em tipos nativos do PHP.
     *
     * @var array
     */
    protected $casts = [
        'published_date' => 'date',
    ];
}
