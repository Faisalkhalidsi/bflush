<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use keltstr\simplehtmldom\SimpleHTMLDom as SHD;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GsheetController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionGet($message = 'hello world')
    {
        //echo $message . "\n";

        $html_source = SHD::file_get_html('http://cmon.telkom.co.id/cacti/noss-osm/cekdb.log'); 
        echo $html_source;

        return ExitCode::OK;
    }
}
