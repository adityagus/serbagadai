<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public $timestamps = false;
    protected $table = 'config';

    protected $fillable = [
        'title',
        'logo',
        'logoSecond',
        'icon',
        'email',
        'phone',
        'address',
        'about',
        'slider',
        'facebook',
        'instagram',
        'whatsapp',
    ];

    const FORM_FIELD = [
        'title' => 'text',
        'email' => 'text',
        'phone' => 'text',
        'facebook' => 'text',
        'instagram' => 'text',
        'twitter' => 'text',
        'whatsapp' => 'text',
        'address' => 'textarea',
        'about' => 'textarea',
        'logo' => 'image',
        'logoSecond' => 'image',
        'icon' => 'image',
    ];

    const FORM_LABEL = [
        'title' => 'Judul Website',
        'email' => 'Email Admin',
        'phone' => 'Telepon Admin',
        'facebook' => 'Facebook Link',
        'instagram' => 'Instagram Link',
        'twitter' => 'Twitter Link',
        'whatsapp' => 'Whatsapp Admin',
        'address' => 'Alamat Kantor',
        'about' => 'Deskripsi singkat (Footer)',
        'logo' => 'Logo Header',
        'logoSecond' => 'Logo Footer',
        'icon' => 'Fav Icon Website',
    ];

    const FORM_HELP_LIST = ['whatsapp','logo','logoSecond','icon'];

    const FORM_LABEL_HELP = [
        'whatsapp' => 'Gunakan Nomor dengan Kode Negara (62)',
        'logo' => 'Format File(PNG,JPG),Ukuran Max(100kb), Ukuran Gambar (200 x 191)',
        'logoSecond' => 'Format File(PNG,JPG),Ukuran Max(100kb), Ukuran Gambar (180 x 80)',
        'icon' => 'Format File(PNG,JPG),Ukuran Max(100kb), Ukuran Gambar (17 x 17)',
    ];

    const FORM_DISABLED = [

    ];

    const FORM_SELECT_LIST = [

    ];

    const FORM_VALIDATION_DETAIL = [
        'title' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'address' => 'required',
    ];

    const ABOUT_FIELD = [
        'title' => 'text',
        'banner' => 'file',
        'header1' => 'text',
        'image1' => 'file',
        'content1' => 'textarea',
        'image2' => 'file',
        'header2' => 'text',
        'content2' => 'textarea',
    ];

    const ABOUT_LABEL = [
        'title' => 'Judul',
        'banner' => 'Gambar Header',
        'header1' => 'Judul Section 1',
        'image1' => 'Gambar Section 1',
        'content1' => 'Konten Section 1',
        'image2' => 'Gambar Section 2',
        'header2' => 'Judul Section 2',
        'content2' => 'Konten Section 2',
    ];

    const ABOUT_LABEL_LIST = ['banner','image1','image2'];

    const ABOUT_LABEL_HELP = [
        'banner' => 'Format File(PNG,JPG),Ukuran Max(100kb), Ukuran Gambar (1920 x 239)',
        'image1' => 'Format File(PNG,JPG),Ukuran Max(400kb), Ukuran Gambar (1200 x 1200)',
        'image2' => 'Format File(PNG,JPG),Ukuran Max(400kb), Ukuran Gambar (1200 x 1200)',
    ];

    const FAQ_FIELD = [
        'title' => 'text',
        'banner' => 'file',
    ];

    const FAQ_LABEL = [
        'title' => 'Judul',
        'banner' => 'Gambar Header',
    ];

    const FAQ_LABEL_LIST = ['banner'];

    const FAQ_LABEL_HELP = [
        'banner' => 'Format File(PNG,JPG),Ukuran Max(100kb), Ukuran Gambar (1920 x 239)',
    ];

}
