<?php

namespace App\Http\Controllers;

use App\DataTables\CompanyDetailsDataTable;
use App\Models\CompanyDetail;
use App\Models\CountryInformation;
use App\Notifications\PaymentCancelled;
use App\Notifications\SanctionRequestCancel;
use App\Notifications\TransactionEmail;
use App\Notifications\SendAttachment;
use App\Models\SancImages;
use App\User;
use App\Utils\EmailStatus;
use App\Utils\SanctionRequestStatus;
use App\Utils\UserStatus;
use App\Utils\UserType;
use Carbon\Carbon;
use Faker\Provider\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Psy\Util\Str;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Button;
use function Symfony\Component\String\u;
use function Symfony\Component\Translation\t;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('login');
    }

    // public function customerHistory(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = DB::table('users')
    //             ->where('type', '<>', UserType::ADMIN)
    //             ->orderBy('id', 'desc')
    //             ->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->editColumn('status', function ($data) {
    //                 if ($data->status == UserStatus::ACTIVE) {
    //                     return '<div class="badge badge-success" fw-bolder">' . $data->status . '</div>';
    //                 } else {
    //                     return '<div class="badge badge-danger" fw-bolder">' . $data->status . '</div>';
    //                 }
    //             })
    //             ->editColumn('email_verified_at', function ($data) {
    //                 if (isset($data->email_verified_at)) {
    //                     return '<div class="badge badge-success" fw-bolder">' . EmailStatus::Verified . '</div>';
    //                 } else {
    //                     return '<div class="badge badge-danger" fw-bolder">' . EmailStatus::Unverified . '</div>';
    //                 }
    //             })
    //             ->addColumn('action', function ($data) {
    //                 $btn = '<a href="' . route("customers.edit", encrypt($data->id)) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
    //                         <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
    //                         <span class="svg-icon svg-icon-3">
    //                             <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    //                                 <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
    //                                 <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
    //                             </svg>
    //                         </span>
    //                         <!--end::Svg Icon-->
    //                         </a>
    //                         <form method="POST" id="form_' . $data->id . '" action="' . route('customers.delete', encrypt($data->id)) . '">
    //                         ' . method_field('Delete') . csrf_field() . '
    //                         <button type="submit" value="' . $data->id . '" class="deleteBtn btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
    //                                 <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
    //                                 <span class="svg-icon svg-icon-3">
    //                                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    //                                                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    //                                                         <rect x="0" y="0" width="24" height="24" />
    //                                                         <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
    //                                                         <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
    //                                                     </g>
    //                                                 </svg>
    //                                             </span>
    //                                 <!--end::Svg Icon-->
    //                             </button>
    //                         </form>';
    //                 return $btn;
    //             })
    //             ->rawColumns(['action', 'status', 'email_verified_at'])
    //             ->make(true);
    //     }

    //     return view('customers.index');
    // }

    // public function customerEdit($id)
    // {
    //     $user = User::where('id', decrypt($id))->first();
    //     return view('customers.edit', compact('user'));
    // }

    // public function customerDelete($id)
    // {
    //     try {
    //         User::where('id', decrypt($id))->first()->delete();
    //         toastr()->success('Customer Deleted Successfully!');
    //         return redirect()->route('customers.history');
    //     } catch (\Exception $exception) {
    //         return redirect()->route('customers.history')->with('danger', 'Something went wrong');
    //     }
    // }

    // public function customerSave(Request $request)
    // {
    //     $request->validate([
    //         'address' => ['required', 'max:255'],
    //         'status' => ['required', 'max:255'],
    //         'company_name' => ['required', 'max:255'],
    //         'office_number' => ['required', 'max:255'],
    //         'mobile_number' => ['required', 'string', 'max:255'],
    //         'country_id' => ['required', 'max:255'],
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users',],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ], [
    //         'country_id.required' => 'The country field is required',
    //         'status.required' => 'The account status field is required',
    //     ]);
    //     try {
    //         $request['password'] = Hash::make($request['password']);
    //         $request['unique_id'] = uniqid(time());
    //         User::create($request->except('_token'));
    //         toastSuccess('Customer Added Successfully!');
    //         return redirect()->route('customers.history');
    //     } catch (\Exception $exception) {
    //         toastr()->error('error', 'Something went wrong!');
    //         return redirect()->route('customers.history');
    //     }
    // }

    // public function customerUpdate(Request $request, $id)
    // {
    //     $decrypt_id = decrypt($id);
    //     $request->validate([
    //         'address' => ['required', 'max:255'],
    //         'status' => ['required', 'max:255'],
    //         'company_name' => ['required', 'max:255'],
    //         'office_number' => ['required', 'max:255'],
    //         'mobile_number' => ['required', 'string', 'max:255'],
    //         'country_id' => ['required', 'max:255'],
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($decrypt_id)],
    //         'vat_number' => ['nullable', 'numeric'],
    //     ], [
    //         'country_id.required' => 'The country field is required',
    //         'status.required' => 'The account status field is required',
    //     ]);
    //     if (isset($request->password)) {
    //         $request->validate([
    //             'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         ]);
    //         unset($request['password_confirmation'], $request['_token']);
    //         $request['password'] = Hash::make($request['password']);
    //         User::where('id', decrypt($id))->update($request->all());
    //     } else {
    //         unset($request['password'], $request['password_confirmation'], $request['_token']);
    //         User::where('id', decrypt($id))->update($request->all());
    //     }
    //     toastr()->success('Customer Updated Successfully!');
    //     return redirect()->route('customers.history');
    // }

    // public function countriesIndex(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = DB::table('country_information')
    //             ->orderby('country_name', 'asc')
    //             ->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->editColumn('rate_in_dollar', function ($data) {
    //                 return '</td><form style="display: flex;" action="' . route('countries.update', $data->id) . '" method="post" >
    //                 ' . csrf_field() . '
    //                     <td><input required class="form-control" name="rate_in_dollar" value="' . $data->rate_in_dollar . '" type="text"></td>
    //                     <td><button class="btn btn-success" style="margin-left: 10px;" type="submit">Save</button></td>
    //                 </form>';
    //             })
    //             ->addColumn('dollar_rate', function ($data) {
    //                 return '<td style="display: none" class="dollar_rate">' . $data->rate_in_dollar . '</td>';
    //             })
    //             ->rawColumns(['dollar_rate', 'rate_in_dollar'])
    //             ->make(true);
    //     }
    //     return view('countries.history');
    // }

    // public function countriesUpdate(Request $request, $id)
    // {
    //     try {
    //         DB::table('country_information')
    //             ->where('id', $id)
    //             ->update($request->except('_token'));
    //         toastr()->success('Dollar Rate Updated Successfully!');
    //         return redirect()->route('countries.index');
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong!');
    //         return back();
    //     }
    // }

    // public function countriesEdit()
    // {
    //     return view('countries.edit');
    // }

    // public function indexWithDatatable(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = CompanyDetail::with(['company_accounting' => function ($company_accounting) {
    //             $company_accounting->select(
    //                 "id",
    //                 "currency",
    //                 "financial_strength_rating",
    //                 "gross_written_premium",
    //                 "gross_written_premium_year",
    //                 "issue_credit_rating",
    //                 "moody_rating",
    //                 "other_rating",
    //                 "public_listed_company",
    //                 "regulatory_authority",
    //                 "s_andprating",
    //                 "company_id"
    //             );
    //         }, 'market_share' => function ($marked_share) {
    //             $marked_share->select(
    //                 "id",
    //                 "authorized_shares",
    //                 "issued_shares",
    //                 "no_of_shares",
    //                 "paid_up_shares",
    //                 "total_share",
    //                 "company_id"
    //             )->with(['shareholders' => function ($shareholder) {
    //                 $shareholder->select(
    //                     "id",
    //                     "name",
    //                     "share_percentage",
    //                     "market_share_id"
    //                 );
    //             }]);
    //         }, 'board_of_directors' => function ($bod) {
    //             $bod->select('id', 'company_id', 'name', 'designation');
    //         }])
    //             ->orderBy('company_name', 'asc')
    //             ->get();

    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->editColumn('status', function ($data) {
    //                 if ($data->status == UserStatus::ACTIVE) {
    //                     return '<div class="badge badge-success" fw-bolder">' . $data->status . '</div>';
    //                 } else {
    //                     return '<div class="badge badge-danger" fw-bolder">' . $data->status . '</div>';
    //                 }
    //             })
    //             //                ->editColumn('board_of_directors',function ($data){
    //             //                    $result = '';
    //             //                    if(count($data->board_of_directors) > 0 ){
    //             //                        foreach ($data->board_of_directors as $item){
    //             //                            $result .= $result. $item->name .'('.$item->designation .'),' ;
    //             //                        }
    //             //                    }
    //             //                    return $result;
    //             //                })
    //             ->addColumn('action', function ($row) {
    //                 $btn = '<a href="' . route('company-details.edit', '' . $row->id . '') . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
    //                                             <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
    //                                             <span class="svg-icon svg-icon-3">
    //                                                                 <svg xmlns="we" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    //                                                                     <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
    //                                                                     <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
    //                                                                 </svg>
    //                                                             </span>
    //                                             <!--end::Svg Icon-->
    //                                         </a>
    //                                         <form method="POST" action=""  id="form_' . $row->id . '" >
    //                                         ' . method_field('Delete') . csrf_field() . '

    //                                         <button type="submit" class="deleteBtn btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
    //                                                 <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
    //                                                 <span class="svg-icon svg-icon-3">
    //                                                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    //                                                                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    //                                                                         <rect x="0" y="0" width="24" height="24" />
    //                                                                         <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero" />
    //                                                                         <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3" />
    //                                                                     </g>
    //                                                                 </svg>
    //                                                             </span>
    //                                                 <!--end::Svg Icon-->
    //                                             </button>
    //                                         </form>';
    //                 return $btn;
    //             })
    //             ->rawColumns(['status', 'action', 'board_of_directors'])
    //             ->make(true);
    //     }

    //     return view('insurance_companies.index');
    // }

    // public function insuranceCompaniesCreate()
    // {
    //     try {
    //         $countries = DB::table('country_information')
    //             ->orderby('country_name', 'asc')
    //             ->get();
    //         return view('insurance_companies.create', compact('countries'));
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }

    // public function insuranceCompaniesEdit($id)
    // {
    //     try {
    //         $company = DB::table('company_detail')
    //             ->where('company_detail.id', '=', $id)
    //             ->join('board_of_director', 'company_detail.id', '=', 'board_of_director.company_id')
    //             ->first();
    //         return view('insurance_companies.edit');
    //     } catch (\Exception $exception) {
    //         dd($exception->getMessage());
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }

    //Transactions
    // public function paymentTransactionsCancel(Request $request)
    // {
    //     try {
    //         $user_id = decrypt($request->user_id);
    //         $transaction_id = decrypt($request->id);
    //         DB::table('transaction')
    //             ->where('id', $transaction_id)
    //             ->update([
    //                 'status' =>  'Cancelled',
    //                 'cancelled_at' =>  Carbon::now()
    //             ]);

    //         $transaction =  DB::table('transaction')
    //             ->where('transaction.id', $transaction_id)
    //             ->join('users', 'transaction.user_id', '=', 'users.id')
    //             ->select(
    //                 'transaction.invoice_id as invoice_id',
    //                 'transaction.package_name as package_name',
    //                 'transaction.created_at as created_at',
    //                 'users.name as name'
    //             )->first();


    //         $sub = DB::table('subscriptions')
    //             ->where('user_id', $user_id)
    //             ->first();

    //         DB::table('subscriptions')
    //             ->where('user_id', $user_id)
    //             ->update([
    //                 'remaining_sanctions' => $sub->remaining_sanctions - decrypt($request->package_sanctions),
    //                 'total_sanctions' => $sub->total_sanctions - decrypt($request->package_sanctions),
    //                 'updated_at' =>  Carbon::now(),
    //             ]);
    //         $user = User::where('id', $user_id)->first();
    //         $user->notify(new PaymentCancelled($transaction));
    //         toastSuccess('Payment has been cancelled successfully!');
    //         return redirect()->back();
    //     } catch (\Exception $exception) {
    //         //            dd($exception->getMessage());
    //         toastError('Something went wrong, try again');
    //         return redirect()->back();
    //     }
    // }

    // public function paymentTransactionsIndex(Request $request)
    // {
    //     try {
    //         if ($request->ajax()) {
    //             $data = DB::table('transaction')
    //                 ->join('users', 'transaction.user_id', '=', 'users.id')
    //                 ->orderBy('transaction.id', 'desc')
    //                 ->select(
    //                     'transaction.*',
    //                     'users.name as user_name'
    //                 )
    //                 ->get();
    //             return Datatables::of($data)
    //                 ->addColumn('billing_name', function ($data) {
    //                     return $data->billing_fname . ' ' . $data->billing_sname;
    //                 })
    //                 ->editColumn('status', function ($data) {
    //                     if ($data->status == "Paid") {
    //                         return '<div class="badge badge-success" fw-bolder">' . $data->status . '</div>';
    //                     } else {
    //                         return '<div class="badge badge-danger" fw-bolder">' . $data->status . '</div>';
    //                     }
    //                 })
    //                 ->addColumn('action', function ($data) {
    //                     $action = '<a href="' . route('payment_transactions.show', encrypt($data->id)) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
    //                         <i class="fa fa-eye" title="View" aria-hidden="true"></i>
    //                         </a>
    //                         <a href="' . route('payment_transactions.resend_email', encrypt($data->id)) . '" class="resend_email btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
    //                             <i class="fa fa-envelope" title="Resend Email" aria-hidden="true"></i>
    //                         </a>';
    //                     if (isset($data->pdf)) {
    //                         $action .= '<a href="' . env('CUSTOMER_DOMAIN') . $data->pdf . '" download="" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
    //                                 <i class="fa fa-file-pdf" aria-hidden="true"></i>
    //                             </a>';
    //                     }
    //                     return $action;
    //                 })
    //                 ->rawColumns(['status', 'billing_name', 'action'])
    //                 ->make(true);
    //         }
    //         return view('payment_transactions.index');
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }

    // public function paymentTransactionsResendEmail($id)
    // {
    //     try {
    //         $transaction = DB::table('transaction')
    //             ->join('users', 'transaction.user_id', '=', 'users.id')
    //             ->join('packages', 'transaction.package_id', '=', 'packages.id')
    //             ->where('transaction.id', '=', decrypt($id))
    //             ->select(
    //                 'transaction.*',
    //                 'users.name as username',
    //                 'users.email as email',
    //                 'users.created_at as reg_date',
    //                 'packages.name as package_name',
    //                 'packages.price as package_price',
    //                 'packages.sanctions as package_sanctions'
    //             )
    //             ->first();
    //         $user = User::find($transaction->user_id)->first();
    //         $user->notify(new TransactionEmail($user, $transaction));
    //         toastr()->success('Transaction email sent succesfully to ' . $user->name);
    //         return back();
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }
    // public function paymentTransactionsShow($id)
    // {
    //     try {
    //         $transaction = DB::table('transaction')
    //             ->join('users', 'transaction.user_id', '=', 'users.id')
    //             ->join('packages', 'transaction.package_id', '=', 'packages.id')
    //             ->where('transaction.id', '=', decrypt($id))
    //             ->select(
    //                 'transaction.*',
    //                 'users.name as username',
    //                 'users.company_name as company_name',
    //                 'users.address as address',
    //                 'users.email as email',
    //                 'users.created_at as reg_date'
    //             )
    //             ->first();
    //         return view('payment_transactions.show', compact('transaction'));
    //     } catch (\Exception $exception) {
    //         //            dd($exception->getMessage());
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }

    //Packages
    // public function ratesIndex(Request $request)
    // {
    //     try {
    //         if ($request->ajax()) {
    //             $data = DB::table('packages')->orderBy('id', 'asc')->get();
    //             return Datatables::of($data)
    //                 ->editColumn('status', function ($data) {
    //                     if ($data->status == UserStatus::ACTIVE) {
    //                         return '<div class="badge badge-success" fw-bolder">' . $data->status . '</div>';
    //                     } else {
    //                         return '<div class="badge badge-danger" fw-bolder">' . $data->status . '</div>';
    //                     }
    //                 })
    //                 ->addColumn('action', function ($data) {
    //                     return '<button id="' . $data->id . '" value="Edit" class="action btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"  data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
    //                                 <span class="svg-icon svg-icon-3">
    //                                     <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    //                                         <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
    //                                         <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
    //                                     </svg>
    //                                 </span>
    //                             </button>';
    //                 })
    //                 ->rawColumns(['status', 'action'])
    //                 ->make(true);
    //         }
    //         return view('rates.index');
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    //     return view('rates.index');
    // }

    // public function ratesEdit(Request $request)
    // {
    //     try {
    //         if ($request->has('id')) {
    //             $request['updated_at'] = now();
    //             $packages = DB::table('packages')
    //                 ->where('id', $request->id)
    //                 ->update($request->except('_token', 'id'));
    //             toastr()->success('Package updated successfully!');
    //         } else {
    //             $request->request->add(
    //                 [
    //                     'created_at' => now(),
    //                     'updated_at' => now()
    //                 ]
    //             );
    //             DB::table('packages')->insert(
    //                 $request->except('_token')
    //             );
    //             toastr()->success('Package added successfully!');
    //         }

    //         return back();
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }

    //Sanctions Request
    // public function sanctionRequestIndex(Request $request)
    // {
    //     try {
    //         if ($request->ajax()) {
    //             $data = DB::table('req_for_sanc_status')
    //                 ->join('users', 'req_for_sanc_status.user_id', '=', 'users.id')
    //                 ->join('company_detail', 'req_for_sanc_status.company_id', '=', 'company_detail.id')
    //                 ->orderBy('id', 'desc')
    //                 ->select(
    //                     'req_for_sanc_status.*',
    //                     'users.id as user_id',
    //                     'users.name as user_name',
    //                     'company_detail.company_name as company_name'
    //                 )
    //                 ->get();
    //             return Datatables::of($data)
    //                 ->editColumn('status', function ($data) {
    //                     if ($data->status == SanctionRequestStatus::Completed) {
    //                         return '<div class="badge badge-success" fw-bolder">' . $data->status . '</div>';
    //                     } elseif ($data->status == SanctionRequestStatus::AllResultAttached) {
    //                         return '<div class="badge badge-success" fw-bolder">' . $data->status . '</div>';
    //                     } else {
    //                         return '<div class="badge badge-danger" fw-bolder">' . $data->status . '</div>';
    //                     }
    //                 })
    //                 ->addColumn('action', function ($data) {
    //                     $action = '<a href="' . route('sanction_request.show', encrypt($data->id)) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
    //                     <i class="fa fa-eye" title="View" aria-hidden="true"></i>
    //                     </a>';
    //                     return $action;
    //                 })
    //                 ->rawColumns(['status', 'action'])
    //                 ->make(true);
    //         }
    //         return view('sanction_request.index');
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }

    // public function sanctionRequestShow($id)
    // {
    //     try {
    //         $sanction_request = DB::table('req_for_sanc_status')
    //             ->where('req_for_sanc_status.id', '=', decrypt($id))
    //             ->join('users', 'req_for_sanc_status.user_id', '=', 'users.id')
    //             ->join('company_detail', 'req_for_sanc_status.company_id', '=', 'company_detail.id')
    //             ->select(
    //                 'req_for_sanc_status.*',
    //                 'users.id as user_id',
    //                 'users.name as user_name',
    //                 'users.email as user_email',
    //                 'company_detail.company_name as company_name'
    //             )
    //             ->orderBy('req_for_sanc_status.id', 'desc')
    //             ->first();

    //         $sanc_save_attachment = SancImages::where('sanc_req_id', decrypt($id))->get();
    //         return view('sanction_request.show', compact('sanction_request', 'sanc_save_attachment'));
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }

    // public function getSanctionResult($id)
    // {
    //     //        self::curlRequest('Union');
    //     //        try {
    //     //            $sanction_request = DB::table('req_for_sanc_status')
    //     //                ->where('req_for_sanc_status.id','=',decrypt($id))
    //     //                ->join('company_detail','req_for_sanc_status.company_id','=','company_detail.id')
    //     //                ->select(
    //     //                    'req_for_sanc_status.*',
    //     //                    'company_detail.company_name as company_name')
    //     //                ->orderBy('req_for_sanc_status.id','desc')
    //     //                ->first();
    //     //
    //     //            $sanc_save_attachment=SancImages::where('sanc_req_id',decrypt($id))->get();
    //     //            return view('sanction_request.show',compact('sanction_request','sanc_save_attachment'));
    //     //
    //     //        }catch (\Exception $exception){
    //     //            toastr()->error('Something went wrong, try again');
    //     //            return back();
    //     //        }
    // }


    //save sacnctum images
    // public function sanc_save_attachment(Request $request)
    // {
    //     try {
    //         $images = array();
    //         if ($files = $request->file('images')) {
    //             foreach ($files as $file) {
    //                 $name = time() . '_' . $file->getClientOriginalName();
    //                 $file->move('images', $name);
    //                 $images[] = $name;
    //                 /*Insert your data*/
    //                 SancImages::insert([
    //                     'file' =>  $name,
    //                     'sanc_req_id' => $request->input('sanc_id'),
    //                     //you can put other insertion here
    //                 ]);
    //             }
    //             //update commetns
    //             DB::table('req_for_sanc_status')
    //                 ->where('id', $request->input('sanc_id'))
    //                 ->update(['admin_comments' => $request->input('comment')]);
    //         } else {
    //             /*Update your Comments*/
    //             DB::table('req_for_sanc_status')
    //                 ->where('id', $request->input('sanc_id'))
    //                 ->update(['admin_comments' => $request->input('comment')]);
    //         }

    //         toastr()->success('Attachmet Saved Successfully!');
    //         return back();
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }

    // public function sanc_send_attachment(Request $request)
    // {
    //     try {
    //         //first save Attachments
    //         $images = array();
    //         if ($files = $request->file('images')) {
    //             foreach ($files as $file) {
    //                 $name = time() . '_' . $file->getClientOriginalName();
    //                 $file->move('images', $name);
    //                 $images[] = $name;
    //                 /*Insert your data*/
    //                 SancImages::insert([
    //                     'file' =>  $name,
    //                     'sanc_req_id' => $request->input('sanc_id'),
    //                     //you can put other insertion here
    //                 ]);
    //             }
    //             //update commetns
    //             DB::table('req_for_sanc_status')
    //                 ->where('id', $request->input('sanc_id'))
    //                 ->update([
    //                     'admin_comments' => $request->input('comment'),
    //                     'result_date' => Carbon::now()
    //                 ]);
    //         } else {
    //             /*Update your Comments*/
    //             DB::table('req_for_sanc_status')
    //                 ->where('id', $request->input('sanc_id'))
    //                 ->update([
    //                     'admin_comments' => $request->input('comment'),
    //                     'result_date' => Carbon::now()
    //                 ]);
    //         }
    //         //end of save attachments
    //         //send attachmets in emails
    //         $sanc_attachment_result = SancImages::where('sanc_req_id', $request->sanc_id)->get();
    //         if (count($sanc_attachment_result) > 0) {
    //             $userdata = DB::table('req_for_sanc_status')->where('id', $request->sanc_id)->first();
    //             $user = User::where('id', $userdata->user_id)->first();
    //             $user->notify(new SendAttachment($user, $sanc_attachment_result));
    //             //update status of sacntuem
    //             DB::table('req_for_sanc_status')
    //                 ->where('id', $request->input('sanc_id'))
    //                 ->update(['status' => SanctionRequestStatus::Completed]);
    //             toastr()->success('Attachment Send Successfully');
    //             return back();
    //         } else {
    //             toastr()->error('Attachment Not Found!');
    //             return back();
    //         }
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }
    //delete attachmetns
    // public function delete_attachements($id)
    // {
    //     try {
    //         $res = SancImages::where('id', $id)->delete();
    //         toastr()->success('Attachment Deleted Successfully!');
    //         return back();
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }
    //cancel request code
    // public function cancel_request(Request $request)
    // {
    //     try {
    //         DB::table('req_for_sanc_status')
    //             ->where('id', $request->input('sanc_id'))
    //             ->update([
    //                 'status' => SanctionRequestStatus::Cancelled,
    //                 'cancel_date' => Carbon::now()
    //             ]);
    //         $sub = DB::table('subscriptions')
    //             ->where('user_id', decrypt($request->user_id))
    //             ->first();
    //         DB::table('subscriptions')
    //             ->where('user_id', decrypt($request->user_id))
    //             ->update([
    //                 'remaining_sanctions' => $sub->remaining_sanctions + decrypt($request->sanctions),
    //                 'used_sanctions' => $sub->used_sanctions - decrypt($request->sanctions),
    //                 'updated_at' =>  Carbon::now(),
    //             ]);
    //         $sanction_details = DB::table('req_for_sanc_status')
    //             ->join('company_detail', 'req_for_sanc_status.company_id', '=', 'company_detail.id')
    //             ->where('req_for_sanc_status.id', $request->sanc_id)
    //             ->where('req_for_sanc_status.user_id', decrypt($request->user_id))
    //             ->select(
    //                 'company_detail.company_name as company_name',
    //                 'company_detail.country as country'
    //             )->first();
    //         $user = User::where('id', decrypt($request->user_id))->first();
    //         $user->notify(new SanctionRequestCancel($sanction_details));
    //         toastr()->success('Request Canceled Successfully');
    //         return back();
    //     } catch (\Exception $exception) {
    //         toastr()->error('Something went wrong, try again');
    //         return back();
    //     }
    // }
}
