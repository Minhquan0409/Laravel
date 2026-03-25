<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách danh mục
     */
    public function index()
    {
        $categories = Category::where('is_delete', false)
            ->with('parent')
            ->orderBy('name')
            ->get();
        
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Hiển thị form thêm mới danh mục
     */
    public function create()
    {
        $parentCategories = Category::getAvailableParents();
        return view('admin.category.create', ['parentCategories' => $parentCategories]);
    }

    /**
     * Lưu danh mục mới vào database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean',
        ]);

        // Kiểm tra parent_id có tồn tại không (nếu được chọn)
        if ($request->parent_id) {
            $parent = Category::find($request->parent_id);
            if (!$parent || $parent->is_delete) {
                return back()->withErrors(['parent_id' => 'Danh mục cha không tồn tại hoặc đã bị xóa.'])->withInput();
            }
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'parent_id' => $request->parent_id ?: null,
            'is_active' => $request->has('is_active') ? true : false,
            'is_delete' => false,
        ]);

        return redirect()->route('category.index')->with('success', 'Danh mục đã được thêm thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa danh mục
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        
        // Lấy danh sách parent có thể chọn (loại trừ chính nó và con cháu)
        $parentCategories = Category::getAvailableParents($id);
        
        return view('admin.category.edit', [
            'category' => $category,
            'parentCategories' => $parentCategories
        ]);
    }

    /**
     * Cập nhật danh mục trong database
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean',
        ]);

        // Kiểm tra parent_id không được là chính nó
        if ($request->parent_id == $id) {
            return back()->withErrors(['parent_id' => 'Danh mục không thể là con của chính nó.'])->withInput();
        }

        // Kiểm tra parent_id không được là con cháu của nó
        if ($request->parent_id) {
            $descendantIds = $this->getDescendantIds($id);
            if (in_array($request->parent_id, $descendantIds)) {
                return back()->withErrors(['parent_id' => 'Danh mục không thể là con của một danh mục con cháu của nó.'])->withInput();
            }

            // Kiểm tra parent có tồn tại không
            $parent = Category::find($request->parent_id);
            if (!$parent || $parent->is_delete) {
                return back()->withErrors(['parent_id' => 'Danh mục cha không tồn tại hoặc đã bị xóa.'])->withInput();
            }
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'parent_id' => $request->parent_id ?: null,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('category.index')->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    /**
     * Xóa mềm danh mục
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Kiểm tra xem có danh mục con không
        $hasChildren = Category::where('parent_id', $id)
            ->where('is_delete', false)
            ->exists();
        
        if ($hasChildren) {
            return redirect()->route('category.index')
                ->with('error', 'Không thể xóa danh mục này vì còn danh mục con.');
        }

        // Xóa mềm
        $category->update(['is_delete' => true]);

        return redirect()->route('category.index')->with('success', 'Danh mục đã được xóa thành công!');
    }

    /**
     * Alias method cho create (giữ lại để tương thích)
     */
    public function add()
    {
        return $this->create();
    }

    /**
     * Get all descendant IDs recursively
     */
    private function getDescendantIds($parentId, $ids = [])
    {
        $children = Category::where('parent_id', $parentId)
            ->where('is_delete', false)
            ->pluck('id')
            ->toArray();
        
        foreach ($children as $childId) {
            $ids[] = $childId;
            $ids = $this->getDescendantIds($childId, $ids);
        }
        
        return $ids;
    }
}

