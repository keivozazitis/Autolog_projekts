const carModels = {
    alfaromeo: ["Giulia", "Stelvio", "MiTo"],
    audi: ["A3", "A4", "A6"],
    bmw: ["3 Series", "5 Series", "X5"],
    chevrolet: ["Camaro", "Malibu", "Tahoe"],
    chrysler: ["300", "Pacifica", "Voyager"],
    citroen: ["C3", "C4", "Berlingo"],
    cupra: ["Formentor", "Leon", "Born"],
    dacia: ["Duster", "Sandero", "Logan"],
    dodge: ["Charger", "Challenger", "Durango"],
    fiat: ["500", "Panda", "Tipo"],
    ford: ["Focus", "Mondeo", "Kuga"],
    honda: ["Civic", "Accord", "CR-V"],
    hyundai: ["i30", "Tucson", "Santa Fe"],
    infiniti: ["Q50", "QX50", "QX60"],
    jaguar: ["XE", "F-Pace", "XF"],
    jeep: ["Wrangler", "Grand Cherokee", "Compass"],
    kia: ["Ceed", "Sportage", "Sorento"],
    lancia: ["Ypsilon", "Delta", "Thema"],
    landrover: ["Discovery", "Range Rover", "Defender"],
    lexus: ["IS", "RX", "NX"],
    mazda: ["3", "6", "CX-5"],
    mercedes: ["C-Class", "E-Class", "GLC"],
    mini: ["Cooper", "Countryman", "Clubman"],
    mitsubishi: ["Outlander", "ASX", "Eclipse Cross"],
    nissan: ["Qashqai", "X-Trail", "Leaf"],
    opel: ["Corsa", "Astra", "Insignia"],
    peugeot: ["208", "3008", "5008"],
    porsche: ["911", "Cayenne", "Panamera"],
    renault: ["Clio", "Megane", "Captur"],
    saab: ["9-3", "9-5", "900"],
    seat: ["Ibiza", "Leon", "Ateca"],
    skoda: ["Octavia", "Fabia", "Kodiaq"],
    smart: ["ForTwo", "ForFour", "EQ ForTwo"],
    subaru: ["Impreza", "Forester", "Outback"],
    suzuki: ["Swift", "Vitara", "SX4 S-Cross"],
    tesla: ["Model S", "Model 3", "Model X"],
    toyota: ["Corolla", "Camry", "RAV4"],
    volkswagen: ["Golf", "Passat", "Tiguan"],
    volvo: ["XC60", "XC90", "S60"],
    gaz: ["Gazelle", "Volga", "Sobol"],
    uaz: ["Hunter", "Patriot", "Bukhanka"],
    vaz: ["2101", "2107", "Niva"]
};

const brandSelect = document.getElementById('brand');
const modelSelect = document.getElementById('model');

brandSelect.addEventListener('change', function () {
    const selectedBrand = this.value;
    modelSelect.innerHTML = '';

    if (selectedBrand && carModels[selectedBrand]) {
        modelSelect.disabled = false;

        const placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = 'Izvēlies modeli';
        modelSelect.appendChild(placeholder);

        carModels[selectedBrand].forEach(function(model) {
            const option = document.createElement('option');
            option.value = model; // saglabā sākotnējo lielo burtu formu!
            option.textContent = model;
            modelSelect.appendChild(option);
        });
    } else {
        const placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = 'Vispirms izvēlies marku';
        modelSelect.appendChild(placeholder);
        modelSelect.disabled = true;
    }
});