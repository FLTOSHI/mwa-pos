<?php
$locations = include 'locations.php';
$detectors = include 'detectors.php';
$artifacts = include 'artifacts.php';
$anomalies = include 'anomalies.php';
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Искалка артефактов</title>
    <script>
        // Передаем данные локаций с аномалиями в JS
        const locationsData = <?php echo json_encode($locations, JSON_UNESCAPED_UNICODE); ?>;
        window.addEventListener('DOMContentLoaded', function() {
            const locationSelect = document.getElementById('location');
            const anomalySelect = document.getElementById('anomaly');

            function clearAnomalies() {
                anomalySelect.innerHTML = '<option value="" disabled selected>Сначала выберите локацию</option>';
                anomalySelect.disabled = true;
            }

            locationSelect.addEventListener('change', function() {
                const selectedLocation = locationSelect.value;
                anomalySelect.innerHTML = '';
                let found = false;
                locationsData.forEach(loc => {
                    if (loc.name === selectedLocation) {
                        found = true;
                        if (loc.sublocations && loc.sublocations.length > 0) {
                            loc.sublocations.forEach(sub => {
                                let text = sub.name + ' (' + sub.anomaly_type + (sub.artifacts !== null ? ', артефактов: ' + sub.artifacts : '') + ')';
                                let opt = document.createElement('option');
                                opt.value = sub.name;
                                opt.textContent = text;
                                anomalySelect.appendChild(opt);
                            });
                            anomalySelect.disabled = false;
                        } else {
                            clearAnomalies();
                        }
                    }
                });
                if (!found) clearAnomalies();
            });
            clearAnomalies();
        });
    </script>
</head>
<body>
<h1>Добро пожаловать.</h1>
<p>Введи информацию о сталкере и скажу, чё он нашел.</p>
<form action="process.php" method="post">
    <label for="name">Имя персонажа:</label>
    <input type="text" placeholder="Иван Иванов" id="name" name="name" required pattern="^[^\d]+$" title="Имя не должно содержать цифр"><br>

    <label for="name">Характеристика «Интеллект»:</label>
    <input type="number" min="2" max="8" placeholder="8" id="intelligence" name="intelligence" required><br>

    <label for="name">Навык «Артефакты»:</label>
    <input type="number" min="0" max="13" placeholder="13" id="artefacts" name="artefacts" required><br>

    <label for="name">Навык «Аномалии»:</label>
    <input type="number" min="0" max="13" placeholder="13" id="anomalies" name="anomalies" required><br>

    <label for="location">Локация:</label>
    <select id="location" name="location" required>
        <option value="" disabled selected>Выберите локацию</option>
        <?php foreach ($locations as $loc): ?>
            <option value="<?= htmlspecialchars($loc['name']) ?>">
                <?= htmlspecialchars($loc['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="anomaly">Аномальное поле:</label>
    <select id="anomaly" name="anomaly" disabled required>
        <option value="" disabled selected>Сначала выберите локацию</option>
    </select><br>

    <label for="anomaly_detector">Детектор аномалий:</label>
    <select id="anomaly_detector" name="anomaly_detector" required>
        <option value="" disabled selected>Выберите детектор аномалий</option>
        <?php foreach ($detectors['anomaly_detectors'] as $det): ?>
            <option value="<?= htmlspecialchars($det['name']) ?>">
                <?= htmlspecialchars($det['name']) ?> (<?= htmlspecialchars($det['description']) ?>)
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="artifact_detector">Детектор артефактов:</label>
    <select id="artifact_detector" name="artifact_detector" required>
        <option value="" disabled selected>Выберите детектор артефактов</option>
        <?php foreach ($detectors['artifact_detectors'] as $det): ?>
            <option value="<?= htmlspecialchars($det['name']) ?>">
                <?= htmlspecialchars($det['name']) ?> (<?= htmlspecialchars($det['description']) ?>)
            </option>
        <?php endforeach; ?>
    </select><br>

    <br><br>
    <button type="submit">Начать</button>
    <button type="reset">Сбросить</button>
</form>
</body>
</html>