// cascading-issues.js

document.addEventListener('DOMContentLoaded', () => {
    const problemsByRating = {
      "1": [
        { value: "numura_zimes_apgaismojums", text: "Numura zīmes apgaismojums nedarbojas" },
        { value: "luktura_stikla_bojajums",   text: "Neliels luktura stikla bojājums" },
        { value: "lukturu_regulejums",         text: "Lukturu regulējums nedaudz neatbilst normām" },
        { value: "ellas_svisana",              text: "Neliela eļļas svīšana no dzinēja" },
        { value: "riepu_nodilums",             text: "Neliels riepu nodilums" },
        { value: "bremzu_disku_nodilums",      text: "Neliels bremžu disku nodilums" },
        { value: "korozija_virsbuve",          text: "Neliela korozija uz virsbūves elementiem" },
        { value: "brivkustiba_balstiekarta",   text: "Neliela brīvkustība balstiekārtas savienojumos" },
        { value: "salona_bojajumi",            text: "Salona aprīkojuma bojājumi" },
        { value: "izpludes_stiprinajums",      text: "Neliels izplūdes sistēmas stiprinājuma bojājums" },
        { value: "logu_tiritalji",             text: "Logu tīrītāju darbība nepietiekama" },
        { value: "stikla_bojajums",            text: "Neliels stikla bojājums ārpus redzamības zonas" },
        { value: "dzesesanas_noplude",         text: "Neliela dzesēšanas šķidruma noplūde" },
        { value: "degvielas_svisana",          text: "Neliela degvielas sistēmas svīšana" },
        { value: "troksna_parsneigums",        text: "Neliels trokšņa līmeņa pārsniegums" },
        { value: "vibracija_bremzesana",       text: "Neliela vibrācija bremzēšanas laikā" },
        { value: "amortizatora_samazinajums",  text: "Neliels amortizatora efektivitātes samazinājums" },
        { value: "elektroinstalacija_izolacija", text: "Neliela elektroinstalācijas izolācijas bojājuma pazīme" },
        { value: "papildaprikojums_nepilnigas", text: "Papildaprīkojums uzstādīts ar nebūtiskām nepilnībām" },
        { value: "virsbuve_deformacija",        text: "Neliela virsbūves deformācija bez ietekmes uz drošību" }
      ],
      "2": [
        { value: "bremzu_speks_nepietiekams",    text: "Bremžu spēks nepietiekams" },
        { value: "nevienmerigas_bremzes",         text: "Nevienmērīga bremzēšana uz vienas ass" },
        { value: "rokas_bremze",                  text: "Rokas bremze nedarbojas efektīvi" },
        { value: "lukturu_regulejums_butisks",    text: "Lukturu regulējums būtiski neatbilst normām" },
        { value: "tuvais_lukturis_nedarbojas",    text: "Nestrādā viens no tuvās gaismas lukturiem" },
        { value: "pagrieziena_raditajs",          text: "Pagrieziena rādītājs nedarbojas" },
        { value: "riepu_protektors_zem_normas",   text: "Riepu protektora dziļums zem minimālās normas" },
        { value: "riepa_bojata",                  text: "Riepa bojāta (plaisa vai izspiedums)" },
        { value: "stūres_brivkustiba",            text: "Stūres mehānismā pārmērīga brīvkustība" },
        { value: "amortizators_nepietiekams",     text: "Amortizatora darbība nepietiekama" },
        { value: "lodbalsts_nodilums",            text: "Lodbalsts ar pārmērīgu nodilumu" },
        { value: "izpludes_emisija",              text: "Izplūdes gāzu emisija pārsniedz normu" },
        { value: "dumainiba",                     text: "Dūmainība pārsniedz pieļaujamo līmeni" },
        { value: "izpludes_sistema_bojata",       text: "Izplūdes sistēma bojāta vai nehermētiska" },
        { value: "vejstikls_bojats",              text: "Vējstikls bojāts redzamības zonā" },
        { value: "logu_tiritalji_nedarbojas",     text: "Logu tīrītāji nedarbojas" },
        { value: "drosibas_josta",                text: "Drošības josta bojāta vai nedarbojas" },
        { value: "degvielas_noplude",             text: "Degvielas sistēmas noplūde" },
        { value: "ellas_noplude",                 text: "Eļļas noplūde no dzinēja" },
        { value: "nesoso_elementu_korozija",      text: "Nesošo elementu korozija" }
      ],
      "3": [
        { value: "bremzu_sistema_nedarbojas",     text: "Bremžu sistēma nedarbojas" },
        { value: "bremzu_skiduma_noplude",        text: "Bremžu šķidruma intensīva noplūde" },
        { value: "bremzu_speka_neesamiba",        text: "Pilnīga bremžu spēka neesamība uz ass" },
        { value: "stūres_mehānisma_bojajums",     text: "Stūres mehānisma bojājums" },
        { value: "stūres_vadamiba",               text: "Stūres vadāmība apdraudēta" },
        { value: "ritenis_nenostiprināts",        text: "Ritenis nav droši nostiprināts" },
        { value: "riepa_kritisks_bojajums",       text: "Riepa ar kritisku bojājumu (plīsuma risks)" },
        { value: "atsperes_luzums",               text: "Atsperes lūzums" },
        { value: "balstiekarta_atvienota",        text: "Balstiekārtas detaļa atvienota vai salūzusi" },
        { value: "ramis_kritiski_bojats",         text: "Rāmis vai nesošā konstrukcija kritiski bojāta" },
        { value: "degviela_aizdegšanas_risks",    text: "Degvielas noplūde ar aizdegšanās risku" },
        { value: "izpludes_atdalita",             text: "Izplūdes sistēma atdalīta vai nokritusi" },
        { value: "redzamiba_ierobezota",          text: "Redzamība būtiski ierobežota" },
        { value: "durvis_neaizveras",             text: "Vadītāja durvis nevar droši aizvērt" },
        { value: "drosibas_josta_kritiski",       text: "Drošības josta nedarbojas kritiski" },
        { value: "kravas_nostiprinas_bistams",    text: "Kravas nostiprinājums bīstams satiksmei" },
        { value: "tiess_apdraudejums",            text: "Transportlīdzeklis rada tiešu apdraudējumu satiksmei" },
        { value: "konstrukcijas_bojajums",        text: "Būtisks konstrukcijas bojājums" },
        { value: "elektriba_aizdegšanas_risks",   text: "Elektriskās sistēmas bojājums ar aizdegšanās risku" },
        { value: "stavoklis_bistams",             text: "Transportlīdzekļa tehniskais stāvoklis bīstams ekspluatācijai" }
      ]
    };
  
    const ratingSelect = document.getElementById('prev_inspection_rating');
    const container    = document.getElementById('problem-group');
  
    // Create a <select> for problems of a given rating
    function makeProblemSelect(rating) {
      const sel = document.createElement('select');
      sel.name = 'prev_inspection_problem[]';
      sel.classList.add('problem-select');
      sel.innerHTML = `<option value="">Izvēlies problēmu</option>` +
        problemsByRating[rating].map(o =>
          `<option value="${o.value}">${o.text}</option>`
        ).join('');
      return sel;
    }
  
    // Create a <select> for choosing next rating (1,2,3)
    function makeRatingSelect() {
      const sel = document.createElement('select');
      sel.name = 'prev_inspection_rating_extra[]';
      sel.classList.add('rating-extra');
      sel.innerHTML = `
        <option value="">Pievienot vēl vienu vērtējumu</option>
        <option value="0">0 — Viss kārtībā (bez defektiem)</option>
        <option value="1">1 — Sīks trūkums vai bojājums</option>
        <option value="2">2 — Būtisks trūkums vai bojājums</option>
        <option value="3">3 — Bīstams trūkums vai bojājums</option>
      `;
      return sel;
    }
  
    // Clear container and initialize first problem select
    function initFirstProblem(rating) {
      container.innerHTML = '';
      if (!problemsByRating[rating]) {
        container.style.display = 'none';
        return;
      }
      const firstProb = makeProblemSelect(rating);
      container.appendChild(firstProb);
      container.style.display = 'block';
    }
  
    // Handle change events on dynamically added selects
    container.addEventListener('change', (e) => {
      const all = Array.from(container.querySelectorAll('select'));
      const last = all[all.length - 1];
      const sel  = e.target;
  
      // If last is a problem-select and has a value, append a rating-extra
      if (sel.classList.contains('problem-select') &&
          sel === last && sel.value !== '') {
        const nextRating = makeRatingSelect();
        container.appendChild(nextRating);
      }
  
      // If last is a rating-extra and has a value, append a problem-select for it
      if (sel.classList.contains('rating-extra') &&
          sel === last && sel.value !== '' && sel.value !== '0') {
        const nextProb = makeProblemSelect(sel.value);
        container.appendChild(nextProb);
      }
    });
  
    // Watch the main rating select
    ratingSelect.addEventListener('change', () => {
      initFirstProblem(ratingSelect.value);
    });
  
    // Optionally initialize on page load if already selected
    if (ratingSelect.value) {
      initFirstProblem(ratingSelect.value);
    }
  });
  