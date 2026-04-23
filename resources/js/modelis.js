const carModels = {
    alfaromeo: ["147","156","159","166","Brera","Giulia","Giulietta","GT","GTV","MiTo","Spider","Stelvio","Tonale"],
    audi: ["A1","A2","A3","A4","A5","A6","A7","A8","e-tron","e-tron GT","e-tron S","e-tron Sportback","Q2","Q3","Q4 e-tron","Q5","Q7","Q8","Q8 e-tron","R8","RS3","RS4","RS5","RS6","RS7","RS Q3","RS Q8","S1","S3","S4","S5","S6","S7","S8","SQ5","SQ7","SQ8","TT","TT RS","TTS"],
    bmw: ["1 Series","2 Series","3 Series","4 Series","5 Series","6 Series","7 Series","8 Series","i3","i4","i5","i7","iX","iX1","iX3","M2","M3","M4","M5","M6","M8","M135i","M140i","M235i","M240i","M340i","M440i","M550i","X1","X2","X3","X3 M","X4","X4 M","X5","X5 M","X6","X6 M","X7","Z3","Z4"],
    chevrolet: ["Aveo","Blazer","Camaro","Captiva","Cobalt","Colorado","Corvette","Cruze","Equinox","Lacetti","Malibu","Orlando","Silverado","Spark","Suburban","Tahoe","Trailblazer","Trax"],
    chrysler: ["300","300C","Grand Voyager","Pacifica","PT Cruiser","Sebring","Voyager"],
    citroen: ["Berlingo","C-Crosser","C-Elysée","C1","C2","C3","C3 Aircross","C4","C4 Cactus","C5","C5 Aircross","C5 X","C6","C8","Jumper","Jumpy","Nemo","Picasso","SpaceTourer","Xsara"],
    cupra: ["Ateca","Born","Formentor","Leon"],
    dacia: ["Duster","Jogger","Logan","Lodgy","Sandero","Sandero Stepway","Spring"],
    dodge: ["Challenger","Charger","Dakota","Durango","Journey","Neon","Ram","Viper"],
    fiat: ["124","500","500L","500X","Bravo","Doblo","Ducato","Fiorino","Grande Punto","Idea","Linea","Multipla","Panda","Punto","Sedici","Stilo","Tipo","Ulysse"],
    ford: ["B-Max","C-Max","EcoSport","Edge","Explorer","F-150","Fiesta","Focus","Galaxy","Ka","Kuga","Mondeo","Mustang","Mustang Mach-E","Puma","Ranger","S-Max","Tourneo"],
    honda: ["Accord","Civic","CR-V","CR-Z","e","FR-V","HR-V","Insight","Jazz","Legend","NSX","Prelude","S2000","Shuttle"],
    hyundai: ["Accent","Elantra","Genesis","Getz","H-1","i10","i20","i30","i40","IONIQ","IONIQ 5","IONIQ 6","Kona","Matrix","Santa Fe","Sonata","Terracan","Trajet","Tucson","Veloster"],
    infiniti: ["Q30","Q50","Q60","Q70","QX30","QX50","QX56","QX60","QX70","QX80"],
    jaguar: ["E-Pace","F-Pace","F-Type","I-Pace","S-Type","X-Type","XE","XF","XJ"],
    jeep: ["Cherokee","Commander","Compass","Gladiator","Grand Cherokee","Renegade","Wrangler"],
    kia: ["Carens","Carnival","Ceed","EV6","Magentis","Niro","Optima","Picanto","ProCeed","Rio","Sorento","Soul","Sportage","Stinger","Stonic","Telluride","Venga","XCeed"],
    lancia: ["Delta","Musa","Stratos","Thema","Ypsilon"],
    landrover: ["Defender","Discovery","Discovery Sport","Freelander","Range Rover","Range Rover Evoque","Range Rover Sport","Range Rover Velar"],
    lexus: ["CT 200h","ES","GS","IS","LC","LS","LX","NX","RC","RX","UX"],
    mazda: ["2","3","5","6","CX-3","CX-30","CX-5","CX-7","CX-9","CX-60","MX-5","MX-30","RX-7","RX-8"],
    mercedes: ["A-Class","A 35 AMG","A 45 AMG","B-Class","C-Class","C 43 AMG","C 63 AMG","CLA","CLA 45 AMG","CLS","E-Class","E 53 AMG","E 63 AMG","EQA","EQB","EQC","EQE","EQS","G-Class","GL","GLA","GLA 45 AMG","GLB","GLC","GLC 43 AMG","GLC 63 AMG","GLC Coupe","GLE","GLE 53 AMG","GLE 63 AMG","GLE Coupe","GLS","GLS 63 AMG","GT AMG","S-Class","S 63 AMG","S 65 AMG","SL","SLC","Sprinter","V-Class","Vito"],
    mini: ["Clubman","Convertible","Cooper","Cooper S","Countryman","John Cooper Works","Paceman"],
    mitsubishi: ["ASX","Carisma","Colt","Eclipse Cross","Galant","L200","Lancer","Outlander","Pajero","Pajero Sport","Space Star"],
    nissan: ["350Z","370Z","Almera","Ariya","GT-R","Juke","Leaf","Micra","Murano","Note","Pathfinder","Patrol","Primera","Qashqai","Sentra","Skyline","Terrano","X-Trail","Z"],
    opel: ["Adam","Ampera","Antara","Astra","Cascada","Corsa","Crossland","Grandland","Insignia","Meriva","Mokka","Omega","Signum","Vectra","Vivaro","Zafira"],
    peugeot: ["107","108","205","206","207","208","2008","301","307","308","3008","407","4007","4008","508","5008","607","e-208","e-2008"],
    porsche: ["718 Boxster","718 Cayman","911","Cayenne","Macan","Panamera","Taycan"],
    renault: ["Captur","Clio","Espace","Fluence","Grand Scenic","Kangoo","Koleos","Laguna","Latitude","Logan","Master","Megane","Modus","Sandero","Scenic","Symbol","Talisman","Twingo","Zoe"],
    saab: ["9-3","9-5","900","9000"],
    seat: ["Alhambra","Altea","Arona","Ateca","Cordoba","Exeo","Ibiza","Leon","Mii","Tarraco","Toledo"],
    skoda: ["Citigo","Enyaq","Fabia","Kamiq","Karoq","Kodiaq","Octavia","Rapid","Roomster","Scala","Superb","Yeti"],
    smart: ["EQ ForFour","EQ ForTwo","ForFour","ForTwo"],
    subaru: ["BRZ","Forester","Impreza","Legacy","Levorg","Outback","Tribeca","WRX","WRX STI","XV"],
    suzuki: ["Alto","Baleno","Celerio","Grand Vitara","Ignis","Jimny","Kizashi","Liana","S-Cross","Splash","Swift","SX4","Vitara","Wagon R+"],
    tesla: ["Cybertruck","Model 3","Model S","Model X","Model Y","Roadster","Semi"],
    toyota: ["Auris","Avensis","Aygo","bZ4X","C-HR","Camry","Corolla","Crown","GR86","GR Supra","GR Yaris","Hilux","Land Cruiser","Prius","ProAce","RAV4","Supra","Verso","Yaris"],
    volkswagen: ["Arteon","Golf","Golf GTI","Golf GTE","Golf R","ID.3","ID.4","ID.5","ID.6","Jetta","Passat","Polo","Scirocco","Sharan","T-Cross","T-Roc","Tiguan","Touareg","Touran","Up!"],
    volvo: ["C30","C40","C70","S40","S60","S80","S90","V40","V50","V60","V70","V90","XC40","XC60","XC70","XC90"],
    gaz: ["Gazelle","Sobol","Volga"],
    uaz: ["Bukhanka","Hunter","Patriot"],
    vaz: ["2101","2102","2103","2104","2105","2106","2107","2108","2109","21099","Granta","Kalina","Largus","Niva","Niva Travel","Priora","Vesta","XRAY"],
    citas: []
};

const carColors = [
    { value: 'Melns',       label: 'Melns',       hex: '#1a1a1a' },
    { value: 'Balts',       label: 'Balts',       hex: '#f0f0f0', outline: true },
    { value: 'Pelēks',      label: 'Pelēks',      hex: '#7a7a7a' },
    { value: 'Sudraba',     label: 'Sudraba',     hex: '#b8b8c8' },
    { value: 'Sarkans',     label: 'Sarkans',     hex: '#cc1a1a' },
    { value: 'Tumši sarkans', label: 'Tumši sarkans', hex: '#7a0000' },
    { value: 'Zils',        label: 'Zils',        hex: '#1d4ed8' },
    { value: 'Tumši zils',  label: 'Tumši zils',  hex: '#1e3a5f' },
    { value: 'Gaiši zils',  label: 'Gaiši zils',  hex: '#60a5fa' },
    { value: 'Zaļš',        label: 'Zaļš',        hex: '#16803d' },
    { value: 'Brūns',       label: 'Brūns',       hex: '#92400e' },
    { value: 'Bēšs',        label: 'Bēšs',        hex: '#d4b896' },
    { value: 'Dzeltens',    label: 'Dzeltens',    hex: '#eab308' },
    { value: 'Oranžs',      label: 'Oranžs',      hex: '#ea580c' },
    { value: 'Violets',     label: 'Violets',     hex: '#7c3aed' },
    { value: 'Zelts',       label: 'Zelts',       hex: '#b8960c' },
    { value: 'Rozā',        label: 'Rozā',        hex: '#ec4899' },
    { value: 'Cits',        label: 'Cits',        hex: null },
];

// ── Brand → Model cascade ──────────────────────────────────────────────────
const brandSelect = document.getElementById('brand');
const modelSelect = document.getElementById('model');

if (brandSelect && modelSelect) {
    brandSelect.addEventListener('change', function () {
        const brand = this.value;
        modelSelect.innerHTML = '';

        if (brand && carModels[brand] && carModels[brand].length > 0) {
            modelSelect.disabled = false;
            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = 'Izvēlies modeli';
            modelSelect.appendChild(placeholder);

            carModels[brand].forEach(function (m) {
                const opt = document.createElement('option');
                opt.value = m;
                opt.textContent = m;
                modelSelect.appendChild(opt);
            });
        } else {
            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = brand ? 'Ievadi modeli manuāli' : 'Vispirms izvēlies marku';
            modelSelect.appendChild(placeholder);
            modelSelect.disabled = !brand;
        }
    });

    // If brand already selected (edit form), populate models and restore selected model
    if (brandSelect.value) {
        const currentModel = modelSelect.dataset.currentModel || '';
        const brand = brandSelect.value;
        modelSelect.innerHTML = '';

        if (carModels[brand] && carModels[brand].length > 0) {
            modelSelect.disabled = false;
            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = 'Izvēlies modeli';
            modelSelect.appendChild(placeholder);

            carModels[brand].forEach(function (m) {
                const opt = document.createElement('option');
                opt.value = m;
                opt.textContent = m;
                if (m === currentModel) opt.selected = true;
                modelSelect.appendChild(opt);
            });

            // If current model not in list, add it as selected option
            if (currentModel && !carModels[brand].includes(currentModel)) {
                const opt = document.createElement('option');
                opt.value = currentModel;
                opt.textContent = currentModel;
                opt.selected = true;
                modelSelect.appendChild(opt);
            }
        } else if (currentModel) {
            modelSelect.disabled = false;
            const opt = document.createElement('option');
            opt.value = currentModel;
            opt.textContent = currentModel;
            opt.selected = true;
            modelSelect.appendChild(opt);
        }
    }
}

// ── Color swatch dropdown ──────────────────────────────────────────────────
function initColorDropdown() {
    const wrapper = document.getElementById('color-select');
    if (!wrapper) return;

    const dropdownList = document.getElementById('color-select-dropdown');
    const hiddenInput  = document.getElementById('color-input');
    const swatchPreview = document.getElementById('color-swatch-preview');
    const labelText    = document.getElementById('color-select-label');
    const trigger      = wrapper.querySelector('.color-select-display');

    carColors.forEach(function (color) {
        const item = document.createElement('div');
        item.className = 'color-option';
        item.dataset.value = color.value;

        const swatch = document.createElement('span');
        swatch.className = 'color-swatch';
        if (color.hex) {
            swatch.style.background = color.hex;
            if (color.outline) swatch.style.border = '1px solid #aaa';
        } else {
            swatch.classList.add('color-swatch-none');
        }

        const lbl = document.createElement('span');
        lbl.textContent = color.label;

        item.appendChild(swatch);
        item.appendChild(lbl);

        item.addEventListener('click', function (e) {
            e.stopPropagation();
            hiddenInput.value = color.value;
            labelText.textContent = color.label;
            if (color.hex) {
                swatchPreview.style.background = color.hex;
                swatchPreview.style.display = 'inline-block';
                if (color.outline) swatchPreview.style.border = '1px solid #aaa';
                else swatchPreview.style.border = '1px solid rgba(255,255,255,0.12)';
            } else {
                swatchPreview.style.display = 'none';
            }
            dropdownList.style.display = 'none';
            wrapper.classList.remove('open');
        });

        dropdownList.appendChild(item);
    });

    trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = dropdownList.style.display === 'block';
        dropdownList.style.display = isOpen ? 'none' : 'block';
        wrapper.classList.toggle('open', !isOpen);
    });

    document.addEventListener('click', function () {
        dropdownList.style.display = 'none';
        wrapper.classList.remove('open');
    });

    // Pre-select existing value (edit form uses data-value attribute)
    const existing = wrapper.dataset.value;
    if (existing) {
        const match = carColors.find(function (c) { return c.value === existing; });
        hiddenInput.value = existing;
        if (match) {
            labelText.textContent = match.label;
            if (match.hex) {
                swatchPreview.style.background = match.hex;
                swatchPreview.style.display = 'inline-block';
                if (match.outline) swatchPreview.style.border = '1px solid #aaa';
            }
        } else {
            labelText.textContent = existing;
        }
    }
}

initColorDropdown();

// ── Filter dropdown toggle (sludinajumi page) ─────────────────────────────
const filterToggle = document.querySelector('.filter-dropdown-toggle');
if (filterToggle) {
    filterToggle.addEventListener('click', function () {
        const content = document.querySelector('.filter-dropdown-content');
        if (content) {
            content.style.display = (content.style.display === 'none' || content.style.display === '') ? 'block' : 'none';
        }
    });
}
