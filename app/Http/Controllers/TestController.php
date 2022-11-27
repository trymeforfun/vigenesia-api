<?php

namespace App\Http\Controllers;

use App\Models\Motivasi;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Email yang anda masukkan salah atau belum terdaftar.'
                ], 400);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Password yang anda masukkan salah!'
                ], 400);
            }

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Email yang anda masukkan salah atau belum terdaftar.'
                ], 400);
            }

            return response()->json([
                "is_active" => auth()->user()->is_active == 1 ? true : false,
                "message" => "login successful",
                "data" => auth()->user()
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'code' => 500,
                'message' => $error->getMessage(),
                'data' => $error,
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {

            $request->validate(
                [
                    'nama' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'password' => 'required|string|min:8',
                    'profesi' => 'required',
                ]
            );

            $userExists = User::where('email', $request->email)->exists();
            if ($userExists) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Error in Register: Email has been registered!',
                ], 400);
            }

            $userExists = User::where('email', $request->email)->exists();
            if ($userExists) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Error in Register: Email has been registered!',
                ], 400);
            }

            Auth::login($user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'profesi' => $request->profesi,
                'password' => Hash::make($request->password),
                'role_id' => 1,
                'is_active' => 1,
                'tanggal_input' => date('d-m-Y'),
                'modified' => date('d-m-Y'),
            ]));

            return response()->json([
                "is_active" => auth()->user()->is_active,
                "message" => "register successful",
                "data" =>   auth()->user()
            ], 200);
        } catch (Exception $error) {
            return null;
            // return response()->json([
            //     'code' => 500,
            //     'message' => 'Error in Register' . $error->getMessage(),
            //     'data' => $error,
            // ], 500);
        }
    }

    public function storeMotivasi(Request $request)
    {
        try {
            $motivasi = new Motivasi;
            $motivasi->iduser = $request->iduser;
            $motivasi->isi_motivasi = $request->isi_motivasi;
            $motivasi->save();

            return response()->json([
                Motivasi::all()
            ], 200);
        } catch (\Throwable $th) {
            // return response()->json([
            //     "message" => $th->getMessage(),
            // ], 500);
            return null;
        }
    }

    public function getMotivasiByUserId(Request $request)
    {
        try {
            $params = $request->except('_token');
            if (array_key_exists("iduser", $params)) {
                # code...
                $motivasi = Motivasi::where("iduser", $params['iduser'])->get();
            } else {
                $motivasi = Motivasi::all();
            }
            return response()->json($motivasi, 200);
        } catch (\Throwable $th) {
            // return response()->json([
            //     "message" => $th->getMessage
            // ], 500);
            return null;
        }
    }

    public function putMotivasi(Request $request)
    {
        try {
            $motivasi = Motivasi::find($request->id);
            $motivasi->isi_motivasi = $request->isi_motivasi;
            $motivasi->save();

            return response()->json([
                "message" => "data updated successfully"
            ], 200);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function deleteMotivasi(Request $request)
    {
        //code...
        // return $request->id;
        // return Motivasi::find($request->id);
        $motivasi = Motivasi::where("id", $request->id)->delete();
        return response()->json([
            "motivasi" => $motivasi,
            "id" => $request->id
        ], 200);
    }
}
