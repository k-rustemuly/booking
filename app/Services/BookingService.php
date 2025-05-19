<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Book;
use App\Models\User;

class BookingService
{
    public function getBookings(User $user, array $filters)
    {
        $query = $user->books()->with('housing');

        if (!empty($filters['search'])) {
            $query->whereHas('housing', function ($q) use ($filters) {
                $q->where('address', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['check_in_from'])) {
            $query->whereDate('check_in', '>=', $filters['check_in_from']);
        }

        if (!empty($filters['check_in_to'])) {
            $query->whereDate('check_in', '<=', $filters['check_in_to']);
        }

        if (!empty($filters['check_out_from'])) {
            $query->whereDate('check_out', '>=', $filters['check_out_from']);
        }

        if (!empty($filters['check_out_to'])) {
            $query->whereDate('check_out', '<=', $filters['check_out_to']);
        }

        if (!empty($filters['sort_by']) && in_array($filters['sort_by'], ['check_in', 'check_out', 'created_at'])) {
            $sortDir = $filters['sort_dir'] ?? 'desc';
            $query->orderBy($filters['sort_by'], $sortDir);
        }

        return $query->paginate();
    }

    public function createBooking(array $data)
    {
        return Book::create($data);
    }
}
