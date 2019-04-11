<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Poster;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;

class PosterController extends Controller
{
	public function __construct()
    {
        //$this->middleware('auth');
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
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'message' => 'required|string|max:255',
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *@return \Illuminate\Http\Response
     */
    public function create()
    {
		if ( Auth::check() ) {
			return view('forms.poster', ['title'=>'Добавление поста']);
		} else {
			return view('forms.notauth');
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$data = [
    		'lat' => $request->input('lat'),
            'lon' => $request->input('lon'),
            'message' => $request->input('msg'),
            'user_id' => auth()->user()->id,
			'status' => 1,
    	];
  
    	if ($this->validator($data)->fails()) {
		   return response()->json($this->validator($data)->errors(), 412);
		}
		
		$poster = Poster::create($data);
		if ($poster->id) {
			$files = $request->file('file');
			if (!empty($files)) {
				foreach ($files as $file)  {
					$image = new ImageController;
					$image->addImages($file, $poster->id, 'App\Poster');
				}
			}
		}
		
		return  $poster;
    }

    /**
     * получаем посты
	 *
	 * $status(1-новые, 2-одобреные, 3-отклоненые)
     */
    public function show($status = null)
    {
        $posters = Poster::select('id','message','lat','lon', 'user_id', 'status');

        if ($status) {
			$posters->where('status', $status);
		}

		$posters->orderBy('created_at', 'desc');

		$posters = $posters->get();

        foreach ($posters as $k=>$post) {
			$images = $post->images;
			$user = $post->user;
		}

		if(request()->ajax()) {
			return response()->json($posters, 200);
		}

		if (request()->getPathInfo() == '/admin') {
			return view('admin.admin', ['posters'=>$posters]);
		}

		return $posters;
    }

    function getPosterById($id) {
		$poster = Poster::find($id);

		$images = $poster->images;
		$user = $poster->user;
		$poster['title'] = 'Информация';

		if(request()->ajax()) {
			return view('forms.posterinfo', $poster);
		}

		return view('forms.posterinfo');
	}
    
    /**
     * Устанавливает статус поста
     */
    public function setStatus($id, $status)
    {
		$poster = Poster::find($id)->update(['status' => $status]);

		if(request()->ajax()) {
			return response()->json($poster, 200);
		}
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
