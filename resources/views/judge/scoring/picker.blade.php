<x-app-layout>
    <x-slot name="header">
    <div style="text-align:center; line-height:1.1; margin-top:-50px;">
        <div style="font-size:26px;font-weight:900; letter-spacing:0.4px;">
            {{ strtoupper($segment->name) }} - SCORING
        </div>
        <div style="color:#666;margin-top:4px;font-size:13px;">
            Click a number to score. Autosaves locally. Submit only when all are complete.
        </div>
    </div>
</x-slot>


    <div style="padding:18px;max-width:1300px;margin:0 auto;">
        @if(session('status'))
            <div style="padding:10px;border:1px solid #d1fae5;background:#ecfdf5;margin-bottom:14px;border-radius:10px;">
                {{ session('status') }}
            </div>
        @endif

        <style>
            :root{
    /* Pantone-ish theme tokens (tweak later if you want exact book match) */
    --male: #0057B8;          /* Pantone-like Blue */
    --male-100: #EAF2FF;
    --male-200: #CFE1FF;

    --female: #E4007C;        /* Pantone-like Pink */
    --female-100: #FFE7F3;
    --female-200: #FFC3E1;

    --ink: #111827;
    --muted: #6b7280;
}
/* Panel theming */
.panel.male {
    background: linear-gradient(180deg, var(--male-100) 0%, #ffffff 45%);
    border: 2px solid var(--male-200);
}
.panel.female {
    background: linear-gradient(180deg, var(--female-100) 0%, #ffffff 45%);
    border: 2px solid var(--female-200);
}

/* Titles */
.panel.male .panelTitle{ color: var(--male); text-align: center;}
.panel.female .panelTitle{ color: var(--female); text-align: center;}

/* Number buttons default border color */
.panel.male .numBtn{ border-color: var(--male-200); }
.panel.female .numBtn{ border-color: var(--female-200); }

/* Active number button (selected) */
.panel.male .numBtn.active{
    background: var(--male);
    border-color: var(--male);
    color:#fff;
}
.panel.female .numBtn.active{
    background: var(--female);
    border-color: var(--female);
    color:#fff;
}

/* Done state (completed contestant) - still green, but tinted border */
.panel.male .numBtn.done{ border-color: #16a34a; }
.panel.female .numBtn.done{ border-color: #16a34a; }

/* Photo box border accent */
.panel.male .photoBox{ border-color: var(--male-200); }
.panel.female .photoBox{ border-color: var(--female-200); }

/* Criteria box accent */
.panel.male .criteriaBox{ border-color: var(--male-200); }
.panel.female .criteriaBox{ border-color: var(--female-200); }

/* Input focus highlight by panel */
.panel.male .input:focus{
    outline: 3px solid rgba(0,87,184,.25);
    border-color: var(--male);
}
.panel.female .input:focus{
    outline: 3px solid rgba(228,0,124,.25);
    border-color: var(--female);
}

/* Submit button polish */
.submit{
    background: linear-gradient(180deg, #111 0%, #000 100%);
    border-color:#000;
    box-shadow: 0 8px 18px rgba(0,0,0,.12);
}
.submit:hover{ filter: brightness(1.08); }

            .wrap { border:1px solid #e5e7eb; border-radius:12px; background:#fff; padding:14px; }
            .topline { display:flex; justify-content:space-between; gap:10px; flex-wrap:wrap; align-items:center; margin-bottom:12px; }
            .topline .left { font-weight:900; }
            .topline .right { color:#666; font-weight:700; }

            .grid2 { 
    display:grid; 
    grid-template-columns: 1fr 1fr; 
    gap:96px;              /* ✅ ~1 inch horizontal space */
}

/* On smaller screens, reduce gap so it doesn’t look broken */
@media(max-width: 1200px){
    .grid2{
        gap:48px;
    }
}
@media(max-width: 900px){
    .grid2{
        grid-template-columns:1fr;
        gap:24px;
    }
}
.panel.male{
    box-shadow: 6px 0 0 rgba(0,0,0,0.02);
}
.panel.female{
    box-shadow: -6px 0 0 rgba(0,0,0,0.02);
}


            /* ✅ one row only (scroll if small screen) */
            .numGrid{
                display:flex;
                gap:8px;
                flex-wrap:nowrap;
                justify-content:flex-start;
                overflow-x:auto;
                -webkit-overflow-scrolling:touch;
                margin-top:10px;
                padding:10px;
                border:1px solid #e5e7eb;
                border-radius:10px;
                background:#fff;
            }
            .numBtn{
                flex:1;
                margin:0 4px;
                padding:8px 0;
                border-radius:8px;
                border:1px solid #ccc;
                text-align:center;
            }
            .numBtn.active { background:#111; color:#fff; border-color:#111; }
            .numBtn.done { background:#dcfce7; border-color:#16a34a; }
            .numBtn.active.done { background:#111; color:#fff; border-color:#111; }

            .main { display:grid; grid-template-columns: 1.1fr 1fr; gap:12px; margin-top:12px; }
            @media(max-width: 1050px){ .main { grid-template-columns:1fr; } }

            .photoBox { border:1px solid #e5e7eb; border-radius:12px; background:#fff; padding:12px; }
            .photo { height:220px; border-radius:12px; background:#e5e7eb; display:flex; align-items:center; justify-content:center;
                     font-size:54px; font-weight:900; }
            .who { text-align:center; margin-top:10px; }
            .who .name { font-weight:900; font-size:18px; }
            .who .meta { color:#666; margin-top:2px; }

            .criteriaBox { border:1px solid #e5e7eb; border-radius:12px; background:#fff; padding:12px; }
            .critTitle { font-weight:900; margin-bottom:10px; }

            .row {
                display:flex;
                justify-content:space-between;
                align-items:flex-start;
                gap:10px;
                padding:8px 10px;
                border:1px solid #eee;
                border-radius:10px;
                background:#fafafa;
                margin-bottom:6px;
            }
            .cname { font-weight:800; padding-top:10px; }

            .panel.male .cname{ color: var(--ink); }
.panel.female .cname{ color: var(--ink); }
.panel.male .critTitle{ color: var(--male); }
.panel.female .critTitle{ color: var(--female); }


            /* ✅ uniform textbox size, fits 10.0 */
            .input{
                width:120px;
                height:44px;
                padding:8px 10px;
                font-size:18px;
                text-align:center;
                box-sizing:border-box;
            }
            .input.invalid{
                border:2px solid #ef4444;
                background:#fef2f2;
            }

            /* ✅ inline warning under each textbox */
            .inlineWarn{
                margin-top:6px;
                font-size:12px;
                font-weight:800;
                color:#b91c1c;
                display:none;
                text-align:right;
                max-width:140px;
            }
            .inlineWarn.show{ display:block; }

            .footer { display:flex; justify-content:space-between; align-items:center; gap:10px; flex-wrap:wrap; margin-top:10px; }
            .progress { color:#666; font-weight:800; }
            .submit { padding:10px 16px; border:1px solid #111; background:#111; color:#fff; border-radius:10px; cursor:pointer; font-weight:900; }
            .submit:disabled { opacity:.6; cursor:not-allowed; }

            .autosave { font-size:12px; color:#666; margin-top:6px; text-align:center; }
        </style>

        <form method="POST" action="{{ route('judge.scoring.submit', $segment) }}" id="pickerForm">
            @csrf
            <div id="hiddenInputs"></div>

            <div class="wrap">
                <div class="topline">
                    <div class="left">SHEET VIEW</div>
                    <div class="right" id="globalProgress">Completed: 0 / 0</div>
                </div>

                <div class="grid2">
                    <!-- MALE PANEL -->
                    <div class="panel male">
                        <div class="panelTitle">MALE CANDIDATES</div>
                        <div class="numGrid" id="maleGrid"></div>

                        <div class="main">
                            <div class="photoBox">
                                <div class="photo" id="malePhoto">#</div>
                                <div class="who">
                                    <div class="name" id="maleName">Select a number</div>
                                    <div class="meta" id="maleMeta"></div>
                                    <div class="autosave">Autosave enabled</div>
                                </div>
                            </div>

                            <div class="criteriaBox">
                                <div class="critTitle">Criteria for Judging</div>
                                <div id="maleCriteria"></div>
                                <div class="footer">
                                    <div class="progress" id="maleProgress">Completed: 0 / 0</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FEMALE PANEL -->
                    <div class="panel female">
                        <div class="panelTitle">FEMALE CANDIDATES</div>
                        <div class="numGrid" id="femaleGrid"></div>

                        <div class="main">
                            <div class="photoBox">
                                <div class="photo" id="femalePhoto">#</div>
                                <div class="who">
                                    <div class="name" id="femaleName">Select a number</div>
                                    <div class="meta" id="femaleMeta"></div>
                                    <div class="autosave">Autosave enabled</div>
                                </div>
                            </div>

                            <div class="criteriaBox">
                                <div class="critTitle">Criteria for Judging</div>
                                <div id="femaleCriteria"></div>
                                <div class="footer">
                                    <div class="progress" id="femaleProgress">Completed: 0 / 0</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top:14px;display:flex;justify-content:center;">
                    <button type="submit" class="submit" id="submitBtn">Submit All Scores</button>
                </div>

                @if ($errors->any())
                    <div style="margin-top:16px;padding:10px;border:1px solid #fecaca;background:#fef2f2;border-radius:10px;">
                        <b>Please fix the following:</b>
                        <ul style="margin:0;padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </form>

        @php
            $criteriaArr = $criteria->map(function($c){
                return ['id' => $c->id, 'name' => $c->name];
            })->values()->all();

            $contestantsArr = $contestants->map(function($c){
                return [
                    'id' => $c->id,
                    'name' => $c->name,
                    'number' => $c->number,
                    'gender' => $c->gender,
                ];
            })->values()->all();
        @endphp

        <script>
            const CRITERIA = @json($criteriaArr);
            const CONTESTANTS = @json($contestantsArr);
            const EXISTING = @json($existing ?? []);

            const maleList = CONTESTANTS.filter(c => c.gender === 'male').sort((a,b)=>a.number-b.number);
            const femaleList = CONTESTANTS.filter(c => c.gender === 'female').sort((a,b)=>a.number-b.number);

            const LS_KEY = 'pageant_sheet_scores_{{ $segment->id }}_{{ auth()->id() }}';
            let store = JSON.parse(localStorage.getItem(LS_KEY) || 'null') || EXISTING || {};

            let activeMaleId = (maleList[0] && maleList[0].id) ? maleList[0].id : null;
            let activeFemaleId = (femaleList[0] && femaleList[0].id) ? femaleList[0].id : null;

            const maleGrid = document.getElementById('maleGrid');
            const femaleGrid = document.getElementById('femaleGrid');

            const malePhoto = document.getElementById('malePhoto');
            const maleName = document.getElementById('maleName');
            const maleMeta = document.getElementById('maleMeta');
            const maleCriteria = document.getElementById('maleCriteria');
            const maleProgress = document.getElementById('maleProgress');

            const femalePhoto = document.getElementById('femalePhoto');
            const femaleName = document.getElementById('femaleName');
            const femaleMeta = document.getElementById('femaleMeta');
            const femaleCriteria = document.getElementById('femaleCriteria');
            const femaleProgress = document.getElementById('femaleProgress');

            const globalProgress = document.getElementById('globalProgress');
            const submitBtn = document.getElementById('submitBtn');

            function saveLocal(){ localStorage.setItem(LS_KEY, JSON.stringify(store)); }

            function isValidScore(v){
                if (v === '' || v === null || v === undefined) return false;
                const s = String(v).trim();

                // 1-10 with optional 1 decimal
                if (!/^\d{1,2}(\.\d)?$/.test(s)) return false;

                const n = parseFloat(s);
                if (Number.isNaN(n)) return false;
                return n >= 1 && n <= 10;
            }

            function isComplete(contestantId){
                if(!contestantId) return false;
                const row = store[contestantId] || {};
                return CRITERIA.every(crit => row[crit.id] && String(row[crit.id]).trim() !== '');
            }

            function countDone(list){ return list.filter(c => isComplete(c.id)).length; }

            function updateProgress(){
                const maleDone = countDone(maleList);
                const femaleDone = countDone(femaleList);

                maleProgress.textContent = `Completed: ${maleDone} / ${maleList.length}`;
                femaleProgress.textContent = `Completed: ${femaleDone} / ${femaleList.length}`;

                const totalDone = maleDone + femaleDone;
                const totalAll = maleList.length + femaleList.length;
                globalProgress.textContent = `Completed: ${totalDone} / ${totalAll}`;

                // enable only when complete (validity checked on submit)
                submitBtn.disabled = (totalDone !== totalAll);
            }

            function renderGrid(list, gridEl, activeId, onSelect){
                gridEl.innerHTML = '';
                list.forEach(c=>{
                    const b = document.createElement('button');
                    b.type = 'button';
                    b.className = 'numBtn';
                    if(isComplete(c.id)) b.classList.add('done');
                    if(activeId === c.id) b.classList.add('active');
                    b.textContent = c.number;
                    b.addEventListener('click', ()=>onSelect(c.id));
                    gridEl.appendChild(b);
                });
            }

            function renderCriteriaPanel(contestantId, which){
                const c = CONTESTANTS.find(x=>x.id===contestantId);
                if(!c) return;

                const photoEl = which === 'male' ? malePhoto : femalePhoto;
                const nameEl = which === 'male' ? maleName : femaleName;
                const metaEl = which === 'male' ? maleMeta : femaleMeta;
                const panelEl = which === 'male' ? maleCriteria : femaleCriteria;

                photoEl.textContent = '#' + c.number;
                nameEl.textContent = c.name;
                metaEl.textContent = c.gender.toUpperCase();

                panelEl.innerHTML = '';

                CRITERIA.forEach((crit, idx)=>{
                    const row = document.createElement('div');
                    row.className = 'row';

                    const left = document.createElement('div');
                    left.className = 'cname';
                    left.textContent = crit.name;

                    // right container: input + inline warning
                    const rightBox = document.createElement('div');
                    rightBox.style.display = 'flex';
                    rightBox.style.flexDirection = 'column';
                    rightBox.style.alignItems = 'flex-end';

                    const input = document.createElement('input');
                    input.className = 'input';
                    input.type = 'text';
                    input.inputMode = 'decimal';
                    input.placeholder = '1-10';
                    input.value = (store[contestantId] && store[contestantId][crit.id]) ? store[contestantId][crit.id] : '';

                    const warn = document.createElement('div');
                    warn.className = 'inlineWarn';
                    warn.textContent = 'Please input numbers between 1 and 10.';

                    function syncValidation(){
                        const raw = String(input.value || '').trim();
                        if(raw !== '' && !isValidScore(raw)){
                            input.classList.add('invalid');
                            warn.classList.add('show');
                        } else {
                            input.classList.remove('invalid');
                            warn.classList.remove('show');
                        }
                    }

                    // initial state (in case localStorage has invalid)
                    syncValidation();

                    input.addEventListener('input', ()=>{
                        if(!store[contestantId]) store[contestantId] = {};
                        store[contestantId][crit.id] = input.value;

                        saveLocal();
                        syncValidation();
                        renderAll();
                    });

                    rightBox.appendChild(input);
                    rightBox.appendChild(warn);

                    row.appendChild(left);
                    row.appendChild(rightBox);
                    panelEl.appendChild(row);

                    if(idx === 0) setTimeout(()=>input.focus(), 10);
                });
            }

            function selectMale(id){
                activeMaleId = id;
                renderAll();
                renderCriteriaPanel(activeMaleId, 'male');
            }

            function selectFemale(id){
                activeFemaleId = id;
                renderAll();
                renderCriteriaPanel(activeFemaleId, 'female');
            }

            function renderAll(){
                renderGrid(maleList, maleGrid, activeMaleId, selectMale);
                renderGrid(femaleList, femaleGrid, activeFemaleId, selectFemale);
                updateProgress();
            }

            document.getElementById('pickerForm').addEventListener('submit', (e)=>{
                // must be complete first
                const totalDone = countDone(maleList) + countDone(femaleList);
                const totalAll = maleList.length + femaleList.length;
                if(totalDone !== totalAll){
                    e.preventDefault();
                    alert('Please complete scoring for ALL contestants before submitting.');
                    return;
                }

                // validate all scores
                for (const c of [...maleList, ...femaleList]) {
                    for (const crit of CRITERIA) {
                        const v = (store?.[c.id]?.[crit.id] ?? '').toString().trim();
                        if (v === '' || !isValidScore(v)) {
                            e.preventDefault();
                            alert('Please fix invalid scores. Only 1–10 with one decimal allowed.');
                            return;
                        }
                    }
                }

                // build hidden inputs
                const hidden = document.getElementById('hiddenInputs');
                hidden.innerHTML = '';

                for(const contestantId in store){
                    for(const criterionId in store[contestantId]){
                        const v = (store[contestantId][criterionId] ?? '').toString().trim();
                        if(!v) continue;

                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = `scores[${contestantId}][${criterionId}]`;
                        input.value = v;
                        hidden.appendChild(input);
                    }
                }
            });

            renderAll();
            if(activeMaleId) renderCriteriaPanel(activeMaleId, 'male');
            if(activeFemaleId) renderCriteriaPanel(activeFemaleId, 'female');
        </script>
    </div>
</x-app-layout>
