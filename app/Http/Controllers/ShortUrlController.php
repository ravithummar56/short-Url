<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Session;
use Log;

class ShortUrlController extends Controller
{
    public function index()
    {
        $shorturl = ShortUrl::latest()->get();
   
        return view('short_url', compact('shorturl'));
    }

    public function store(Request $request)
    {
        try {
            
            $request->validate([
               'url' => 'required|url'
            ]);
       
            $input['url'] = $request->url;
            $input['hash_code'] = $this->checkHashCode();
       
            ShortUrl::create($input);

            Session::flash('message', ' <div class="alert alert-success"><p>Short URL Generated!</p></div>');

            return redirect('/');
        } catch (Exception $e) {
            Log::debug($e);
        }    
    }

    public function shorUrlRedirect($code)
    {
        $find = ShortUrl::where('hash_code', $code)->first();
        if(!$find){

          abort(404);  
        }
        else{
            $find->delete();
        }
        return redirect($find->url);
    }

    public function checkHashCode()
    {
        $code = Str::random(6);

        $find = ShortUrl::where('hash_code', $code)->first();
        if($find){
            $code = $this->checkHashCode();
        }
         return $code;
    }
}
