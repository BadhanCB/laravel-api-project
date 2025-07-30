<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller {
  /**
   * Display a listing of the resource.
   */
  public function index() {
    //
    return "Called Get Request to get all data";
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create() {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request) {
    //
    return "Called data request to save data";
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id) {
    //
    return "Get data by id";
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id) {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id) {
    //
    return "Called Put request to update specific data";
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id) {
    //
    return "Called delete request";
  }
}
