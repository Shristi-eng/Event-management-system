<?php

require_once __DIR__ . '/TestCase.php';
require_once __DIR__ . '/Validator.php';
require_once __DIR__ . '/EventValidationTest.php';

// ── Run tests ─────────────────────────────────────────────────────────────────
$suite   = new EventValidationTest();
$results = $suite->run();

// ── Group by test method ──────────────────────────────────────────────────────
$grouped = [];
foreach ($results as $r) {
    $grouped[$r['test']][] = $r;
}

// ── Counts ────────────────────────────────────────────────────────────────────
$pass    = count(array_filter($results, fn($r) => $r['passed']));
$fail    = count($results) - $pass;
$total   = count($results);
$pct     = $total > 0 ? round($pass / $total * 100) : 0;
$allPass = $fail === 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>JUnit Test Results – Admin Dashboard</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f9; color: #222; font-size: 14px; }

  /* ── Header ── */
  header {
    background: #1a237e;
    color: #fff;
    padding: 18px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  header h1 { font-size: 18px; font-weight: 600; }
  header small { opacity: .75; font-size: 12px; display: block; margin-top: 3px; }
  .status-pill {
    padding: 6px 18px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 13px;
  }
  .status-pill.ok   { background: #43a047; color: #fff; }
  .status-pill.err  { background: #e53935; color: #fff; }

  /* ── Summary bar ── */
  .summary {
    display: flex;
    gap: 0;
    border-bottom: 1px solid #ddd;
    background: #fff;
  }
  .summary-card {
    flex: 1;
    padding: 22px 28px;
    text-align: center;
    border-right: 1px solid #eee;
  }
  .summary-card:last-child { border-right: none; }
  .summary-card .num  { font-size: 36px; font-weight: 700; line-height: 1; }
  .summary-card .lbl  { font-size: 12px; color: #777; margin-top: 4px; text-transform: uppercase; letter-spacing: .5px; }
  .c-blue  .num { color: #1565c0; }
  .c-green .num { color: #2e7d32; }
  .c-red   .num { color: #c62828; }
  .c-gold  .num { color: #e65100; }

  /* ── Progress bar ── */
  .progress-wrap { background: #fff; padding: 0 32px 14px; }
  .progress-bar { height: 8px; border-radius: 4px; background: #e0e0e0; overflow: hidden; margin-top: 4px; }
  .progress-fill { height: 100%; background: #43a047; transition: width .4s; }
  .progress-fill.partial { background: #e53935; }

  /* ── Content ── */
  .content { padding: 24px 32px; }

  /* ── Test row ── */
  .test-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 16px;
    border-left: 3px solid transparent;
    border-bottom: 1px solid #f0f0f0;
    background: #fff;
  }
  .test-row:first-child { border-radius: 8px 8px 0 0; }
  .test-row:last-child  { border-radius: 0 0 8px 8px; border-bottom: none; }
  .test-row.pass { border-left-color: #43a047; }
  .test-row.fail { border-left-color: #e53935; background: #fff8f8; }

  .icon { font-size: 16px; margin-top: 1px; flex-shrink: 0; }
  .icon.pass { color: #43a047; }
  .icon.fail { color: #e53935; }

  .test-name { font-family: 'Courier New', monospace; font-size: 13px; font-weight: 600; color: #1a237e; }
  .test-name.fail { color: #c62828; }

  .detail {
    font-family: 'Courier New', monospace;
    font-size: 11px;
    color: #c62828;
    background: #fff3f3;
    border: 1px solid #ffcdd2;
    border-radius: 4px;
    padding: 6px 10px;
    margin-top: 6px;
    white-space: pre-wrap;
  }

  /* ── Group heading ── */
  .group-title {
    font-size: 13px;
    font-weight: 700;
    color: #fff;
    background: #283593;
    padding: 8px 16px;
    border-radius: 8px 8px 0 0;
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .group-title .g-badge {
    font-size: 11px;
    background: rgba(255,255,255,.2);
    border-radius: 12px;
    padding: 2px 10px;
  }
  .group-block { border-radius: 0 0 8px 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.08); }

  footer { text-align: center; color: #aaa; font-size: 11px; padding: 24px; }
</style>
</head>
<body>

<header>
  <div>
    <h1>EventValidationTest — JUnit Test Results</h1>
    <small>Admin Dashboard · PlanBot Event Management System · CTEC2713</small>
  </div>
  <span class="status-pill <?= $allPass ? 'ok' : 'err' ?>">
    <?= $allPass ? '✔ ALL TESTS PASSED' : '✖ FAILURES DETECTED' ?>
  </span>
</header>

<!-- SUMMARY -->
<div class="summary">
  <div class="summary-card c-blue">
    <div class="num"><?= $total ?></div>
    <div class="lbl">Tests Run</div>
  </div>
  <div class="summary-card c-green">
    <div class="num"><?= $pass ?></div>
    <div class="lbl">Passed</div>
  </div>
  <div class="summary-card c-red">
    <div class="num"><?= $fail ?></div>
    <div class="lbl">Failed</div>
  </div>
  <div class="summary-card c-gold">
    <div class="num"><?= $pct ?>%</div>
    <div class="lbl">Pass Rate</div>
  </div>
</div>

<!-- PROGRESS BAR -->
<div class="progress-wrap">
  <div class="progress-bar">
    <div class="progress-fill <?= $allPass ? '' : 'partial' ?>" style="width:<?= $pct ?>%"></div>
  </div>
</div>

<!-- TEST RESULTS GROUPED BY METHOD NAME -->
<div class="content">

<?php
// Group tests by property prefix (testEventName_, testLocation_, etc.)
$groups = [];
foreach ($grouped as $testName => $assertions) {
    preg_match('/^test([A-Z][a-zA-Z]+?)_/', $testName, $m);
    $group = $m[1] ?? 'Other';
    $groups[$group][$testName] = $assertions;
}

foreach ($groups as $groupName => $tests):
    $gPass = 0; $gTotal = 0;
    foreach ($tests as $assertions) {
        foreach ($assertions as $a) {
            $gTotal++;
            if ($a['passed']) $gPass++;
        }
    }
?>
  <div class="group-title">
    <span><?= htmlspecialchars($groupName) ?></span>
    <span class="g-badge"><?= $gPass ?>/<?= $gTotal ?> passed</span>
  </div>
  <div class="group-block">
  <?php foreach ($tests as $testName => $assertions):
    $testPassed = array_reduce($assertions, fn($c, $a) => $c && $a['passed'], true);
    $cls = $testPassed ? 'pass' : 'fail';
  ?>
    <div class="test-row <?= $cls ?>">
      <span class="icon <?= $cls ?>"><?= $testPassed ? '✔' : '✖' ?></span>
      <div style="flex:1">
        <div class="test-name <?= $cls ?>"><?= htmlspecialchars($testName) ?>()</div>
        <?php foreach ($assertions as $a): if (!$a['passed']): ?>
          <div class="detail"><?= htmlspecialchars($a['detail']) ?></div>
        <?php endif; endforeach; ?>
      </div>
      <small style="color:#aaa;white-space:nowrap;font-size:11px">
        <?= count($assertions) ?> assertion<?= count($assertions) !== 1 ? 's' : '' ?>
      </small>
    </div>
  <?php endforeach; ?>
  </div>
<?php endforeach; ?>

</div>

<footer>
  Generated <?= date('d M Y, H:i:s') ?> &nbsp;·&nbsp;
  EventValidationTest &nbsp;·&nbsp;
  Tester: Suhani &nbsp;·&nbsp;
  CTEC2713 Agile Development Team Project
</footer>

</body>
</html>
