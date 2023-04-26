<?php

namespace App\Observers;

use App\Models\Books;

class BookObserver
{
    /**
     * Handle the Books "created" event.
     */
    public function created(Books $books): void
    {
        //
    }

    /**
     * Handle the Books "updated" event.
     */
    public function updated(Books $books): void
    {
        //
    }

    /**
     * Handle the Books "deleted" event.
     */
    public function deleted(Books $books): void
    {
        //
    }

    /**
     * Handle the Books "restored" event.
     */
    public function restored(Books $books): void
    {
        //
    }

    /**
     * Handle the Books "force deleted" event.
     */
    public function forceDeleted(Books $books): void
    {
        //
    }

    public function saving(Books $book)
    {
        //dd($post);
        $book->slug = $book->createSlug($book->title);
    }
}
