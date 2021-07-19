<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Video;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class VideosTable extends LivewireDatatable
{
    public $model = Video::class;

    protected $listeners = ['videoAdded'=>'columns'];
    // public $exportable = true;
    public $searchable = "title";
    public $hideable = 'select';

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID'),
            Column::name('title')->label('Ttile')->editable(),
            Column::name('video_link')->label('URL')->editable(),
            DateColumn::name('created_at')->label('Added On'),
            Column::delete()->label('Delete')->alignRight()           

        ];
    }
}