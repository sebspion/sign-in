<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 26/12/16
 * Time: 12:26
 */

namespace App\Http\Controllers;


use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller {
	public function index() {
		$member = Auth::user();

		return view('app.profil', ['member' => $member]);
	}

	public function update(Request $request) {
		/** @var User $member */
		$member = Auth::user();

		$validator = Validator::make($request->all(), [
			'username' => 'required|max:255|unique:users,username,' . $member->id,
			'new_password' => 'min:8',
			'lastName' => 'required',
			'firstName' => 'required',
			'date_of_birth' => 'required|date_format:d/m/Y',
			'address' => 'required',
			'postcode' => 'required',
			'city' => 'required',
			'country' => 'required',
			'phone' => 'required',
		], [
			'new_password.min' => 'Le mot de passe doit contenir au moins :min caractères',
			'new_password.regex' => 'hello'
		]);

		// password validation
		$validator->after(function($validator) use ($request, $member) {
			// one field is filled but not the other
			if($request->get('old_password') && ! $request->get('new_password')) {
				$validator->errors()->add('new_password', 'Si vous voulez changer de mot de passe, il faut le définir');

				return;
			}
			// one field is filled but not the other
			if( ! $request->get('old_password') && $request->get('new_password')) {
				$validator->errors()->add('old_password', 'Remplissez votre mot de passe actuel');

				return;
			}

			if($request->get('old_password') && $request->get('new_password')) {
				// Old password don't match
				if( ! Hash::check($request->get('old_password'), $member->getAuthPassword())) {
					$validator->errors()->add('old_password', 'Ce mot de passe ne correspond pas à votre mot de passe actuel');
				}

				// OK !
				$member->password = Hash::make($request->get('new_password'));
			}
		});

		// validate
		if($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

		// change date format
		$request->merge(array(
			'date_of_birth' => Carbon::createFromFormat('d/m/Y', $request->get('date_of_birth'))->toDateTimeString(),
		));

		if($request->get('username') != $member->username) {
			$member->username = $request->get('username');
		}

		$member->update($request->all());

		return back()->with([
			'message' => 'Votre profil a été mis à jour.',
			'status' => 'success'
		]);
	}
}