<?php

namespace App\DataTables;

use App\Models\Perusahaan;
use App\Models\Pic;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
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

    return (new EloquentDataTable($query))
        ->addColumn('action', function($query) {
            $editBtn = '';
            $editBtnSuperAdmin = '';
            // $deleteBtnSuperAdmin = '';
            $viewBtn = '';
            $viewBtnSuperAdmin = '';

            // Check if the user has the required role for editing
            if (Auth::user()->role == 'admin') { 
                $editBtn = "<a href='".route('admin.perusahaan.edit',$query->id)."' class='btn btn-primary mb-2'>
                    <i class='fa-solid fa-pen-to-square'></i></a>";
                $viewBtn = "<a href='".route('admin.perusahaan.show',$query->id)."' class='btn btn-success mb-2'>
                   <i class='fa-regular fa-eye'></i>";
            }

            // Check if the user has the required role for deleting
            if (Auth::user()->role === 'super-admin') { 
                // $deleteBtnSuperAdmin = "<a href='".route('super-admin.perusahaan.destroy', $query->id)."' class='btn btn-danger btn-sm delete-item mb-2'><i class='fa-solid fa-trash'></i></a>";
                $editBtnSuperAdmin = "<a href='".route('super-admin.perusahaan.editSuperAdmin', $query->id)."' class='btn btn-primary btn-sm mb-2'><i class='fa-solid fa-pen-to-square'></i></a>";
                $viewBtnSuperAdmin = "<a href='".route('super-admin.perusahaan.showSuperAdmin', $query->id)."' class='btn btn-success btn-sm mb-2'><i class='fa-regular fa-eye'></i></a>";
                
            }

            return "<div class='d-flex gap-2'>".$editBtn.$editBtnSuperAdmin.$viewBtn.$viewBtnSuperAdmin."</div>";
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
        ->orderBy(0, 'asc')
        ->selectStyleSingle()
        ->buttons([
            Button::make('excel')->className('custom-export-button'),
            Button::make('csv')->className('custom-export-button'),
        ])
        ->parameters([
            'scrollX' => true,
        ]);
}

    public function getColumns(): array
    {
        return [
            
            Column::make('id')->width(6),
            Column::make('id_perusahaan')->width(10),
            Column::make('nama_perusahaan')->width(10)->addClass('word-wrap'),
            Column::make('kota')->width(10),
            Column::make('phone')->width(10),
            Column::make('email')->width(10)->addClass('word-wrap'),
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