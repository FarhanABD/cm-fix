<?php

namespace App\DataTables;

use App\Models\Layanan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class LayananDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $editBtnAdmin = '';
                $deleteBtnAdmin = '';
                $editBtnSuperAdmin = '';
                $deleteBtnSuperAdmin = '';
                
    
                // Check if the user has the required role for editing
                if (Auth::user()->role == 'admin') { 
                    $editBtnAdmin = "<a href='".route('admin.layanan.edit',$query->id)."' class='btn btn-primary mb-2'><i class='fa-solid fa-pen-to-square'></i></a>";
                    // $deleteBtnAdmin = "<a href='".route('admin.layanan.destroy',$query->id)."' class='btn btn-danger delete-item mb-2'><i class='fa-solid fa-trash'></i></a>";
                }
    
                // Check if the user has the required role for deleting
                if (Auth::user()->role === 'super-admin') { 
                    $deleteBtnSuperAdmin = "<a href='".route('super-admin.layanan.destroy',$query->id)."' class='btn btn-danger delete-item mb-2'><i class='fa-solid fa-trash'></i></a>";
                    $editBtnSuperAdmin = "<a href='".route('super-admin.layanan.edit',$query->id)."' class='btn btn-primary mb-2'>
                    <i class='fa-solid fa-pen-to-square'></i></a>";
                }
    
                return $editBtnAdmin.$deleteBtnSuperAdmin.$editBtnSuperAdmin;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Layanan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('layanan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('jenis_layanan'),
            Column::make('jenis_paket'),
            Column::make('harga'),
            Column::make('kuota'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
          
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Layanan_' . date('YmdHis');
    }
}