<?php

namespace App\DataTables;

use App\Models\Perusahaan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

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
    // Assuming you have a function to get the current user's role
    // $userRole = $this->getUserRole();

    return (new EloquentDataTable($query))
        ->addColumn('action', function($query) {
            $editBtn = '';
            $editBtnSuperAdmin = '';
            $deleteBtn = '';

            // Check if the user has the required role for editing
            if (Auth::user()->role == 'admin') { 
                $editBtn = "<a href='".route('admin.perusahaan.edit',$query->id)."' class='btn btn-primary mb-2'>
                    <i class='fa-solid fa-pen-to-square'></i></a>";
            }

            // Check if the user has the required role for deleting
            if (Auth::user()->role === 'super-admin') { 
                $deleteBtn = "<a href='".route('super-admin.perusahaan.destroy',$query->id)."' class='btn btn-danger delete-item mb-2'><i class='fa-solid fa-trash'></i></a>";
                $editBtnSuperAdmin = "<a href='".route('super-admin.perusahaan.edit',$query->id)."' class='btn btn-primary mb-2'>
                <i class='fa-solid fa-pen-to-square'></i></a>";
            }

            return $editBtn.$deleteBtn.$editBtnSuperAdmin;
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