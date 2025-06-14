<?php

namespace App\Jobs;

use App\Models\Bill;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendInvoiceToCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Bill $bill;

    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }

    public function handle()
    {
        try {
            $pdf = Pdf::loadView('pdfs.invoice', ['bill' => $this->bill])
                ->setPaper('a4')
                ->setOption([
                    'isPhpEnabled' => true,
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'sans-serif',
                ]);

            $filename = $this->generateFilename();
            $customerEmail = $this->bill->reservation->customer->email;

            Mail::send('emails.invoice', ['bill' => $this->bill],
                function ($message) use ($customerEmail, $pdf, $filename) {
                    $message->to($customerEmail)
                        ->subject("Invoice #{$this->bill->invoice_number}")
                        ->attachData($pdf->output(), $filename, [
                            'mime' => 'application/pdf',
                        ]);
                }
            );

        } catch (Exception $e) {
            Log::error("Invoice generation failed for bill {$this->bill->id}: ".$e->getMessage());
            throw $e;
        }
    }

    protected function generateFilename(): string
    {
        return sprintf('invoice_%s_%s.pdf',
            $this->bill->reservation_id,
            now()->format('Ymd_His')
        );
    }
}
