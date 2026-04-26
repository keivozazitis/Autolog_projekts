<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'brand' => ['required', 'string', 'max:255'],
                'model' => ['required', 'string', 'max:255'],
                'year' => ['required', 'integer', 'min:1950', 'max:' . (date('Y') + 1)],
                'price' => ['required', 'numeric', 'min:0'],
                'body_type' => ['nullable', 'string'],
                'fuel_type' => ['nullable', 'string'],
                'transmission' => ['nullable', 'string'],
                'engine_volume' => ['nullable', 'integer'],
                'mileage' => ['nullable', 'integer'],
                'color' => ['nullable', 'string'],
                'license_plate' => ['nullable', 'string'],
                'vin' => ['nullable', 'string'],
                'next_inspection' => ['nullable', 'date'],
                'phone' => ['required', 'string', 'max:30'],
                'description' => ['nullable', 'string'],
                'prev_inspection_rating' => ['nullable', 'integer', 'min:0', 'max:3'],
                'prev_inspection_rating_extra' => ['nullable', 'array'],
                'prev_inspection_rating_extra.*' => ['nullable', 'integer', 'min:0', 'max:3'],
                'prev_inspection_problem' => ['nullable', 'array'],
                'prev_inspection_problem.*' => ['string'],
                'images' => ['nullable', 'array', 'max:10'],
                'images.*' => ['nullable', 'image', 'max:15360'],
            ], [
                'price.decimal' => 'Cenai jābūt ar 2 zīmēm aiz komata.',
                'images.*.image' => 'Katrai augšupielādētajai bildei jābūt attēla formātā.',
                'images.*.max' => 'Bildei jābūt mazākai par 15MB.'
            ]);

            $validated['prev_inspection_problem'] = implode(', ', $validated['prev_inspection_problem'] ?? []);
            $validated['prev_inspection_ratings'] = self::buildRatingCounts(
                $validated['prev_inspection_rating'] ?? null,
                $validated['prev_inspection_rating_extra'] ?? []
            );
            unset($validated['prev_inspection_rating_extra']);
            $user = Auth::user();
            if (!$user->subscribed('default')) {
                $count = Listing::where('user_id', $user->id)->count();
                if ($count >= 1) {
                    return redirect()->route('subscription.upgrade')
                        ->with('limit', 'Bezmaksas kontam ir 1 sludinājuma limits. Jaunina uz AutoPlacis!');
                }
            }

            $validated['user_id'] = $user->id;
            $listing = Listing::create($validated);
            Log::info('Listing izveidots ar ID: ' . $listing->id);


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
                        // Rotation needed — re-encode with GD at max quality
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
                        // No rotation — copy original bytes, zero quality loss
                        $image->move($dir, $filename);
                    }

                    ListingImage::create([
                        'listing_id' => $listing->id,
                        'image_path' => 'storage/listing_images/' . $filename,
                    ]);
                }
            }
            
        } catch (\Exception $e) {
            Log::error('❌ Neizdevās saglabāt sludinājumu vai bildes', ['error' => $e->getMessage()]);
            return back()->with('error', 'Kļūda saglabājot sludinājumu vai bildes!');
        }

        Log::info('✅ Pāradresācija uz /sludinajumi');
        return redirect('/sludinajumi')->with('success', 'Sludinājums veiksmīgi pievienots!');
    }

    public function index(Request $request)
{
    $query = Listing::with('images');

    if ($request->filled('brand')) {
        $query->where('brand', $request->brand);
    }

    if ($request->filled('model')) {
        $query->where('model', $request->model);
    }

    if ($request->filled('year-from')) {
        $query->where('year', '>=', $request->input('year-from'));
    }

    if ($request->filled('year-to')) {
        $query->where('year', '<=', $request->input('year-to'));
    }

    if ($request->filled('price-from')) {
        $query->where('price', '>=', $request->input('price-from'));
    }

    if ($request->filled('price-to')) {
        $query->where('price', '<=', $request->input('price-to'));
    }

    if ($request->filled('body-type')) {
        $query->where('body_type', $request->input('body-type'));
    }

    if ($request->filled('fuel-type')) {
        $query->where('fuel_type', $request->input('fuel-type'));
    }

    if ($request->filled('trans-type')) {
        $query->where('transmission', $request->input('trans-type'));
    }

    if ($request->filled('engine-volume-from')) {
        $query->where('engine_volume', '>=', $request->input('engine-volume-from'));
    }

    if ($request->filled('engine-volume-to')) {
        $query->where('engine_volume', '<=', $request->input('engine-volume-to'));
    }

    if ($request->filled('mileage-from')) {
        $query->where('mileage', '>=', $request->input('mileage-from'));
    }

    if ($request->filled('mileage-to')) {
        $query->where('mileage', '<=', $request->input('mileage-to'));
    }

    if ($request->has('inspection-rating') && $request->input('inspection-rating') !== '') {
        $rating = $request->input('inspection-rating');
        $query->where(function ($q) use ($rating) {
            $q->where(function ($q2) use ($rating) {
                $q2->whereNotNull('prev_inspection_ratings')
                   ->where('prev_inspection_ratings', 'LIKE', '%"' . $rating . '":%');
            })->orWhere(function ($q2) use ($rating) {
                $q2->whereNull('prev_inspection_ratings')
                   ->where('prev_inspection_rating', $rating);
            });
        });
    }

    match($request->input('sort', 'newest')) {
        'price_asc'    => $query->orderBy('price', 'asc'),
        'price_desc'   => $query->orderBy('price', 'desc'),
        'year_desc'    => $query->orderBy('year', 'desc'),
        'year_asc'     => $query->orderBy('year', 'asc'),
        'mileage_asc'  => $query->orderBy('mileage', 'asc'),
        'mileage_desc' => $query->orderBy('mileage', 'desc'),
        default        => $query->latest(),
    };

    $listings = $query->paginate(12)->withQueryString();

    return view('sludinajumi', compact('listings'));
}

    public function show($id)
    {
        $listing = Listing::with('images')->findOrFail($id);
        return view('listing.show', compact('listing'));
    }

    public function edit(Listing $listing)
    {
        if (Auth::id() !== $listing->user_id && !Auth::user()->is_admin) {
            abort(403);
        }
        return view('listing.edit', compact('listing'));
    }

    public function update(Request $request, Listing $listing)
    {
        if (Auth::id() !== $listing->user_id && !Auth::user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'brand'       => ['required','string','max:255'],
            'model'       => ['required','string','max:255'],
            'year'        => ['required','integer','min:1950','max:'.(date('Y')+1)],
            'price'       => ['required','numeric','min:0'],
            'body_type'   => ['nullable','string'],
            'fuel_type'   => ['nullable','string'],
            'transmission'=> ['nullable','string'],
            'engine_volume'=> ['nullable','integer'],
            'mileage'     => ['nullable','integer'],
            'color'       => ['nullable','string'],
            'license_plate'=> ['nullable','string'],
            'vin'         => ['nullable','string'],
            'next_inspection'=> ['nullable','date'],
            'phone' => ['required', 'string', 'max:30'],
            'description' => ['nullable','string'],
            'prev_inspection_rating' => ['nullable','integer','min:0','max:3'],
            'prev_inspection_rating_extra' => ['nullable','array'],
            'prev_inspection_rating_extra.*' => ['nullable','integer','min:0','max:3'],
            'prev_inspection_problem' => ['nullable','array'],
            'prev_inspection_problem.*' => ['string'],
            'images'      => ['nullable','array'],
            'images.*'    => ['nullable','image','max:15360'],
            'remove_images' => ['nullable','array'],
            'remove_images.*' => ['integer'],
        ]);

        $removing = count($validated['remove_images'] ?? []);
        $adding   = count(array_filter($request->file('images') ?? []));
        $existing = $listing->images()->count();
        if (($existing - $removing + $adding) > 10) {
            return back()->withErrors(['images' => 'Sludinājumam var būt maksimāli 10 bildes.']);
        }

        $validated['prev_inspection_problem'] = implode(', ', $validated['prev_inspection_problem'] ?? []);
        $validated['prev_inspection_ratings'] = self::buildRatingCounts(
            $validated['prev_inspection_rating'] ?? null,
            $validated['prev_inspection_rating_extra'] ?? []
        );
        unset($validated['prev_inspection_rating_extra']);

        $listing->update(\Illuminate\Support\Arr::except($validated, ['images','remove_images']));

        // Dzēst atzīmētās bildes
        if ($request->filled('remove_images')) {
            foreach ($listing->images()->whereIn('id', $request->remove_images)->get() as $img) {
                Storage::delete(str_replace('storage/', 'public/', $img->image_path));
                $img->delete();
            }
        }

        // Pievienot jaunas bildes
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
                ListingImage::create(['listing_id' => $listing->id, 'image_path' => 'storage/listing_images/' . $filename]);
            }
        }

        return redirect()->route('listing.show', $listing->id)->with('success', 'Sludinājums atjaunināts!');
    }

    public function destroy(Listing $listing)
    {
        if (Auth::id() !== $listing->user_id && !Auth::user()->is_admin) {
            abort(403);
        }

        foreach ($listing->images as $image) {
            Storage::delete(str_replace('storage/', 'public/', $image->image_path));
            $image->delete();
        }

        $listing->delete();

        return redirect('/sludinajumi')->with('success', 'Sludinājums izdzēsts veiksmīgi!');
    }

    private static function buildRatingCounts(?int $main, array $extras): ?array
    {
        $all = array_filter(
            array_merge($main !== null ? [$main] : [], $extras),
            fn($r) => $r !== null && $r !== ''
        );
        if (empty($all)) return null;
        $counts = [];
        foreach ($all as $r) {
            $key = (string)(int)$r;
            $counts[$key] = ($counts[$key] ?? 0) + 1;
        }
        return $counts;
    }
}
