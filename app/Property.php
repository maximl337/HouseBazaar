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
        'user_id' 
    ];

    /**
     * [scopeLocatedAt description]
     * @param  [type] $query  [description]
     * @param  [type] $zip    [description]
     * @param  [type] $street [description]
     * @return [type]         [description]
     */
    public static function locatedAt($zip, $street)
    {
        $street = str_replace('-', ' ', $street);

        return static::where(compact('zip', 'street'))->firstOrFail();

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
        return $this->zip . '/' . str_replace(' ', '-', $this->street);
    }
}
