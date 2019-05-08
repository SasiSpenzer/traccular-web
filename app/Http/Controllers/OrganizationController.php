<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchType;
use App\Models\Division;
use App\Models\DivisionType;
use App\Models\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Traits\CaptureIpTrait;
use Config;
use Carbon\Carbon;

use Illuminate\Http\Response;

use Validator;

class OrganizationController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(){
        $userId = Auth::id();
        $branchObj = new Branch();
        $currentuser = User::find($userId)->toArray();

        $branches = $branchObj->getAllBranches($currentuser['organization_id']);

        return View('organization.show-branches', compact('branches'));

    }

    public function search(){

    }

    public function destroy($id){

        $branch_id = $id ;
        $branchObj = new Branch();
        $branchObj->deleteBranch($branch_id);

        return redirect('organization/branch')->with('success', trans('organization.deleteSuccess'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),
            [
                'branch_name'                  => 'required|max:255',
                'branch_code'            => 'required|max:50',
                'email'                 => 'required|email|max:255|unique:branch',
                'address'              => 'required|min:6',
                'branch_type' => 'required',
                'status'                  => 'required',
                'contact_number'                  => 'required',
            ],
            [

                'branch_name.required'       => trans('auth.branchnameRequired'),
                'branch_code.required' => trans('auth.branchCode'),
                'address.required'  => trans('auth.address'),
                'email.required'      => trans('auth.emailRequired'),
                'email.email'         => trans('auth.emailInvalid'),
                'branch_type.required'         => trans('auth.branch_type'),
                'contact_number.required'         => trans('auth.contact_number'),

            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $userId = Auth::id();
        $currentuser = User::find($userId)->toArray();
         if(!empty($currentuser['organization_id'])){
             $o_id = $currentuser['organization_id'];
         }

        $branch = [
            'branch_name'             => $request->input('branch_name'),
            'branch_code'       =>       $request->input('branch_code'),
            'email'        =>            $request->input('email'),
            'contact_number'            =>        $request->input('contact_number'),
            'address'            =>        $request->input('address'),
            'organization_id'        =>  $o_id,
            'status'            =>       $request->input('status'),
            'branch_type'         =>     $request->input('branch_type'),
            'created_at'         =>      Carbon::today()->toDateTimeString(),
            'updated_at'         =>      Carbon::today()->toDateTimeString(),
        ];

         $branchObj = new Branch();
         $branchObj->insertBranch($branch);

        return redirect('organization/branch')->with('success', trans('organization.createSuccess'));
    }

    public function create(){

        $types = BranchType::all();

        $data = [
            'types' => $types,

        ];

        return view('organization.create-branch')->with($data);
    }

    public function update(Request $request,$id){


        if ($request) {
            $validator = Validator::make($request->all(), [
                'branch_name'     => 'required|max:255|',
                'email'    => 'email|max:255|unique:branch',
                'branch_code' => 'required',
                'address' => 'required',
                'contact' => 'required',
                'status' => 'required',

            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }

        $dataArray = array();
        $dataArray['branch_name'] = $request->input('branch_name');
        $dataArray['branch_code'] = $request->input('branch_code');
        $dataArray['address'] = $request->input('address');
        $dataArray['contact_number'] = $request->input('contact');
        $dataArray['branch_type'] = $request->input('branch_type');
        $dataArray['status'] = $request->input('status');
        $where['id'] =$id;

        $brachObj = new Branch();
        $brachObj->updateBranch($dataArray,$where);


        return back()->with('success', trans('organization.updateSuccess'));
    }

    public function editBranch($id){

        $branch = Branch::findOrFail($id);

        $branch_types = BranchType::all();

        $currentType = $branch->branch_type;


        $data = [
            'branch'        => $branch,
            'types'       => $branch_types,
            'currentType' => $currentType,
        ];

        return view('organization.edit-branch')->with($data);

    }

    public function show($id){

        $branch = Branch::find($id);
        $userId = Auth::id();
        $user = User::find($userId);

        return view('organization.show_branch', compact('branch','user'));
    }

    public function branchType(){

        $branch_types = BranchType::paginate(config('organization.paginateListSize'));
        return view('organization.list-branch-types', compact('branch_types'));

    }

    public function branchTypeEdit($id){

        $branch_type = BranchType::findOrFail($id);

        return view('organization.edit-branch-type',compact('branch_type'));

    }

    public function branchTypeUpdate(Request $request,$id,$g =NULL){

        if ($request) {
            $validator = Validator::make($request->all(), [
                'branch_type'     => 'required|max:255|',
                'status' => 'required',

            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }

        $dataArray = array();
        $dataArray['branch_type'] = $request->input('branch_type');
        $dataArray['status'] = $request->input('status');
        $where['id'] =$id;

        $brachTypeObj = new BranchType();
        $brachTypeObj->updateBranchType($dataArray,$where);


        return back()->with('success', trans('organization.updateSuccess'));
    }

    public function branchTypeCreate(){

        return view('organization.create-branch-type');

    }

    public function branchTypeStore(Request $request){
        if ($request) {
            $validator = Validator::make($request->all(), [
                'branch_type'     => 'required|max:255|',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
        }

        $dataArray = array();
        $dataArray['branch_type'] = $request->input('branch_type');


        $brachTypeObj = new BranchType();
        $brachTypeObj->insertBranchType($dataArray);

        return redirect('branch-type')->with('success', trans('organization.createSuccessType'));

    }

    public function branchTypeDelete($id){

        $branch_type_id = $id ;
        $branchTypeObj = new BranchType();
        $branchTypeObj->deleteBranchType($branch_type_id);

        return redirect('branch-type')->with('success', trans('organization.deleteSuccessType'));
    }



    public function branchDivision(Request $request){

        if ($request->isMethod('GET')) {

            $divisions = Division::paginate(10);
            return view('organization.list-divisions', compact('divisions'));
        } else {
            $branch_code = $request->input('branchSelect');

            $branchDetails = Branch::where('branch_code', $branch_code)->get()->toArray();

            $branch_id = $branchDetails[0]['id'];
            $divisions = Division::where('branch_id',$branch_id)->get();
            return view('organization.list-divisions', compact('divisions'));

        }


    }

    public function branchDivisionSearch(){

    }

    public function branchDivisionCreate(){

        $userId = Auth::id();

        $currentuser = User::find($userId)->toArray();
        $divisionTypeObj = new DivisionType();
        $division_type = $divisionTypeObj->getAllDivisionTypesByOrgId($currentuser['organization_id']);

        return View('organization.create-division', compact('division_type'));

    }

    public function branchDivisionSave(Request $request){

        $validator = Validator::make($request->all(),
            [
                'branch_code'                  => 'required|max:255',
                'email'                 => 'required|email|max:255',
                'division_type' => 'required',
                'contact_number'                  => 'required',
                'status'                  => 'required',
                'division_code'                  => 'required',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $branch_code = $request->input('branch_code');
        $branchData = Branch::where('branch_code',$branch_code)->get()->toArray();

        if(!isset($branchData[0]['branch_code'])){

            $errors = new MessageBag();

            // adding my error message Spenzer:
            $errors->add('branch_code_invalid', 'Branch Code is Invalid !');
            return back()->withErrors($errors);
        }
        else{

            $dataArray = array();
            $dataArray['division_type'] = $request->input('division_type');
            $dataArray['division_code'] = $request->input('division_code');
            $dataArray['status'] = $request->input('status');
            $dataArray['contact_number'] = $request->input('contact_number');
            $dataArray['email'] = $request->input('email');
            $dataArray['branch_id'] = $branchData[0]['id'];
            $dataArray['created_at'] = Carbon::today()->toDateTimeString();
            $dataArray['updated_at'] = Carbon::today()->toDateTimeString();

            $divisionObj = new Division();
            $divisionObj->insertDivision($dataArray);
            return redirect('branch-division-create')->with('success', trans('organization.createSuccessDivi'));

        }






    }




}
