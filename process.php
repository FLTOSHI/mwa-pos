<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $detectors = include 'detectors.php';
    // Получение данных с формы
    $name = htmlspecialchars($_POST["name"]);
    $intelligence = (int)$_POST["intelligence"];
    $artefacts = (int)$_POST["artefacts"];
    $anomalies_skill = (int)$_POST["anomalies"];
    $location = $_POST["location"];
    $anomaly = $_POST["anomaly"];
    $anomaly_detector = $_POST["anomaly_detector"];
    $artifact_detector = $_POST["artifact_detector"];

    // Найти бонус к "Аномалиям" по выбранному детектору аномалий
    $anomaly_bonus = 0;
    foreach ($detectors['anomaly_detectors'] as $det) {
        if ($det['name'] === $anomaly_detector) {
            $anomaly_bonus = $det['bonus'];
            break;
        }
    }
    $anomalies_skill_total = $anomalies_skill + $anomaly_bonus;

    // Найти доступные тиры артефактов по выбранному детектору артефактов
    $artifact_tiers = [];
    foreach ($detectors['artifact_detectors'] as $det) {
        if ($det['name'] === $artifact_detector) {
            $artifact_tiers = $det['tiers'];
            break;
        }
    }

    echo "<h2>Введённые данные</h2>";
    echo "<ul>";
    echo "<li><b>Имя:</b> ".$name."</li>";
    echo "<li><b>Интеллект:</b> ".$intelligence."</li>";
    echo "<li><b>Навык Артефакты:</b> ".$artefacts."</li>";
    echo "<li><b>Навык Аномалии (базовый):</b> ".$anomalies_skill."</li>";
    echo "<li><b>Детектор аномалий:</b> ".$anomaly_detector." (бонус: +".$anomaly_bonus.")</li>";
    echo "<li><b>Навык Аномалии с учётом детектора:</b> ".$anomalies_skill_total."</li>";
    echo "<li><b>Детектор артефактов:</b> ".$artifact_detector." (доступные тиры: ".implode(', ', $artifact_tiers).")</li>";
    echo "<li><b>Локация:</b> ".$location."</li>";
    echo "<li><b>Аномальное поле:</b> ".$anomaly."</li>";
    echo "<li><b>Детектор аномалий:</b> ".$anomaly_detector."</li>";
    echo "<li><b>Детектор артефактов:</b> ".$artifact_detector."</li>";
    echo "</ul>";
}
?>