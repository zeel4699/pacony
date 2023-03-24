<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Cart;
use App\Models\User;
use Laravel\Fortify\Fortify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.sign-in');
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //Cart session check and user routing
            if (session()->has('cart')) {

                // Retrieve the currently authenticated user's ID...
                $user_id = Auth::id();

                $carts = Cart::where('carts.user_id', $user_id)->get();

                // returns array of cart product IDs
                $cart_product_ids = Cart::where('user_id', $user_id)->pluck('product_id', 'type')->toArray();

                $cart_items = session()->get('cart');

                if (count($cart_items) != 0) {

                    foreach (session()->get('cart') as  $id => $details) {

                        if (!in_array($details['product_id'], $cart_product_ids)) {
                            // If the product is not in the cart, add a new product
                            $cart = new Cart();

                            $cart->product_id = $details['product_id'];
                            $cart->user_id = $user_id;
                            $cart->product_quantity = 1;
                            $cart->selected_price = $details['selected_price'];
                            $cart->type = $details['type'];

                            $cart->save();

                        } else {

                            // If there is the same product in the cart, increase the quantity
                            foreach ($carts as $cart) {

                                if ($cart->product_id == $details['product_id']) {

                                    // Update quantity column
                                    Cart::find($cart->id)->update(
                                        ['product_quantity' => $cart->product_quantity + 1, 'selected_price' => $details['selected_price']]
                                    );

                                }

                            }

                        }

                    }

                    return redirect()->route('cart-page.index_my_cart');
                }


            } else {
                return redirect()->route('profile-page.index');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

}
