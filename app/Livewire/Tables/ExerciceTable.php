<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Exercice;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ExerciceTable extends DataTableComponent
{
    protected $model = Exercice::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('dashboard.exercices.edit', $row);
            });
    }

    public function filters(): array
    {
        $filters = [
            SelectFilter::make('Catégorie', 'category')
                ->options(
                    Exercice::categories_available()
                )
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('category', $value);
                }),
        ];

        return $filters;
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Autre noms", "other_names")
                ->hideIf(true)
                ->searchable(),
            ImageColumn::make('Image')
                ->location(
                    fn($row) => $row->images->first()->url
                )
                ->attributes(fn($row) => [
                    'class' => 'rounded-lg w-20 object-cover',
                    'alt' => $row->name . ' Avatar',
                ]),
            Column::make("Nom", "name")
                ->sortable()
                ->searchable()
                ->view('components.dashboard.table-cells.exercice-names'),
            Column::make("Categorie", "category")
                ->format(
                    fn($value, $row, Column $column) => __($value)
                ),
            Column::make("Dernière mise à jour", "updated_at")
                ->format(
                    fn($value, $row, Column $column) => isset($value) ? $value->format('d/m/Y') : null
                )
                ->sortable(),
        ];
    }
}
