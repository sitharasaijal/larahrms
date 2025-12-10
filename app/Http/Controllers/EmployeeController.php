<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Employees;


class EmployeeController extends Controller
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
            asset('js/employees.js')
        ]);
    }

    public function employees()
    {
        return view('employees');
    }

    public function getEmployeesData(Request $request)
    {
        $formdata = $request->input('formdata');

        // Start query
        $query = Employees::query()->where('archive', 0);

        // Apply form filters
        if (!empty($formdata)) {
            if (!empty($formdata['username'])) {
                $query->where('username', 'like', '%' . $formdata['username'] . '%');
            }

            if (!empty($formdata['name'])) {
                $name = strtolower($formdata['name']);
                $query->where(function ($q) use ($name) {
                    $q->whereRaw('LOWER(firstname) LIKE ?', ["%{$name}%"])
                        ->orWhereRaw('LOWER(lastname) LIKE ?', ["%{$name}%"]);
                });
            }

            if (!empty($formdata['designation'])) {
                $query->where('designation', $formdata['designation']);
            }

            if (!empty($formdata['department'])) {
                $query->where('department', $formdata['department']);
            }

            if (isset($formdata['status']) && $formdata['status'] !== '') {
                $query->where('status', $formdata['status']);
            }
        }

        // Global search
        if ($searchValue = $request->input('search.value')) {
            $searchValue = strtolower($searchValue);
            $query->where(function ($q) use ($searchValue) {
                $q->whereRaw('LOWER(firstname) LIKE ?', ["%{$searchValue}%"])
                    ->orWhereRaw('LOWER(lastname) LIKE ?', ["%{$searchValue}%"])
                    ->orWhere('username', 'like', "%{$searchValue}%");
            });
        }

        // Total records for DataTables
        $totalData = $query->count();

        // Pagination & ordering
        $employees = $query->offset($request->input('start', 0))
            ->limit($request->input('length', 10))
            ->orderBy('id', 'desc')
            ->get();

        // Prepare data for DataTables
        $data = [];
        $sl = $request->input('start', 0) + 1;

        foreach ($employees as $employee) {
            $path = $employee->image ? asset('files/employees/' . $employee->image) : asset('images/default-image.jpg');
            $empName = $employee->firstname . ' ' . $employee->lastname;
            $designationName = ''; // Add relation if needed
            $departmentName = ''; // Add relation if needed
            $statusClass = $employee->status == 0 ? 'text-success' : 'text-danger';
            $status = $employee->status == 1 ? 'Inactive' : 'Active';


            $data[] = [
                'slno' => $sl,
                'full_name' => '<h2 class="table-avatar">
                        <a href="" class="avatar"><img alt="" src="' . $path . '"></a>
                        <a href="">' . $empName . ' <span>' . $designationName . '</span></a>
                    </h2>',
                'employee_id' => $employee->username,
                'email' => $employee->email,
                'phone' => $employee->phone,
                'department' => $departmentName,
                'designation' => $designationName,
                'status' => '<div class="dropdown action-label">
                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fa fa-dot-circle-o ' . $statusClass . '"></i> ' . $status . '
                    </a>
                </div>',
                'actions' => '<div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href=""><i class="fa fa-pencil m-r-5"></i> Edit</a>
                    <a class="dropdown-item" href=""><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
            </div>',
            ];


            $sl++;
        }

        return response()->json([
            'draw' => (int) $request->input('draw', 1),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data
        ]);
    }



}
