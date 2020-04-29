<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a list of Services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::getList();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new Service
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.add');
    }

    /**
     * Save new Service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validatedData = request()->validate(Service::validationRules());

        $service = Service::create($validatedData);

        return redirect()->route('admin.services.index')->with([
            'type' => 'success',
            'message' => 'Service added'
        ]);
    }

    /**
     * Show the form for editing the specified Service
     *
     * @param \App\Service $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the Service
     *
     * @param \App\Service $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Service $service)
    {
        $validatedData = request()->validate(
            Service::validationRules($service->id)
        );

        $service->update($validatedData);

        return redirect()->route('admin.services.index')->with([
            'type' => 'success',
            'message' => 'Service Updated'
        ]);
    }

    /**
     * Delete the Service
     *
     * @param \App\Service $service
     * @return void
     */
    public function destroy(Service $service)
    {
        if ($service->providers()->count()) {
            return redirect()->route('admin.services.index')->with([
                'type' => 'error',
                'message' => 'This record cannot be deleted as there are relationship dependencies.'
            ]);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with([
            'type' => 'success',
            'message' => 'Service deleted successfully'
        ]);
    }
}
