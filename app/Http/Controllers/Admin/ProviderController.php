<?php

namespace App\Http\Controllers\Admin;

use App\Provider;
use App\Service;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    /**
     * Display a list of Providers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::getList();

        return view('admin.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new Provider
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('admin.providers.add', compact('services'));
    }

    /**
     * Save new Provider
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validatedData = request()->validate(Provider::validationRules());

        $validatedData['password'] = bcrypt($validatedData['password']);
        unset($validatedData['services']);
        $provider = Provider::create($validatedData);

        $provider->services()->sync(request('services'));

        return redirect()->route('admin.providers.index')->with([
            'type' => 'success',
            'message' => 'Provider added'
        ]);
    }

    /**
     * Show the form for editing the specified Provider
     *
     * @param \App\Provider $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $services = Service::all();

        $provider->services = $provider->services->pluck('id')->toArray();

        return view('admin.providers.edit', compact('provider', 'services'));
    }

    /**
     * Update the Provider
     *
     * @param \App\Provider $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Provider $provider)
    {
        $validatedData = request()->validate(
            Provider::validationRules($provider->id)
        );

        $validatedData['password'] = bcrypt($validatedData['password']);
        unset($validatedData['services']);
        $provider->update($validatedData);

        $provider->services()->sync(request('services'));

        return redirect()->route('admin.providers.index')->with([
            'type' => 'success',
            'message' => 'Provider Updated'
        ]);
    }

    /**
     * Delete the Provider
     *
     * @param \App\Provider $provider
     * @return void
     */
    public function destroy(Provider $provider)
    {
        if ($provider->services()->count()) {
            return redirect()->route('admin.providers.index')->with([
                'type' => 'error',
                'message' => 'This record cannot be deleted as there are relationship dependencies.'
            ]);
        }

        $provider->delete();

        return redirect()->route('admin.providers.index')->with([
            'type' => 'success',
            'message' => 'Provider deleted successfully'
        ]);
    }
}
