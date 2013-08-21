<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{

		$s3 = AWS::get('s3');

		$iterator = $s3->getIterator('ListObjects', array(
		'Bucket' => 'rajiv-seelam-aws-learn'
		));

		foreach ($iterator as $object) {
			$images[] = $s3->getObjectUrl('rajiv-seelam-aws-learn',$object['Key']);
		}

		return View::make('hello',compact('images'));

	}

	public function postWelcome()
	{
		$file_name = time().'_'.Input::file('image')->getClientOriginalName();
		$result =  Input::file('image')->move('uploads', $file_name);

		$s3 = AWS::get('s3');

		$s3->putObject(array(
		    'Bucket'     => 'rajiv-seelam-aws-learn',
		    'Key'        => $file_name,
		    'SourceFile' => "uploads/$file_name",
		    'ACL'		 => 'public-read'
		));

		File::delete("uploads/$file_name");

		return Redirect::to('/');
	}

}