<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{

    public function index()
    {
        $browsers = DB::table('visits')
            ->select('browser_info', DB::raw('count(*) as visits'), DB::raw('ROUND((count(*)/(SELECT count(*) FROM visits))*100, 2) as total'))
            ->groupBy('browser_info')
            ->get();

        $oss = DB::table('visits')
            ->select('os', DB::raw('count(*) as visits'), DB::raw('ROUND((count(*)/(SELECT count(*) FROM visits))*100, 2) as total'))
            ->groupBy('os')
            ->get();

        $countries = DB::table('visits')
            ->select('country', 'country_code', DB::raw('count(*) as visits'), DB::raw('ROUND((count(*)/(SELECT count(*) FROM visits))*100, 2) as total'))
            ->groupBy('country', 'country_code')
            ->get();





        $visit_info = [
            'browsers' => $browsers,
            'countries' => $countries,
            'oss' => $oss,
        ];

        return view('visits', compact('visit_info'));
    }

    public function saveUserInfo(Request $request)
    {
        $ipAddress = $request->ip();
        $pageUrl = $request->header('referer');

        $existingRecord = Visit::where('ip_address', $ipAddress)
            // ->where('page_url', $pageUrl) // enable it if check for each page
            ->first();

        if ($existingRecord) {
            // $existingRecord->visits += 1;
            // $existingRecord->data_usage += $request->input('data_usage');
            // $existingRecord->save();
            return response()->json(['message' => 'User info already saved. We Increment Visits By one']);
        }

        $visits = new Visit();
        $visits->ip_address = $ipAddress;
        $visits->page_url = $pageUrl;
        $visits->user_agent = $request->input('user_agent');
        $visits->browser_info = $this->getBrowserInfo(strtolower($request->input('browser_info')));
        $visits->country = strtolower($request->input('country'));
        $visits->os = $this->getOSInfo(strtolower($request->input('os')));
        $visits->country_code = strtolower($request->input('country_code'));
        $visits->data_usage = $request->input('data_usage');
        $visits->save();

        return response()->json(['message' => 'User info saved.']);
    }


    private function getBrowserInfo($browser_name)
    {
        switch ($browser_name) {
            case 'not_a brand':
            case 'not a;brand':
                return 'not a brand';
                break;

            case 'microsoft edge':
            case 'edge':
                return 'edge';
                break;

            case 'google chrome':
            case 'chromium':
                return 'chrome';
                break;

            case 'unknown':
                return 'unknown';
                break;

            default:
                if (strlen($browser_name) > 0)
                    return $browser_name;
                return 'unknown';
                break;
        }
    }


    private function getOSInfo($os_name)
    {
        switch ($os_name) {
            case 'windows':
                return 'windows';
                break;

            case 'macintosh':
                return 'mac';
                break;

            case 'linux':
                return 'linux';
                break;

            case 'ios':
                return 'ios';
                break;

            case 'android':
                return 'android';
                break;

            default:
                if (strlen($os_name) > 0)
                    return $os_name;
                return 'unknown';
                break;
        }
    }
}
