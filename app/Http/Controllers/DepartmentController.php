<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;

class DepartmentController extends Controller
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
            asset('js/department.js')
        ]);
    }
    public function departments()
    {
        $departments = Department::orderBy('id', 'desc')->get();

        // Pass the data to the view
        return view('departments', compact('departments'));
    }

    public function postDepartment(Request $request)
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
                $result = DB::table('departments')->insert([
                    'name' => $name,
                    'status' => $status,
                    'created_at' => now()
                ]);
                $message = "Added Successfully";
            } else {
                $result = DB::table('departments')
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
    public function getDepartmentById($id)
    {

        $department = DB::table('departments')->where('id', $id)->first();
        if ($department) {
            return response()->json($department);
        } else {
            return response()->json(['error' => 'Department not found'], 404);
        }
    }
}
