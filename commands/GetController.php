<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use keltstr\simplehtmldom\SimpleHTMLDom as SHD;
use app\models\NossaStatusIntegrasi;
use app\models\NossaTopTenTable;
use app\models\NossaSessionDbTotal;
use app\models\NossaSessionUserTotal;
use app\models\NossaWorkorderTotal;
use app\models\NossfOsmOrderQueue;
use app\models\NossfUimTopTen;
use app\models\NossfUimAsm;
use app\models\NossfUimTablespace;
use app\models\NossfUimSessionServer;
use app\models\NossaSessionAppl;
use app\models\NossaSessionDb;
use app\models\NossaDbStatus;

/**
 * @author Faisal Khalid <faisal.khalid@telkom.coid>
 * DIT- Telkom Indonesia
 */
class GetController extends Controller {

    public function findParam($param, $words, $init, $val) {
        $ketemu = FALSE;
        while ($ketemu == FALSE) {
            if ($words[$init] == $param) {
                $ketemu = TRUE;
                $init = $init + $val;
            }
            $init++;
        }
        return $init;
    }

    public function actionData() {
        $html_source = SHD::file_get_html('http://cmon.telkom.co.id/cacti/nossa/cekdb.log');
        $data = $html_source->plaintext;
        $words = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $data, -1, PREG_SPLIT_NO_EMPTY);
        $limit = 2000;
        $init = 0;

        $wkt = $words[8] . " " . $words[9];
        date_default_timezone_set('Asia/Jakarta');
        $waktuNya = date('Y-m-d H:i:s', strtotime($wkt));

        // untuk cek antrian integrasi
        $init = $this->findParam('B.Check', $words, $init, 5);
        $step = $init;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "Locking") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 2;
                    $modelIntegration = new NossaStatusIntegrasi();
                    $modelIntegration->integration_type = $words[$step];
                    $modelIntegration->queue = $words[$step + 1];
                    $modelIntegration->waktu = $waktuNya;
                    $modelIntegration->save();
                    $step = $step + 2;
                } else {
                    $fee--;
                }
            }
            $init++;
        }
        // cek top ten table nossa
        $init = $this->findParam('E.Check', $words, $init, 11);
        $step = $init;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "NOSSA") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 3;
                    $modelTopTen = new NossaTopTenTable();
                    $modelTopTen->table_name = $words[$step];
                    $modelTopTen->rows_total = str_replace(',', '', $words[$step + 1]);
                    $modelTopTen->last_analyzed = date("Y-m-d", strtotime($words[$step + 2]));
                    $modelTopTen->save();
                    $step = $step + 3;
                } else {
                    $fee--;
                }
            }
            $init++;
        }
        // F1.Check Jumlah SESSION TOTAL DB  NOSSA
        $init = $this->findParam('COUNT(1', $words, $init, 1);
        date_default_timezone_set('Asia/Jakarta');
        $modelSessionDB = new NossaSessionDbTotal();
        $modelSessionDB->session_total = $words[$init - 1];
        $modelSessionDB->waktu = $waktuNya;
        $modelSessionDB->save();

        // F3.Check Jumlah Session User 
        $init = $this->findParam('JML_SESSION', $words, $init, 1);
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "G.Check") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 3;
                    $modelSessionUser = new NossaSessionUserTotal();
                    $modelSessionUser->session_total = $words[$init];
                    $modelSessionUser->user_total = $words[$init + 1];
                    $modelSessionUser->waktu = $waktuNya;
                    $modelSessionUser->save();
                    $step = $step + 3;
                } else {
                    $fee--;
                }
            }
            $init++;
        }

        //H.Check Jumlah Workorder Total
        $init = $this->findParam('H.Check', $words, $init, 5);
        $modelWorkOrder = new NossaWorkorderTotal();
        $modelWorkOrder->workorder_total = str_replace(',', '', $words[$init]);
        $modelWorkOrder->waktu = $waktuNya;
        $modelWorkOrder->save();
        return ExitCode::OK;
    }

    public function actionOsmqueue() {
        $html_source = SHD::file_get_html('http://cmon.telkom.co.id/cacti/noss-osm/cekorder.log');
        $data = $html_source->plaintext;

        $words = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $data, -1, PREG_SPLIT_NO_EMPTY);

        $wkt = $words[9] . " " . $words[10];
        date_default_timezone_set('Asia/Jakarta');
        $waktuNya = date('Y-m-d H:i:s', strtotime($wkt));

        $init = 19;
        $start = $init;
        $limit = 2000;

        $step = $init;
        $fee = 0;

        $ketemu = FALSE;
        $stop = 200;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($stop == $init) {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 4;

                    if ($words[$step + 1] != "rows") {
//                        echo $words[$step] . "|" . $words[$step + 1] . "|" . $words[$step + 2] . "|" . $waktuNya . "||";
                        echo $words[$step+1] . "|";
                        $modelNossfOsmQueue = new NossfOsmOrderQueue();
                        $modelNossfOsmQueue->flow = $words[$step];
                        $modelNossfOsmQueue->task_description = $words[$step + 1];
                        $modelNossfOsmQueue->queued = $words[$step + 2];
                        $modelNossfOsmQueue->waktu = $waktuNya;
                        $modelNossfOsmQueue->save();
                    }
                    $step = $step + 4;
                } else {
                    $fee--;
                }
            }
            $init++;
        }

        return ExitCode::OK;
    }

    public function actionUim() {
        $html_source = SHD::file_get_html('http://cmon.telkom.co.id/cacti/noss-uim/cekdb.log');
        $data = $html_source->plaintext;
        $words = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $data, -1, PREG_SPLIT_NO_EMPTY);
        $limit = 2000;
        $init = 0;

        $wkt = $words[8] . " " . $words[9];
        date_default_timezone_set('Asia/Jakarta');
        $waktuNya = date('Y-m-d H:i:s', strtotime($wkt));

        //E.Check TOP 10 TABLE WITH TOP ROWS:
        $init = 0;
        $init = $this->findParam('E.Check', $words, $init, 10);

        $step = $init;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "Group") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 3;

                    $modelNossfUimTopten = new NossfUimTopTen();
                    $modelNossfUimTopten->table_name = $words[$step];
                    $modelNossfUimTopten->rows_total = str_replace(',', '', $words[$step + 1]);
                    $modelNossfUimTopten->last_analyzed = date("Y-m-d", strtotime($words[$step + 2]));
                    $modelNossfUimTopten->save();

                    $step = $step + 3;
                } else {
                    $fee--;
                }
            }
            $init++;
        }

        //F.Check Free ASM Disk Group:
        $init = $init + 5;

        //Get Data
        $step = $init;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "Total") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 4;
                    if (strpos($words[$step + 1], ".") != TRUE) {
                        $words[$step + 1] = "0." . $words[$step + 1];
                    }

                    $modelNossfUimAsm = new NossfUimAsm();
                    $modelNossfUimAsm->asm_name = $words[$step];
                    $modelNossfUimAsm->free_asm = $words[$step + 1];
                    $modelNossfUimAsm->total_asm = $words[$step + 2];
                    $modelNossfUimAsm->waktu = $waktuNya;
                    $modelNossfUimAsm->save();

                    $step = $step + 4;
                } else {
                    $fee--;
                }
            }
            $init++;
        }

        $init = $init + 5;

        //G. Check Status Tablespace (%Free terkecil):
        $step = $init;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "Check") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 4;

                    $modelNossfUimTablespace = new NossfUimTablespace();
                    $modelNossfUimTablespace->tablespace_name = $words[$step];
                    $modelNossfUimTablespace->free_tablespace = $words[$step + 1];
                    $modelNossfUimTablespace->total_tablespace = $words[$step + 2];
                    $modelNossfUimTablespace->waktu = $waktuNya;
                    $modelNossfUimTablespace->save();

                    $step = $step + 4;
                } else {
                    $fee--;
                }
            }
            $init++;
        }

//        H. Check Jumlah Session Active dari server-server UIM:
//        limit nya cuma 20
        $init = $init + 9;

        $step = $init;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "SQL_TEXT") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 2;

                    $modelNossfSessionServer = new NossfUimSessionServer();
                    $modelNossfSessionServer->machine_name = $words[$step];
                    $modelNossfSessionServer->session_total = $words[$step + 1];
                    $modelNossfSessionServer->waktu = $waktuNya;
                    $modelNossfSessionServer->save();

                    $step = $step + 2;
                } else {
                    $fee--;
                }
            }
            $init++;
        }

        return ExitCode::OK;
    }

    public function actionOsm() {
        $html_source = SHD::file_get_html('http://cmon.telkom.co.id/cacti/noss-osm/cekdb.log');
        $data = $html_source->plaintext;
        $words = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $data, -1, PREG_SPLIT_NO_EMPTY);
        $limit = 2000;
        $init = 0;

        $wkt = $words[8] . " " . $words[9];
        date_default_timezone_set('Asia/Jakarta');
        $waktuNya = date('Y-m-d H:i:s', strtotime($wkt));

        $init = $this->findParam('E.Check', $words, $init, 10);
//        echo $words[$init];

        $step = $init;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "DB") {
                $ketemu = TRUE;
                // echo $init;
            } else {
                if ($fee == 0) {
                    $fee = 3;

                    $date = strtotime($words[$step + 2]);
                    $date = date('Y-m-d', $date);
                    $row_total = str_replace(',', '', $words[$step + 1]);
                    $insert = $database->insert("top_table", [
                        "table_name" => $words[$step],
                        "date" => $date,
                        "row_total" => $row_total
                    ]);
                    $step = $step + 3;
                } else {
                    $fee--;
                }
            }
            $init++;
        }
        return ExitCode::OK;
    }

    public function actionNossadb() {
        $html_source = SHD::file_get_html('http://cmon.telkom.co.id/cacti/nossa/ceksess.log');
        $data = $html_source->plaintext;
        $words = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $data, -1, PREG_SPLIT_NO_EMPTY);
        $limit = 2000;
        $init = 16;

        // nossa session appl
        $step = $init;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "STATUS") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 5;
                    $wkt = $words[$step] . " " . $words[$step + 1];
                    $waktuNya = date('Y-m-d H:i:s', strtotime($wkt));

                    $modelNossaSessionAppl = new NossaSessionAppl();
                    $modelNossaSessionAppl->server_name = $words[$step + 2];
                    $modelNossaSessionAppl->session_total = $words[$step + 3];
                    $modelNossaSessionAppl->status = $words[$step + 4];
                    $modelNossaSessionAppl->waktu = $waktuNya;
                    $modelNossaSessionAppl->save();

                    $step = $step + 5;
                } else {
                    $fee--;
                }
            }
            $init++;
        }

        $fee = 0;
        $sum = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($sum == 49) {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 5;
                    $wkt = $words[$step] . " " . $words[$step + 1];
                    $waktuNya = date('Y-m-d H:i:s', strtotime($wkt));

                    $modelNossaSessionAppl = new NossaSessionAppl();
                    $modelNossaSessionAppl->server_name = $words[$step + 2];
                    $modelNossaSessionAppl->session_total = $words[$step + 3];
                    $modelNossaSessionAppl->status = $words[$step + 4];
                    $modelNossaSessionAppl->waktu = $waktuNya;
                    $modelNossaSessionAppl->save();

                    $step = $step + 5;
                } else {
                    $fee--;
                }
            }
            $init++;
            $sum++;
        }


        // nossa session db 
        $step = $init - 50;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "selected") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 6;
                    $wkt = $words[$step] . " " . $words[$step + 1];
                    $waktuNya = date('Y-m-d H:i:s', strtotime($wkt));
//                    echo $waktuNya . "|" . $words[$step + 2] . "|" . $words[$step + 3] . "|" . $words[$step + 4] . "|" . $words[$step + 5] . "]" ;
//                    echo $waktuNya . "|" . $words[$step + 2] . "|" . $words[$step + 3] . "|" . $words[$step + 4] . "|" . $words[$step + 5] . "|" ;

                    $modelNossaSessionDB = new NossaSessionDb();
                    $modelNossaSessionDB->machine_name = $words[$step + 3];
                    $modelNossaSessionDB->inst_id = $words[$step + 2];
                    $modelNossaSessionDB->session_total = $words[$step + 4];
                    $modelNossaSessionDB->status = $words[$step + 5];
                    $modelNossaSessionDB->waktu = $waktuNya;

                    $modelNossaSessionDB->save();

//                    $modelNossaSessionAppl = new NossaSessionAppl();
//                    $modelNossaSessionAppl->server_name = $words[$step + 2];
//                    $modelNossaSessionAppl->session_total = $words[$step + 3];
//                    $modelNossaSessionAppl->status = $words[$step + 4];
//                    $modelNossaSessionAppl->waktu = $waktuNya;
//                    $modelNossaSessionAppl->save();

                    $step = $step + 6;
                } else {
                    $fee--;
                }
            }
            $init++;
        }

//        $fee = 0;
//        $sum = 0;
//        $ketemu = FALSE;
//        while (($ketemu == FALSE) && ($init != $limit)) {
//            if ($sum == 110) {
//                $ketemu = TRUE;
//            } else {
//                if ($fee == 0) {
//                    $fee = 5;
//                    $wkt = $words[$step] . " " . $words[$step + 1];
//                    $waktuNya = date('Y-m-d H:i:s', strtotime($wkt));
//                    echo $waktuNya . "|" . $words[$step + 2] . "|" . $words[$step + 3] . "|" . $words[$step + 4] . "|" . $words[$step + 5] .  "]";
//                    $modelNossaSessionDB = new NossaSessionDb();
//                    $modelNossaSessionDB->machine_name = $words[$step + 2];
//                    $modelNossaSessionDB->inst_id = $words[$step + 3];
//                    $modelNossaSessionDB->session_total= $words[$step + 4];
//                    $modelNossaSessionDB->status = $words[$step + 5];
//                    $modelNossaSessionDB->waktu = $waktuNya;
////                    $modelNossaSessionDB->save();
//
////                    $modelNossaSessionAppl = new NossaSessionAppl();
////                    $modelNossaSessionAppl->server_name = $words[$step + 2];
////                    $modelNossaSessionAppl->session_total = $words[$step + 3];
////                    $modelNossaSessionAppl->status = $words[$step + 4];
////                    $modelNossaSessionAppl->waktu = $waktuNya;
////                    $modelNossaSessionAppl->save();
//
//                    $step = $step + 5;
//                } else {
//                    $fee--;
//                }
//            }
//            $init++;
//            $sum++;
//        }
        // nossa session DB
        return ExitCode::OK;
    }

    function actionNossadbcheck() {
        $html_source = SHD::file_get_html('http://cmon.telkom.co.id/cacti/nossa/cekdb.log');
        $data = $html_source->plaintext;
        $words = preg_split("/[^\w]*([\s]+[^\w]*|$)/", $data, -1, PREG_SPLIT_NO_EMPTY);
        $limit = 2000;
        $init = 20;

        $step = $init;
        $fee = 0;
        $ketemu = FALSE;
        while (($ketemu == FALSE) && ($init != $limit)) {
            if ($words[$init] == "B.Check") {
                $ketemu = TRUE;
            } else {
                if ($fee == 0) {
                    $fee = 6;

                    $wkt = $words[$step + 3]." ".$words[$step + 4];
                    date_default_timezone_set('Asia/Jakarta');
                    $waktuNya = date('Y-m-d H:i:s', strtotime($wkt));
                    $modelNossaDBStatus = new NossaDbStatus();
                    $modelNossaDBStatus->instance_name = $words[$step + 1];
                    $modelNossaDBStatus->hostname = $words[$step + 2];
                    $modelNossaDBStatus->uptime = $waktuNya;
                    $modelNossaDBStatus->status = $words[$step + 5];
                    $modelNossaDBStatus->save();
                    $step = $step + 6;
                } else {
                    $fee--;
                }
            }
            $init++;
        }
    }

}
