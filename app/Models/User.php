<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'password',
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
        'confirmed' => 'boolean'
    ];


    public function ensureUserHasRole($role)
    {
        // return User::where('user_type', $role)->where('id', Auth::id())->first();
        $roles = explode("|", $role);
        return in_array($this->user_type, $roles);
        // return $this->user_type == $role;
    }

    public function getUserType()
    {
        return $this->user_type;
    }

    public function operatorProfile()
    {
        if ($this->getUserType() == 'company') {
            return $this->hasOne(CompanyProfile::class, 'user_id');
        }else {
            return $this->hasOne(FreelancerProfile::class, 'user_id');
        }
    }

    public function user_services()
    {
        return $this->hasMany(UserServices::class, 'user_id');
    }

    public function chatMsgs()
    {
        return $this->hasMany(ChatMessagesModel::class, 'recipient_user_id');
    }


    public function chatMsgsSn()
    {
        return $this->hasMany(ChatMessagesModel::class, 'sender_user_id');
    }

    public function user_rates()
    {
        $value = $this->hasMany(UserRatingModel::class, 'rated_user_id', 'id')->get()->avg('rating_value');
        return intval(round($value));
    }


    public function rates()
    {
        return $this->hasMany(UserRatingModel::class, 'rated_user_id', 'id');
    }

    public function ratesR()
    {
        return $this->hasMany(UserRatingModel::class, 'rater_user_id', 'id');
    }
    public function jobs()
    {
        return $this->hasMany(JobsModel::class, 'user_id');
    }

    public function Service_requests()
    {
        return $this->hasMany(ServiceRequests::class, 'user_id');
    }

    public function operator_bio()
    {
        return $this->operatorProfile->bio_text ? true : false;
    }

    public function active_status()
    {
        return $this->confirmed;
    }

    public function billing_status()
    {
        return $this->iban_code ? true : false;
    }

    public function user_portfolio()
    {
        return $this->hasMany(UserPortfolio::class, 'user_id');
    }

    function calculate_profile($refreshData = false)
    {
        // if (!$profile) {
        //     return 0;
        // }
        // $columns_operatorProfile    = preg_grep('/(.+ed_at)|(.*id)/', array_keys($this->operatorProfile->toArray()), PREG_GREP_INVERT);
        // $columns_user   = preg_grep('/(.+ed_at)|(.*id)/', array_keys($this->toArray()), PREG_GREP_INVERT);
        // $columnsToCalc = array_merge($this->toArray(), $this->operatorProfile->toArray());
        // dd($columnsToCalc);
        // dd($this->toArray());

        if ($refreshData) {
            // $this->operatorProfile->fresh();
            $this->refresh();
        }

        $columnsUser = [
            'name',
            'email',
            'profile_img',
            'phone_number',
            'iban_code',
        ];
        if ($this->user_type == 'user') {
            $UserOnlyColumns = [
                'nationality',
                'country_id'
            ];
            $columnsUser = array_merge($columnsUser, $UserOnlyColumns);
        }
        // dd($columnsUser);
        $columnsProfile = [];
        if ($this->user_type == 'company') {

            $columnsProfile = [
                "licensenumber",
                "license_copy",
                "address",
                "owner_name",
                "contact_person_name",
                "bio_text"
            ];
        } else if ($this->user_type == 'freelancer') {
            $columnsProfile = [
                "membershipId",
                "membership_copy",
                "address",
                "bio_text"
            ];
        }

        $columns = array_merge($columnsUser, $columnsProfile);
        // dd($columns);
        $per_column = 100 / count($columns);
        $total      = 0;
        if ($this->user_type == 'user') {
            $profileData = $this->toArray();
        } else {

            $profileData = array_merge($this->toArray(), $this->operatorProfile->toArray());
        }
        // dd($profileData);
        foreach ($profileData  as $key => $value) {
            if ($value !== NULL && $value !== [] && in_array($key, $columns)) {
                $total += $per_column;
            }
        }
        // dd($total);
        return round($total);
    }
}
