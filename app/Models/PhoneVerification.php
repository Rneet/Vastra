<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PhoneVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'otp',
        'expires_at',
        'verified',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified' => 'boolean',
    ];

    /**
     * Generate a random OTP code.
     *
     * @return string
     */
    public static function generateOtp(): string
    {
        return (string) rand(100000, 999999);
    }

    /**
     * Check if the OTP has expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return Carbon::now()->isAfter($this->expires_at);
    }

    /**
     * Create or update a verification record.
     *
     * @param string $phone
     * @return PhoneVerification
     */
    public static function createOrUpdateVerification(string $phone): PhoneVerification
    {
        $otp = self::generateOtp();
        $expiresAt = Carbon::now()->addMinutes(10);

        return self::updateOrCreate(
            ['phone' => $phone],
            [
                'otp' => $otp,
                'expires_at' => $expiresAt,
                'verified' => false,
            ]
        );
    }
}
