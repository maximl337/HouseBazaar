<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'street',
        'city',
        'zip',
        'state',
        'country',
        'price',
        'description',
        'user_id',
        'bedrooms',
        'bathrooms',
        'size_square_feet',
        'youtube_url',
        'contact_phone_1',
        'contact_phone_2',
        'contact_email',
        'allow_comments',
        'transaction_type',
        'seller_type',
        'property_type',
        'furnished',
        'pets',
        'sample' 
    ];

    /**
     * 
     * @param  [type] $country  [description]
     * @param  [type] $zip    [description]
     * @param  [type] $street [description]
     * @return [type]         [description]
     */
    public static function locatedAt($country, $zip, $street)
    {
        $country = strtolower($country);

        $street = str_replace('-', ' ', $street);

        $zip = str_replace('', ' ', $zip);

        $published = true;

        return static::where(compact('country', 'zip', 'street', 'published'))->firstOrFail();

    }

    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }

    // public function getPriceAttribute($price)
    // {
    //     return '$' . number_format($price);
    // }

    /**
     * A property has many photos
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany;
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function ownedBy(User $user)
    {
        return $user->id == $this->user_id; 
    }

    public function path()
    {
        return '/' . $this->country . '/' . str_replace(' ', '', $this->zip) . '/' . str_replace(' ', '-', $this->street);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'property_tags')->withTimestamps();
    }
}
