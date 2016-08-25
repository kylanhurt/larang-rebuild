<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entity;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

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
        $request_data = $this->request->input();
        $request_data['criteria'] = $this->request->input('criteria');
        $request_data['order'] = $this->request->input('order');
        $request_data['count'] = $this->request->input('count');
        $found = DB::table('entities')->orderBy( $request_data['criteria'], $request_data['order'])->take($request_data['count'])->get();
        $found['code'] = 1;
        $found['message'] = 'Success';
        return $found;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entityName = $this->request->input('entityName');
        
        //create pretty url
        $pretty_url = entitiesController::prettify_url($this->request->input('entityName'));
        
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
            $new_entity->pretty_url = $pretty_url;
            $new_entity->save();
            if(count(Entity::where('title',$entityName)->get() === 1)) {
                $resp['new_id'] = $new_entity->id;
                $resp['entity_name'] = $entityName;
                $resp['pretty_url'] = $pretty_url;
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
    public function show(Request $request, $id) //id specifically refers to the name of this function, only input should be entityPrettyUrl
    {
        $foundEntity = Entity::where('pretty_url','=',$request->input('entityPrettyUrl'))->get()->first();
         //remove business info / vulnerable information
        unset($foundEntity->id);
        unset($foundEntity->created_by);
        $foundEntity->message = '';
        foreach($foundEntity as $k => $v) {
            if(!$v || $v === '') {
                $foundEntity[$k] = 'n/a';
            }
        }
        $foundEntity->code = 1;
        return $foundEntity;
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
            $foundSaveEntity->description = $request->input('description');
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

    public static function prettify_url($ugly_url) {
        //only prettifies, assumes entity is rejected for duplicate name
        $entity_despaced = strtolower(str_replace(" ", '-', $ugly_url));
        $entity_reduced = preg_replace('/[^a-zA-Z0-9\-\']/', '', $entity_despaced);
        $entity_dequoted = str_replace("'", '', $entity_reduced);   
        return $entity_dequoted;
    }
    
    public static function check_pretty_url($pretty_url_candidate) {
        //not yet implemented because no feature for "are you sure this has not already been submitted?"
        $entity_despaced = strtolower(str_replace(" ", '-', $pretty_url_candidate));
        $entity_reduced = preg_replace('/[^a-zA-Z0-9\-\']/', '', $entity_despaced);
        $entity_dequoted = str_replace("'", '', $entity_reduced);
        $found_existing_pretty_url = Entity::where( 'pretty_url', '=', $entity_dequoted)->get();
        $count = count($found_existing_pretty_url);
        if($count === 0) {
            return $entity_dequoted;
        } else {
            while( $iterator = 2 ) {
                $entities_found = count(Entity::where('pretty_url', '=', $entity_dequoted . '-' . $iterator)->get());
                if($entities_found !== 0) {
                    $iterator++;
                } else {
                    return $entity_dequoted . '-' . $iterator;
                }
            }
        }
    }
}
