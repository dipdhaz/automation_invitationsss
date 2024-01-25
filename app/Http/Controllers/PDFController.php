<?php

namespace App\Http\Controllers;

// app/Http/Controllers/PDFController.php
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use setasign\Fpdi\Fpdi;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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

            $fpdi->SetFont("Times", "", 8);
            $fpdi->SetTextColor(0, 0, 0);
            //Kondisi

            //Kordinat Laki-Laki
            if ($user->jenis_kelamin == 'L') {

                // Add user information to the PDF
                // Add more text

                // kolom dtpln
                $fpdi->SetFont("Times", "",8);
                $left2 = 138;
                $top2 = 132.5;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);

                // Add more text
                $left2 = 138;
                $top2 = 279;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);
                 // kolom dtpln



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

                // Add user information to the PDF


                $left6 = 100;
                $top6 = 65;
                $text6 = $user->alamat;
                $fpdi->Text($left6, $top6, $text6);

                $left6 = 98;
                $top6 = 59;
                if ($user->metode_pemilihan_id == 1) {
                    $text6 = "TPS" ."  ". $user->metode_pemilihan;
                } else {
                    $text6 ="00" .$user->metode_pemilihan;
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

                $left6 = 98;
                $top6 = 206;
                if ($user->metode_pemilihan_id == 1) {
                    $text6 = "TPS" ."  ". $user->metode_pemilihan;
                } else {
                    $text6 ="00" .$user->metode_pemilihan;
                }
                $fpdi->Text($left6, $top6, $text6);

                $fpdi->SetFont("Times", "B", 8);
                $left8 = 123;
                $top8 = 29.5;
                $text8 = "/";
                $fpdi->Text($left8, $top8, $text8);

                $left8 = 119.5;
                $top8 = 177;
                $text8 = "/";
                $fpdi->Text($left8, $top8, $text8);


                $fpdi->SetFont("Times", "", 8);
                $left = 48;
                $top = 28.5;
                $text = $user->nama_lengkap; // Use the specific attribute of the user model
                $fpdi->Text($left, $top, $text);

                $left8 = 48;
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

                $left8 = 180;
                $top8 = 176.6;
                $text8 = $user->nomor_passpor;
                $fpdi->Text($left8, $top8, $text8);

                $left8 = 181;
                $top8 = 28.5;
                $text8 = $user->nomor_passpor;
                $fpdi->Text($left8, $top8, $text8);

                // Add more text
                $fpdi->SetFont("Times", "B", 8);
                $left2 = 46.3;
                $top2 = 15;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);

                // Add more text
                $left2 = 46.3;
                $top2 = 162.5;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);

                // $left2 = 200;
                // $top2 = 39;
                // $text2 = $user->nama_lengkap;
                // $fpdi->Text($left2, $top2, $text2);

                // khusus kolom cowok
                $left2 = 138;
                $top2 = 126.5;
                $text2 = $user->nama_lengkap;
                $fpdi->Text($left2, $top2, $text2);

                $left2 = 138;
                $top2 = 274.5;
                $text2 = $user->nama_lengkap;
                $fpdi->Text($left2, $top2, $text2);


                $left6 = 202;
                $top6 = 275;
                $text6 = "/";
                $fpdi->Text($left6, $top6, $text6);

                $left6 = 202;
                $top6 = 126.5;
                $text6 = "/";
                $fpdi->Text($left6, $top6, $text6);
                // khusus kolom cowok


            } else {
                //JIKA PEREMPUAN

                // Add user information to the PDF

                // Add more text

                $left6 = 140;
                $top6 = 274;
                $text6 = $user->nama_lengkap;
                $fpdi->Text($left6, $top6, $text6);

                $left6 = 140;
                $top6 = 280;
                $text6 = $user->no_dptln;
                $fpdi->Text($left6, $top6, $text6);

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

                $left6 = 98;
                $top6 = 59;
                if ($user->metode_pemilihan_id == 1) {
                    $text6 = "TPS" ."  ". $user->metode_pemilihan;
                } else {
                    $text6 ="00" .$user->metode_pemilihan;
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

                $left6 = 98;
                $top6 = 206;
                if ($user->metode_pemilihan_id == 1) {
                    $text6 = "TPS" ."  ". $user->metode_pemilihan;
                } else {
                    $text6 ="00" .$user->metode_pemilihan;
                }
                $fpdi->Text($left6, $top6, $text6);

                $fpdi->SetFont("Times", "B", 8);
                $left8 = 91;
                $top8 = 29.5;
                $text8 = "/";
                $fpdi->Text($left8, $top8, $text8);

                $left8 = 91;
                $top8 = 177.5;
                $text8 = "/";
                $fpdi->Text($left8, $top8, $text8);

                // khusus kolom

                $left = 198;
                $top = 128;
                $text = "/"; // Use the specific attribute of the user model
                $fpdi->Text($left, $top, $text);

                $left6 = 198;
                $top6 = 275;
                $text6 = "/";
                $fpdi->Text($left6, $top6, $text6);


                // khusus kolom
                $fpdi->SetFont("Times", "", 8);
                $left = 48;
                $top = 28.5;
                $text = $user->nama_lengkap; // Use the specific attribute of the user model
                $fpdi->Text($left, $top, $text);

                $left8 = 48;
                $top8 = 176;
                $text8 = $user->nama_lengkap;
                $fpdi->Text($left8, $top8, $text8);

                // ini khusus form di bawah
                $fpdi->SetFont("Times", "", 8);
                $left = 140;
                $top = 126.5;
                $text = $user->nama_lengkap; // Use the specific attribute of the user model
                $fpdi->Text($left, $top, $text);


                $fpdi->SetFont("Times", "", 8);
                $left = 140;
                $top = 133;
                $text = $user->no_dptln; // Use the specific attribute of the user model
                $fpdi->Text($left, $top, $text);

                $fpdi->SetFont("Times", "", 8);
                $left8 = 180;
                $top8 = 176.5;
                $text8 = $user->nomor_passpor;
                $fpdi->Text($left8, $top8, $text8);

                $left8 = 181;
                $top8 = 28.5;
                $text8 = $user->nomor_passpor;
                $fpdi->Text($left8, $top8, $text8);

                // Add more text
                $fpdi->SetFont("Times", "B", 8);
                $left2 = 45;
                $top2 = 15;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);

                // Add more text
                $left2 = 45;
                $top2 = 162.2;
                $text2 = $user->no_dptln;
                $fpdi->Text($left2, $top2, $text2);

                $fpdi->SetFont("Times", "", 8);
                $left6 = 125;
                $top6 = 39;
                $text6 = "FEBRUARI ";
                $fpdi->Text($left6, $top6, $text6);

                $left6 = 125;
                $top6 = 186;
                $text6 = "FEBRUARI ";
                $fpdi->Text($left6, $top6, $text6);
            }

            // $uniqueOutputPath = $outputFilePath . '_' . $user->nama_lengkap . '.pdf';
            // $fpdi->Output($uniqueOutputPath, 'F' );
            // Build a unique file name based on user attributes
        $uniqueOutputPath = "{$user->nama_lengkap}_{$i}.pdf";

        // Output the PDF content to the storage disk
        $fpdi->Output('F', storage_path("app/public/{$uniqueOutputPath}"));
        }

        // return response()->file($uniqueOutputPath);
        return response()->download(storage_path("app/public/{$uniqueOutputPath}"));
    }
}
