<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Media;
use App\Models\Product;
use App\Services\AdminActivityLogger;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()
            ->with('media')
            ->latest('id')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $media = Media::query()->latest('id')->limit(200)->get();
        return view('admin.products.create', compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->ensureUniqueSlug($data['slug']);

        $product = Product::create($data);
        AdminActivityLogger::log(
            $request->user(),
            'products',
            'create',
            'Created product: '.$product->name,
            Product::class,
            $product->id,
            ['slug' => $product->slug],
            $request
        );

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('media');
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $media = Media::query()->latest('id')->limit(200)->get();
        return view('admin.products.edit', compact('product', 'media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if (isset($data['slug']) && $data['slug'] !== $product->slug) {
            $data['slug'] = $this->ensureUniqueSlug($data['slug'], $product->id);
        }

        $product->update($data);
        AdminActivityLogger::log(
            $request->user(),
            'products',
            'update',
            'Updated product: '.$product->name,
            Product::class,
            $product->id,
            ['slug' => $product->slug],
            $request
        );

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $name = $product->name;
        $id = $product->id;
        $product->delete();
        AdminActivityLogger::log(
            request()->user(),
            'products',
            'delete',
            'Deleted product: '.$name,
            Product::class,
            $id,
            null,
            request()
        );
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function ensureUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug);
        $candidate = $base;
        $i = 2;

        while (
            Product::query()
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
