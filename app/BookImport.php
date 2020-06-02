<?php

namespace App;

use App\Book;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BookImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $rows)
    {
       $i = 0;
        foreach ($rows as $row) 
        {
            if($i != 0)
            {
                $book = new Book([
                    'name' => $row['0'],
                            'bookshelves' => (int)$row['1'],
                            'author' => $row['2'],
                            'total' => (int)$row['3'],
                            'description' => $row['4'],
                            'active' => $row['5'],
                ]);
                $book->save();
            }
            $i++;
        }  
       
    }
}