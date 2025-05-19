<?php

namespace App\Observers;

use App\Models\Book;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function creating(Book $book): void
    {
        $book->user_id = auth()->id();
    }
}
