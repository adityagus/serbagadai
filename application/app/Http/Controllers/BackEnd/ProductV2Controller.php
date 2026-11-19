<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Pages;
use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductV2Controller extends BackEndController
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Tampilkan Halaman CMS Product V2
     */
    public function index()
    {
        $data['sidebar'] = 'product_v2';
        $home = Pages::where('types', Constant::PAGES_TYPES_HOME)->first();
        $data['home'] = $home;
        $data['content'] = !empty($home) ? json_decode($home->content) : (object)[];
        
        return view('backend.product_v2.index', $data);
    }

    /**
     * Simpan Header Section Produk V2 (Title & Sub Title)
     */
    public function saveHeader(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_title' => 'required|string|max:150',
            'product_sub_title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'message' => 'Mohon lengkapi judul dan deskripsi section produk',
                'error' => $validator->errors(),
            ]);
        }

        $home = Pages::where('types', Constant::PAGES_TYPES_HOME)->first();
        if (!$home) {
            $home = new Pages();
            $home->types = Constant::PAGES_TYPES_HOME;
            $content = (object)[];
        } else {
            $content = json_decode($home->content) ?: (object)[];
        }

        $content->product_title = $request->product_title;
        $content->product_sub_title = $request->product_sub_title;

        $home->content = json_encode($content);

        if ($home->save()) {
            return Response::json([
                'status' => true,
                'message' => 'Header Section Produk V2 berhasil disimpan',
            ]);
        }

        return Response::json([
            'status' => false,
            'message' => 'Gagal menyimpan header section produk',
        ]);
    }

    /**
     * Simpan Item Slider / Card Produk V2 (Tambah Baru / Edit)
     */
    public function saveSlider(Request $request)
    {
        $id = (int)$request->id; // 0 for new, 1..n for update
        $rules = [
            'title' => 'required|string|max:100',
            'priority' => 'required|integer|min:1',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'message' => 'Periksa kembali data item produk',
                'error' => $validator->errors(),
            ]);
        }

        $home = Pages::where('types', Constant::PAGES_TYPES_HOME)->first();
        if (!$home) {
            $home = new Pages();
            $home->types = Constant::PAGES_TYPES_HOME;
            $content = (object)[];
        } else {
            $content = json_decode($home->content) ?: (object)[];
        }

        $sliders = !empty($content->product_sliders) ? (array)$content->product_sliders : [];

        $imagePath = '';
        if ($id > 0) {
            $existingIndex = $id - 1;
            if (isset($sliders[$existingIndex]) && !empty($sliders[$existingIndex]->image)) {
                $imagePath = $sliders[$existingIndex]->image;
            }
        }

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            if (!empty($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $imageFile->store('home/product', 'public');
        }

        $item = (object)[
            'title' => $request->title,
            'link' => $request->link ?: route('simulasi'),
            'priority' => (int)$request->priority,
            'image' => $imagePath,
        ];

        if ($id === 0) {
            $sliders[] = $item;
        } else {
            $existingIndex = $id - 1;
            $sliders[$existingIndex] = $item;
        }

        // Sort by priority ascending
        usort($sliders, function ($a, $b) {
            if ($a->priority == $b->priority) {
                return 0;
            }
            return ($a->priority < $b->priority) ? -1 : 1;
        });

        $content->product_sliders = array_values($sliders);
        $home->content = json_encode($content);

        if ($home->save()) {
            return Response::json([
                'status' => true,
                'message' => 'Item Produk V2 berhasil disimpan',
            ]);
        }

        return Response::json([
            'status' => false,
            'message' => 'Gagal menyimpan item produk',
        ]);
    }

    /**
     * Hapus Item Slider / Card Produk V2
     */
    public function deleteSlider(Request $request)
    {
        $id = (int)$request->id;
        if ($id <= 0) {
            return Response::json(['status' => false, 'message' => 'ID item tidak valid']);
        }

        $home = Pages::where('types', Constant::PAGES_TYPES_HOME)->first();
        if (!$home) {
            return Response::json(['status' => false, 'message' => 'Halaman tidak ditemukan']);
        }

        $content = json_decode($home->content) ?: (object)[];
        $sliders = !empty($content->product_sliders) ? (array)$content->product_sliders : [];
        $index = $id - 1;

        if (isset($sliders[$index])) {
            if (!empty($sliders[$index]->image) && Storage::disk('public')->exists($sliders[$index]->image)) {
                Storage::disk('public')->delete($sliders[$index]->image);
            }
            array_splice($sliders, $index, 1);
            $content->product_sliders = array_values($sliders);
            $home->content = json_encode($content);

            if ($home->save()) {
                return Response::json([
                    'status' => true,
                    'message' => 'Item Produk V2 berhasil dihapus',
                ]);
            }
        }

        return Response::json([
            'status' => false,
            'message' => 'Gagal menghapus item produk',
        ]);
    }
}

