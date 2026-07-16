<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Calculate dynamic KPI Card Metrics
        $totalInterviews = DB::table('interviews')->count();
        $completedInterviews = DB::table('interviews')->where('status', 'completed')->count();
        $completionRate = $totalInterviews > 0 ? round(($completedInterviews / $totalInterviews) * 100) . '%' : '0%';

        $stats = [
            'scheduled' => $totalInterviews,
            'completion_rate' => $completionRate,
            'no_show_rate' => '2%', 
            'feedback_time' => '4.2 hrs',
        ];

        // 2. Fetch all interviews and group them by day of the week
        $interviews = DB::table('interviews')
            ->join('candidates', 'interviews.candidate_id', '=', 'candidates.id')
            ->join('job_positions', 'interviews.job_position_id', '=', 'job_positions.id')
            ->join('interview_types', 'interviews.interview_type_id', '=', 'interview_types.id')
            ->select(
                'interviews.*',
                'candidates.name as candidate_name',
                'job_positions.title as position_title',
                'interview_types.stage_name',
                'interview_types.color_code'
            )
            ->get();

        $calendar = ['Mon' => [], 'Tue' => [], 'Wed' => [], 'Thu' => [], 'Fri' => []];

        foreach ($interviews as $interview) {
            $dayOfWeek = Carbon::parse($interview->start_at)->format('D'); 
            if (array_key_exists($dayOfWeek, $calendar)) {
                $calendar[$dayOfWeek][] = $interview;
            }
        }

        // 3. Fetch lookup lists
        $candidates = DB::table('candidates')->orderBy('name')->get();
        $positions = DB::table('job_positions')->get();
        $stages = DB::table('interview_types')->get();

        return view('dashboard', compact('stats', 'calendar', 'candidates', 'positions', 'stages'));
    }

    public function store(Request $request)
    {
        $candidateId = $request->candidate_id;

        // Inline Quick Add Candidate Logic
        if ($request->filled('new_candidate_name')) {
            $candidateId = DB::table('candidates')->insertGetId([
                'name' => $request->new_candidate_name,
                'email' => $request->new_candidate_email,
                'github_handle' => $request->new_candidate_github,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $start = Carbon::parse($request->date . ' ' . $request->time);
        
        DB::table('interviews')->insert([
            'candidate_id' => $candidateId,
            'job_position_id' => $request->job_position_id,
            'interview_type_id' => $request->interview_type_id,
            'start_at' => $start->toDateTimeString(),
            'end_at' => $start->addMinutes(45)->toDateTimeString(),
            'status' => 'scheduled',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Interview scheduled successfully!');
    }

    public function update(Request $request, $id)
    {
        $start = Carbon::parse($request->date . ' ' . $request->time);

        DB::table('interviews')
            ->where('id', $id)
            ->update([
                'candidate_id' => $request->candidate_id,
                'job_position_id' => $request->job_position_id,
                'interview_type_id' => $request->interview_type_id,
                'start_at' => $start->toDateTimeString(),
                'end_at' => $start->addMinutes(45)->toDateTimeString(),
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Interview updated successfully!');
    }
}