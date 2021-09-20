<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/calendar.css">
  </head>
  <body>
    <nav class="navbar navbar-dark bg-primary mb-3">
      <h3 style="color: white;">Mon calendrier</h3>
    </nav>
      <?php
      include 'src/Date/Month.php';
      try {
          $month = new App\Date\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
          $start = $month->getStartingDay()->modify('last monday');
      } catch (\Exception $e) {
        $month = new App\Date\Month();
      }


      ?>
      <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
        <h1><?= $month->toString(); ?></h1>
        <div>
          <a href="index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt;</a>
          <a href="index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt;</a>
          <a href="index.php" class="btn btn-primary">Aujourd'hui</a>
        </div>
      </div>




      <table class="calendar__table calendar__table--<?= $month->getWeeks(); ?> weeks">
        <?php for ($i=0; $i < $month->getWeeks(); $i++): ?>
          <tr>
            <?php
            foreach ($month->days as $k => $day):

              $date = (clone $start)->modify("+" . ($k + $i * 7) . "days");
              ?>
            <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>">
              <?php if ($i === 0): ?>
              <div class="calendar__weekday"><?= $day; ?></div>
            <?php endif; ?>
              <div class="calendar__day"><?= $date->format('d'); ?> </div>
            </td>
          <?php endforeach; ?>
          </tr>

        <?php endfor; ?>
      </table>

  </body>
</html>
