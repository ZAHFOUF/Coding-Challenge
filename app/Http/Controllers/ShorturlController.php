<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShorturlResource;
use App\Models\Shorturl;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class ShorturlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $urls =   Shorturl::all('*')->sortByDesc('clicks');



       return ShorturlResource::collection($urls);
    }


    /**
     * Generate A Short Url for the user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validate the request
        $request->validate([
            'url' => 'required|url'
        ]);

        $url = $request->url ;

        // genrate short code
        $code = Random::generate("5",'a-z');


        // store the short url to the db

        $shorturl = new Shorturl();
        $shorturl->origin_url = $url;
        $shorturl->short_url = $code;

        $shorturl->save();



        return ["short" => env("APP_URL"). $code];
    }


     /**
     *  fetch the Short Url and redirect the user
     */

    public function short ($code)

    {


        try{

            $url = Shorturl::where('short_url',$code)->first();

            return redirect()->away($url->origin_url);

        }catch(\Exception $e){

            return "invalid url";

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
