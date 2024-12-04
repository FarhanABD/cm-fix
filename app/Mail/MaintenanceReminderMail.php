<?php
namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels; 

class MaintenanceReminderMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public $order;
    public $message;

    public function __construct(Order $order, $message = null)
    {
        $this->order = $order;
        $this->message = $message;
    }

    public function build()

    {
        return $this->subject('Maintenance Reminder for Order #'. $this->order->id_order)
                    ->view('admin.maintenance.reminder_form')([
                        'order' => $this->order,
                        'message' => $this->message,
                    ]);
                    // ->with([
                    //     'invoiceId' => $this->invoice->id_order,
                    //     // Tambahkan data lain yang diperlukan
                    // ]);
    }
}