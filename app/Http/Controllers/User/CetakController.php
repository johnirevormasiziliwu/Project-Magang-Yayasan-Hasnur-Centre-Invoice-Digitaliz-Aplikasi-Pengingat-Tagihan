<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CetakController extends Controller
{
    public function downloadInvoice(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $dompdf = Pdf::loadView('user.cetak.download', compact('invoice'));


        $dompdf->render();

        // Instantiate canvas instance 
        $canvas = $dompdf->getCanvas();

        // Get height and width of page 
        $w = $canvas->get_width();
        $h = $canvas->get_height();

        // Specify watermark image 
        $imageURL = 'dist/assets/pdf/invoice.jpg';
        $imgWidth = 600;
        $imgHeight = 849;


        $canvas->page_script('
            
            $pdf->set_opacity(1, "Multiply");
            $pdf->image("dist/assets/pdf/invoice.jpg", 0, 0, 600, 849);

            $pdf->set_opacity(.5,"Multiply");
         
        ');


        // Set image opacity 
        //$canvas->set_opacity(.5, "Multiply");

        //$canvas->page_script('$pdf->set_opacity(.5, "Multiply");');

        // Specify horizontal and vertical position 
        //$x = (($w-$imgWidth)/2); 
        //$y = (($h-$imgHeight)/3); 

        // Add an image to the pdf 

        /** 
         * Add an image to the pdf. 
         * 
         * The image is placed at the specified x and y coordinates with the 
         * given width and height. 
         * 
         * @param string $img_url the path to the image 
         * @param float $x x position 
         * @param float $y y position 
         * @param int $w width (in pixels) 
         * @param int $h height (in pixels) 
         * @param string $resolution The resolution of the image 
         */
        //$canvas->image($imageURL, 0, 0, $imgWidth, $imgHeight,$resolution = "normal"); 
        $toDay = Carbon::now()->format('d-m-Y');
        return $dompdf->download('Tagihan invoice ' . $invoice->customer->name_unit . ' ' . $toDay . '.pdf');
    }
    public function printInvoice(string $id)
    {
        $invoice = Invoice::findOrFail($id);

        $dompdf = Pdf::loadView('user.cetak.donwload', compact('invoice'));


        $dompdf->render();

        // Instantiate canvas instance 
        $canvas = $dompdf->getCanvas();

        // Get height and width of page 
        $w = $canvas->get_width();
        $h = $canvas->get_height();

        // Specify watermark image 
        $imageURL = 'dist/assets/pdf/invoice.jpg';
        $imgWidth = 600;
        $imgHeight = 849;


        $canvas->page_script('
            
            $pdf->set_opacity(1, "Multiply");
            $pdf->image("dist/assets/pdf/invoice.jpg", 0, 0, 600, 849);

            $pdf->set_opacity(.5,"Multiply");
         
        ');


        // Set image opacity 
        //$canvas->set_opacity(.5, "Multiply");

        //$canvas->page_script('$pdf->set_opacity(.5, "Multiply");');

        // Specify horizontal and vertical position 
        //$x = (($w-$imgWidth)/2); 
        //$y = (($h-$imgHeight)/3); 

        // Add an image to the pdf 

        /** 
         * Add an image to the pdf. 
         * 
         * The image is placed at the specified x and y coordinates with the 
         * given width and height. 
         * 
         * @param string $img_url the path to the image 
         * @param float $x x position 
         * @param float $y y position 
         * @param int $w width (in pixels) 
         * @param int $h height (in pixels) 
         * @param string $resolution The resolution of the image 
         */
        //$canvas->image($imageURL, 0, 0, $imgWidth, $imgHeight,$resolution = "normal"); 
        $toDay = Carbon::now()->format('d-m-Y');
        return $dompdf->download('Tagihan invoice ' . $invoice->customer->name_unit . ' ' . $toDay . '.pdf');
    }

}
