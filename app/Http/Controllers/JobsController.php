<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
use Smalot\PdfParser\Parser;


use Illuminate\Http\Request;

class JobsController extends Controller
{
    //
    public function available()
    {
        $user = request()->user();

        $alreadyApplied = DB::table('applications')
            ->where('resume_id', '=', $user->resume->id)
            ->pluck('job_id')->toArray();

        $jobs = Job::select()
            ->whereNotIn('id', $alreadyApplied)
            ->where('active', '=', 1)
            ->get();


        return view('jobsApplicant', ['jobs' => $jobs]);
    }

    public function apply(Job $job)
    {

        $user = request()->user();

        $app = new Application;
        $app->job_id = $job->id;
        $app->score = 0;
        $app->resume_id = $user->resume->id;
        $app->save();

        return back();
    }

    public function create()
    {
        request()->validate([
            'jobTitle' => 'required',
            'jobDescription' => 'required',
            'jobResponsibilities' => 'required',
            'jobQualifications' => 'required',
            'keywords' => 'required',
        ]);

        $job = new Job;
        $job->jobTitle = request('jobTitle');
        $job->jobDescription = request('jobDescription');
        $job->jobResponsibilities = request('jobResponsibilities');
        $job->jobQualifications = request('jobQualifications');
        $job->keywords = request('keywords');
        $job->save();
        return back();
    }

    public function edit(Job $job)
    {
        $job->jobTitle = request('jobTitle');
        $job->jobDescription = request('jobDescription');
        $job->jobResponsibilities = request('jobResponsibilities');
        $job->jobQualifications = request('jobQualifications');
        $job->keywords = request('keywords');
        $job->save();
        return back();
    }

    public function delete(Job $job)
    {
        $job->delete();
        return back();
    }

    public function close(Job $job)
    {
        $job->active = false;

        $applications = Application::where('job_id', $job->id)->get();
        foreach ($applications as $app) {
            if ($app->status != "Accepted") {
                $app->status = "Job is no longer available";
                $app->save();
            }
        }
        $job->save();
        return back();
    }

    public function applicants(Job $job)
    {
        $applications = Application::where('job_id', $job->id)->get()->sortByDesc('score');
        
        // dd($applications[0]->resume->user);
        return view('applicants', [
            'applications' => $applications,
            'job' => $job,
        ]);
    }

    public function rank(Job $job)
    {
        $applications = Application::where('job_id', $job->id)->get();

        foreach ($applications as $app) {
            $app->score = (JobsController::calculate_score($job->keywords, $app->resume->content));
            $app->save();
        }
        return back();
    }

    public function calculate_score($keywords, $content)
    {
        $score = 0;
        $keyArray = explode(",", $keywords);
        foreach ($keyArray as $keyword) {
            if (strpos($content, $keyword) != false) {
                $score += 1;
            }
        }
        return $score;
    }
}
