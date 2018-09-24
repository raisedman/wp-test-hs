<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wordpress');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Z1{,(~9}2s>r+xlpR vYyuJuxu%u8@D|tiY;*cG~~V80:nh#g/A`aL1GV@@}k] p');
define('SECURE_AUTH_KEY',  'fHJQU~mT&t1)wF!JhJU^PV*sl?SwbKC<QR0?<dMV>So@U?z25~A;q*[9B|3*AuYc');
define('LOGGED_IN_KEY',    'r<)og_|26s%(/jOX$yO*O2mX8k/Z?(OvLv_eF~$GJ$O3YirgG7u>OtWAFOWn>]CV');
define('NONCE_KEY',        'nIT7n/8%gR&;0]DM8,~Z~5;+ cclWaTo?xPufG{hqM-/KF?MybD,+HE:jMtozA5<');
define('AUTH_SALT',        'Hp!^-RV=D$T0aH{Ad~mS$RUpm:n6|HpA 0q4[^ovy5-p_}q;gbX)oS0a<lVFddy!');
define('SECURE_AUTH_SALT', ',m?tM0[|k7l*q+3|^:yGs%xEWb9J9,:]vq&^%M!w4IGIp0c2:7Ll{9lu0j$wuMpg');
define('LOGGED_IN_SALT',   '5()OX<F)Go=Ry(f.VSdI+vH$e*%`zyMs#CO*jN sB$-gWCRU0n?@5,&r_+Xd3IP)');
define('NONCE_SALT',       'G)y8AycqK&jX bu@|c&0Ti7LW%Nwrk 4S,*3+h&t6nz8KE?)|/% DV`Ng[:{4DT(');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
