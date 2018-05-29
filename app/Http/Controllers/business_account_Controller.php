<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBusinessAccountRequest;
use App\business_account;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Session;
use Redirect;


class business_account_Controller extends Controller
{
  public function index()
  {
    $accounts = business_account::all();
    return View::make('accounts.index')->with('accounts', $accounts);
  }

  public function create()
  {
    return View::make('accounts.create');
  }



  public function store(StoreBusinessAccountRequest $request)
  {
    $account = new business_account;
    $account->name = $request->name;
    $account->address = $request->address;
    $account->country = $request->country;
    $account->tax_number = $request->tax_number;
    $account->phone_number = $request->phone_number;

    $account->user()->associate($request->user());

    $account->save();


    return Redirect::to('accounts');

  }

  public function show($id)
  {
    $account = business_account::findorFail($id);

    return View::make('accounts.show')
            ->with('accounts', $account);
  }


  public function edit($id)
  {
    $account = business_account::findorFail($id);

    return View::make('accounts.edit')
           ->with('account', $account);
  }

  public function update(StoreBusinessAccountRequest $request, $id)
  {
    $account = business_account::findorFail($id);
    $account->name = $request->name;
    $account->address = $request->address;
    $account->country = $request->country;
    $account->tax_number = $request->tax_number;
    $account->phone_number = $request->phone_number;
    $account->save();

    Session::flash('message', 'Successfully updated account');
            return Redirect::to('accounts');
  }

  public function destroy($id)
  {
    $account = business_account::findorFail($id);
    $account->delete();
    Session::flash('message', 'Successfully deleted the account!');
        return Redirect::to('accounts');
  }









}
