<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Pharaonic\Laravel\Images\HasImages; 

class Post extends Model
{
    use HasFactory, Sluggable, HasImages;
    //protected $guarded = [];
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'type',
    ];
    
    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get all of the category for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category()
    {
        return $this->hasManyThrough(
            Category::class, 
            Post_category::class,
            'post_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'category_id' // Local key on the environments table..
        );
    }
    /**
     * Get all of the tag for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tag()
    {
        return $this->hasManyThrough(
            Tag::class, 
            Post_tag::class,
            'post_id', // Foreign key on the environments table...
            'id', // Foreign key on the deployments table...
            'id', // Local key on the projects table...
            'tag_id' // Local key on the environments table..
        );
        return $this->hasMany(tag::class);
    }
    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
        //return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
