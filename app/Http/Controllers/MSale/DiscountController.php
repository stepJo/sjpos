<?php

namespace App\Http\Controllers\MSale;

use App\Http\Controllers\Controller;
use App\Http\Requests\MSale\CreateDiscountRequest;
use App\Http\Requests\MSale\UpdateDiscountRequest;
use Illuminate\Http\Request;
use App\Models\MSale\Discount;
use Keygen;
Use Session;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();
        
        return view('msale.d_index', compact('discounts'));
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscountRequest $request)
    {
        Discount::create([
            'dis_code'  => $request->dis_code,
            'dis_type'  => $request->dis_type,
            'min_trans' => $request->min_trans,
            'dis_value' => $request->dis_value,
            'dis_qty'   => $request->dis_qty,
            'exp_date'  => $request->exp_date,
            'u_id'      => Session::get('u_id')
        ]);

        return redirect('discount')->with('success', 'Berhasil tambah diskon');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $discount->update($request->all());

        return redirect('discount')->with('success', 'Berhasil update diskon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->back()->with('success', 'Berhasil hapus diskon');
    }

    public function generate()
    {
        $split_code = function($key) {
            return join('-', str_split($key, 4));
        };

        $code = Keygen::alphanum(12)->generate($split_code);

        return $code;
    }
}
