<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Designation;

class DesignationController extends Controller
{

    public function __construct()
    {
        // Share CSS and JS globally for this controller's views
        View::share('controllerCss', [
            asset('assets/css/select2.min.css'),
            asset('assets/css/bootstrap-datetimepicker.min.css'),
            asset('css/custom.css')
        ]);

        View::share('controllerJs', [
            asset('assets/js/select2.min.js'),
            asset('assets/js/moment.min.js'),
            asset('assets/js/bootstrap-datetimepicker.min.js'),
            asset('js/designation.js')
        ]);
    }
    public function designations()
    {
        $designations = Designation::orderBy('id', 'desc')->get();

        // Pass the data to the view
        return view('designations', compact('designations'));
    }

    public function postDesignation(Request $request)
    {
        $name = $request->input('name');
        $status = $request->input('status');
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
            // validation failed return with 422 status
        } else {

            if ($id == '') {
                $result = DB::table('designations')->insert([
                    'name' => $name,
                    'status' => $status,
                    'created_at' => now()
                ]);
                $message = "Added Successfully";
            } else {
                $result = DB::table('designations')
                    ->where('id', $id)
                    ->update([
                        'name' => $name,
                        'status' => $status,
                        'updated_at' => now()
                    ]);
                $message = "Updated Successfully";
            }

            if ($result) {
                $return = array("status" => true, 'message' => $message);
                exit(json_encode($return));
            } else {
                //return response()->json([["Something went wrong"]], 422);
                $return = array("status" => false, 'message' => 'Something went wrong');
                exit(json_encode($return));
            }
        }
    }
    public function getDesignationById($id)
    {

        $designation = DB::table('designations')->where('id', $id)->first();
        if ($designation) {
            return response()->json($designation);
        } else {
            return response()->json(['error' => 'Designation not found'], 404);
        }
    }

}
