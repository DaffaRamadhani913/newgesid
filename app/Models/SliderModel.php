<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table = 'tb_slider';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'image_filename',
        'title',
        'subtitle',
        'description',
        'button_1_label',
        'button_1_link',
        'button_2_label',
        'button_2_link',
        'sort_order',
        'is_active'
    ];
}
