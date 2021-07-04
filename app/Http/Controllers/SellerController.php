<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\User;
use App\Agent;
use App\Instolment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $approved = null;
        $sellers = User::where('user_type', 'agent')->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $user_ids = User::where('user_type', 'agent')->where(function($user) use ($sort_search){
                $user->where('name', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');        
            });
        }
        $sellers = $sellers->paginate(10);       
        return view('sellers.index', compact('sellers', 'sort_search', 'approved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(User::where('email', $request->email)->first() != null){
            flash(translate('Email already exists!'))->error();
            return back();
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = "agent";
        $user->address = $request->address;
        $user->phone = $request->phone;
        if($request->hasFile('profile')){
            $user->avatar = $request->file('profile')->store('uploads/profile');
        }
        $user->password = Hash::make($request->password);    
        if($user->save()){           
                flash(translate('Agents has been inserted successfully'))->success();
                return redirect()->route('agents.index');
        }

        flash(translate('Something went wrong'))->error();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seller = User::findOrFail(decrypt($id));
        return view('sellers.edit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = "agent";
        $user->address = $request->address;
        $user->phone = $request->phone;
        if($request->hasFile('profile')){
            $user->avatar = $request->file('profile')->store('uploads/profile');
        }
        $user->password = Hash::make($request->password);
       

        if($user->save()){           
                flash(translate('Agents has been inserted successfully'))->success();
                return redirect()->route('agents.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id="")
    {
        print_r($id);
        $seller = User::findOrFail($id);
        dd($seller);
        if($seller->delete()){
            flash(translate('Seller has been deleted successfully'))->success();
            return redirect()->route('agents.index');
        }
        else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function show_verification_request($id)
    {
        $seller = Seller::findOrFail($id);
        return view('sellers.verification', compact('seller'));
    }

    public function approve_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 1;
        if($seller->save()){
            flash(translate('Seller has been approved successfully'))->success();
            return redirect()->route('agents.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function reject_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 0;
        $seller->verification_info = null;
        if($seller->save()){
            flash(translate('Seller verification request has been rejected successfully'))->success();
            return redirect()->route('sellers.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }


    public function payment_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        return view('sellers.payment_modal', compact('seller'));
    }

    public function profile_modal(Request $request)
    {
        $seller = User::findOrFail($request->id);
        return view('sellers.profile_modal', compact('seller'));
    }

    public function updateApproved(Request $request)
    {
        $seller = User::findOrFail($request->id);
        $seller->verification_status = $request->status;
        if($seller->save()){
            return 1;
        }
        return 0;
    }

    public function login($id)
    {
        $seller = Seller::findOrFail(decrypt($id));

        $user  = $seller->user;

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function ban($id) {
        $seller = Seller::findOrFail($id);

        if($seller->user->banned == 1) {
            $seller->user->banned = 0;
        } else {
            $seller->user->banned = 1;
        }

        $seller->user->save();

        return back();
    }
   public function accounts(Request $request)
   {
         $sort_search = null;
         $sellers = Agent::orderBy('created_at', 'desc');
         if ($request->has('search')){
            $sort_search = $request->search;
            $sellers = Agent::where('name', 'like', '%'.$sort_search.'%')->orWhere('fathername', 'like', '%'.$sort_search.'%');        
        }
        $sellers = $sellers->paginate(10);      
        return view('agent.index', compact('sellers', 'sort_search'));
   }
   public function accountsapproved($id)
   {
      $agent=Agent::findOrFail($id);
      $instolment=$agent->loan_price / 10;
    
      $inst = new Instolment();
      for ($i=1; $i < 11 ; $i++) {          
          $data=array('agent_id'=>$agent->agent_id,'customer_name'=>$agent->name,'payment'=>$instolment,'account_id'=>$agent->id,'status'=>0,'month'=>Carbon::now()->addMonths($i));
          Instolment::insert($data);
      }
        $agent=Agent::where('id',$id)->update(['status' => 1]);
        flash(translate('Agents has been inserted successfully'))->success();
        return redirect()->route('agents.index');

   }
}
