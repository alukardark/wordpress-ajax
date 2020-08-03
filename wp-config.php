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
define( 'DB_NAME', 'barcode' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'x286dlnWXD-T-q%G7h!e91Pw9/Wdpv#6vWUs $0_|1/S>!e6>&Jq@oR]^zdre.;u' );
define( 'SECURE_AUTH_KEY',  '-qfIp[z D~9l5>%Q!NHjN_^Z2{%@YUXIv xq y[e%bDy-O]Yl*^0*hlhhWkE=Nd>' );
define( 'LOGGED_IN_KEY',    'LixM|e,E!CB6E@(>qn<:oxXr0TQ<pSinUcdn^AFKWFr:?sdM7+[F*Nm4=>^r??Z!' );
define( 'NONCE_KEY',        'h#q~fVF!ut4t|lc!tZ;@}BRkD[mj}X9Th?koQU.D*|uAWg6N`OOYDbZ=U1YiipcN' );
define( 'AUTH_SALT',        '-0WLk hf]E77/2n!rZYSq_(8 ,c|>Xls7;I1nu1}c_jw3A8W8p_D2Z #FdfiPGO]' );
define( 'SECURE_AUTH_SALT', 'uw{+m/W!8T>;y{F}4A=J98-D.^,DZzM~d4S#@d+nt,SHl&hon]I-YTi@j;*MKqiF' );
define( 'LOGGED_IN_SALT',   'fdQ$cb&Gp.0bPO-U8B,EDO(zo|QR0Ue+Kh! uM`C3]g@(lX?_%G?&j1?55h6*n`b' );
define( 'NONCE_SALT',       'ahQKLemz+p~j,`mit6uy{ea|o@o[|2 `}LU`~{]$E$(e&KdO8<_A(tXx0DRG$I$g' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
