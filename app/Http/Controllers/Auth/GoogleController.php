<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Maatwebsite\Excel\Facades\Excel;
use Google_Client;
use Google_Service_Oauth2;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;

class GoogleController extends Controller
{
    public $gClient;

    public function __construct()
    {
        $google_redirect_url = route('glogin');
        $this->gClient = new Google_Client();
        $this->gClient->setApplicationName(config('services.google.app_name'));
        $this->gClient->setClientId(config('services.google.client_id'));
        $this->gClient->setClientSecret(config('services.google.client_secret'));
        $this->gClient->setRedirectUri($google_redirect_url);
        $this->gClient->setDeveloperKey(config('services.google.api_key'));
        $this->gClient->setScopes([
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/drive',
        ]);
        $this->gClient->setAccessType('offline');
        $this->gClient->setApprovalPrompt('force');
    }

    public function googleLogin(Request $request)
    {
        $auth = Auth::user();

        if (Auth::user()->access_token === null) {
            // return $auth->access_token;
            return 'not registered';
        }

        $google_oauthV2 = new Google_Service_Oauth2($this->gClient);

        if ($request->get('code')) {
            $this->gClient->authenticate($request->get('code'));
            $request->session()->put('token', $this->gClient->getAccessToken());
        }

        if ($request->session()->get('token')) {
            $this->gClient->setAccessToken($request->session()->get('token'));
        }

        if ($this->gClient->getAccessToken()) {
            //For logged in user, get details from google using acces
            $user = Auth::user();

            $user->access_token = json_encode($request->session()->get('token'));
            // $token = $request->session()->get('token');
            // dd($token);
            // $user->access_token = $token['access_token'];
            // dd($request);
            // dd($user->access_token, $request);
            $user->save();
            // dd('Successfully authenticated');
            return redirect()
                ->back()
                ->withInput(['tab' => 'backup'])
                ->with('success', 'google dirve was authorized!, Please "CLICK" Google Drive button again to continue backup data');
        } else {
            //For Guest user, get google login url
            $authUrl = $this->gClient->createAuthUrl();

            return redirect()->to($authUrl);
        }
    }

    public function uploadFileUsingAccessToken(Request $request)
    {
        $auth = Auth::user();

        if (Auth::user()->access_token === '') {
            // return $auth->access_token;
            $google_oauthV2 = new Google_Service_Oauth2($this->gClient);

            if ($request->get('code')) {
                $this->gClient->authenticate($request->get('code'));
                $request->session()->put('token', $this->gClient->getAccessToken());
            }

            if ($request->session()->get('token')) {
                $this->gClient->setAccessToken($request->session()->get('token'));
            }

            if ($this->gClient->getAccessToken()) {
                //For logged in user, get details from google using acces
                $user = Auth::user();

                $user->access_token = json_encode($request->session()->get('token'));
                // $token = $request->session()->get('token');
                // dd($token);
                // $user->access_token = $token['access_token'];
                // dd($request);
                // dd($user->access_token, $request);
                $user->save();
                // dd('Successfully authenticated');
                return
                redirect()
                    ->back()->withInput(['tab' => 'backup'])
                    ->with('success', 'google dirve was authorized!, Please "CLICK" Google Drive button again to continue backup data');
            } else {
                //For Guest user, get google login url
                $authUrl = $this->gClient->createAuthUrl();

                return redirect()->to($authUrl);
            }
        }

        // dd($auth);
        $service = new Google_Service_Drive($this->gClient);
        $user = Auth::user();
        // dd($user);
        $this->gClient->setAccessToken(json_decode($user->access_token, true));

        if ($this->gClient->isAccessTokenExpired()) {
            // save refresh token to some variable
            $refreshTokenSaved = $this->gClient->getRefreshToken();
            // update access token
            $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);
            // // pass access token to some variable
            $updatedAccessToken = $this->gClient->getAccessToken();
            // // append refresh token
            $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
            //Set the new acces token
            $this->gClient->setAccessToken($updatedAccessToken);

            $user->access_token = $updatedAccessToken;
            $user->save();
        }

        $name = $user->name;
        // dd($name);
        $backupName = $name.time().'.csv';
        Excel::store(new UsersExport($request), 'backup/'.$backupName);
        // dd($backupName);

        $folder = 'howsit-backup'.time();
        $fileMetadata = new Google_Service_Drive_DriveFile([
            'name'     => $folder,
            'mimeType' => 'application/vnd.google-apps.folder', ]);
        $folder = $service->files->create($fileMetadata, [
            'fields' => 'id', ]);
        printf("Folder ID: %s\n", $folder->id);

        // $nameFile = 'howsit-backup'.time().'.csv';
        $file = new Google_Service_Drive_DriveFile([
            'name'    => $backupName,
            'parents' => [$folder->id],
        ]);
        $result = $service->files->create($file, [
            'data'       => file_get_contents(public_path('backup/'.$backupName)),
            'mimeType'   => 'application/octet-stream',
            'uploadType' => 'media',
        ]);
        // get url of uploaded file
        $url = 'https://drive.google.com/open?id='.$result->id;

        return
        redirect()
            ->back()->withInput(['tab' => 'backup'])
            ->with('success', 'Data backup successfully!');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect('/home');
            } else {
                $newUser = User::update([
                    'google_id' => $user->id,
                ]);

                Auth::login($newUser);

                return redirect('/home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
