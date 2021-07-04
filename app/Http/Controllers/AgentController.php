<?php

namespace App\Http\Controllers;

use App\Agent;
use Illuminate\Http\Request;
use Auth;
use App\Instolment;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $data=$request->validate([
           'name'               => 'required',
           'mothername'         => 'required',
           'fathername'         => 'required',
           'dob'                => 'required',
           'gender'             => 'required',
           'aadhar_no'          => 'required',
           'pan_number'         => 'required',
           'account'            => 'required',
           'ifsc'               => 'required',
           'bankname'           => 'required',
           'branch_name'        => 'required',
           'shop_name'          => 'required',
           'ponumber'           => 'required',
           'psnumber'           => 'required',
           'mobile_number'      => 'required',
           'district'           => 'required',
           'type'               => 'required',
           'pinnumber'          => 'required',
           'address'            => 'required',
           'loan_price'         => 'required',
           'photo'              => 'required'          
        ]);
      
        $agents = new Agent();
        $agents->agent_id       = Auth::user()->id;
        $agents->name           = $request->name;
        $agents->mothername     = $request->mothername;   
        $agents->fathername     = $request->fathername;     
        $agents->dob            = $request->dob;
        $agents->gender         = $request->gender;
        $agents->aadhar_no      = $request->aadhar_no;   
        $agents->pan_number     = $request->pan_number;       
        $agents->account        = $request->account;
        $agents->bankname       = $request->bankname;
        $agents->ifsc           = $request->ifsc;   
        $agents->branch_name    = $request->branch_name;
        $agents->shop_name      = $request->shop_name;
        $agents->psnumber       = $request->psnumber;
        $agents->ponumber       = $request->ponumber;   
        $agents->mobile_number  = $request->mobile_number;
        $agents->district       = $request->district;
        $agents->type           = $request->type;   
        $agents->pinnumber      = $request->pinnumber;     
        $agents->address        = $request->address;
        $agents->loan_price     = $request->loan_price;
        $agents->photo          = $request->photo->store('uploads/bank');

        if($agents->save())
        {
            flash(translate('Agents has been inserted successfully'))->success();
            return redirect()->route('agent.index');
        }
        else
        {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agent = Agent::findOrFail(decrypt($id));
        return view('agent.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = Agent::findOrFail(decrypt($id));
        return view('agent.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agents)
    {

        $agents                 = Agent::findOrFail($request->id);
        $agents->name           = $request->name;
        $agents->mothername     = $request->mothername;   
        $agents->fathername     = $request->fathername;     
        $agents->dob            = $request->dob;
        $agents->gender         = $request->gender;
        $agents->aadhar_no      = $request->aadhar_no;   
        $agents->pan_number     = $request->pan_number;       
        $agents->account        = $request->account;
        $agents->bankname       = $request->bankname;
        $agents->ifsc           = $request->ifsc;   
        $agents->branch_name    = $request->branch_name;
        $agents->shop_name      = $request->shop_name;
        $agents->psnumber       = $request->psnumber;
        $agents->ponumber       = $request->ponumber;   
        $agents->mobile_number  = $request->mobile_number;
        $agents->district       = $request->district;
        $agents->type           = $request->type;   
        $agents->pinnumber      = $request->pinnumber;     
        $agents->address        = $request->address;
        $agents->loan_price     = $request->loan_price;
        $agents->photo          = $request->photo->store('uploads/bank');

        if($agents->save())
        {
            flash(translate('Agents has been Update successfully'))->success();
            return redirect()->route('agents.accounts');
        }
        else
        {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $id)
    {
        $agent = Agent::findOrFail($id);
        dd($agent);
        $agent->delete();
           flash(translate('Agents has been Update successfully'))->success();
            return redirect()->route('agents.accounts');
    }
    public function instolment(request $request)
    {
        $user = Auth::user();
        $sellers  =   Instolment::orderBy('created_at','desc');      
        if ($request->has('search')){
            $sort_search = $request->search;
            $sellers = Instolment::where('customer_name', 'like', '%'.$sort_search.'%')->orWhere('agent_id', 'like', '%'.$sort_search.'%');   
        }
        if($user->user_type = 'agent')
        {
          //  $sellers  =   $sellers->where('agent_id',$user->id);
        }
        $sellers  =   $sellers->paginate(12);
        return view('agent.instolment',compact('sellers'));
    }
}
