<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\Facades\Image;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theme = Theme::findOrFail(1);
        return view('theme.index', [
            'theme' => $theme,
        ]);
    }
    public function time()
    {
        $theme = Theme::findOrFail(1);
        return view('theme.time', [
            'theme' => $theme,
        ]);
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
    public function update(Request $request)
    {
        $path = base_path('.env');
        $test = file_get_contents($path);

        if (file_exists($path)) {
            if ($request->live) {
                $test = str_replace(["SSLCZ_STORE_ID=bangl6362104f9019c","SSLCZ_STORE_PASSWORD=bangl6362104f9019c@ssl","SSLCZ_TESTMODE=true", "IS_LOCALHOST=true"], ["SSLCZ_STORE_ID=commwardlive","SSLCZ_STORE_PASSWORD=624D5711684E252112","SSLCZ_TESTMODE=false", "IS_LOCALHOST=false"], $test);
            } else {
                $test = str_replace(["SSLCZ_STORE_ID=commwardlive","SSLCZ_STORE_PASSWORD=624D5711684E252112","SSLCZ_TESTMODE=false", "IS_LOCALHOST=false"], ["SSLCZ_STORE_ID=bangl6362104f9019c","SSLCZ_STORE_PASSWORD=bangl6362104f9019c@ssl","SSLCZ_TESTMODE=true", "IS_LOCALHOST=true"], $test);
            }

            file_put_contents($path, $test);
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
        }

        $update_data = Theme::findOrFail(1);
        $previous_app_name= $update_data->name;

        if ($request->hasFile('logo')) {
            $img = $request->file('logo');
            $logo = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(public_path('assets/img/') . $logo);
            if ($update_data->logo=='logo.png') {

            } else {
                unlink(public_path('assets/img/' . $request->old_logo));
                // unlink('assets/img/' . $request->old_logo);
            }

        } else {
            $logo = $request->old_logo;
        }

        if ($request->hasFile('background')) {
            $img = $request->file('background');
            $background = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(public_path('assets/img/') . $background);
            if ($update_data->background=='background.jpg') {

            } else {
                unlink(public_path('assets/img/' . $request->old_background));
                // unlink('assets/img/' . $request->old_background);
            }

        } else {
            $background = $request->old_background;
        }

        if ($request->hasFile('iconbg')) {
            $img = $request->file('iconbg');
            $iconbg = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(public_path('assets/img/') . $iconbg);
            if ($update_data->iconbg=='icon_bg.png') {

            } else {
                unlink(public_path('assets/img/' . $request->old_iconbg));
                // unlink('assets/img/' . $request->old_background);
            }

        } else {
            $iconbg = $request->old_iconbg;
        }

        if ($request->hasFile('favicon')) {
            $img = $request->file('favicon');
            $favicon = md5(time() . rand()) . '.' . $img->clientExtension();
            $inter = Image::make($img->getRealPath());
            $inter->filesize();
            $inter->save(public_path('assets/img/') . $favicon);
            if ($update_data->favicon=='favicon.ico') {

            } else {
                unlink(public_path('assets/img/' . $request->old_favicon));
                // unlink('assets/img/' . $request->old_favicon);
            }

        } else {
            $favicon = $request->old_favicon;
        }

        $update_data->update([
            'title' => $request->title,
            'close' => $request->close,
            'footer' => $request->footer,
            'name' => $request->name,
            'url' => $request->url,
            'amount' => $request->amount,
            'logo' => $logo,
            'background' => $background,
            'favicon' => $favicon,
            'iconbg' => $iconbg,
        ]);
        // $path = base_path('.env');
        // $test = file_get_contents($path);

        if (file_exists($path)) {
            file_put_contents($path, str_replace("APP_NAME='".$previous_app_name."'", "APP_NAME='".$request->name."'", $test));
        }
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        return back()->with('success', 'Setting Updated Successfully');
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
    public function authenticateTheme(Request $request)
    {
        $password = $request->input('password');

        // Replace 'your_password' with the actual password you want to use
        $correctPassword = '246801';

        if ($password === $correctPassword) {
            // Password is correct, create a session
            session(['authenticatedTheme' => true]);
            return back();
        } else {
            // Password is incorrect, show the form with an error message
            return back()->with('danger', 'Incorrect password. Please try again.');
        }
    }
    public function authenticateTime(Request $request)
    {
        $password = $request->input('password');

        // Replace 'your_password' with the actual password you want to use
        $correctPassword = '12356790';

        if ($password === $correctPassword) {
            // Password is correct, create a session
            session(['authenticatedTime' => true]);
            return back();
        } else {
            // Password is incorrect, show the form with an error message
            return back()->with('danger', 'Incorrect password. Please try again.');
        }
    }
}
