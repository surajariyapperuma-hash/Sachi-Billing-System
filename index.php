<?php
// index.php (SUPIRI + Mobile Optimized)
?>
<!DOCTYPE html>
<html lang="si">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SACHI - Small Bill</title>

  <style>
    :root{
      --bg:#0b1220;
      --bg2:#0f1a33;
      --text:#e5e7eb;
      --muted:#9ca3af;
      --line:rgba(255,255,255,.10);
      --blue:#60a5fa;
      --green:#34d399;
      --red:#fb7185;
      --shadow: 0 16px 40px rgba(0,0,0,.35);
      --radius:18px;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      color:var(--text);
      background:
        radial-gradient(1200px 600px at 20% 10%, rgba(96,165,250,.20), transparent 60%),
        radial-gradient(900px 500px at 80% 0%, rgba(52,211,153,.16), transparent 55%),
        radial-gradient(900px 500px at 50% 100%, rgba(251,113,133,.12), transparent 60%),
        linear-gradient(180deg, var(--bg), var(--bg2));
      min-height:100vh;
    }

    .wrap{max-width:1100px;margin:14px auto;padding:0 12px}

    .card{
      border:1px solid var(--line);
      border-radius:var(--radius);
      background: linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.04));
      box-shadow: var(--shadow);
      overflow:hidden;
    }
    .cardHead{
      padding:14px 16px;
      border-bottom:1px solid var(--line);
      display:flex;align-items:center;justify-content:space-between;gap:12px;
      background: linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.03));
    }
    .cardHead .left{display:flex;flex-direction:column;gap:2px}
    .cardHead .left b{font-size:14px}
    .cardHead .left span{font-size:12px;color:var(--muted)}
    .cardBody{padding:16px}

    /* Header */
    .header{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:14px;
      margin-bottom:12px;
      padding:12px 14px;
      border:1px solid var(--line);
      border-radius:var(--radius);
      background: linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.04));
      box-shadow: var(--shadow);
    }
    .brandBox{display:flex; align-items:center; gap:12px; min-width: 260px;}
    .brandBox img{width:110px;height:auto;filter: drop-shadow(0 8px 18px rgba(0,0,0,.35));}
    .brandText{display:flex; flex-direction:column; gap:2px;}
    .brandText h1{margin:0;font-size:22px;letter-spacing:.2px;line-height:1.1;}
    .brandText .sub{margin:0;color:var(--muted);font-size:12px;line-height:1.3;}

    .chipRow{display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-end}
    .chip{
      padding:8px 12px;border-radius:999px;border:1px solid var(--line);
      background:linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,.04));
      backdrop-filter: blur(8px);
      box-shadow: 0 10px 25px rgba(0,0,0,.22);
      font-size:12px;color:var(--muted);white-space:nowrap;
      display:flex;align-items:center;gap:8px;
    }
    .chip b{color:var(--text);font-weight:900}

    /* Layout */
    .layout{
      display:grid;
      grid-template-columns: 1.35fr .65fr;
      gap:12px;
      align-items:start;
    }

    /* Mobile layout */
    @media (max-width: 980px){
      .layout{grid-template-columns:1fr}
      .chipRow{justify-content:flex-start}
      .brandBox{min-width:unset}
    }

    @media (max-width: 520px){
      .header{flex-direction:column;align-items:flex-start}
      .brandBox img{width:95px}
      .brandText h1{font-size:20px}
      .cardBody{padding:12px}
      .cardHead{padding:12px}
    }

    label{display:block;font-size:12px;color:var(--muted);margin-bottom:6px}
    input, select, button{font-family:inherit}
    input, select{
      width:100%;
      padding:12px 12px;
      border-radius:14px;
      border:1px solid var(--line);
      outline:none;
      color:var(--text);
      background: rgba(0,0,0,.22);
      transition:.15s;
    }
    input:focus, select:focus{
      border-color: rgba(96,165,250,.65);
      box-shadow: 0 0 0 4px rgba(96,165,250,.16);
    }
    input::placeholder{color:rgba(229,231,235,.55)}

    .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    @media (max-width: 780px){ .grid{grid-template-columns:1fr} }

    .btn{
      border:0;padding:12px 14px;border-radius:14px;cursor:pointer;
      font-weight:950;font-size:14px;transition:.15s;
      display:inline-flex;align-items:center;gap:8px;user-select:none;
    }
    .btn:active{transform:translateY(1px)}
    .btnBlue{background: rgba(96,165,250,.18); color: var(--text); border:1px solid rgba(96,165,250,.25);}
    .btnGreen{background: linear-gradient(180deg, rgba(52,211,153,.95), rgba(16,185,129,.9)); color:#062014;}
    .btnDanger{background: rgba(251,113,133,.18); color: var(--text); border:1px solid rgba(251,113,133,.28); padding:10px 12px; border-radius:12px; font-weight:950;}
    .iconBtn{border:1px solid rgba(255,255,255,.14);background: rgba(255,255,255,.06);color: var(--text);border-radius:10px;padding:6px 10px;cursor:pointer;font-weight:900;}
    .iconBtn.d{border-color: rgba(251,113,133,.35); background: rgba(251,113,133,.14);}

    /* Table (mobile scroll) */
    .tableWrap{
      margin-top:14px;
      border:1px solid var(--line);
      border-radius:var(--radius);
      overflow:hidden;
      background: rgba(0,0,0,.18);
    }
    .tableScroll{
      overflow-x:auto;
      -webkit-overflow-scrolling: touch;
    }
    table{width:100%;border-collapse:separate;border-spacing:0;min-width: 720px;}
    thead th{
      text-align:left;font-size:12px;color:rgba(229,231,235,.85);
      background: rgba(255,255,255,.06);
      border-bottom:1px solid var(--line);
      padding:10px 12px;
      position:sticky; top:0;
    }
    tbody td{
      border-bottom:1px solid rgba(255,255,255,.06);
      padding:10px 12px;
      vertical-align:middle;
    }
    tbody tr:last-child td{border-bottom:0}
    .tdInput input{padding:10px 10px;border-radius:12px;font-size:14px}
    .right{text-align:right}
    .lt{font-weight:950;min-width:78px}
    .lt small{color:var(--muted);font-weight:800;margin-left:6px}
    .hintSmall{font-size:11px;color:rgba(229,231,235,.55);margin-top:6px}

    .btnRow{
      display:flex;gap:10px;flex-wrap:wrap;
      margin-top:14px;align-items:center;justify-content:space-between;
    }
    @media (max-width: 520px){
      .btnRow{flex-direction:column;align-items:stretch}
      .btnRow .leftBtns{width:100%}
      .btnRow button{width:100%;justify-content:center}
    }

    /* Summary */
    .summary{position:sticky;top:12px}
    @media (max-width: 980px){
      .summary{position:static}
    }
    .sumBox{padding:16px;display:flex;flex-direction:column;gap:12px}
    @media (max-width:520px){ .sumBox{padding:12px} }

    .kpiCard{
      border:1px solid var(--line);
      background: rgba(0,0,0,.20);
      border-radius:16px;
      padding:12px 12px;
      display:flex;justify-content:space-between;align-items:center;
      gap:10px;
    }
    .kpiCard .lab{color:var(--muted);font-size:12px}
    .kpiCard .val{font-size:18px;font-weight:950}
    .kpiCard .val span{font-size:12px;color:var(--muted);font-weight:800;margin-left:6px}
    .divider{height:1px;background:rgba(255,255,255,.08);margin:2px 0}

    /* Item manager list */
    .list{
      border:1px solid var(--line);
      border-radius:16px;
      background: rgba(0,0,0,.18);
      overflow:hidden;
    }
    .listHead{
      padding:10px 12px;
      border-bottom:1px solid rgba(255,255,255,.06);
      font-size:12px;
      color:rgba(229,231,235,.85);
      background: rgba(255,255,255,.06);
      display:flex;justify-content:space-between;align-items:center;
      gap:10px;
    }
    .listBody{max-height:240px; overflow:auto}
    .listRow{
      display:flex;justify-content:space-between;align-items:center;gap:10px;
      padding:10px 12px;
      border-bottom:1px solid rgba(255,255,255,.06);
    }
    .listRow:last-child{border-bottom:0}
    .itemName{font-weight:900}
    .priceTag{color:rgba(229,231,235,.85); font-weight:900}
    .rowBtns{display:flex;gap:8px;flex-wrap:wrap}
    .managerGrid2{display:grid;grid-template-columns: 1fr 120px 120px; gap:10px}
    @media (max-width:520px){
      .managerGrid2{grid-template-columns:1fr}
      .managerGrid2 button{width:100%;justify-content:center}
    }
  </style>
</head>

<body>
  <div class="wrap">

    <div class="header">
      <div class="brandBox">
        <img src="logo_mark.png" alt="Logo">
        <div class="brandText">
          <h1 id="shopNameText">SACHI Sweet and Foods</h1>
          <p class="sub" id="shopSubText">Small Bill Counter System</p>
        </div>
      </div>
      <div class="chipRow">
        <div class="chip">Mode: <b>Counter</b> 🧾</div>
        <div class="chip">Fast Keys: <b>Enter</b></div>
        <div class="chip">Mobile: <b>Optimized</b></div>
      </div>
    </div>

    <div class="layout">

      <!-- LEFT -->
      <div class="card">
        <div class="cardHead">
          <div class="left">
            <b>Bill Details</b>
            <span>Fill, add items, then print.</span>
          </div>
          <div class="chip">Bill No: <b class="mono">SACHI-0001</b></div>
        </div>

        <div class="cardBody">
          <form method="post" action="print.php" id="billForm">

            <div class="grid">
              <div>
                <label>Date</label>
                <input type="date" name="bill_date" value="<?php echo date('Y-m-d'); ?>" required>
              </div>

              <div>
                <label>Bill No</label>
                <input type="text" name="bill_no" id="billNo" placeholder="SACHI-0001" required>
              </div>

              <div>
                <label>Payment Method</label>
                <select name="pay_method">
                  <option>Cash</option>
                  <option>Card</option>
                  <option>Transfer</option>
                </select>
              </div>

              <div>
                <label>Paid Amount (LKR)</label>
                <input type="number" name="paid" id="paid" value="0" min="0" step="1" placeholder="0">
              </div>
            </div>

            <datalist id="commonItems"></datalist>

            <div class="tableWrap">
              <div class="tableScroll">
                <table id="itemsTable">
                  <thead>
                    <tr>
                      <th style="width:46%">Item</th>
                      <th style="width:14%">Qty</th>
                      <th style="width:18%">Price</th>
                      <th style="width:18%" class="right">Line Total</th>
                      <th style="width:64px" class="right">Remove</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="tdInput">
                        <input name="item[]" class="item" list="commonItems" placeholder="Select / Type item" required>
                        <div class="hintSmall">Select කරාම price auto-fill. Mobile වල table side-scroll වෙනවා.</div>
                      </td>
                      <td class="tdInput"><input name="qty[]" class="qty" type="number" min="1" value="1" required></td>
                      <td class="tdInput"><input name="price[]" class="price" type="number" min="0" value="0" required></td>
                      <td class="right lt"><span class="lineTotal">0</span> <small>LKR</small></td>
                      <td class="right"><button type="button" class="btnDanger" onclick="removeRow(this)">✕</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="btnRow">
              <div class="leftBtns" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
                <button type="button" class="btn btnBlue" onclick="addRow()">＋ Add Item</button>

                <div style="min-width:220px">
                  <label style="margin-bottom:6px;">Auto Print?</label>
                  <select name="autoprint">
                    <option value="1">Yes (Auto)</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>

              <button class="btn btnGreen" type="submit" id="printBtn">🖨 Print Bill</button>
            </div>

          </form>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="card summary">
        <div class="cardHead">
          <div class="left">
            <b>Live Summary</b>
            <span>Subtotal preview realtime</span>
          </div>
          <div class="chip">LKR</div>
        </div>

        <div class="sumBox">
          <div class="kpiCard">
            <div>
              <div class="lab">Rows</div>
              <div class="lab">Table rows count</div>
            </div>
            <div class="val" id="kpiRows">1 <span>rows</span></div>
          </div>

          <div class="kpiCard">
            <div>
              <div class="lab">Subtotal</div>
              <div class="lab">Sum of totals</div>
            </div>
            <div class="val" id="kpiSubtotal">0 <span>LKR</span></div>
          </div>

          <div class="kpiCard">
            <div>
              <div class="lab">Paid</div>
              <div class="lab">Entered amount</div>
            </div>
            <div class="val" id="kpiPaid">0 <span>LKR</span></div>
          </div>

          <div class="kpiCard" id="diffCard">
            <div>
              <div class="lab" id="kpiDiffLabel">Balance Due</div>
              <div class="lab">Auto calc</div>
            </div>
            <div class="val" id="kpiDiff">0 <span>LKR</span></div>
          </div>

          <div class="divider"></div>

          <div class="card" style="box-shadow:none;background:rgba(0,0,0,.14);border-radius:16px;border:1px solid var(--line);overflow:hidden">
            <div class="cardHead" style="border-bottom:1px solid var(--line);">
              <div class="left">
                <b>Item Manager</b>
                <span>Add items + prices</span>
              </div>
              <button class="iconBtn" type="button" onclick="resetItems()">Reset</button>
            </div>

            <div class="cardBody" style="padding:12px;">
              <div class="managerGrid2">
                <div>
                  <label>Item Name</label>
                  <input id="newItemName" placeholder="Eg: Ice Coffee">
                </div>
                <div>
                  <label>Price</label>
                  <input id="newItemPrice" type="number" min="0" step="1" placeholder="250">
                </div>
                <div style="display:flex;align-items:end;">
                  <button type="button" class="btn btnBlue" style="width:100%;justify-content:center;" onclick="addItemToList()">＋ Add</button>
                </div>
              </div>

              <div class="list" style="margin-top:10px;">
                <div class="listHead">
                  <span>Saved Items</span>
                  <span class="lab">(tap Edit/Del)</span>
                </div>
                <div class="listBody" id="itemsList"></div>
              </div>

            </div>
          </div>

        </div>
      </div>

    </div>

  </div>

<script>
  // ----------------- CONFIG -----------------
  const SHOP_NAME = "SACHI Sweet and Foods";
  const SHOP_SUB  = "Small Bill Counter System";
  const STORAGE_KEY = "sachi_items_v1";

  const DEFAULT_ITEMS = [
    {name:"Milk Toffee", price: 50},
    {name:"Watalappan", price: 200},
    {name:"Cake Piece", price: 180},
    {name:"Cup Cake", price: 150},
    {name:"Samosa", price: 80},
    {name:"Fish Bun", price: 120},
    {name:"Egg Bun", price: 130},
    {name:"Roll", price: 100},
    {name:"Faluda", price: 280},
    {name:"Ice Coffee", price: 250},
  ];

  document.getElementById("shopNameText").textContent = SHOP_NAME;
  document.getElementById("shopSubText").textContent = SHOP_SUB;

  function loadItems(){
    try{
      const raw = localStorage.getItem(STORAGE_KEY);
      if(!raw) return [...DEFAULT_ITEMS];
      const parsed = JSON.parse(raw);
      if(!Array.isArray(parsed)) return [...DEFAULT_ITEMS];
      return parsed.filter(x => x && typeof x.name === "string");
    }catch(e){ return [...DEFAULT_ITEMS]; }
  }
  function saveItems(items){ localStorage.setItem(STORAGE_KEY, JSON.stringify(items)); }
  function normalizeName(s){ return (s||"").trim().replace(/\s+/g," "); }

  let ITEMS = loadItems();

  function rebuildDatalist(){
    const dl = document.getElementById("commonItems");
    dl.innerHTML = "";
    ITEMS.slice().sort((a,b)=>a.name.localeCompare(b.name)).forEach(it=>{
      const op = document.createElement("option");
      op.value = it.name;
      dl.appendChild(op);
    });
  }

  function rebuildManagerList(){
    const box = document.getElementById("itemsList");
    box.innerHTML = "";
    const sorted = ITEMS.slice().sort((a,b)=>a.name.localeCompare(b.name));
    if(sorted.length === 0){
      const empty = document.createElement("div");
      empty.className = "listRow";
      empty.innerHTML = `<div class="lab">No items saved.</div>`;
      box.appendChild(empty);
      return;
    }

    sorted.forEach(it=>{
      const row = document.createElement("div");
      row.className = "listRow";
      row.innerHTML = `
        <div>
          <div class="itemName">${it.name}</div>
          <div class="lab">Price: <span class="priceTag">${it.price ?? 0} LKR</span></div>
        </div>
        <div class="rowBtns">
          <button class="iconBtn" type="button" onclick='editItem("${encodeURIComponent(it.name)}")'>Edit</button>
          <button class="iconBtn d" type="button" onclick='deleteItem("${encodeURIComponent(it.name)}")'>Del</button>
        </div>
      `;
      box.appendChild(row);
    });
  }

  function getPriceByName(name){
    const n = normalizeName(name);
    const found = ITEMS.find(x => normalizeName(x.name).toLowerCase() === n.toLowerCase());
    return found ? Number(found.price || 0) : null;
  }

  function addItemToList(){
    const name = normalizeName(document.getElementById("newItemName").value);
    const price = Math.max(0, parseInt(document.getElementById("newItemPrice").value || "0", 10));
    if(name === ""){ alert("Item name දාන්න"); return; }

    const idx = ITEMS.findIndex(x => normalizeName(x.name).toLowerCase() === name.toLowerCase());
    if(idx >= 0) ITEMS[idx].price = price;
    else ITEMS.push({name, price});

    saveItems(ITEMS);
    rebuildDatalist();
    rebuildManagerList();

    document.getElementById("newItemName").value = "";
    document.getElementById("newItemPrice").value = "";
    document.getElementById("newItemName").focus();
  }

  function editItem(encodedName){
    const name = decodeURIComponent(encodedName);
    const it = ITEMS.find(x => normalizeName(x.name).toLowerCase() === normalizeName(name).toLowerCase());
    if(!it) return;
    const newPrice = prompt(`Update price for: ${it.name}`, String(it.price ?? 0));
    if(newPrice === null) return;
    it.price = Math.max(0, parseInt(newPrice || "0", 10));

    saveItems(ITEMS);
    rebuildDatalist();
    rebuildManagerList();
    applyAutoPriceToAllRows();
    calcAll();
  }

  function deleteItem(encodedName){
    const name = decodeURIComponent(encodedName);
    if(!confirm(`Delete item: ${name} ?`)) return;
    ITEMS = ITEMS.filter(x => normalizeName(x.name).toLowerCase() !== normalizeName(name).toLowerCase());
    saveItems(ITEMS);
    rebuildDatalist();
    rebuildManagerList();
  }

  function resetItems(){
    if(!confirm("Reset items to default list?")) return;
    ITEMS = [...DEFAULT_ITEMS];
    saveItems(ITEMS);
    rebuildDatalist();
    rebuildManagerList();
    applyAutoPriceToAllRows();
    calcAll();
  }

  // ---------- Table ----------
  const money = (n) => (isNaN(n) ? 0 : Math.round(n));
  function rows(){ return Array.from(document.querySelectorAll("#itemsTable tbody tr")); }

  function addRow(prefill = {}){
    const tb = document.querySelector("#itemsTable tbody");
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td class="tdInput">
        <input name="item[]" class="item" list="commonItems" placeholder="Select / Type item" required value="${prefill.item ?? ''}">
        <div class="hintSmall">Select කරාම price auto-fill.</div>
      </td>
      <td class="tdInput"><input name="qty[]" class="qty" type="number" min="1" value="${prefill.qty ?? 1}" required></td>
      <td class="tdInput"><input name="price[]" class="price" type="number" min="0" value="${prefill.price ?? 0}" required></td>
      <td class="right lt"><span class="lineTotal">0</span> <small>LKR</small></td>
      <td class="right"><button type="button" class="btnDanger" onclick="removeRow(this)">✕</button></td>
    `;
    tb.appendChild(tr);
    hookAll();
    calcAll();
    tr.querySelector(".item").focus();
  }

  function removeRow(btn){
    const r = btn.closest("tr");
    const tb = document.querySelector("#itemsTable tbody");
    if(tb.querySelectorAll("tr").length > 1) r.remove();
    hookAll();
    calcAll();
  }

  function calcRow(tr){
    const q = parseFloat(tr.querySelector(".qty").value || 0);
    const p = parseFloat(tr.querySelector(".price").value || 0);
    const total = money(q * p);
    tr.querySelector(".lineTotal").textContent = total;
    return total;
  }

  function calcAll(){
    const trs = rows();
    let subtotal = 0;
    trs.forEach(tr => subtotal += calcRow(tr));

    const paid = money(parseFloat(document.getElementById("paid").value || 0));
    const diff = paid - subtotal;

    document.getElementById("kpiRows").innerHTML = `${trs.length} <span>rows</span>`;
    document.getElementById("kpiSubtotal").innerHTML = `${subtotal} <span>LKR</span>`;
    document.getElementById("kpiPaid").innerHTML = `${paid} <span>LKR</span>`;

    const label = document.getElementById("kpiDiffLabel");
    const diffBox = document.getElementById("kpiDiff");
    const diffCard = document.getElementById("diffCard");

    if(diff >= 0){
      label.textContent = "Change";
      diffBox.innerHTML = `${Math.abs(diff)} <span>LKR</span>`;
      diffCard.style.borderColor = "rgba(52,211,153,.35)";
    }else{
      label.textContent = "Balance Due";
      diffBox.innerHTML = `${Math.abs(diff)} <span>LKR</span>`;
      diffCard.style.borderColor = "rgba(251,113,133,.35)";
    }
  }

  function applyAutoPrice(tr){
    const itemName = tr.querySelector(".item").value;
    const p = getPriceByName(itemName);
    if(p !== null) tr.querySelector(".price").value = p;
  }
  function applyAutoPriceToAllRows(){ rows().forEach(tr => applyAutoPrice(tr)); }

  // ---------- Keyboard flow ----------
  function getInputsInOrder(){
    const form = document.getElementById("billForm");
    const base = Array.from(form.querySelectorAll(
      'input[name="bill_date"], input[name="bill_no"], select[name="pay_method"], input[name="paid"]'
    ));
    const t = [];
    rows().forEach(r=>{
      t.push(r.querySelector(".item"));
      t.push(r.querySelector(".qty"));
      t.push(r.querySelector(".price"));
    });
    return [...base, ...t].filter(el => el && !el.disabled && el.type !== "hidden");
  }

  function focusNext(current){
    const list = getInputsInOrder();
    const i = list.indexOf(current);
    if(i >= 0 && i < list.length - 1){
      list[i+1].focus();
      if(list[i+1].select) list[i+1].select();
    }
  }

  function onEnterJump(e){
    if(e.key !== "Enter") return;
    const el = e.target;
    if(el.id === "printBtn") return; // allow submit
    e.preventDefault();

    if(el.classList.contains("price")){
      const trs = rows();
      const tr = el.closest("tr");
      const isLast = trs[trs.length - 1] === tr;
      if(!isLast){ focusNext(el); return; }
      addRow();
      return;
    }
    focusNext(el);
  }

  function onItemChanged(e){
    const tr = e.target.closest("tr");
    if(!tr) return;
    applyAutoPrice(tr);
    calcAll();
  }

  function hookAll(){
    document.querySelectorAll(".qty, .price, #paid").forEach(i=>{
      i.removeEventListener("input", calcAll);
      i.addEventListener("input", calcAll);
    });

    document.querySelectorAll(".item").forEach(i=>{
      i.removeEventListener("change", onItemChanged);
      i.addEventListener("change", onItemChanged);
      i.removeEventListener("blur", onItemChanged);
      i.addEventListener("blur", onItemChanged);
    });

    const form = document.getElementById("billForm");
    form.querySelectorAll("input, select").forEach(el=>{
      el.removeEventListener("keydown", onEnterJump);
      el.addEventListener("keydown", onEnterJump);
    });
  }

  // Init
  rebuildDatalist();
  rebuildManagerList();
  hookAll();
  calcAll();
</script>

</body>
</html>