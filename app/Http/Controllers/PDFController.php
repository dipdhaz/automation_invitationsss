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
        $timestamp = now()->format('Y-m-d_H-i-s');
        $filePath = public_path("invitation");
        $outputFilePath = public_path("_{$timestamp}");
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
            //Kondisi

            //Kordinat Laki-Laki
            if ($user->jenis_kelamin == 'L') {

                // Add user information to the PDF
                // Add more text
                $left2 = 113;
                $top2 = 49;
                $text2 = "08:00";
                $fpdi->Text($left2, $top2, $text2);


                $left3 = 167;
                $top3 = 49;
                $text3 = "MYT";
                $fpdi->Text($left3, $top3, $text3);


                $left3 = 138;
                $top3 = 49;
                $text3 = "18:00";
                $fpdi->Text($left3, $top3, $text3);

                // Add more text
                $left2 = 113;
                $top2 = 44;
                $text2 = "08:00";
                $fpdi->Text($left2, $top2, $text2);


                $left3 = 138;
                $top3 = 44;
                $text3 = "18:00";
                $fpdi->Text($left3, $top3, $text3);

                $left3 = 167;
                $top3 = 44;
                $text3 = "MYT";
                $fpdi->Text($left3, $top3, $text3);

                $left6 = 100;
                $top6 = 65;
                $text6 = $user->alamat;
                $fpdi->Text($left6, $top6, $text6);

                // $left6 = 100;
                // $top6 = 59;
                // $text6 = $user->tps;
                // $fpdi->Text($left6, $top6, $text6);


                // Add user information to the PDF


                $left6 = 100;
                $top6 = 65;
                $text6 = $user->alamat;
                $fpdi->Text($left6, $top6, $text6);

                $left6 = 105;
                $top6 = 59;
                if ($user->metode_pemilihan_id == 1) {
                    $text6 = "TPS" . $user->metode_pemilihan;
                } else {
                    $text6 = $user->metode_pemilihan;
                }


                $fpdi->Text($left6, $top6, $text6);

                $fpdi->Text($left6, $top6, $text6);


                $left7 = 140;
                $top7 = 39;
                $text7 = "2024";
                $fpdi->Text($left7, $top7, $text7);


                $left4 = 98;
                $top4 = 39;
                $text4 = "5-11";
                $fpdi->Text($left4, $top4, $text4);

                // Add more text
                $left2 = 113;
                $top2 = 191.5;
                $text2 = "08:00";
                $fpdi->Text($left2, $top2, $text2);


                $left3 = 167;
                $top3 = 196;
                $text3 = "MYT";
                $fpdi->Text($left3, $top3, $text3);


                $left3 = 138;
                $top3 = 196;
                $text3 = "18:00";
                $fpdi->Text($left3, $top3, $text3);

                // Add more text
                $left2 = 113;
                $top2 = 196;
                $text2 = "08:00";
                $fpdi->Text($left2, $top2, $text2);


                $left3 = 138;
                $top3 = 191.5;
                $text3 = "18:00";
                $fpdi->Text($left3, $top3, $text3);

                $left3 = 167;
                $top3 = 191.5;
                $text3 = "MYT";
                $fpdi->Text($left3, $top3, $text3);


                $left4 = 98;
                $top4 = 186;
                $text4 = "5-11";
                $fpdi->Text($left4, $top4, $text4);


                $left7 = 140;
                $top7 = 186;
                $text7 = "2024";
                $fpdi->Text($left7, $top7, $text7);



                $left6 = 100;
                $top6 = 212;
                $text6 = $user->alamat;
                $fpdi->Text($left6, $top6, $text6);

                $left6 = 100;
                $top6 = 206;

                if ($user->metode_pemilihan_id == 1) {
                    $text6 = "TPS" . $user->metode_pemilihan;
                } else {
                    $text6 = $user->metode_pemilihan;
                }

                $fpdi->Text($left6, $top6, $text6);


                $fpdi->SetFont("Times", "B", 12);
                $left8 = 77.5;
                $top8 = 29.5;
                $text8 = "/";
                $fpdi->Text($left8, $top8, $text8);

                $left8 = 77.5;
                $top8 = 177;
                $text8 = "/";
                $fpdi->Text($left8, $top8, $text8);

                $fpdi->SetFont("Times", "", 7);
                $left = 52;
                $top = 28.5;
                $text = $user->nama_lengkap; // Use the specific attribute of the user model
                $fpdi->Text($left, $top, $text);

                $left8 = 52;
                $top8 = 176;
                $text8 = $user->nama_lengkap;
                $fpdi->Text($left8, $top8, $text8);


                $left6 = 125;
                $top6 = 39;
                $text6 = "FEBRUARI ";
                $fpdi->Text($left6, $top6, $text6);



                $left6 = 125;
                $top6 = 186;
                $text6 = "FEBRUARI ";
                $fpdi->Text($left6, $top6, $text6);


                $left8 = 137.5;
                $top8 = 176;
                $text8 = $user->nomor_paspor;
                $fpdi->Text($left8, $top8, $text8);

                $left8 = 137.5;
                $top8 = 28.5;
                $text8 = $user->nomor_paspor;
                $fpdi->Text($left8, $top8, $text8);

                // Add more text
                $fpdi->SetFont("Times", "B", 10);
                $left2 = 45;
                $top2 = 15;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);

                // Add more text
                $left2 = 45;
                $top2 = 162.2;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);
            } else {
                //JIKA PEREMPUAN

                // Add user information to the PDF
                // Add more text
                $left2 = 113;
                $top2 = 49;
                $text2 = "08:00";
                $fpdi->Text($left2, $top2, $text2);


                $left3 = 167;
                $top3 = 49;
                $text3 = "MYT";
                $fpdi->Text($left3, $top3, $text3);


                $left3 = 138;
                $top3 = 49;
                $text3 = "18:00";
                $fpdi->Text($left3, $top3, $text3);

                // Add more text
                $left2 = 113;
                $top2 = 44;
                $text2 = "08:00";
                $fpdi->Text($left2, $top2, $text2);


                $left3 = 138;
                $top3 = 44;
                $text3 = "18:00";
                $fpdi->Text($left3, $top3, $text3);

                $left3 = 167;
                $top3 = 44;
                $text3 = "MYT";
                $fpdi->Text($left3, $top3, $text3);

                $left6 = 100;
                $top6 = 65;
                $text6 = $user->alamat;
                $fpdi->Text($left6, $top6, $text6);

                $left6 = 100;
                $top6 = 65;
                $text6 = $user->alamat;
                $fpdi->Text($left6, $top6, $text6);

                $left6 = 100;
                $top6 = 59;
                if ($user->metode_pemilihan_id == 1) {
                    $text6 = "TPS" . $user->metode_pemilihan;
                } else {
                    $text6 = $user->metode_pemilihan;
                }
                $fpdi->Text($left6, $top6, $text6);

                $left7 = 140;
                $top7 = 39;
                $text7 = "2024";
                $fpdi->Text($left7, $top7, $text7);


                $left4 = 98;
                $top4 = 39;
                $text4 = "5-11";
                $fpdi->Text($left4, $top4, $text4);

                // Add more text
                $left2 = 113;
                $top2 = 191.5;
                $text2 = "08:00";
                $fpdi->Text($left2, $top2, $text2);


                $left3 = 167;
                $top3 = 196;
                $text3 = "MYT";
                $fpdi->Text($left3, $top3, $text3);


                $left3 = 138;
                $top3 = 196;
                $text3 = "18:00";
                $fpdi->Text($left3, $top3, $text3);

                // Add more text
                $left2 = 113;
                $top2 = 196;
                $text2 = "08:00";
                $fpdi->Text($left2, $top2, $text2);


                $left3 = 138;
                $top3 = 191.5;
                $text3 = "18:00";
                $fpdi->Text($left3, $top3, $text3);

                $left3 = 167;
                $top3 = 191.5;
                $text3 = "MYT";
                $fpdi->Text($left3, $top3, $text3);


                $left4 = 98;
                $top4 = 186;
                $text4 = "5-11";
                $fpdi->Text($left4, $top4, $text4);


                $left7 = 140;
                $top7 = 186;
                $text7 = "2024";
                $fpdi->Text($left7, $top7, $text7);



                $left6 = 100;
                $top6 = 212;
                $text6 = $user->alamat;
                $fpdi->Text($left6, $top6, $text6);

                $left6 = 100;
                $top6 = 206;
                if ($user->metode_pemilihan_id == 1) {
                    $text6 = "TPS" . $user->metode_pemilihan;
                } else {
                    $text6 = $user->metode_pemilihan;
                }
                $fpdi->Text($left6, $top6, $text6);


                $fpdi->SetFont("Times", "B", 12);
                $left8 = 73;
                $top8 = 29.5;
                $text8 = "/";
                $fpdi->Text($left8, $top8, $text8);

                $left8 = 73;
                $top8 = 177;
                $text8 = "/";
                $fpdi->Text($left8, $top8, $text8);

                $fpdi->SetFont("Times", "", 7);
                $left = 52;
                $top = 28.5;
                $text = $user->nama_lengkap; // Use the specific attribute of the user model
                $fpdi->Text($left, $top, $text);

                $left8 = 52;
                $top8 = 176;
                $text8 = $user->nama_lengkap;
                $fpdi->Text($left8, $top8, $text8);


                $left6 = 125;
                $top6 = 39;
                $text6 = "FEBRUARI ";
                $fpdi->Text($left6, $top6, $text6);



                $left6 = 125;
                $top6 = 186;
                $text6 = "FEBRUARI ";
                $fpdi->Text($left6, $top6, $text6);


                $left8 = 137.5;
                $top8 = 176;
                $text8 = $user->nomor_paspor;
                $fpdi->Text($left8, $top8, $text8);

                $left8 = 137.5;
                $top8 = 28.5;
                $text8 = $user->nomor_paspor;
                $fpdi->Text($left8, $top8, $text8);

                // Add more text
                $fpdi->SetFont("Times", "B", 10);
                $left2 = 45;
                $top2 = 15;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);

                // Add more text
                $left2 = 45;
                $top2 = 162.2;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);
            }









            $uniqueOutputPath = $outputFilePath . '_' . $text . '.pdf';
            $fpdi->Output($uniqueOutputPath, 'F');
        }

        return response()->file($uniqueOutputPath);
    }
}
