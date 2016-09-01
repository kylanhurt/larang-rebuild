<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Entity;
use App\Review;
use App\Criteria;

use App\Http\Requests;

class ReviewsController extends Controller
{
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

        $user = User::where('email',$request->input('user_email'))->first();
        $entity = Entity::where('pretty_url', $request->input('pretty_url'))->first();
        $criteria = Criteria::where('name', $request->input('criteria'))->first();
        $review = Review::firstOrNew(['entity_id' => $entity['id'], 'user_id' => $user['id'], 'criteria_id' => $criteria['id']]);
        $review->update(['entity_id' => $entity['id'], 'user_id' => $user['id'], 'criteria_id' => $criteria['id']]);
        
        //we still need to double-check to see if a user has already submitted a score
        $resp['review'] = $review;   
        $resp['code'] = 1;
        $resp['message'] = 'Review update submitted successfully';        
        
        return $resp;
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
