<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dailyquestion;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DailyquestionsTable extends LivewireDatatable
{
    public $model = Dailyquestion::class;

    protected $listeners = ['mcqAdded'=>'columns'];
    // public $exportable = true;
    public $searchable = "mcq";
    public $hideable = 'select';

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID'),
            Column::name('mcq')->label('MCQ')->editable(),
            BooleanColumn::name('is_active')->label('Active Status(1: Active, 0:Inactive)')->editable(),
            DateColumn::name('created_at')->label('Added On'),
            Column::delete()->label('Delete')->alignRight()           

        ];
    }
}