<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemasokController extends Controller
{
	public function index()
	{
		$products = Pemasok::get();
		return response()->json([
			"success" => true,
			"message" => "List Pemasok",
			"data" => $products
		]);
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'namapemasok' => 'required|unique:pemasoks',
			'alamat' => 'required',
			'notelp' => 'required'
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$pemasok = Pemasok::create($input);
		return response()->json([
			"success" => true,
			"message" => "Pemasok Berhasil Ditambahkan.",
			"data" => $pemasok
		]);
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$pemasok = Pemasok::find($id);
		if (is_null($pemasok)) {
			return $this->sendError('Pemasok Tidak Ada.');
		}
		return response()->json([
			"success" => true,
			"message" => "Data Pemasok Berhasil Diambil",
			"data" => $pemasok
		]);
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Pemasok $pemasok)
	{
		$pemasok = Pemasok::find($pemasok->id);
		$input = $request->all();
		$validator = Validator::make($input, [
			'namapemasok' => 'required',
			'alamat' => 'required',
			'notelp' => 'required'
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$data = $pemasok->update($input);
		return response()->json([
			"success" => true,
			"message" => "Data pemasok berhasil diupdate.",
			"data" => $data
		]);
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($pemasok)
	{
		Pemasok::destroy($pemasok);
		return response()->json([
			"success" => true,
			"message" => "Data pemasok berhasil dihapus",
			"data" => $pemasok
		]);
	}
}
