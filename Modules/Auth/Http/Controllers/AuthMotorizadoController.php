<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\UserMoto as User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use DB;

class AuthMotorizadoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('auth::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('auth::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::with('empleado')->where('usuario', $loginData['email'])->where( 'pass', md5( $loginData['password'] ) )->where('id_perfil', 3)->first();

        if ( !$user ) {
            return response_data([], Response::HTTP_INTERNAL_SERVER_ERROR, 'Credenciales Incorrectas.');
        }

        return response_data([ 
            'username' => $user->usuario, 
            'token' => null,
            'empleado' => [
                'nombres' => $user->empleado->name,
                'ci_empleado' => $user->empleado->ci_empleado
            ]
        ], Response::HTTP_OK, 'Login correctamente.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $user = User::where('id_sg', $id)->first();
        $password = md5( 'holamudno');
        return response_data($password, Response::HTTP_CREATED, 'Usuario actualizado exitosamente.' );
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('auth::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {

            $user = User::where('usuario', $request->cedula)->first();
            
            if ( !isset( $user ) ) :
                throw new \ErrorException( 'Cliente no se encuentra registrado' );
            endif;

            $password = md5( $request->password );

            $user->update([ 'pass' => $password ]);

            DB::commit();
            return response_data($user, Response::HTTP_CREATED, 'Usuario actualizado exitosamente.' );
            
        } catch (\Exception $e) {
            DB::rollback(); 
            return response_data(null, Response::HTTP_INTERNAL_SERVER_ERROR , $e->getMessage() );            
        }        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
