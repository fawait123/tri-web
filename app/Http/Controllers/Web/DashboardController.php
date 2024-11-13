<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BrushingTeeth;
use App\Models\Education;
use App\Models\Observable;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('dashboard/index', [
            'totalUser' => fn() => User::count(),
            'totalEducation' => fn() => Education::count(),
            'quiz' => fn() => $this->getListQuiz($request),
            'observable' => fn() => $this->getListObservable($request),
            'quizActivity' => fn() => Quiz::with('user')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->get(),
            'observableActivity' => fn() => Observable::with('user')->where('created_at', 'like', '%' . date('Y-m-d') . '%')->get(),
            'notifications' => fn() => $this->getNotification()
        ]);
    }

    public function getNotification()
    {
        return DB::table('users')->whereNotIn('id', function ($query) {
            $query->select('user_id')
                ->from('brushing_teeths')
                ->where('date', date('Y-m-d'));
        })
            ->get();
    }

    public function getListObservable(Request $request)
    {
        $limit = 10;
        $page = $request->observable_page ? $request->observable_page : 1;
        $query = Observable::query();
        $query->with('user');

        $query->orderBy('created_at', 'DESC');
        return $query->paginate($limit, ['*'], 'page', $page);
    }

    public function getListQuiz(Request $request)
    {
        $limit = 10;
        $page = $request->quiz_page ? $request->quiz_page : 1;
        $query = Quiz::query();
        $query->with('user');

        $query->orderBy('created_at', 'DESC');
        return $query->paginate($limit, ['*'], 'page', $page);
    }


    public function profile()
    {
        return Inertia::render('welcome/profile');
    }

    public function adminProfile()
    {
        return Inertia::render('dashboard/profile');
    }

    public function welcome()
    {
        return Inertia::render('welcome/index', []);
    }

    public function education()
    {
        return Inertia::render('welcome/education', [
            'educations' => Education::latest()->get()
        ]);
    }

    public function educationDetail($id)
    {
        return Inertia::render('welcome/educationDetail', [
            'education' => Education::where('id', $id)->first()
        ]);
    }

    public function brushingTeeth(Request $request)
    {
        return Inertia::render('welcome/brushingTeeth', [
            'data' => $this->getListBrushingTeeth($request)
        ]);
    }

    public function getListBrushingTeeth(Request $request)
    {
        $query = BrushingTeeth::query();

        if ($request->user()->role == "user") {
            $query->where('user_id', $request->user()->id);
        }

        return $query->get();
    }

    public function video()
    {
        return Inertia::render('welcome/video');
    }

    public function preTest(Request $request)
    {
        return Inertia::render('welcome/preTest', [
            'showQuiz' => fn() => Quiz::where('user_id', $request->user()->id)->where('type', 'pre-test')->count() == 0,
            'showObservableOne' => fn() => Observable::where('user_id', $request->user()->id)->where('type', 'pre-test')->where('number', 0)->count() == 0,
            'showObservableTwo' => fn() => Observable::where('user_id', $request->user()->id)->where('type', 'pre-test')->where('number', 1)->count() == 0,
            'quiz' => fn() => Quiz::where('user_id', $request->user()->id)->where('type', 'pre-test')->first(),
            'observableOne' => fn() => Observable::where('user_id', $request->user()->id)->where('type', 'pre-test')->where('number', 0)->first(),
            'observableTwo' => fn() => Observable::where('user_id', $request->user()->id)->where('type', 'pre-test')->where('number', 1)->first()
        ]);
    }

    public function postTest(Request $request)
    {
        return Inertia::render('welcome/postTest', [
            'showQuiz' => fn() => Quiz::where('user_id', $request->user()->id)->where('type', 'post-test')->count() == 0,
            'showObservableOne' => fn() => Observable::where('user_id', $request->user()->id)->where('type', 'post-test')->where('number', 0)->count() == 0,
            'showObservableTwo' => fn() => Observable::where('user_id', $request->user()->id)->where('type', 'post-test')->where('number', 1)->count() == 0,
            'quiz' => fn() => Quiz::where('user_id', $request->user()->id)->where('type', 'post-test')->first(),
            'observableOne' => fn() => Observable::where('user_id', $request->user()->id)->where('type', 'post-test')->where('number', 0)->first(),
            'observableTwo' => fn() => Observable::where('user_id', $request->user()->id)->where('type', 'post-test')->where('number', 1)->first()
        ]);
    }

    public function postPreTest(Request $request)
    {
        $score = collect($request->all())->where('correct', true)->count();
        $grade = $this->calculateGrade($score * 10);

        Quiz::create([
            'user_id' => $request->user()->id,
            'score' => $score * 10,
            'grade' => $grade,
            'type' => 'pre-test',
            'answer' => json_encode($request->all())
        ]);

        return redirect()->back();
    }


    public function postPostTest(Request $request)
    {
        $score = collect($request->all())->where('correct', true)->count();
        $grade = $this->calculateGrade($score * 10);

        Quiz::create([
            'user_id' => $request->user()->id,
            'score' => $score * 10,
            'grade' => $grade,
            'type' => 'post-test',
            'answer' => json_encode($request->all())
        ]);

        return redirect()->back();
    }

    public function postObservable(Request $request)
    {
        $s = collect($request->all())->where('value', 'S')->count();
        $ss = collect($request->all())->where('value', 'SS')->count();
        $ts = collect($request->all())->where('value', 'TS')->count();
        $sts = collect($request->all())->where('value', 'STS')->count();

        Observable::create([
            'user_id' => $request->user()->id,
            's' => $s,
            'ss' => $ss,
            'ts' => $ts,
            'sts' => $sts,
            'type' => 'pre-test',
            'number' => Observable::where('user_id', $request->user()->id)->where('type', 'pre-test')->count(),
            'answer' => json_encode($request->all())
        ]);

        return redirect()->back();
    }

    public function postObservablePostTest(Request $request)
    {
        $s = collect($request->all())->where('value', 'S')->count();
        $ss = collect($request->all())->where('value', 'SS')->count();
        $ts = collect($request->all())->where('value', 'TS')->count();
        $sts = collect($request->all())->where('value', 'STS')->count();

        Observable::create([
            'user_id' => $request->user()->id,
            's' => $s,
            'ss' => $ss,
            'ts' => $ts,
            'sts' => $sts,
            'type' => 'post-test',
            'number' => Observable::where('user_id', $request->user()->id)->where('type', 'post-test')->count(),
            'answer' => json_encode($request->all())
        ]);

        return redirect()->back();
    }

    private function calculateGrade($score)
    {
        if ($score >= 90 && $score <= 100) {
            return 'A';
        } elseif ($score >= 80 && $score < 90) {
            return 'B';
        } elseif ($score >= 70 && $score < 80) {
            return 'C';
        } elseif ($score >= 60 && $score < 70) {
            return 'D';
        } elseif ($score >= 0 && $score < 60) {
            return 'F';
        } else {
            return 'F'; // Untuk menangani nilai di luar rentang
        }
    }

    public function consultation()
    {
        return Inertia::render('welcome/consulation');
    }
}
