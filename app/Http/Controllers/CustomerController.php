<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CustomerController extends Controller
{
   /*  public function index(){
        return inertia::render('index' , [
            'customers' => Customer::all()->map(function($customer){
                return [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                ];
            }),
        ]); */
    /* } */
   /*  public function create(){
        return inertia::render('create');
    } */
   /*  public function store(Request $request){
        $validated= $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|unique:customers|max:14|min:10',
            'email' => 'required|email|unique:customers',
        ]);

        Customer::create($validated);

        return Redirect::route('customers.index')->with('message' , 'Customer created successfully');
    } */

   /*  public function destroy(Customer $customer){

         $customer->delete();
         return Redirect::route('customers.index')->with('message' , 'Customer deleted successfully');

    } */

    /* public function edit(Customer $customer){
        return inertia::render('edit' , [
            'customer' => $customer
        ]);
    } */

   /*  public function update(Request $request , Customer $customer){
        $validated= $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:14|min:10',
            'email' => 'required|email',
        ]);

        $customer->update($validated);

        return Redirect::route('customers.index')->with('message' , 'Customer updated successfully');
    } */
}

