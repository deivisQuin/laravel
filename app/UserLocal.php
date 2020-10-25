<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLocal extends Model
{
    protected $table = "user_local";
    protected $primaryKey = "ULId";
	protected $fillable = ["ULUsersId", "ULLocalId", "ULEstadoId"];
    
    public function estado(){
        return $this->belongsTo(Estado::class, "ULEstadoId");
    }

    public function local(){
        //return $this->belongsTo("App\Local", "ULLocalId");
        return $this->belongsTo(Local::class, "ULLocalId");
    }

    public function user(){
        return $this->belongsTo(User::class, "ULUsersId");
    }
}
	