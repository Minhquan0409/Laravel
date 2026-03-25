<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category_id');

        $products = Product::query()
            ->where('is_delete', false)
            ->with('category')
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::where('is_delete', false)
            ->orderBy('name')
            ->get();

        return view('admin.product.index', [
            'products' => $products,
            'categories' => $categories,
            'keyword' => $keyword,
            'categoryId' => $categoryId,
        ]);
    }

    /**
     * Hiển thị form thêm mới sản phẩm
     */
    public function create()
    {
        $categories = Category::where('is_delete', false)
            ->orderBy('name')
            ->get();

        return view('admin.product.create', ['categories' => $categories]);
    }

    /**
     * Lưu sản phẩm mới vào database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['nullable', Rule::exists('categories', 'id')],
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if (!empty($validated['category_id'])) {
            $existsActiveCategory = Category::where('id', $validated['category_id'])
                ->where('is_delete', false)
                ->exists();

            if (!$existsActiveCategory) {
                return back()
                    ->withErrors(['category_id' => 'Danh mục không tồn tại hoặc đã bị xóa.'])
                    ->withInput();
            }
        }

        Product::create([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'is_active' => $request->has('is_active'),
            'is_delete' => false,
        ]);

        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được thêm thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa sản phẩm
     */
    public function edit($id)
    {
        $product = Product::where('is_delete', false)->findOrFail($id);
        $categories = Category::where('is_delete', false)
            ->orderBy('name')
            ->get();

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Cập nhật sản phẩm trong database
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => ['nullable', Rule::exists('categories', 'id')],
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        if (!empty($validated['category_id'])) {
            $existsActiveCategory = Category::where('id', $validated['category_id'])
                ->where('is_delete', false)
                ->exists();

            if (!$existsActiveCategory) {
                return back()
                    ->withErrors(['category_id' => 'Danh mục không tồn tại hoặc đã bị xóa.'])
                    ->withInput();
            }
        }

        $product = Product::where('is_delete', false)->findOrFail($id);
        $product->update([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    /**
     * Xóa mềm sản phẩm
     */
    public function destroy($id)
    {
        $product = Product::where('is_delete', false)->findOrFail($id);
        $product->update(['is_delete' => true]);

        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }

    /**
     * Alias method cho create (giữ lại để tương thích với route cũ)
     */
    public function add()
    {
        return $this->create();
    }
}
