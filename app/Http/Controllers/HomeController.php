<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class HomeController extends Controller
{

    public function index(Request $request)
    {

        $user = Auth::user();

        if ($request->has('order_by')) {
            $articles = Article::orderBy($request->get('order_by'), $request->get('order'))->paginate(5);
        } else {
            $articles = Article::orderBy('id', 'desc')->paginate(5);
        }

        return view('site.index')
            ->with([
                'user' => $user,
                'articles' => $articles
            ]);

    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }


    public function create(ArticleRequest $request)
    {
        $data = $request->except('_token');

        $user = User::where('name', $request->user_name)->first();
        $data['user_id'] = $user->id;
        $data['text'] = strip_tags($request['text'], '<a></a>><code></code><i></i><strong></strong>');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $format = '.' . explode(".", $request['file']->getClientOriginalName())[1];
            $filename = time() . '-' . $user->id . $format;
            $destinationPath = public_path('/uploads');


            if ($format != '.txt') {
                $img = Image::make($file->getRealPath());
                $img->resize(320, 240, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $filename);
            } else if ($format == '.txt') {
                Storage::disk('public')->put($filename, File::get($file));
            }
            $data['file'] = $filename;
        }


        Article::create($data);

        return back();
    }

    public function show_attachment(Request $request)
    {
        $article = Article::find($request->article_id);
        $filename = $article->showFile;
        if(!empty($filename)) {
            $format = explode('.', $filename)[1];

            if ($format != 'txt') {
                return '<img src=" ' . $article->showFile . '">';
            } elseif ($format == 'txt') {
                $content = file_get_contents(public_path() . '/' . $filename);


                $enclist = array(
                    'UTF-8', 'ASCII',
                    'Windows-1251', 'Windows-1252', 'Windows-1254',
                );

                $current_encoding = mb_detect_encoding($content, $enclist, true);
                return iconv($current_encoding, 'UTF-8', $content);
            }
        }

        return null;
    }
}
