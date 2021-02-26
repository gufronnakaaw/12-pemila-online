<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;
use Illuminate\Support\Str;

class LaptopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laptops = Laptop::all();
        return view('dashboard.menu.laptops', compact('laptops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.menu.createLaptops');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_laptop' => 'required',
            'brand' => 'required',
            'status' => 'required',
        ]);

        if( $request->hasFile('img_laptop') ){
            
            $imgName = Str::random(10) . '-' . $request->file('img_laptop')->getClientOriginalName();
            $request->file('img_laptop')->move(public_path('img/laptops'), $imgName);

            $laptop = Laptop::create([
                'name_laptop' => $request->name_laptop,
                'brand_laptop' => $request->brand,
                'status' => $request->status,
                'img_laptop' => $imgName,
                'created_by' => session('loggedUser')['username']
            ]);

            if( $laptop ){
                return redirect('/laptops')->with('success', 'Create data successfully');
            } else {
                return redirect('/laptops')->with('fail', 'Cannot create data');
            }
            
        } else {

            $laptop = Laptop::create([
                'name_laptop' => $request->name_laptop,
                'brand_laptop' => $request->brand,
                'status' => $request->status,
                'img_laptop' => 'default-laptop.jpg',
                'created_by' => session('loggedUser')['username']
            ]);

            if( $laptop ){
                return redirect('/laptops')->with('success', 'Create data successfully');
            } else {
                return redirect('/laptops')->with('fail', 'Cannot create data');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Laptop $laptop)
    {
        return view('dashboard.menu.editLaptops', compact('laptop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if( $request->hasFile('edit_img_laptop') ){
            
            // get old imgname
            $oldImgName = Laptop::find($request->id_laptop)->first()->img_laptop;

            if( $oldImgName === 'default-laptop.jpg' ){

                // upload
                $imgName = Str::random(10) . '-' . $request->file('edit_img_laptop')->getClientOriginalName();
                $request->file('edit_img_laptop')->move(public_path('img/laptops'), $imgName);
    
                $laptop = Laptop::where('id', $request->id_laptop)->update([
                    'name_laptop' => $request->edit_name_laptop,
                    'brand_laptop' => $request->edit_brand_laptop,
                    'status' => $request->edit_status_laptop,
                    'img_laptop' => $imgName,
                    'updated_by' => session('loggedUser')['username'],
                ]);
        
                if($laptop){
                    return redirect('/laptops')->with('success', 'Update successfully');
                } else {
                    return redirect('/laptops')->with('fail', 'Cannot update data');
                }
                
            } else {
                
                // delete old img
                unlink(public_path("img/laptops/$oldImgName"));
                
                // upload
                $imgName = Str::random(10) . '-' . $request->file('edit_img_laptop')->getClientOriginalName();
                $request->file('edit_img_laptop')->move(public_path('img/laptops'), $imgName);
    
                $laptop = Laptop::where('id', $request->id_laptop)->update([
                    'name_laptop' => $request->edit_name_laptop,
                    'brand_laptop' => $request->edit_brand_laptop,
                    'status' => $request->edit_status_laptop,
                    'img_laptop' => $imgName,
                    'updated_by' => session('loggedUser')['username'],
                ]);
        
                if($laptop){
                    return redirect('/laptops')->with('success', 'Update successfully');
                } else {
                    return redirect('/laptops')->with('fail', 'Cannot update data');
                }
            }

        } else {
            
            $laptop = Laptop::where('id', $request->id_laptop)->update([
                'name_laptop' => $request->edit_name_laptop,
                'brand_laptop' => $request->edit_brand_laptop,
                'status' => $request->edit_status_laptop,
                'updated_by' => session('loggedUser')['username'],
            ]);
    
            if($laptop){
                return redirect('/laptops')->with('success', 'Update successfully');
            } else {
                return redirect('/laptops')->with('fail', 'Cannot update data');
            }
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imgName = Laptop::find($id)->img_laptop;

        if( $imgName === 'default-laptop.jpg' ){
            
            $laptop = Laptop::destroy($id);
    
            if($laptop){
                return redirect('/laptops')->with('success', 'Delete successfully');
            }

            return redirect('/laptops')->with('fail', 'Cannot delete data');
            
        } else {

            unlink(public_path("img/laptops/$imgName"));

            $laptop = Laptop::destroy($id);
    
            if($laptop){
                return redirect('/laptops')->with('success', 'Delete successfully');
            }
            
            return redirect('/laptops')->with('fail', 'Cannot delete data');
        
        }
    }
}
