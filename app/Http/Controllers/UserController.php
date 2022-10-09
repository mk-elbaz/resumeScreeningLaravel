<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;


class UserController extends Controller
{


    public function create()
    {
        request()->validate([
            'targetJob' => 'required',
            'careerLevel' => 'required',
            'phoneNumber' => 'required',
            'country' => 'required',
            'about' => 'required',
        ]);

        $file = request('resumePdf');
        $pdfParser = new Parser();
        $pdf = $pdfParser->parseFile($file->path());
        // dd($pdf->getText());
        $user = request()->user();

        $content = strtolower($pdf->getText());
        $content = trim($content);
        $content = preg_replace('/[\x00-\x1F\x80-\xFF]/', ' ', $content);

        $user->resume()->create([
            'user_id' => request()->user()->id,
            'targetJob' => request('targetJob'),
            'careerLevel' => request('careerLevel'),
            'phoneNumber' => request('phoneNumber'),
            'country' => request('country'),
            'about' => request('about'),
            'content' => $content
        ]);
        $user->filled = true;
        $user->save();
        return back();
    }

    public function edit()
    {
        $resume = request()->user()->resume;
        $content = "";
        if (request()->has('resumePdf')) {
            $file = request('resumePdf');
            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($file->path());
            $content = $pdf->getText();
        }
        
        $content = strtolower($content);
        $content = trim($content);
        $content = preg_replace('/[\x00-\x1F\x80-\xFF]/', ' ', $content);
        // dd($string);
        request()->user()->name = request('fullName');
        $resume->targetJob = request('targetJob');
        $resume->careerLevel = request('careerLevel');
        $resume->phoneNumber = request('phoneNumber');
        $resume->about = request('about');
        $resume->content = $content;
        $resume->save();
        request()->user()->save();
        return back();
    }
}
