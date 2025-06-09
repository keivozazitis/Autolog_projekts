<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function store(Request $request)
    {
        $carModels = [
            'alfaromeo' => ["Giulia", "Stelvio", "MiTo"],
            'audi' => ["A3", "A4", "A6"],
            'bmw' => ["3 Series", "5 Series", "X5"],
            'chevrolet' => ["Camaro", "Malibu", "Tahoe"],
            'chrysler' => ["300", "Pacifica", "Voyager"],
            'citroen' => ["C3", "C4", "Berlingo"],
            'cupra' => ["Formentor", "Leon", "Born"],
            'dacia' => ["Duster", "Sandero", "Logan"],
            'dodge' => ["Charger", "Challenger", "Durango"],
            'fiat' => ["500", "Panda", "Tipo"],
            'ford' => ["Focus", "Mondeo", "Kuga"],
            'honda' => ["Civic", "Accord", "CR-V"],
            'hyundai' => ["i30", "Tucson", "Santa Fe"],
            'infiniti' => ["Q50", "QX50", "QX60"],
            'jaguar' => ["XE", "F-Pace", "XF"],
            'jeep' => ["Wrangler", "Grand Cherokee", "Compass"],
            'kia' => ["Ceed", "Sportage", "Sorento"],
            'lancia' => ["Ypsilon", "Delta", "Thema"],
            'landrover' => ["Discovery", "Range Rover", "Defender"],
            'lexus' => ["IS", "RX", "NX"],
            'mazda' => ["3", "6", "CX-5"],
            'mercedes' => ["C-Class", "E-Class", "GLC"],
            'mini' => ["Cooper", "Countryman", "Clubman"],
            'mitsubishi' => ["Outlander", "ASX", "Eclipse Cross"],
            'nissan' => ["Qashqai", "X-Trail", "Leaf"],
            'opel' => ["Corsa", "Astra", "Insignia"],
            'peugeot' => ["208", "3008", "5008"],
            'porsche' => ["911", "Cayenne", "Panamera"],
            'renault' => ["Clio", "Megane", "Captur"],
            'saab' => ["9-3", "9-5", "900"],
            'seat' => ["Ibiza", "Leon", "Ateca"],
            'skoda' => ["Octavia", "Fabia", "Kodiaq"],
            'smart' => ["ForTwo", "ForFour", "EQ ForTwo"],
            'subaru' => ["Impreza", "Forester", "Outback"],
            'suzuki' => ["Swift", "Vitara", "SX4 S-Cross"],
            'tesla' => ["Model S", "Model 3", "Model X"],
            'toyota' => ["Corolla", "Camry", "RAV4"],
            'volkswagen' => ["Golf", "Passat", "Tiguan"],
            'volvo' => ["XC60", "XC90", "S60"],
            'gaz' => ["Gazelle", "Volga", "Sobol"],
            'uaz' => ["Hunter", "Patriot", "Bukhanka"],
            'vaz' => ["2101", "2107", "Niva"]
        ];

        $brand = $request->input('brand');
        $allowedModels = $carModels[$brand] ?? [];

        try {
            $validated = $request->validate([
                'brand' => ['required', 'string', 'max:255'],
                'model' => ['required', 'string', 'max:255', Rule::in($allowedModels)],
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
                'description' => ['nullable', 'string'],
                'prev_inspection_problem' => ['nullable', 'array'],
                'prev_inspection_problem.*' => ['string'],
                'images.*' => ['nullable', 'image', 'max:5120'], // max 5MB per image
            ], [
                'model.in' => 'Izvēlētais modelis nav derīgs izvēlētajai markai.',
                'price.decimal' => 'Cenai jābūt ar 2 zīmēm aiz komata.',
                'images.*.image' => 'Katrai augšupielādētajai bildei jābūt attēla formātā.',
                'images.*.max' => 'Bildei jābūt mazākai par 5MB.'
            ]);

            $validated['prev_inspection_problem'] = implode(', ', $validated['prev_inspection_problem'] ?? []);
            $listing = Listing::create($validated);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('listing_images', 'public');

                        ListingImage::create([
                            'listing_id' => $listing->id,
                            'image_path' => 'storage/' . $path,
                        ]);
                    }
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

    if ($request->filled('year')) {
        $query->where('year', $request->year);
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

    $listings = $query->get();

    return view('sludinajumi', compact('listings'));
}

    public function show($id)
    {
        $listing = Listing::with('images')->findOrFail($id);
        return view('listing.show', compact('listing'));
    }

    public function destroy(Listing $listing)
    {
        // Noņemta īpašnieka pārbaude, lai nebloķētu dzēšanu
        // Dzēš saistītās bildes no diska un datubāzes
        foreach ($listing->images as $image) {
            Storage::delete(str_replace('storage/', 'public/', $image->image_path));
            $image->delete();
        }

        $listing->delete();

        return redirect('/sludinajumi')->with('success', 'Sludinājums izdzēsts veiksmīgi!');
    }
}
