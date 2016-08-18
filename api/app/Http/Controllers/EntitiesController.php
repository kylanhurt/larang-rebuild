<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entity;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class entitiesController extends Controller
{
    
   protected $request;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function __construct(\Illuminate\Http\Request $request)
   {
       $this->request = $request;
   }   
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entityName = $this->request->input('entityName');
        $entityWebsite = $this->request->input('entityWebsite');
        $found = Entity::where('title',$entityName)->get();
        $num = count($found);
        if($num >= 1) {
            $resp['code'] = 0;
            $resp['message'] = "We're sorry but that entity has already been submitted.";
        } elseif($num === 0) {
            $new_entity = new Entity;
            $new_entity->title = $entityName;
            $new_entity->website = $entityWebsite;
            $new_entity->save();
            if(count(Entity::where('title',$entityName)->get() === 1)) {
                $resp['new_id'] = $new_entity->id;
                $resp['code'] = 1;
                $resp['message'] = "Enity successfully submitted.";
            }
        }
        return $resp;
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
        //$resp['input'] = $request->input();
        $foundSaveEntity = Entity::find($request->input('new_id'));
        $numFound = count($foundSaveEntity);
        if($numFound === 1) {
            $foundSaveEntity->website = $request->input('website');
            $foundSaveEntity->year_founded = $request->input('year_founded');
            $foundSaveEntity->industry = $request->input('industry');
            $foundSaveEntity->location = $request->input('location');
            $foundSaveEntity->save();
            if($foundSaveEntity){
                $resp['code'] = 1;
                $resp['message'] = 'Entity update successful';
            }
            else {
                App::abort(500, 'Entity update error');
            }
        } else {
            $resp['code'] = 0;
            $resp['message'] = 'Save failed due entity ID issue';
        }
        return $resp;
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
