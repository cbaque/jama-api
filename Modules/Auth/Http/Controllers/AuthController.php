<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use DB;

class AuthController extends Controller
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
	public function create(Request $request)
	{
		$validacion = $request->validate([
			'name' => 'required|max:255',
			'email' => 'required|unique:users',
			'password' => 'required'
		]);

		$validacion['password'] = Hash::make( $request->password );
		$user = User::create( $validacion );
		$token = $user->createToken('authToken')->accessToken;

		return response_data([ 
			'usuario' => $user,                    
			'token' => $token, 
		], Response::HTTP_CREATED , 'Usuario '. $request->name .' creado correctamente.');        
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

		if ( ! auth()->attempt( $loginData ) ) {
			return response_data([], Response::HTTP_INTERNAL_SERVER_ERROR, 'Credenciales Incorrectas.');
		}
		
		$token = auth()->user()->createToken('authToken')->accessToken;

		return response_data([ 
			'username' => auth()->user()->name, 
			'token' => $token,
			'cliente' => [
				'nombres' => auth()->user()->cliente->name,
				'direccion' => auth()->user()->cliente->direccion,
				'celular' => auth()->user()->cliente->tlf_celular,
				'email' => auth()->user()->cliente->correo_cli, 
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
		return view('auth::show');
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
	public function update(Request $request)
	{

		try {

			$user = User::where('ci_cliente', $request->cedula)->first();
			
			if ( !isset( $user ) ) :
				throw new \ErrorException( 'Cliente no se encuentra registrado' );
			endif;

			$password = Hash::make( $request->password );
			$user->update([ 'password' => $password ]);

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


	public function generate(Request $request)
	{
		$password= isset($request->password) ? $request->password : null;
		$password   = Hash::make( $password );

		return response_data( [ 'password' => $password ], Response::HTTP_CREATED, '' );
	}     
}
