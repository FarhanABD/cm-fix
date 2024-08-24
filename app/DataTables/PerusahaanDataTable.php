<?php

namespace App\DataTables;

use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PerusahaanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query){
            $editBtn = "<a href='".route('admin.perusahaan.edit',$query->id)."' class='btn btn-primary mb-2'>
            <i class='fa-solid fa-pen-to-square'></i></a>";
            $deleteBtn = "<a href='".route('admin.perusahaan.destroy',$query->id)."' class='btn btn-danger delete-item'><i class='fa-solid fa-trash'></i></a>";
           
            return $editBtn.$deleteBtn;
        })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * @param \App\Models\Perusahaan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Perusahaan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('perusahaan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            
            Column::make('id')->width(10),
            Column::make('email')->width(10)->addClass('word-wrap'),
            Column::make('nama_perusahaan')->width(10)->addClass('word-wrap'),
            Column::make('phone')->width(10),
            Column::make('alamat')->width(10),
            Column::make('nama_website')->width(10),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(10)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Perusahaan_' . date('YmdHis');
    }
}