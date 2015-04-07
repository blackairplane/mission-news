<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Vote;
use Illuminate\Http\Request;
use App\Link;
use Illuminate\Support\Facades\Input;

class LinksController extends V1_APIController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $link = Link::create(array(
            'title' => Input::get('title'),
            'url' => Input::get('url'),
            'user_id' => Input::get('user_id')
        ));

        $this->output = Link::with('votes', 'user', 'comments')->orderBy('id', 'desc')->get()->take(20);
        return $this->response();
	}

    public function add_vote($id) {
        $vote = Vote::create(array(
            'link_id' => $id,
            'user_id' => 1
        ));

        $this->output = Link::with('votes', 'user', 'comments')->orderBy('id', 'desc')->get()->take(20);
        return $this->response();
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

    public function all()
    {
        $this->output = Link::with('votes', 'user', 'comments')->orderBy('id', 'desc')->get()->take(20);
        return $this->response();
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
