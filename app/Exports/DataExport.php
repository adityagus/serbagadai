<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithProperties;

class DataExport implements FromView,WithProperties
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $properties;
    protected $data;
    public function __construct($data)
    {
        $this->properties = $data['properties'];
        $this->data = $data['data'];
    }

    public function properties(): array
    {
        return $this->properties;
    }

    public function view(): View
    {
        return view('backend.part.export', ['datas'=>$this->data['items'],'model'=>$this->data['model']]);
    }
}
