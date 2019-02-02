<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use URL;
use Auth;
use App\Clinics;
use App\ClinicTimings;
use Illuminate\Support\Facades\Validator;

class ClinicController extends Controller 
{
	public function __construct() {
		$this->middleware('auth');
	}

	/**
     * Get a validator for clinic addition request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'clinic_name' => 'required|string|max:255',
            'clinic_email' => 'required|string|email|max:30|unique:clinics',
            'clinic_phone' => 'required|regex:/^[0-9]+$/|min:10|max:13|unique:clinics',
            'clinic_bio' => 'required|string|max:800',
        ], [
        'clinic_name.required' => 'Clinic name is required',
        'clinic_email.required' => 'Email is required',
        'clinic_phone.required'  => 'Phone number is required',
        'clinic_bio.required' => 'Bio is required',
        ]);
    }

	public function addClinic(Request $request) {
		$validate = $this->validator($request->all());
		if ($validate->fails()) {
			$errorMessage = "";
			foreach (array_values($validate->messages()->toArray()) as $errorMsg) {
				$errorMessage .= implode('',$errorMsg).',';
			}

			return response()->json(['status' => 0, 'message' => rtrim($errorMessage,',')]);
		}

		Clinics::create([
			'doctor_id' => Auth::user()->id,
            'clinic_name' => $request->clinic_name,
            'clinic_email' => $request->clinic_email,
            'clinic_phone' => $request->clinic_phone,
            'clinic_bio' => $request->clinic_bio,
        ]);

        return response()->json(['status' => 1, 'message' => 'Clinic added successfully']);
	}

	public function addClinicTiming(Request $request) {
		Validator::make(array('day_id' => $request->timing_day_id,'from_time' => $request->from_time,'to_time' => $request->to_time),['day_id' => 'required','from_time' => 'required','to_time' => 'required'])->validate();

		$day_ids = $request->timing_day_id;
		if (count($day_ids)==0) {
			
			return redirect(URL::previous())->withErrors(['Day is required...!']);
		}
		$errorFlag = 0;
		$fromTime = date('H:i:s',strtotime($request->from_time.':00:00'));
		$toTime = date('H:i:s',strtotime($request->to_time.':00:00'));
		foreach ($day_ids as $days) {
			$checkAppointment = DB::table('clinic_timings')
									->join('clinics','clinic_timings.clinic_id','=','clinics.id')
									->where('doctor_id','=',Auth::user()->id)
									->where('day_id','=',$days)
									->where(function($query) use($fromTime,$toTime) {
										$query->where(function($subQuery) use($fromTime,$toTime) {
											$subQuery->where('from_time','>=',$fromTime);
											$subQuery->where('from_time','<=',$toTime);
										});
										$query->orWhere(function($subQuery) use($fromTime,$toTime) {
											$subQuery->where('to_time','>=',$fromTime);
											$subQuery->where('to_time','<=',$toTime);
										});
										$query->orWhere(function($subQuery) use($fromTime,$toTime) {
											$subQuery->where('from_time','>=',$fromTime);
											$subQuery->where('to_time','<=',$fromTime);
											$subQuery->where('from_time','>=',$toTime);
											$subQuery->where('to_time','<=',$toTime);
										});
										$query->orWhere(function($subQuery) use($fromTime,$toTime) {
											$subQuery->where('from_time','<=',$fromTime);
											$subQuery->where('to_time','>=',$fromTime);
											$subQuery->where('from_time','<=',$toTime);
											$subQuery->where('to_time','>=',$toTime);
										});
									})
									->count();
			if ($checkAppointment==0) {
				ClinicTimings::create([
		            'clinic_id' => $request->clinic_id,
		            'day_id' => $days,
		            'from_time' => $fromTime,
		            'to_time' => $toTime,
		        ]);
			}
			else {
				$errorFlag++;
			}
		}
		if ($errorFlag==0) {

			return redirect(URL::previous())->with('message','Timing added successfully...!');
		}
		else {
			if ($errorFlag==1) {
				$errorMessage = $errorFlag.' timing is ';
			}
			else {
				$errorMessage = $errorFlag.' timings are ';
			}
			$errorMessage .= 'in conflict with a clinic...!';

			return redirect(URL::previous())->withErrors([$errorMessage]);
		}
	}

	public function deleteClinicTimings($timing_id) {
		if (!$timing_id) {

			return redirect(URL::previous())->withErrors(['Could not delete timing...!']);
		}

		$deleteData = ClinicTimings::find($timing_id);
		if (!$deleteData) {
			
			return redirect(URL::previous())->withErrors(['Could not delete timing...!']);
		}
		$deleteData->delete();

		return redirect(URL::previous())->with('message','Timing deleted successfully...!');
	}

}