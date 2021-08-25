<?php

namespace App\Exports;

use App\Models\PollKey;
use Maatwebsite\Excel\Concerns\FromCollection;

class PollKeysExport implements FromCollection
{

//    protected $poll_id;
//
//    function __construct($id) {
//        $this->poll_id = $id;
//    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PollKey::all();
//        return PollKey::where('poll_id', $this->poll_id)->get()([
//            'key'
//        ]);
    }
}
