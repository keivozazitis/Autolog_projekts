// cascading-issues.js

document.addEventListener('DOMContentLoaded', () => {
    const problemsByRating = {
      "1": [
        { value: "virspuseja_korozija",  text: "Virspusējā rāmja vai nesošā elementa korozija" },
        { value: "neveidojot_piles",  text: "Neveidojot piles sūcas eļļa no motora.(transmisijas)" },
        { value: "nelieli_riepas",  text: "Nelieli vietēji vai virspusēji riepas bojājumi" }
      ],
      "2": [
        { value: "kreisais_miglas",   text: "Kreisais priekšējais miglas lukturis iestatīts par augstu" },
        { value: "bremzesanas_speks",  text: "Bremzēšanas spēka nevienmērība" },
        { value: "stāvbremze",   text: "Stāvbremze nestrādā" }
      ],
      "3": [
        { value: "grida_caurums",     text: "Grīdā konstatēts korozijas caurums" }
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
        <option value="">Izvēlies līmeni</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
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
          sel === last && sel.value !== '') {
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
  