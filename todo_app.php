<?php

$tasks = [];

$tasksFile = 'tasks.json';
if (file_exists($tasksFile)) {
    $tasks = json_decode(file_get_contents($tasksFile), true);
}
while (true) {
    echo "===== Vazifalar ro'yxati =====\n";
    echo "1. Vazifa qo'shish\n";
    echo "2. Vazifani olib tashlash\n";
    echo "3. Vazifani ko'rish\n";
    echo "4. Vazifani bajarilgan deb belgilash\n";
    echo "5. Chiqish\n";
    echo "Tanlovni kiriting: ";

    $choice = readline();

    switch ($choice) {
        case '1':
            echo "Vazifa nomi: ";
            $title = readline();
            echo "Vazifa tavsifini kiriting: ";
            $description = readline();
            echo "Vazifa tugash sanasi: ";
            $lifetime = readline();
            
            $task = [
                'title' => $title,
                'description' => $description,
                'lifetime' => $lifetime,
                'status' => 'Tugallanmagan'
            ];
            
            $tasks[$title] = $task;
            echo "Vazifa muvaffaqiyatli qo'shildi!\n";
            break;

        case '2':
            echo "Vazifani olib tashlash uchun nomini kiriting: ";
            $title = readline();

            if (isset($tasks[$title])) {
                unset($tasks[$title]);
                echo "Vazifa muvaffaqiyatli olib tashlandi!\n";
            } else {
                echo "Vazifa topilmadi\n";
            }
            break;

        case '3':
            echo "===== Vazifalar =====\n";
            foreach ($tasks as $task) {
                echo "Sarlavha: " . $task['title'] . "\n";
                echo "Tavsif: " . $task['description'] . "\n";
                echo "Muddat: " . $task['lifetime'] . "\n";
                echo "Status: " . $task['status'] . "\n\n";
                echo "-----------------\n";
            }
            break;

        case '4':
            echo "Bajarildi deb belgilash uchun vazifa nomini kiriting: ";
            $title = readline();

            if (isset($tasks[$title])) {
                $tasks[$title]['status'] = 'Completed';
                echo "Vazifa bajarildi deb belgilandi!\n";
            } else {
                echo "Vazifa topilmadi!\n";
            }
            break;

        case '5':
            exit();

        default:
        echo "Yaroqsiz tanlov! Iltimos, yana bir bor urinib ko'ring.\n";
        break;
    }
    file_put_contents($tasksFile, json_encode($tasks, JSON_PRETTY_PRINT));
    echo "\n";
}

?>
