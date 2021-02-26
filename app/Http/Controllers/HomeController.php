<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;
use App\Models\Order;

class HomeController extends Controller
{
    public function index(){
        // $laptops = Laptop::where('name_laptop', 'laptop 1')->orWhere('name_laptop', 'laptop 2')->orWhere('name_laptop', 'laptop 3')->get();

        // foreach ($laptops as $laptop) {
        //     dump($laptop->status);
        // }

        $laptops = Laptop::where('status', 'unused')->get();
        return view('home', compact('laptops'));
    }

    public function create(Request $request){
        $request->validate([
            'name_order' => 'required',
            'class' => 'required',
            'total' => 'required',
            'majors' => 'required',
            'reason' => 'required',
        ]);

        
        $arrLaptop = '';
        switch ($request->total) {
            case 1:
                $arrLaptop = $request->choose_laptop_1;
                Laptop::where('name_laptop', $request->choose_laptop_1)->update([
                    'status' => 'used'
                ]);

                break;
            case 2:
                $arrLaptop = $request->choose_laptop_1 . ',' .$request->choose_laptop_2;
                
                Laptop::where('name_laptop', $request->choose_laptop_1)
                ->orWhere('name_laptop', $request->choose_laptop_2)
                ->update([
                    'status' => 'used'
                ]);

                break;
            case 3:
                $arrLaptop = $request->choose_laptop_1 . ',' . $request->choose_laptop_2 . ',' . $request->choose_laptop_3;

                Laptop::where('name_laptop', $request->choose_laptop_1)
                ->orWhere('name_laptop', $request->choose_laptop_2)
                ->orWhere('name_laptop', $request->choose_laptop_3)
                ->update([
                    'status' => 'used'
                ]);

                break;
            case 4:
                $arrLaptop = $request->choose_laptop_1 . ',' . $request->choose_laptop_2 . ',' . $request->choose_laptop_3 . ',' . $request->choose_laptop_4;

                Laptop::where('name_laptop', $request->choose_laptop_1)
                ->orWhere('name_laptop', $request->choose_laptop_2)
                ->orWhere('name_laptop', $request->choose_laptop_3)
                ->orWhere('name_laptop', $request->choose_laptop_4)
                ->update([
                    'status' => 'used'
                ]);

                break;
            
            case 5:
                $arrLaptop = $request->choose_laptop_1 . ',' . $request->choose_laptop_2 . ',' . $request->choose_laptop_3 . ',' . $request->choose_laptop_4 . ',' . $request->choose_laptop_5;

                Laptop::where('name_laptop', $request->choose_laptop_1)
                ->orWhere('name_laptop', $request->choose_laptop_2)
                ->orWhere('name_laptop', $request->choose_laptop_3)
                ->orWhere('name_laptop', $request->choose_laptop_4)
                ->orWhere('name_laptop', $request->choose_laptop_5)
                ->update([
                    'status' => 'used'
                ]);

                break;
            
            default:
                $arrLaptop = $request->choose_laptop_1;
                break;
        }

        $order = Order::create([
            'name_order' => $request->name_order,
            'class' => $request->class,
            'laptops' => $arrLaptop,
            'majors' => $request->majors,
            'total' => $request->total,
            'reason' => $request->reason,
        ]);

        if( $order ){
            return redirect('/thanks');
        }
        return redirect('/');

    }
}
