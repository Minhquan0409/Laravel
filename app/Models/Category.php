<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'parent_id', 'is_active', 'is_delete'];

    /**
     * Get the parent category
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get all child categories
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get all descendants (children, grandchildren, etc.)
     */
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    /**
     * Scope to get only active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get only non-deleted categories
     */
    public function scopeNotDeleted($query)
    {
        return $query->where('is_delete', false);
    }

    /**
     * Get all categories that can be selected as parent (excluding self and descendants)
     */
    public static function getAvailableParents($excludeId = null)
    {
        $query = self::where('is_delete', false);
        
        if ($excludeId) {
            // Exclude self
            $excludeIds = [$excludeId];
            
            // Get all descendants recursively
            $descendants = self::getDescendantIdsRecursive($excludeId);
            $excludeIds = array_merge($excludeIds, $descendants);
            
            $query->whereNotIn('id', $excludeIds);
        }
        
        return $query->get();
    }

    /**
     * Get all descendant IDs recursively
     */
    private static function getDescendantIdsRecursive($parentId, $ids = [])
    {
        $children = self::where('parent_id', $parentId)
            ->where('is_delete', false)
            ->pluck('id')
            ->toArray();
        
        foreach ($children as $childId) {
            $ids[] = $childId;
            $ids = self::getDescendantIdsRecursive($childId, $ids);
        }
        
        return $ids;
    }

}

