<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Housing;

class HousingService
{

    public function getHousings(array $filters)
    {
        $query = Housing::query();

        if (isset($filters['search']) && $search = $filters['search']) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%");
        }

        return $query->paginate();
    }

    public function createHousing(array $data): Housing
    {
        return Housing::create($data);
    }

    public function updateHousing(Housing $housing, array $data): Housing
    {
        $housing->update($data);
        return $housing;
    }

    public function deleteHousing(Housing $housing): void
    {
        $housing->delete();
    }
}
