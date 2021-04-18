<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TopicsTable extends LivewireDatatable
{
    protected $listeners = ['topicAdded'=>'columns'];

    // public $exportable = true;
    public $hideable = 'select';

    public function builder()
    {
        return Topic::query()->leftJoin('subjects', 'subjects.id', 'topics.subject_id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID'),
            Column::name('subjects.subject')->label('subject')->searchable(),
            Column::name('topic')->label('Topic')->searchable()->editable(),
            DateColumn::name('created_at')->label('Added On'),
            Column::delete()->label('Delete')->alignRight()           

        ];
    }
}