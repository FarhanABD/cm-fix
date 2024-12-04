<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use function App\Helpers\formatRupiah;

class OrderDataTable extends DataTable
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
            $editBtnSuperAdmin = '';
            $deleteBtnSuperAdmin = '';
            $viewBtn = '';
            $viewBtnSuperAdmin = '';
            
            if (Auth::user()->role == 'admin') { 
                $editBtnAdmin = "<a href='".route('admin.order.edit', $query->id)."' class='btn btn-primary btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>";
                $viewBtn = "<a href='".route('admin.order.show', urlencode($query->id_order))."' class='btn btn-success btn-sm'><i class='fa-regular fa-eye'></i></a>";
            }
            if (Auth::user()->role == 'super-admin') { 
                $deleteBtnSuperAdmin = "<a href='".route('super-admin.order.destroy', $query->id)."' class='btn btn-warning delete-item btn-sm'><i class='fa-solid fa-trash'></i></a>";
                $editBtnSuperAdmin = "<a href='".route('super-admin.paket.editSuperAdmin', $query->id)."' class='btn btn-primary btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>";
                $viewBtnSuperAdmin = "<a href='".route('super-admin.order.showSuperAdmin', urlencode($query->id_order))."' class='btn btn-success btn-sm'><i class='fa-regular fa-eye'></i></a>";
            }

            return "<div class='d-flex gap-2'>".$editBtnAdmin.$deleteBtnSuperAdmin.$editBtnSuperAdmin.$viewBtn.$viewBtnSuperAdmin."</div>";
        })
        ->addColumn('status', function($query){
            if($query->status == 1 ) {
                $button = '<div class="form-check form-switch mb-2">
                <input class="form-check-input change-status" type="checkbox" id="flexSwitchCheckChecked" data-id="'.$query->id.'" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">Paid</label>
            </div>';
            } else {
                $button = '<div class="form-check form-switch mb-2">
                <input class="form-check-input change-status" type="checkbox" data-id="'.$query->id.'" id="flexSwitchCheckChecked">
                <label class="form-check-label" for="flexSwitchCheckChecked">Unpaid</label>
            </div>';
            }
            return $button;
        })   
        ->rawColumns(['action','status'])
        ->editColumn('total', function ($query) {
            return $query->formatRupiah('total');
        })
        ->setRowId('id');
    }


    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery();
    }
    public function html(): HtmlBuilder
{
    return $this->builder()
                ->setTableId('order-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->responsive(true) // Menambahkan fitur responsif
                ->orderBy(0, 'asc')
                ->selectStyleSingle()
                ->buttons([
                    Button::make('excel'),
                    Button::make('csv'),
                    Button::make('pdf'),
                    Button::make('print'),
                    Button::make('reset'),
                    Button::make('reload'),
                ]);
}

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('id_order'),
            Column::make('total') // Tidak perlu diubah di sini, sudah diformat di dataTable()
                ->title('Total'),
            Column::make('status'), // Menambahkan judul kolom
            Column::make('tanggal_langganan'),
            Column::make('tanggal_habis'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }
    
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}