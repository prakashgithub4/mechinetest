<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            "name"=>$row['name'],
            "phone"=>$row['phone'],
            "email"=>$row["email"],
            "password"=>\Hash::make($row['password']),
            "status"=>'1',
        ]);
    }
}
