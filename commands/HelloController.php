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
use Google_Service_Gmail;
use yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller {

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world') {
        //echo $message . "\n";

        $gmail = new Google_Service_Gmail(Yii::$app->google->getService());

        $messages = $gmail->users_messages->listUsersMessages('me', [
            'maxResults' => 1,
            'labelIds' => 'INBOX',
        ]);
        $list = $messages->getMessages();


        if (count($list) == 0) {
            echo "You have no emails in your INBOX .. how did you achieve that ??";
        } else {
            $messageId = $list[0]->getId(); // Grab first Message

            $message = $gmail->users_messages->get('me', $messageId, ['format' => 'full']);

            $messagePayload = $message->getPayload();
            $headers = $messagePayload->getHeaders();

            echo "Your last email subject is: ";
            foreach ($headers as $header) {
                if ($header->name == 'Subject') {
                    echo "<b>" . $header->value . "</b>";
                }
            }
        }

//        $html_source = SHD::file_get_html('https://docs.google.com/spreadsheets/d/1KHCOoB_3smFwx4CsQhJZvkQQVxn6S_nMMY4IRQI--nY/edit#gid=48939431'); 
//        echo $html_source;

        return ExitCode::OK;
    }

}
