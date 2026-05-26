<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Services\AdminActivityLogger;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::query()
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->ensureUniqueSlug($data['slug']);

        $service = Service::create($data);
        AdminActivityLogger::log(
            $request->user(),
            'services',
            'create',
            'Created service: '.$service->title,
            Service::class,
            $service->id,
            ['slug' => $service->slug],
            $request
        );

        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->validated();

        if (isset($data['slug']) && $data['slug'] !== $service->slug) {
            $data['slug'] = $this->ensureUniqueSlug($data['slug'], $service->id);
        }

        $service->update($data);
        AdminActivityLogger::log(
            $request->user(),
            'services',
            'update',
            'Updated service: '.$service->title,
            Service::class,
            $service->id,
            ['slug' => $service->slug],
            $request
        );

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $title = $service->title;
        $id = $service->id;
        $service->delete();
        AdminActivityLogger::log(
            request()->user(),
            'services',
            'delete',
            'Deleted service: '.$title,
            Service::class,
            $id,
            null,
            request()
        );
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    private function ensureUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug);
        $candidate = $base;
        $i = 2;

        while (
            Service::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = $base.'-'.$i;
            $i++;
        }

        return $candidate;
    }
}
