<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'profile',
        'password',
        'photo_path',
        'gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function isProfileCustomer()
    {
        return $this->profile == 'customer' ? true : false;
    }

    public function isProfileAdmin()
    {
        return $this->profile == 'admin' ? true : false;
    }

    public function isProfileNormal()
    {
        return $this->profile == 'normal' ? true : false;
    }

    public function profileForHumans()
    {
        $pHumans = '';
        $pHumans = $this->profile == 'customer' ? 'Cliente' : $pHumans;
        $pHumans = $this->profile == 'admin' ? 'Administrador' : $pHumans; 
        $pHumans = $this->profile == 'normal' ? 'Usuario Normal' : $pHumans; 
        
        return $pHumans;
    }

    public static function storeUser($request)
    {
        $dir = 'public/avatars';
        if ($request->hasFile('avatar')){
            $file = $request->avatar;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            //$path = $request->avatar->store('avatars');
            $request->request->add(['photo_path'=> $path]);
        }
        
        $newPassword = Hash::make($request->password);
        
        $request->request->remove('password');
        $request->request->add(['password'=> $newPassword]);

        $user = User::create($request->all());

        if($user){
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El usuario se ha creado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para crear el usuario",
            );
            request()->session()->put('status', $status);
        }

        return $user;
    }

    public static function updateUser($request, $id)
    {
        $user = User::find($id);
        $dir = 'public/avatars';

        if ($request->hasFile('avatar')){
            
            if($user->photo_path){
                Storage::delete($user->photo_path);
            }
            $file = $request->avatar;
            $path = $file->storeAs($dir, $file->getClientOriginalName());
            $request->request->add(['photo_path'=> $path]);
        }
        
        if(isset($request->password)){
            $newPassword = Hash::make($request->password);
            $request->request->remove('password');
            $request->request->add(['password'=> $newPassword]);
        }else{
            $request->request->remove('password');
        }
        
        
        
        if( $user->update($request->all())){
            
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El usuario se ha actualizado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para actualizar al usuario",
            );
            request()->session()->put('status', $status);
        }

        return $user;
    }

    public static function destroyUser($id)
    {
        $user = User::find($id);
        
        if($user->photo_path){
            Storage::delete($user->photo_path);
        }

        $user_delete = $user->delete();
        
        if( $user_delete ){
            
            $status = array(
                'time' => 4,
                'type' => "success",
                'message' => "El usuario se ha borrado correctamente.",
            );
            request()->session()->put('status', $status);

        }else{
            $status = array(
                'time' => 4,
                'type' => "danger",
                'message' => "Hay un problema para borrar al usuario",
            );
            request()->session()->put('status', $status);
        }

        return $user_delete;
    }
}
