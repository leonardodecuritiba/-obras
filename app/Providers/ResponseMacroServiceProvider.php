<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider {
	/**
	 * Register the application's response macros.
	 *
	 * @return void
	 */
	public function boot() {
		Response::macro( 'success', function ( $type, $entity, $route = null, $data = null ) {
			$message  = trans( 'messages.crud.' . $entity->sex . '.' . strtoupper( $type ) . '.SUCCESS', [ 'name' => $entity->name ] );
			$response = new JsonResponse( [
				'type'    => 'success',
				'errors'  => false,
				'message' => $message,
				'data'    => $data,
			], 200 );
			if ( Request::is( 'api/*' ) ) {
				return $response;
			} else {
				if ( $route != null ) {
					session()->forget( 'success' );
					session( [ 'success' => $message ] );

					return is_array( $route ) ? Redirect::route( $route[0], $route[1] ) : Redirect::route( $route );
				}

				return $response;
			}

		} );

		Response::macro( 'info', function ( $data, $message ) {
			$response = new JsonResponse( [
				'type'    => 'info',
				'errors'  => false,
				'message' => $message,
				'data'    => $data,
			], 200 );
			session()->forget( 'info' );
			session( [ 'info' => $response ] );

			return $response;
		} );

		Response::macro( 'error', function ( $message, $status = 400 ) {
			$response = new JsonResponse( [
				'type'    => 'error',
				'errors'  => true,
				'message' => $message,
			], $status );
			session()->forget( 'error' );
			session( [ 'error' => $response ] );

			return $response;
		} );


		Response::macro( 'return', function ( $route, $page_response, $data = null ) {
			if ( Request::is( 'api/*' ) ) {
				return new JsonResponse( [
					'PageResponse',
					$page_response,
					'Data',
					$data
				], 200 );
			} else {
				return view( $route )
					->with( 'PageResponse', $page_response )
					->with( 'Data', $data );
			}
		} );

		Response::macro( 'request', function ( $errors ) {
			if ( Request::is( 'api/*' ) ) {
				$content = [
					'status'   => 0,
					'response' => $errors
				];

				return new JsonResponse( $content, 422 );
			} else {
				return Redirect::back()->withErrors( $errors )->withInput();
			}
		} );
	}
}