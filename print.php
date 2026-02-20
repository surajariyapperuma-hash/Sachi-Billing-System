<?php
// print.php

function clean($s){ return htmlspecialchars(trim((string)$s), ENT_QUOTES, 'UTF-8'); }

$date = clean($_POST['bill_date'] ?? '');
$billNo = clean($_POST['bill_no'] ?? '');
$payMethod = clean($_POST['pay_method'] ?? 'Cash');
$paid = (int)($_POST['paid'] ?? 0);
$autoprint = (int)($_POST['autoprint'] ?? 1);

$items  = $_POST['item'] ?? [];
$qtys   = $_POST['qty'] ?? [];
$prices = $_POST['price'] ?? [];

$lines = [];
$subtotal = 0;

for($i=0; $i<count($items); $i++){
  $name = clean($items[$i] ?? '');
  $q = (int)($qtys[$i] ?? 0);
  $p = (int)($prices[$i] ?? 0);

  if($name === '' || $q <= 0) continue;

  $lt = $q * $p;
  $subtotal += $lt;
  $lines[] = ['name'=>$name, 'qty'=>$q, 'price'=>$p, 'total'=>$lt];
}

$total = $subtotal;
$diff = $paid - $total; // >=0 change, <0 balance due
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Print Bill</title>

<style>
  /* 80mm thermal friendly */
  @page { size: 80mm auto; margin: 4mm; }
  body{ font-family: Arial, sans-serif; width: 72mm; margin:0 auto; color:#000; }
  .center{text-align:center;}
  hr{ border:0; border-top:1px dashed #000; margin:8px 0; }
  table{ width:100%; border-collapse:collapse; font-size:12px; }
  th,td{ padding:3px 0; }
  th{ text-align:left; border-bottom:1px solid #000; }
  .r{text-align:right;}
  .big{ font-size:14px; font-weight:700; }
  .muted{ font-size:11px; }
  .note{ font-size:11px; text-align:center; margin-top:8px; }
  .no-print{ margin:10px 0; text-align:center; display:flex; gap:8px; justify-content:center; flex-wrap:wrap; }
  button{ padding:8px 10px; border:0; border-radius:10px; cursor:pointer; font-family:Arial,sans-serif; }
  .p{ background:#0b7a3b; color:#fff; }
  .b{ background:#1f7ae0; color:#fff; }
  .g{ background:#444; color:#fff; }
  @media print{ .no-print{ display:none; } }
</style>
</head>

<body>

<!-- ✅ Receipt only area (PNG capture එකට) -->
<div id="receipt">

  <div class="center">
    <!-- ✅ Logo -->
    <img src="logo.png" style="width:160px;max-width:100%;height:auto;margin-bottom:4px;" alt="SACHI Logo">
    <div class="muted">Tel: 0750 70 40 30</div>
  </div>

  <hr>

  <div class="muted">
    Date: <?php echo $date; ?><br>
    Bill No: <?php echo $billNo; ?>
  </div>

  <hr>

  <table>
    <thead>
      <tr>
        <th>Item</th>
        <th class="r">Qty</th>
        <th class="r">Price</th>
        <th class="r">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php if(empty($lines)): ?>
        <tr><td colspan="4" class="center muted">No items</td></tr>
      <?php else: ?>
        <?php foreach($lines as $ln): ?>
          <tr>
            <td><?php echo $ln['name']; ?></td>
            <td class="r"><?php echo $ln['qty']; ?></td>
            <td class="r"><?php echo $ln['price']; ?></td>
            <td class="r"><?php echo $ln['total']; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <hr>

  <table>
    <tr><td>Subtotal</td><td class="r"><?php echo $subtotal; ?></td></tr>
    <tr><td class="big">Total (LKR)</td><td class="r big"><?php echo $total; ?></td></tr>
    <tr><td>Paid</td><td class="r"><?php echo $paid; ?></td></tr>
    <tr>
      <td><?php echo ($diff >= 0) ? 'Change' : 'Balance Due'; ?></td>
      <td class="r"><?php echo abs($diff); ?></td>
    </tr>
  </table>

  <hr>

  <div class="center muted">Payment: <?php echo $payMethod; ?></div>

  <div class="note">
    Thank you for ordering! ❤<br>
    SACHI Sweet and Foods
  </div>

</div>
<!-- ✅ receipt end -->

<div class="no-print">
  <button class="p" onclick="window.print()">🖨 Print</button>
  <button class="b" onclick="downloadPNG()">⬇ Download PNG</button>
  <button class="g" onclick="window.location.href='index.php'">Back</button>
</div>

<!-- ✅ Offline html2canvas -->
<script src="html2canvas.min.js"></script>
<script>
async function downloadPNG(){
  const el = document.getElementById("receipt");

  // make sure images are loaded
  const imgs = el.querySelectorAll("img");
  for (const img of imgs){
    if(!img.complete){
      await new Promise(res => { img.onload = res; img.onerror = res; });
    }
  }

  // capture
  const canvas = await html2canvas(el, {
    scale: 2,         // clarity
    useCORS: true,
    backgroundColor: "#ffffff"
  });

  const a = document.createElement("a");
  const billNo = "<?php echo $billNo !== '' ? $billNo : 'SACHI-BILL'; ?>";
  a.download = billNo + ".png";
  a.href = canvas.toDataURL("image/png");
  a.click();
}

<?php if($autoprint === 1): ?>
window.onload = () => { window.print(); };
<?php endif; ?>
</script>

</body>
</html>