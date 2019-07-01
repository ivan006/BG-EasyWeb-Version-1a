<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NetworkM;
use App\PostM;
use App\MetadataM;





class Post extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allURLs = PostM::ShowActions(func_get_args());

      $PostList = NetworkM::ShowPost();


      // echo Route::getCurrentRoute()->getPath();

      return view('browse', compact('PostList', 'allURLs'));
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


      $arguments = func_get_args();
      array_shift($arguments);
      if (1==1) {
        $SubAssetURL = PostM::ShowLocation($arguments);


        $filename =  $request->get('file');
        $file =  $SubAssetURL."/".$filename;
        // echo file_get_contents($file);

        $contents =  $request->get('contents');
        file_put_contents($file,$contents);
      }



      if (1==1) {
        $SubAssetDeepRead = PostM::ShowIndirectData($arguments);

        $EPgCont =  json_decode($request->get('smart'), true);

        PostM::Store($SubAssetURL, $EPgCont);


      }
      if (null !== $request->file('zip_file')) {

        echo PostM::upload($arguments, $request);
      }

      $allURLs = PostM::ShowActions($arguments);
      // dd($allURLs['sub_post_edit']);

      return redirect($allURLs['sub_post_edit']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){
      $arguments = func_get_args();
      array_shift($arguments);
      array_shift($arguments);


      $SubPostDeepList = PostM::ShowIndirectSubPost(func_get_args());
      // dd($SubPostDeepList);
      $SubAssetDeepRead = PostM::ShowIndirectData(func_get_args());
      // $func_get_args =func_get_args();
      // $VSiteHeader = PostM::ShowIndirectDataHelper(NetworkM::ShowLocation(end($func_get_args)));


      $allURLs = PostM::ShowActions(func_get_args());

       $ShowBaseIDPlusBaseLocation = PostM::ShowBaseIDPlusBaseLocation(func_get_args());



      return view('view', compact('SubAssetDeepRead','SubPostDeepList', 'allURLs', 'ShowBaseIDPlusBaseLocation'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(){
      $arguments = func_get_args();

      array_shift($arguments);
      array_shift($arguments);

      $SubPostDeepList = PostM::ShowIndirectSubPost(func_get_args());

      $SubAssetDeepRead = PostM::ShowIndirectData(func_get_args());


      $allURLs = PostM::ShowActions(func_get_args());




      return view('edit', compact('SubAssetDeepRead','SubPostDeepList', 'allURLs'));
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