<?php



namespace App\Http\Controllers;

use App\Post;

use Mail;

use Session;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use GuzzleHttp\Client;

use Croppa;

class PagesController extends Controller {



	public function getIndex (){

		$posts = Post::orderBy('created_at', 'desc')->take(4)->get();

		$vposts = Post::all()->sortByDesc('page_views')->take(4);

		$rposts = DB::select('select p.id, p.title, count(post_id) as brr, avg(rating) as aresredina from posts p inner join post_reviews pr on p.id = pr.post_id group by p.id order by aresredina desc, brr desc;');

		$pomocposts = Post::all();

		return view ('pages.welcome')->withPosts($posts)->withVposts($vposts)->withRposts($rposts)->withPomocposts($pomocposts);

	}



	public function gettac(){

		return view ('pages.terms-and-conditions');

	}



	public function getContact(){

		return view ('pages.contact');

	}

	public function store(Request $request){

		  $token = $request->input('g-recaptcha-response');

	 $this->validate($request, [

		 'name' => 'required',

		 'email' => 'required|email',

		 'message' => 'required|min:10'

	 ]);

	 if ($token){

 			$client = new Client();

 			$response = $client->post('https://www.google.com/recaptcha/api/siteverify',[

 				'form_params' => array (

 					'secret' => '6Ld961kUAAAAABgkodeR_G00Fy99sSYS7A7OkR9z',

 					'response' => $token

 				)

 			]);

 			$results = json_decode($response->getBody()->getContents());

	 $data = array (

		 'name' => $request->name,

		 'email' => $request->email,

		 'bodyMessage' => $request->message

	 );

	 Mail::send('emails.contact-message', $data, function($message) use ($data){

		 $message->from($data['email']);

		 $message->to('showyourmotorbike@gmail.com');

		 $message->subject('SYMb');

	 });

	 Session::flash('success', 'Thank you for contacting us we will get back to you soon');

	 return redirect()->back();

	}

	else {

		Session::flash('error', 'Are you a robot? :D');

		return redirect()->back();

	}

}

}

