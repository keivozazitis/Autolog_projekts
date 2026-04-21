<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivataisKatalogs;
use App\Models\PrivataisKatalogsImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PrivataisKatalogsController extends Controller
{
    public function index()
    {
        $ieraksti = PrivataisKatalogs::with('images')->where('user_id', Auth::id())->get();
        return view('privatais.index', compact('ieraksti'));
    }

    public function create()
    {
        return view('katalogs');
    }

    public function show($id)
    {
        $ieraksts = PrivataisKatalogs::with('images')->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        return view('privatais.show', compact('ieraksts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'images.*' => ['nullable', 'image', 'max:65536'],
        ]);

        $validated['user_id'] = Auth::id();

        $ieraksts = PrivataisKatalogs::create(array_merge($validated, $request->only([
            'body_type', 'fuel_type', 'transmission', 'engine_volume',
            'mileage', 'color', 'license_plate', 'vin', 'next_inspection',
            'description', 'prev_inspection_rating', 'prev_inspection_problem'
        ])));

        if ($request->hasFile('images')) {
            $dir = storage_path('app/public/listing_images');
            if (!file_exists($dir)) mkdir($dir, 0755, true);

            foreach ($request->file('images') as $image) {
                if (!$image->isValid()) continue;

                $orientation = 1;
                if (function_exists('exif_read_data')) {
                    $exif = @exif_read_data($image->getRealPath());
                    $orientation = $exif['Orientation'] ?? 1;
                }

                $ext = strtolower($image->getClientOriginalExtension()) ?: 'jpg';
                $filename = uniqid('img_', true) . '.' . $ext;

                if (in_array($orientation, [3, 6, 8])) {
                    $src = @imagecreatefromstring(file_get_contents($image->getRealPath()));
                    if (!$src) continue;
                    switch ($orientation) {
                        case 3: $src = imagerotate($src, 180, 0); break;
                        case 6: $src = imagerotate($src, -90, 0); break;
                        case 8: $src = imagerotate($src, 90, 0); break;
                    }
                    $filename = uniqid('img_', true) . '.jpg';
                    imagejpeg($src, $dir . '/' . $filename, 100);
                    imagedestroy($src);
                } else {
                    $image->move($dir, $filename);
                }

                PrivataisKatalogsImage::create([
                    'privatais_katalogs_id' => $ieraksts->id,
                    'image_path' => 'storage/listing_images/' . $filename,
                ]);
            }
        }

        return redirect()->route('privatais.index')->with('success', 'Dati saglabāti!');
    }

    public function destroy($id)
    {
        $ieraksts = PrivataisKatalogs::with('images')->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        foreach ($ieraksts->images as $image) {
            Storage::delete(str_replace('storage/', 'public/', $image->image_path));
            $image->delete();
        }

        $ieraksts->delete();
        return redirect()->route('privatais.index')->with('success', 'Ieraksts izdzēsts!');
    }
}
