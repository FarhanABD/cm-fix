<?php

namespace App\DataTables;

use App\Models\Paket;
use App\Traits\HasFormatRupiah;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use function App\Helpers\formatRupiah;

class PaketDataTable extends DataTable
{
    use HasFormatRupiah;
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
            $deleteBtnSuperAdmin = '';
            $editBtnSuperAdmin = '';
            // Check if the user has the required role for editing
            if (Auth::user()->role == 'admin') { 
                $editBtnAdmin = "<a href='".route('admin.paket.edit',$query->id)."' class='btn btn-primary mb-2'><i class='fa-solid fa-pen-to-square'></i></a>";
            }
            // Check if the user has the required role for deleting
            if (Auth::user()->role === 'super-admin') { 
                $deleteBtnSuperAdmin = "<a href='".route('super-admin.paket.destroy',$query->id)."' class='btn btn-warning delete-item mb-2'><i class='fa-solid fa-trash'></i></a>";
                $editBtnSuperAdmin = "<a href='".route('super-admin.paket.editSuperAdmin',$query->id)."' class='btn btn-primary mb-2'>
                <i class='fa-solid fa-pen-to-square'></i></a>";
            }

            return "<div class='d-flex gap-2'>".$editBtnAdmin.$deleteBtnSuperAdmin.$editBtnSuperAdmin."</div>";
        })
        ->editColumn('harga', function ($query) {
            // Menggunakan formatRupiah dari trait
            return $query->formatRupiah('harga');
        })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Paket $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('paket-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0,'asc')
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

    
    public function getColumns(): array
{
    return [
        Column::make('id_paket')->width(150),
        Column::make('jenis_layanan')->width(300),
        Column::make('jenis_paket')->width(300),
        Column::make('kuota'),
        Column::make('harga') // Tidak perlu diubah di sini, sudah diformat di dataTable()
        ->title('harga paket'), // Menambahkan judul kolom
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
        return 'Paket_' . date('YmdHis');
    }
}