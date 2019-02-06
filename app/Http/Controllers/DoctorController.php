<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use URL;
use Auth;
use File;
use App\User;
use App\DoctorExperiences;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller 
{
	public function __construct() {
		$this->middleware('auth');
	}

	/**
     * Get a validator for doctor details udpate request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|string|email|max:30|unique:users,email,'.$data['doctor_id'],
            'phone' => 'required|regex:/^[0-9]+$/|min:10|max:13|unique:users,phone,'.$data['doctor_id'],
            'license_number' => 'required|string|max:30',
            // 'password' => 'required|string|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#!@$&]).{6,}+$/|min:6',
            'image' => 'sometimes|nullable|mimes:jpeg,jpg,png|max:2048',
        ], [
        'first_name.required' => 'First name is required',
        'last_name.required'  => 'Last name is required',
        'email.required' => 'Email is required',
        'phone.required'  => 'Phone number is required',
        'license_number.required' => 'License Number is required',
        // 'password.required' => 'Password is required',
        // 'password.regex' => 'Password should contain one capital and one small letter, one number, one special character(&#33;,&#64;,&#35;,&#36;,&amp;)',
        'image.mimes' => 'Image should be JPEG or JPG or PNG and size should be max 2MB',
        ]);
    }

    /*
     * @function updateDetails
     * 
     * update doctor details
     * 
     * @param - $request
     * 
     * 
     * @return 
     * array
     * 
     * @author
     * 
     * Amjad Ali
     * 
     */

	public function updateDetails(Request $request) {
		$this->validator($request->all())->validate();
		
		$file = $request->file('image');
		if ($file) {
			if (Auth::user()->image) {
				$filename = public_path('images/doctor_images').'/'.Auth::user()->image;
				if (File::exists($filename)) {
					File::delete($filename);
					User::where('id','=',$request->doctor_id)->update(['image' => NULL]);
				}
			}
			$imageName = strtotime(date('Y-m-d H:i:s')).'_'.$request->doctor_id.'.'.$file->getClientOriginalExtension();
			$file->move(public_path('images/doctor_images'), $imageName);
		}
		else {
			$imageName = NULL;
		}

		User::where('id','=',$request->doctor_id)->update(['first_name' => $request->first_name,'last_name' => $request->last_name,'email' => $request->email,'phone' => $request->phone,'license_number' => $request->license_number,'password' => bcrypt($request->password),'image' => $imageName]);

		return redirect(URL::previous())->with('message','Details updated successfully...!');
	}

	/*
     * @function updateDoctorBio
     * 
     * update doctor bio
     * 
     * @param - $request
     * 
     * 
     * @return 
     * array
     * 
     * @author
     * 
     * Amjad Ali
     * 
     */

	public function updateDoctorBio(Request $request) {
		Validator::make(array('doctor_bio' => $request->doctor_bio),['doctor_bio' => 'required|string|max:800'])->validate();

		User::where('id','=',$request->doctor_id)->update(['doctor_bio' => $request->doctor_bio]);

		return redirect(URL::previous())->with('message','Bio updated successfully...!');
	}

	/*
     * @function addDoctorExperience
     * 
     * add doctor experience
     * 
     * @param - $request
     * 
     * 
     * @return 
     * array
     * 
     * @author
     * 
     * Amjad Ali
     * 
     */

	public function addDoctorExperience(Request $request) {
		Validator::make(array('role_id' => $request->role_id,'start_year' => $request->start_year,'end_year' => $request->end_year,'organisation_name' => $request->organisation_name),['role_id' => 'required','start_year' => 'required','end_year' => 'required','organisation_name' => 'required|string|max:255'])->validate();

		DoctorExperiences::create([
            'doctor_id' => Auth::user()->id,
            'role_id' => $request->role_id,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'organisation_name' => $request->organisation_name,
        ]);

        return redirect(URL::previous())->with('message','Experience added successfully...!');
	}

	/*
     * @function deleteDoctorExperience
     * 
     * delete doctor experience
     * 
     * @param - $exp_id
     * 
     * 
     * @return 
     * array
     * 
     * @author
     * 
     * Amjad Ali
     * 
     */

	public function deleteDoctorExperience($exp_id) {
		if (!$exp_id) {

			return redirect(URL::previous())->withErrors(['Could not delete experience...!']);
		}

		$deleteData = DoctorExperiences::find($exp_id);
		if (!$deleteData) {
			
			return redirect(URL::previous())->withErrors(['Could not delete experience...!']);
		}
		$deleteData->delete();

		return redirect(URL::previous())->with('message','Experience deleted successfully...!');
	}

}