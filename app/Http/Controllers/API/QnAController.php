<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ResponseMessage;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class QnAController extends Controller
{
  public function index()
  {
    $data = DB::connection('mysql_bot')->table('message')
      ->join('user', 'user.id', '=', 'message.user_id')
      ->select(
        'message.id AS message_id',
        "user.first_name",
        "user.last_name",
        "user.email",
        "message.text AS message_text",
        "message.reply_markup AS jawaban",
        "message.date AS message_date"
      )
      ->whereRaw("message.text is not null AND message.text NOT LIKE '/%' AND message.text NOT LIKE '%@%'")
      ->paginate(5);

    foreach ($data as $ele) {
      $ele->fullname = $ele->first_name . " " . $ele->last_name;
      $strArr = explode(' ', trim($ele->message_text));
      $ele->message_text = $strArr[0] . ' ...';
      $ele->message_date = date_format(DateTime::createFromFormat('Y-m-d H:i:s', $ele->message_date), 'l, d F Y H:i:s');
    }
    return view('qna.index', compact('data'));
  }

  public function show($id)
  {
    $resmsg = new ResponseMessage();
    try {
      if (preg_match("/[a-zA-Z]/", $id)) throw new Exception("Data Tidak Valid");

      $data = DB::connection('mysql_bot')->table('message')
        ->join('user', 'user.id', '=', 'message.user_id')
        ->select(
          'message.id AS message_id',
          "user.first_name",
          "user.last_name",
          "user.email",
          "message.text AS message_text",
          "message.reply_markup AS jawaban",
          "message.date AS message_date"
        )
        ->whereRaw("message.text is not null AND message.text NOT LIKE '/%' AND message.text NOT LIKE '%@%' AND message.id=" . $id)->first();
      if (empty($data)) throw new Exception("Tidak Ada Data", 0);
      $data->fullname = $data->first_name . " " . $data->last_name;
      return response()->json($data);
    } catch (Exception $ex) {
      $resmsg->code = $ex->getCode();
      $resmsg->message = $ex->getMessage();
      return response()->json($resmsg);
    }
  }
}
