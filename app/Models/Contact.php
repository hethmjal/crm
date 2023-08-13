<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone','user_id'];

    protected static function booted()
    {
       
  
      static::addGlobalScope('user',function($builder) {
            $builder->where('user_id',Auth::id());
        }); 
    }  
    
    public function scopeFilter($builder,$search)
    {

        $builder->when($search ?? '', function($builder,$value){
            $builder->where(function($builder) use ($value){
                $builder->where('name','LIKE',"%{$value}%")
                ->orWhere('email','LIKE',"%{$value}%")
                ->orWhere('phone','LIKE',"%{$value}%");
            });
            
        });
         
        
    }

}
