<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.sign-up');
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|confirmed|min:6',
            'type' => ['required', 'integer', 'in:1,2'],
            'agree_term_and_condition' => ['accepted'],
        ]);

        // Get All Request
        $input = $request->all();

        // Set agree_term_and_condition
        if ($input['agree_term_and_condition'] == true) {
            $input['agree_term_and_condition'] = 1;
        } else {
            $input['agree_term_and_condition'] = 0;
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'type' => $input['type'],
            'agree_term_and_condition' => $input['agree_term_and_condition'],
        ]);

        // Login user
        Auth::login($user);

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
}
