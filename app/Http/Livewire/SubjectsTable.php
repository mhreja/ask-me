<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subject;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SubjectsTable extends LivewireDatatable
{
    public $model = Subject::class;

    protected $listeners = ['subjectAdded'=>'columns'];
    public $exportable = true;
    public $searchable = "subject";
    public $hideable = 'select';

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID'),
            Column::name('subject')->label('subject')->editable(),
            DateColumn::name('created_at')->label('Added On'),
            Column::delete()->label('delete')->alignRight()           

        ];
    }
}