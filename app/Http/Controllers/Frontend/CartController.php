<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Breadcrumb;
use App\Models\Admin\ColorOption;
use App\Models\Admin\Currency;
use App\Models\Admin\ExternalUrl;
use App\Models\Admin\GoogleAnalytic;
use App\Models\Admin\Page;
use App\Models\Admin\Service;
use App\Models\Admin\SiteInfo;
use App\Models\Admin\Social;
use App\Models\Admin\Software;
use App\Models\Admin\TawkTo;
use App\Models\Admin\WhatsappChat;
use App\Models\Frontend\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Default values
        $currency_symbol = "$";
        $currency_position = "left";
        $decimal_digit = 2;
        $decimal_separator = ".";
        $thousand_separator = ",";

        // Retrieving models
        $currency = Currency::first();

        if (isset($currency)) {
            $currency_symbol = $currency->currency;
            $currency_position = $currency->currency_position;
            $decimal_digit = $currency->decimal_digit;

            if ($decimal_separator == "dot") {
                $decimal_separator = ".";
            } elseif ($decimal_separator == "comma") {
                $decimal_separator = ",";
            } else {
                $decimal_separator = " "; //space
            }

            if ($thousand_separator == "dot") {
                $thousand_separator = ".";
            } elseif ($thousand_separator == "comma") {
                $thousand_separator = ",";
            } else {
                $thousand_separator = " "; //space
            }
        }

        // Get site language
        $language = getSiteLanguage();

        // Retrieving models
        $site_info = SiteInfo::where('language_id', $language->id)->first();
        $google_analytic = GoogleAnalytic::first();
        $tawk_to = TawkTo::first();
        $whatsapp_chats = WhatsappChat::where('language_id', $language->id)
            ->where('status', 'published')
            ->orderBy('order', 'asc')
            ->get();
        $socials = Social::where('status', 1)->get();
        $color_option = ColorOption::first();
        $breadcrumb = Breadcrumb::first();
        $external_url = ExternalUrl::where('language_id', $language->id)->first();
        $header_pages = Page::where('language_id', $language->id)
            ->where('display_header_menu', 1)
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
        $footer_pages = Page::where('language_id', $language->id)
            ->where('display_header_menu', 0)
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        return view('frontend.order.index', compact('site_info', 'google_analytic', 'tawk_to', 'whatsapp_chats',
            'socials', 'color_option', 'breadcrumb', 'external_url', 'header_pages', 'footer_pages',
            'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator',
            'thousand_separator'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_my_cart()
    {
        // Default values
        $currency_symbol = "$";
        $currency_position = "left";
        $decimal_digit = 2;
        $decimal_separator = ".";
        $thousand_separator = ",";

        // Retrieving models
        $currency = Currency::first();

        if (isset($currency)) {
            $currency_symbol = $currency->currency;
            $currency_position = $currency->currency_position;
            $decimal_digit = $currency->decimal_digit;

            if ($decimal_separator == "dot") {
                $decimal_separator = ".";
            } elseif ($decimal_separator == "comma") {
                $decimal_separator = ",";
            } else {
                $decimal_separator = " "; //space
            }

            if ($thousand_separator == "dot") {
                $thousand_separator = ".";
            } elseif ($thousand_separator == "comma") {
                $thousand_separator = ",";
            } else {
                $thousand_separator = " "; //space
            }
        }

        // Get site language
        $language = getSiteLanguage();

        // Retrieving models
        $site_info = SiteInfo::where('language_id', $language->id)->first();
        $google_analytic = GoogleAnalytic::first();
        $tawk_to = TawkTo::first();
        $whatsapp_chats = WhatsappChat::where('language_id', $language->id)
            ->where('status', 'published')
            ->orderBy('order', 'asc')
            ->get();
        $socials = Social::where('status', 1)->get();
        $color_option = ColorOption::first();
        $breadcrumb = Breadcrumb::first();
        $external_url = ExternalUrl::where('language_id', $language->id)->first();
        $header_pages = Page::where('language_id', $language->id)
            ->where('display_header_menu', 1)
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
        $footer_pages = Page::where('language_id', $language->id)
            ->where('display_header_menu', 0)
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        $id = Auth::id();

        $carts = Cart::
            where('carts.user_id', $id)
            ->get();


        return view('frontend.order.index-my-cart', compact('site_info', 'google_analytic', 'tawk_to', 'whatsapp_chats',
            'socials', 'color_option', 'breadcrumb', 'external_url', 'header_pages', 'footer_pages',
            'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator',
            'thousand_separator', 'carts'));
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
        // Form validation
        $request->validate([
            'selection_price' => 'required|in:0,1,2',
        ]);

        $type_text = "service";
        // Get All Request
        $input = $request->all();

        // Retrieving models
        $service = Service::findOrFail($input['hidden_order_id']);

        // Period control
        if (($service->monthly_price == "" && $input['selection_price'] == 0) ||
            ($service->annually_price == "" && $input['selection_price'] == 1) ||
            ($service->onetime_price == "" && $input['selection_price'] == 2)) {
            return redirect()->route('order-period-page.show', $input['hidden_order_id'])
                ->with('warning', 'content.Please make sure you enter the correct value.');
        }

        if ($input['selection_price'] == 0) {
            $now_price = $service->monthly_price;
        } elseif ($input['selection_price'] == 1) {
            $now_price = $service->annually_price;
        } else {
            $now_price = $service->onetime_price;
        }

        // Default values
        $currency_symbol = "$";
        $currency_position = "left";
        $decimal_digit = 2;
        $decimal_separator = ".";
        $thousand_separator = ",";

        // Retrieving models
        $currency = Currency::first();

        if (isset($currency)) {
            $currency_symbol = $currency->currency;
            $currency_position = $currency->currency_position;
            $decimal_digit = $currency->decimal_digit;

            if ($decimal_separator == "dot") {
                $decimal_separator = ".";
            } elseif ($decimal_separator == "comma") {
                $decimal_separator = ",";
            } else {
                $decimal_separator = " "; //space
            }

            if ($thousand_separator == "dot") {
                $thousand_separator = ".";
            } elseif ($thousand_separator == "comma") {
                $thousand_separator = ",";
            } else {
                $thousand_separator = " "; //space
            }
        }

        // Retrieving models
        $breadcrumb = Breadcrumb::first();

        // Cart check with user login/session
       if (Auth::check()) {

           // Retrieve the currently authenticated user's ID...
           $id = Auth::id();

           $carts = Cart::where('carts.user_id', $id)->get();

           // returns array of cart product IDs
           $cart_product_ids = Cart::where('user_id', $id)->where('type', 'service')->pluck('product_id')->toArray();

           if (!in_array($service->id, $cart_product_ids)) {
               // If the product is not in the cart, add a new product
               $cart = new Cart();

               $cart->product_id = $service->id;
               $cart->user_id = $id;
               $cart->product_quantity = 1;
               $cart->selected_price = $input['selection_price'];
               $cart->type = "service";

               $cart->save();
           } else {

               // If there is the same product in the cart, increase the quantity
               foreach ($carts as $cart) {

                   if ($cart->product_id == $service->id && $cart->type == "service") {

                       // Update quantity column
                       Cart::find($cart->id)->update(
                           ['product_quantity' => $cart->product_quantity + 1, 'selected_price' => $input['selection_price']]
                       );

                   }

               }

           }

           return redirect()->route('cart-page.index_my_cart')
               ->with('success', 'Product added to cart successfully!');

       } else {

           $cart = session()->get('cart');

           // if cart is empty then this the first product
           if(!$cart) {
               $cart = [
                   $input['hidden_order_id'].$type_text => [
                       "product_id" => $input['hidden_order_id'],
                       "name" => $service->service_name,
                       "quantity" => 1,
                       "price" => $now_price,
                       "tax_value" => $service->tax_value,
                       "selected_price" => $input['selection_price'],
                       "type" => "service",
                   ]
               ];
               session()->put('cart', $cart);

               return redirect()->route('cart-page.index')
                   ->with(['breadcrumb' => $breadcrumb,
                       'currency_symbol' => $currency_symbol,
                       'currency_position' => $currency_position,
                       'decimal_digit' => $decimal_digit,
                       'decimal_separator' => $decimal_separator,
                       'thousand_separator' => $thousand_separator])
                   ->with('success', 'Product added to cart successfully!');
           }

           // if cart not empty then check if this product exist then increment quantity and update price etc...
           if(isset($cart[$input['hidden_order_id'].$type_text])) {

               $cart[$input['hidden_order_id'].$type_text]['quantity']++;
               $cart[$input['hidden_order_id'].$type_text]['price'] = $now_price;
               $cart[$input['hidden_order_id'].$type_text]['selected_price'] = $input['selection_price'];

               session()->put('cart', $cart);

               return redirect()->route('cart-page.index')
                   ->with(['breadcrumb' => $breadcrumb,
                       'currency_symbol' => $currency_symbol,
                       'currency_position' => $currency_position,
                       'decimal_digit' => $decimal_digit,
                       'decimal_separator' => $decimal_separator,
                       'thousand_separator' => $thousand_separator])
                   ->with('success', 'Product added to cart successfully!');
           }

           // if item not exist in cart then add to cart with quantity = 1
           $cart[$input['hidden_order_id'].$type_text] = [
               "product_id" => $input['hidden_order_id'],
               "name" => $service->service_name,
               "quantity" => 1,
               "price" => $now_price,
               "tax_value" => $service->tax_value,
               "selected_price" => $input['selection_price'],
               "type" => "service",
           ];
           session()->put('cart', $cart);

           return redirect()->route('cart-page.index')
               ->with(['breadcrumb' => $breadcrumb,
                   'currency_symbol' => $currency_symbol,
                   'currency_position' => $currency_position,
                   'decimal_digit' => $decimal_digit,
                   'decimal_separator' => $decimal_separator,
                   'thousand_separator' => $thousand_separator])
               ->with('success', 'Product added to cart successfully!');
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_software(Request $request)
    {
        // Form validation
        $request->validate([
            'selection_price' => 'required|in:0,1,2',
        ]);

        $type_text = "software";

        // Get All Request
        $input = $request->all();

        // Retrieving models
        $software = Software::findOrFail($input['hidden_order_id']);

        // Period control
        if (($software->monthly_price == "" && $input['selection_price'] == 0) ||
            ($software->annually_price == "" && $input['selection_price'] == 1) ||
            ($software->onetime_price == "" && $input['selection_price'] == 2)) {
            return redirect()->route('order-period-page.show', $input['hidden_order_id'])
                ->with('warning', 'content.Please make sure you enter the correct value.');
        }

        if ($input['selection_price'] == 0) {
            $now_price = $software->monthly_price;
        } elseif ($input['selection_price'] == 1) {
            $now_price = $software->annually_price;
        } else {
            $now_price = $software->onetime_price;
        }

        // Default values
        $currency_symbol = "$";
        $currency_position = "left";
        $decimal_digit = 2;
        $decimal_separator = ".";
        $thousand_separator = ",";

        // Retrieving models
        $currency = Currency::first();

        if (isset($currency)) {
            $currency_symbol = $currency->currency;
            $currency_position = $currency->currency_position;
            $decimal_digit = $currency->decimal_digit;

            if ($decimal_separator == "dot") {
                $decimal_separator = ".";
            } elseif ($decimal_separator == "comma") {
                $decimal_separator = ",";
            } else {
                $decimal_separator = " "; //space
            }

            if ($thousand_separator == "dot") {
                $thousand_separator = ".";
            } elseif ($thousand_separator == "comma") {
                $thousand_separator = ",";
            } else {
                $thousand_separator = " "; //space
            }
        }

        // Retrieving models
        $breadcrumb = Breadcrumb::first();

        // Cart check with user login/session
        if (Auth::check()) {

            // Retrieve the currently authenticated user's ID...
            $id = Auth::id();

            $carts = Cart::where('carts.user_id', $id)->get();

            // returns array of cart product IDs
            $cart_product_ids = Cart::where('user_id', $id)->where('type', 'software')->pluck('product_id')->toArray();

            if (!in_array($software->id, $cart_product_ids)) {
                // If the product is not in the cart, add a new product
                $cart = new Cart();

                $cart->product_id = $software->id;
                $cart->user_id = $id;
                $cart->product_quantity = 1;
                $cart->selected_price = $input['selection_price'];
                $cart->type = "software";

                $cart->save();
            } else {

                // If there is the same product in the cart, increase the quantity
                foreach ($carts as $cart) {

                    if ($cart->product_id == $software->id && $cart->type == "software") {

                        // Update quantity column
                        Cart::find($cart->id)->update(
                            ['product_quantity' => $cart->product_quantity + 1, 'selected_price' => $input['selection_price']]
                        );

                    }

                }

            }

            return redirect()->route('cart-page.index_my_cart')
                ->with('success', 'Product added to cart successfully!');

        } else {

            $cart = session()->get('cart');

            // if cart is empty then this the first product
            if(!$cart) {
                $cart = [
                    $input['hidden_order_id'].$type_text => [
                        "product_id" => $input['hidden_order_id'],
                        "name" => $software->title,
                        "quantity" => 1,
                        "price" => $now_price,
                        "tax_value" => $software->tax_value,
                        "selected_price" => $input['selection_price'],
                        "type" => "software",
                    ]
                ];
                session()->put('cart', $cart);

                return redirect()->route('cart-page.index')
                    ->with(['breadcrumb' => $breadcrumb,
                        'currency_symbol' => $currency_symbol,
                        'currency_position' => $currency_position,
                        'decimal_digit' => $decimal_digit,
                        'decimal_separator' => $decimal_separator,
                        'thousand_separator' => $thousand_separator])
                    ->with('success', 'Product added to cart successfully!');
            }

            // if cart not empty then check if this product exist then increment quantity and update price etc...
            if(isset($cart[$input['hidden_order_id'].$type_text])) {

                $cart[$input['hidden_order_id'].$type_text]['quantity']++;
                $cart[$input['hidden_order_id'].$type_text]['price'] = $now_price;
                $cart[$input['hidden_order_id'].$type_text]['selected_price'] = $input['selection_price'];

                session()->put('cart', $cart);

                return redirect()->route('cart-page.index')
                    ->with(['breadcrumb' => $breadcrumb,
                        'currency_symbol' => $currency_symbol,
                        'currency_position' => $currency_position,
                        'decimal_digit' => $decimal_digit,
                        'decimal_separator' => $decimal_separator,
                        'thousand_separator' => $thousand_separator])
                    ->with('success', 'Product added to cart successfully!');
            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$input['hidden_order_id'].$type_text] = [
                "product_id" => $input['hidden_order_id'],
                "name" => $software->title,
                "quantity" => 1,
                "price" => $now_price,
                "tax_value" => $software->tax_value,
                "selected_price" => $input['selection_price'],
                "type" => "software",
            ];
            session()->put('cart', $cart);

            return redirect()->route('cart-page.index')
                ->with(['breadcrumb' => $breadcrumb,
                    'currency_symbol' => $currency_symbol,
                    'currency_position' => $currency_position,
                    'decimal_digit' => $decimal_digit,
                    'decimal_separator' => $decimal_separator,
                    'thousand_separator' => $thousand_separator])
                ->with('success', 'Product added to cart successfully!');
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

    // Session forget for cart
    public function destroy_order($order_id){

        // Forget a single key...
        session()->forget('cart.'.$order_id);

        // Get Cart content
        $cart_items = session()->get('cart');


        // Cart items count check
        if (count($cart_items) == 0) {
            // Forget a single key...
            session()->forget('cart');
        }


        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_my_cart_order($id)
    {
        // Retrieve a model
        $cart = Cart::findOrFail($id);

        // Delete record
        $cart->delete();

        return redirect()->route('cart-page.index_my_cart')
            ->with('success', 'content.deleted_successfully');
    }
}
