<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Entity;
use App\Review;

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
        $old_review = Review::where(['entity_id' => $entity['id'], 'user_id' => $user['id']]);
        if(count($old_review) === 0 ){
            $new_review = new Review;
            $new_review['user_id'] = $user['id'];
            $new_review['entity_id'] = $entity['id'];
            $new_review['score'] = $request->input('score');
            $new_review->save();
            $resp['code'] = 1;
            $resp['message'] = 'Initial review submitted successfully';
        } else {
            $old_review->update(['score' => $request->input('score')]);
            $resp['code'] = 1;
            $resp['message'] = 'Review update submitted successfully';
        }
        
        //we still need to double-check to see if a user has already submitted a score
        
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
