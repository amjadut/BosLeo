<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller 
{
	public function __construct() {
		$this->middleware('auth');
	}

	/*
     * @function checkAuthDetails
     * 
     * redirect if authenticated
     * 
     * @param - null
     * 
     * @author
     * 
     * Amjad Ali
     * 
     */

	public function checkAuthDetails() {
        if(Auth::check()) {

            return redirect('home');
        }
        else {

            return view('auth.login');
        }
    }

    /*
     * @function dashboard
     * 
     * show dashboard details
     * 
     * @param - null
     * 
     * 
     * @return 
     * view
     * 
     * @author
     * 
     * Amjad Ali
     * 
     */

	public function dashboard() {
		$availableRoles = DB::table('available_roles')
							->select('id','user_roles')
							->orderBy('user_roles','asc')
							->get();

		$experiences = DB::table('doctor_experiences')
						->select(DB::raw('doctor_experiences.id,available_roles.user_roles,CONCAT(start_year," - ",end_year) as duration,organisation_name'))
						->join('available_roles','doctor_experiences.role_id','=','available_roles.id')
						->where('doctor_id','=',Auth::user()->id)
						->orderBy('start_year','desc')
						->orderBy('end_year','desc')
						->get();

		$selectQuery = "";
		$availableDays = DB::table('available_days')
							->select('id','day_name')
							->orderBy('id','asc')
							->get();
		if ($availableDays) {
			foreach ($availableDays as $days) {
				$selectQuery .= ',(SELECT GROUP_CONCAT(CONCAT(clinic_timings.id," - ",clinic_timings.from_time," - ",clinic_timings.to_time)) FROM clinic_timings WHERE '.$days->id.'=clinic_timings.day_id AND clinic_timings.clinic_id=clinics.id) as '.$days->day_name;
			}
		}

		$clinics = DB::table('clinics')
					->select(DB::raw('id,clinic_name,clinic_email,clinic_phone'.$selectQuery))
					->where('doctor_id','=',Auth::user()->id)
					->orderBy('clinic_name','asc')
					->get();

		return view('home',compact('availableRoles','experiences','availableDays','clinics'));
	}

}