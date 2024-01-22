<?php

namespace App\Http\Controllers;

// app/Http/Controllers/PDFController.php
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use setasign\Fpdi\Fpdi;
use App\Models\User;

class PDFController extends Controller
{
    public function index(Request $request)
    {
        $timestamp = now()->timestamp;
        $filePath = public_path("invitation.pdf");
        $outputFilePath = public_path("_{$timestamp}.pdf");
        $user = User::first();

        $this->fillPDFFile($filePath, $outputFilePath, $user);

        return response()->file($outputFilePath);
    }

    public function fillPDFFile($file, $outputFilePath, User $user)
    {
        $fpdi = new Fpdi;

        $count = $fpdi->setSourceFile($file);

        $uniqueIdentifier = uniqid();

        for ($i = 1; $i <= $count; $i++) {
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);

            $fpdi->SetFont("Times", "", 10);
            $fpdi->SetTextColor(0, 0, 0);

            // Add user information to the PDF
            $left = 140;
            $top = 126;
            $text = $user->nama_lengkap; // Use the specific attribute of the user model
            $fpdi->Text($left, $top, $text);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));

            $uniqueOutputPath = $outputFilePath . '_' . $uniqueIdentifier . '_page_' . $i . '.pdf';
            $fpdi->Output($uniqueOutputPath, 'F');
        }

        // Combine all pages into a single PDF
        $this->mergePDFPages($outputFilePath, $uniqueIdentifier, $count);

        // Return a response with the merged PDF file
        return response()->file($outputFilePath);
    }

    private function mergePDFPages($outputFilePath, $uniqueIdentifier, $count)
    {
        $pdf = new Fpdi;

        for ($i = 1; $i <= $count; $i++) {
            $pagePath = $outputFilePath . '_' . $uniqueIdentifier . '_page_' . $i . '.pdf';
            $pdf->setSourceFile($pagePath);
            $template = $pdf->importPage(1);
            $size = $pdf->getTemplateSize($template);
            $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
            $pdf->useTemplate($template);
        }

        // Save the final merged PDF
        $pdf->Output($outputFilePath, 'F');

        // Clean up temporary page files
        for ($i = 1; $i <= $count; $i++) {
            $pagePath = $outputFilePath . '_' . $uniqueIdentifier . '_page_' . $i . '.pdf';
            unlink($pagePath);
        }
    }
}

