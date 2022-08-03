<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    public function responsibleTech()
    {
        //relacionamento onde o nome da função não bate com a coluna da chave estrangeira
        return $this->belongsTo(User::class,'responsible_tech');
    }

}
