<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'tax_amount',
        'shipping_amount',
        'grand_total',
        'status',
        'payment_status',
        'payment_method',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_zipcode',
        'shipping_country',
        'notes',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getFormattedStatusAttribute(): string
    {
        return ucfirst($this->status);
    }
    public function getFormattedPaymentStatusAttribute(): string
    {
        return ucfirst($this->payment_status);
    }
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('M d, Y');
    }
}
