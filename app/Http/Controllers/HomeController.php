<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    // banner identificator
    private $bannerId = 1;

    public function home()
    {
        return view('home', ['url' => '', 'bannerHit' => Redis::get('banner:' . $this->bannerId)]);
    }
    
    public function generateShortlink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|active_url',
            ],
            [
                'required' => 'Введите url!',
                'active_url' => 'Введите правильный url!',
            ]);


        $validator->after(function($validator) {
            $input = $validator->getData();
            if (DB::table('test_shortlink')->where(['hash' => md5($input['url'])])->count() > 0) {
                $validator->errors()->add('url', 'URL yже существует!');
            }
        });

        $validator->validate();

        $url = $request->input('url');

        do {
            $shortlink = md5($url . time());
            $shortlink = substr($shortlink, rand(0, 28), 4);

        } while (DB::table('test_shortlink')->where(['shortlink' => $shortlink])->count() > 0);
        
        DB::table('test_shortlink')->insert(['shortlink' => $shortlink, 'url' => $url, 'hash' => md5($url)]);

        return view('home', ['url' => $shortlink, 'bannerHit' => Redis::get('banner:' . $this->bannerId)]);
    }

    public function shortlinkRedirect($shortlink)
    {
        $url = DB::table('test_shortlink')->where('shortlink', (string) $shortlink)->value('url');

        return redirect()->to($url);
    }

    public function banner()
    {
        $banner = Redis::get('banner:' . $this->bannerId);

        if (empty($banner)) {
            Redis::set('banner:' . $this->bannerId, 1);
        } else {
            Redis::command('INCR', ['banner:' . $this->bannerId]);
        }

        $filePath = storage_path() . '/banners/banner.png';

        return response()->file($filePath);
    }
}
