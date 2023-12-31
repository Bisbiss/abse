<?php

namespace App\Controllers;


class Telegram extends BaseController
{

    function send($image, $caption)
    {
        $chatId = '1146265784';

        $curl = curl_init();
        // $photo = 'https://absensi.mawedding.my.id/assets/absen/capture/'.$image;
        $photo = 'https://picsum.photos/200';

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.telegram.org/bot6406105621:AAFMQNcRcZi6bbqKgooaHqORzhx1BWmaLW0/sendPhoto',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'chat_id' => $chatId,
            'photo' => $photo,
            'caption'=> $caption),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}